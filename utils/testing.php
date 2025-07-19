<?php

    namespace Minerva\Testing;

    require_once 'responses/success.php';
    require_once 'responses/fail.php';
    require_once 'classes/DataFetcher.php';

    $historianPort = 8291;
    $connectorPort = 8292;
    
    use Exception;
    use Minerva\Testing\Responses\MinervaResponseSuccess;
    use Minerva\Testing\Responses\MinervaResponseFail;
    use Minerva\Testing\DataFetcher;

    /**
     * @brief Delete a user from minerva
     * @param string $username The username to delete
    */
    function minerva_service_heartbeats(string $url): array {
        // Acquire Globals
        global $historianPort;
        global $connectorPort;

        $dataFetcher = new DataFetcher();

        // Define endpoints
        $endpoints = [
            'historian' => "http://" . $url . ":" . $historianPort . '/',
            'connector' => "http://" . $url . ":" . $connectorPort . '/',
        ];

        $responses = [];

        foreach ($endpoints as $service => $endpoint) {
            try {
                $response = $dataFetcher->get($endpoint);
                $responses[$service] = $response;
            } catch (Exception $e) {
                $fail = new MinervaResponseFail();
                $fail->code = 500;
                $fail->message = "Failed to fetch data from " . $service . ": " . $e->getMessage();    
                $responses[$service] = $fail->json();
            }
        }
        
        $successResponse = new MinervaResponseSuccess();
        $successResponse->data = $responses;
        
        return $successResponse->json();
        
}