<?php namespace App\Http\Controllers;

use Log;
use Config;
use GuzzleHttp\Client;
use SoapBox\Formatter\Formatter;

class IndexController extends Controller {

    protected $client;

    public function __construct() {
        Log::info('Started fetching items');

        $username = Config::get('services.itemmaster.username');
        $password = Config::get('services.itemmaster.password');
        $endpoint = Config::get('services.itemmaster.endpoint');

        $this->client = new Client([
            'base_uri' => $endpoint,
            'headers' => [
                'username' => $username,
                'password' => $password
            ],
            'timeout' => 300,
            'synchronous' => true,
            'verify' => false
        ]);
    }

    public function index() {
        $images = null;

        $manufacturers = $this->getManufacturers();
        $manufacturers = array_slice($manufacturers, 0, 50);

        foreach($manufacturers as $manufacturer) {
            $response = $this->client->request('GET', 'item', [
                'query' => [
                    'm' => $manufacturer['id'],
                    'epf' => 200,
                    'epl' => 200,
                    'epr' => 200,
                    'ef' => 'png'
                ]
            ]);

            $itemArray = Formatter::make($response->getBody()->getContents(), Formatter::XML)->toArray();

            if(isset($itemArray['item'])) {
                if($itemArray['@attributes']['total'] > 1) {
                    foreach($itemArray['item'] as $item) {
                        $items[] = $this->buildItemArray($item);
                    }
                } else {
                    $items[] = $this->buildItemArray($itemArray['item']);
                }
            }
        }

        return view('index', compact('items'));
    }

    private function buildItemArray($itemArray) {
        return [
            'id' => $itemArray['@attributes']['id'],
            'upc' => $itemArray['upcs']['upc'],
            'name' => e($itemArray['name']),
            'brand' => e($itemArray['products']['product']['brand']),
            'manufacturer' => e($itemArray['products']['product']['manufacturer']),
            'category' => $this->buildCategory($itemArray['categories']['category']),
            'marketing_description' => $this->getFirstLine($itemArray['marketingDescription']),
            'other_description' => $this->getFirstLine($itemArray['otherDescription']),
            'images' => $this->buildImageArray($itemArray['media']['medium']),
            'status' => $itemArray['@attributes']['status'],
            'created_at' => date('Y-m-d', strtotime($itemArray['created'])),
            'updated_at' => date('Y-m-d', strtotime($itemArray['lastUpdated']))
        ];
    }

    private function buildImageArray($imageArray) {
        foreach($imageArray as $image) {
            if(isset($image['@attributes'])) {
                $items[] = [
                    'view' => $image['@attributes']['view'],
                    'mime_type' => $image['@attributes']['mimeType'],
                    'description' => $image['description'],
                    'url' => $image['url']
                ];
            } else {
                $items[] = [
                    'view' => $imageArray['@attributes']['view'],
                    'mime_type' => $imageArray['@attributes']['mimeType'],
                    'description' => $imageArray['description'],
                    'url' => $imageArray['url']
                ];
            }
        }

        return $items;
    }

    private function buildCategory($category) {
        if(is_array($category)) {
            return null;
        }

        return e($category);
    }

    private function getBrands() {
        $brands = null;

        $response = $this->client->request('GET', 'brand');

        $itemArray = Formatter::make($response->getBody()->getContents(), Formatter::XML)->toArray();

        if(isset($itemArray['brand'])) {
            foreach($itemArray['brand'] as $brand) {
                $brands[] = [
                    'id' => $brand['@attributes']['id'],
                    'name' => e($brand['name'])
                ];
            }
        }

        return $brands;
    }

    private function getManufacturers() {
        $manufacturers = null;

        $response = $this->client->request('GET', 'manufacturer');

        $itemArray = Formatter::make($response->getBody()->getContents(), Formatter::XML)->toArray();

        if(isset($itemArray['manufacturer'])) {
            foreach($itemArray['manufacturer'] as $manufacturer) {
                $manufacturers[] = [
                    'id' => $manufacturer['@attributes']['id'],
                    'name' => e($manufacturer['name'])
                ];
            }
        }

        return $manufacturers;
    }

    private function getFirstLine($string) {
        if(is_array($string)) {
            return null;
        }

        if(preg_match('/^(.*)\n/', $string, $line)) {
            $string = $line[0];
        }

        return e(trim($string));
    }

    public function __destruct() {
        Log::info('Finished fetching items');
    }

}
