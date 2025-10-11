<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class GlamController extends Controller
{
    public function index()
    {
        // Query SPARQL untuk Wikidata
        $sparqlQuery = <<<'SPARQL'
SELECT distinct ?museum ?museumLabel (SAMPLE(?coordinate_location) AS ?coord) (SAMPLE(?img) AS ?img) ?sitelink
WHERE {
  SERVICE wikibase:label { bd:serviceParam wikibase:language "id". }
  VALUES ?glam {wd:Q33506 wd:Q7075 wd:Q166118 wd:Q1007870}
  ?museum wdt:P31|wdt:P31/wdt:P279* ?glam;
    wdt:P17 wd:Q252.
  OPTIONAL { ?museum wdt:P625 ?coordinate_location. }
  OPTIONAL { ?museum wdt:P18 ?img. }
  OPTIONAL { ?sitelink schema:about ?museum;
                       schema:isPartOf <https://id.wikipedia.org/>.}
}
GROUP BY ?museum ?museumLabel ?sitelink
SPARQL;

        try {
            // Request ke Wikidata Query Service
            $response = Http::withHeaders([
                'Accept' => 'application/sparql-results+json',
                'User-Agent' => 'WikimediaIndonesia/1.0'
            ])->get('https://query.wikidata.org/sparql', [
                'query' => $sparqlQuery
            ]);

            $glamData = [];
            
            if ($response->successful()) {
                $results = $response->json()['results']['bindings'] ?? [];
                
                foreach ($results as $result) {
                    // Parse koordinat dari format "Point(longitude latitude)"
                    $coord = null;
                    if (isset($result['coord']['value'])) {
                        preg_match('/Point\(([-\d.]+) ([-\d.]+)\)/', $result['coord']['value'], $matches);
                        if (count($matches) === 3) {
                            $coord = [
                                'lng' => floatval($matches[1]),
                                'lat' => floatval($matches[2])
                            ];
                        }
                    }
                    
                    if ($coord) { // Hanya ambil yang punya koordinat
                        $glamData[] = [
                            'name' => $result['museumLabel']['value'] ?? 'Unknown',
                            'wikidata' => $result['museum']['value'] ?? null,
                            'coord' => $coord,
                            'image' => $result['img']['value'] ?? null,
                            'wikipedia' => $result['sitelink']['value'] ?? null,
                        ];
                    }
                }
            }
            
            return Inertia::render('GlamTerbuka', [
                'glamLocations' => $glamData,
                'totalLocations' => count($glamData)
            ]);
            
        } catch (\Exception $e) {
            // Fallback jika error
            return Inertia::render('GlamTerbuka', [
                'glamLocations' => [],
                'totalLocations' => 0,
                'error' => 'Gagal memuat data dari Wikidata'
            ]);
        }
    }
}