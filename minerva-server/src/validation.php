<?php   

    namespace Minerva\Testing;

    $REQUEST_TYPE_PERMITTED = "";
    
    function permitRequest(string $request): void {
        global $REQUEST_TYPE_PERMITTED;
        $REQUEST_TYPE_PERMITTED = $request;
    }

    /**
     * @brief Check if the request method is allowed
     * @param string $request The request method to check
     */
    function checkRequest(string $request): void{
        global $REQUEST_TYPE_PERMITTED;
        if($REQUEST_TYPE_PERMITTED != $request || empty($request)){
            http_response_code(405);
            exit(json_encode([
                'error' => 'Method Not Allowed'
            ]));
        }
    }

    /**
     * @brief Check if a string is valid
     * @param string $input The input string to check
     */
    function checkString(string $input): void {
        if (empty($input) || !is_string($input)) {
            http_response_code(400);
            exit(json_encode([
                'error' => 'Invalid input: String expected.'
            ]));
        }
    }