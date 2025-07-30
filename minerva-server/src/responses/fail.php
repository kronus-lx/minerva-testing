<?php

    namespace Minerva\Testing\Responses;
    
    class MinervaResponseFail  {
        /**
         * @brief The response code
         */
        public int $code = 400;

        /**
         * @brief The response message
         */
        public string $message = "Error";

        /**
         * @brief The response data
         */
        public array $data = [];

        /**
         * @brief Return JSON Encoded Array
         */
        public function json() : array {
            return [
                "code" => $this->code,
                "message" => $this->message,
                "data" => $this->data,
            ];
        }
    }