<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RefreshGlamCache extends Command
{
    protected $signature = 'glam:refresh';
    protected $description = 'Refresh GLAM locations cache from Wikidata';

    public function handle()
    {
        $this->info('🔄 Fetching GLAM data from Wikidata...');
        
        try {
            $glamData = $this->fetchGlamData();
            
            if (empty($glamData)) {
                $this->error('❌ No data received from Wikidata');
                return Command::FAILURE;
            }
            
            // Simpan ke cache
            Cache::put('glam_locations', $glamData, now()->addHours(24));
            Cache::put('glam_locations_backup', $glamData, now()->addDays(7));
            
            $this->info("✅ Successfully cached " . count($glamData) . " locations");
            
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('❌ Failed: ' . $e->getMessage());
            $this->error('Line: ' . $e->getLine());
            $this->error('File: ' . $e->getFile());
            Log::error('GLAM refresh failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return Command::FAILURE;
        }
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
            LIMIT 100
        SPARQL;

        $this->info('📡 Connecting to Wikidata SPARQL endpoint...');

        $response = Http::timeout(60)
            ->retry(3, 1000)
            ->withHeaders([
                'Accept' => 'application/sparql-results+json',
                'User-Agent' => 'WikimediaIndonesia/1.0'
            ])
            ->get('https://query.wikidata.org/sparql', [
                'query' => $sparqlQuery
            ]);

        if (!$response->successful()) {
            throw new \Exception('Wikidata API returned status: ' . $response->status());
        }

        $json = $response->json();
        
        if (!isset($json['results']['bindings'])) {
            throw new \Exception('Invalid response structure from Wikidata');
        }
        
        $results = $json['results']['bindings'];
        
        $this->info('📦 Received ' . count($results) . ' results from Wikidata');
        
        if (empty($results)) {
            throw new \Exception('No results from Wikidata');
        }

        $glamData = [];
        $skipped = 0;
        
        $bar = $this->output->createProgressBar(count($results));
        $bar->start();
        
        foreach ($results as $index => $result) {
            try {
                // Parse museum URL
                if (!isset($result['museum']['value'])) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }
                
                $museumUrl = $result['museum']['value'];
                $wikidataId = basename($museumUrl);
                
                // Parse name
                $name = $result['museumLabel']['value'] ?? 'Unknown';
                
                // Parse coordinates
                $coord = null;
                if (isset($result['coord']['value'])) {
                    $coordValue = $result['coord']['value'];
                    
                    // Pastikan ini string
                    if (is_string($coordValue)) {
                        $coord = $this->parseCoordinates($coordValue);
                    }
                }
                
                // Skip jika tidak ada koordinat
                if (!$coord) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }
                
                // Parse image
                $img = null;
                if (isset($result['img']['value']) && is_string($result['img']['value'])) {
                    $img = $result['img']['value'];
                }
                
                // Parse Wikipedia link
                $wp = null;
                if (isset($result['sitelink']['value']) && is_string($result['sitelink']['value'])) {
                    $wp = $result['sitelink']['value'];
                }
                
                $glamData[] = [
                    'name' => $name,
                    'wd' => $wikidataId,
                    'lat' => $coord['lat'],
                    'lng' => $coord['lng'],
                    'img' => $img,
                    'wp' => $wp,
                ];
                
            } catch (\Exception $e) {
                // Log error tapi tetap lanjut
                $this->warn("⚠️  Skipped item {$index}: " . $e->getMessage());
                $skipped++;
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        
        if ($skipped > 0) {
            $this->warn("⚠️  Skipped {$skipped} items (no coordinates or errors)");
        }
        
        return $glamData;
    }
    
    private function parseCoordinates(?string $coordString): ?array
    {
        if (!$coordString || !is_string($coordString)) {
            return null;
        }
        
        // Format: Point(longitude latitude)
        if (preg_match('/Point\(([-\d.]+)\s+([-\d.]+)\)/', $coordString, $matches)) {
            return [
                'lng' => (float) $matches[1],
                'lat' => (float) $matches[2]
            ];
        }
        
        return null;
    }
}