<?php

namespace codephix\Asaas;

class Connection {
    
    public $http;
    public $api_key;
    public $api_key_live;
    public $api_status;
    public $base_url;
    public $headers;

    public function __construct() {
        $this->api_key = PAYMENT['asaas']['chave'];
        $this->api_key_live = PAYMENT['asaas']['chavelivre'];
        $this->api_status = PAYMENT['asaas']['status'];
        $this->base_url = "https://" . ((PAYMENT['asaas']['status']) ? 'sandbox' : 'www');
        return $this;
    }


    public function get($url, $option = false, $custom = false )
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url .'.asaas.com/api/v3'. $url."?".$option);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        if(!empty($custom)){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: ".(($this->api_status == 1) ? $this->api_key_live : $this->api_key)
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        //$response = $this->http->request('GET', $this->base_url . $url);

        return $response;
    }
    
    public function post($url, $params)
    {
        $params = json_encode($params);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->base_url .'.asaas.com/api/v3'. $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: ".(($this->api_status == 1) ? $this->api_key_live : $this->api_key)
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;

    }
    
}