<?php

class Api {
    protected string $api_key;

    function __construct(string $api_key) {
        $this->api_key = $api_key;
    }

    public function send_request(string $prompt): string {
        return "";
    }
}

class ChatGPTApi extends Api {
    public function send_request(string $prompt): string {
        $url = 'https://api.openai.com/v1/chat/completions';

        $data = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'user', 
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.7
        ];
        
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $answere = 'Errore nella richiesta: ' . curl_error($ch);
        } else {
            $response_data = json_decode($response, true);
            print_r($response_data);
            $answere = $response_data['choices'][0]['message']['content'];
        }

        curl_close($ch);
        return $answere;
    }
}

class UnsplashApi extends Api {
    public function send_request(string $prompt): string {
        //TODO: implement this
        return "";
    }
}