<?php

class Api {
    private string $api_key;

    function __construct(string $api_key) {
        $this->api_key = $api_key;
    }

    public function send_request(string $prompt): array {
        return [];
    }
}

class ChatGPTApi extends Api {
    public function send_request(string $prompt): array {
        //TODO: implement this
        $link = "";
        return [];
    }
}

class UnsplashApi extends Api {
    public function send_request(string $prompt): array {
        //TODO: implement this
        return [];
    }
}