<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GlamController extends Controller
{
    public function index()
    {
        // Cache selama 24 jam (1440 menit)
        $glamData = Cache::remember('glam_locations', 1440, function () {
            return $this->fetchGlamData();
        });
        
        return Inertia::render('GlamTerbuka', [
            'glamLocations' => $glamData,
            'totalLocations' => count($glamData)
        ]);
    }
    
    private function fetchGlamData()
    {
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
                    
                    if ($coord) {
                        $wikidataId = basename($result['museum']['value'] ?? '');
                        
                        $glamData[] = [
                            'name' => $result['museumLabel']['value'] ?? 'Unknown',
                            'wd' => $wikidataId,
                            'lat' => $coord['lat'],
                            'lng' => $coord['lng'],
                            'img' => $result['img']['value'] ?? null,
                            'wp' => $result['sitelink']['value'] ?? null,
                        ];
                    }
                }
            }
            
            return $glamData;
            
        } catch (\Exception $e) {
            return [];
        }
    }
}