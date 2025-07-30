<?php
    namespace Minerva\Testing\Responses;
    
    class MinervaResponseSuccess {
        /**
         * @brief The response code
         */
        public int $code = 200;

        /**
         * @brief The response message
         */
        public string $message = "Success";

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