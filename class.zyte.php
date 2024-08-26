<?php

class ZyteExtractor {
    private $apiUrl = 'https://api.zyte.com/v1/extract';
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    private function makeRequest($params) {
        $ch = curl_init($this->apiUrl);

        $json_data = json_encode($params);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_USERPWD => $this->apiKey . ':',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept-Encoding: gzip'
            ],
            CURLOPT_ENCODING => '',
        ]);

        $response = curl_exec($ch);

        if(curl_errno($ch)){
            throw new Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response);
    }

    public function getRawHTML($url) {
        $params = [
            'url' => $url,
            'httpResponseBody' => true,
        ];

        $data = $this->makeRequest($params);

        return base64_decode($data->httpResponseBody);
    }

    public function getScreenshot($url) {
        $params = [
            'url' => $url,
            'screenshot' => true,
        ];

        $data = $this->makeRequest($params);

        return base64_decode($data->screenshot);
    }

    public function getRenderedHTML($url) {
        $params = [
            'url' => $url,
            'browserHtml' => true,
        ];

        $data = $this->makeRequest($params);

        return $data->browserHtml;
    }
}

?>