<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class DataController extends Controller
{
    public function retrieveData()
    {
        $url = "https://www.bls.gov/news.release/eci.t01.htm";

        try {
            $client = new Client();
            $response = $client->get($url);

        if ($response->getStatusCode() == 200) {
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);

            //Using the crawler to extract and process the data from the HTML
            $data = [
                'example_key' => 'example_value'
            ];

            return response()->json($data);
        } else {
            return response()->json(['error' => 'Failed to retrieve data']);
        }
    }
    } catch (\Exception $e) {
    // Log the exception message or error details
    \Log::error($e->getMessage());
    return response()->json(['error' => 'An error occurred']);
}
