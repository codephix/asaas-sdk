<?php

namespace CodePhix\Asaas;


class Pix {
    //
    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    //https://www.asaas.com/api/v3/payments/id/pixQrCode

    //Retorna informação via Pix, para conta com liberação.
    public function create($id)
    {

        $resturn = $this->http->get('/payments/'.$id.'/pixQrCode');
        if(!empty($resturn->encodedImage)){
            $resturn->success = 1;
            return $resturn;
        }else{
            return $resturn;
        }

        /*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/pixQrCode/createAsaasPaymentQrCode/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        if(!empty($custom)){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        //$response = $this->http->request('GET', $this->base_url . $url);

        return $response;*/
    }

    //Retorna informação via Pix, para conta com liberação.
    public function get($id)
    {

        $id = str_replace('pay_','',$id);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/payment/isReceivedPayment/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        if(!empty($custom)){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        //$response = $this->http->request('GET', $this->base_url . $url);

        return $response;
    }

    // Retorna a listagem de cobranças
    public function getAll(array $filtros = []){
        $filtro = '';
        if(is_array($filtros)){
            if($filtros){
                foreach($filtros as $key => $f){
                    if(!empty($f)){
                        if($filtro){
                            $filtro .= '&';
                        }
                        $filtro .= $key.'='.$f;
                    }
                }
                $filtro = '?'.$filtro;
            }
        }
        return $this->http->get('/pix/transactions'.$filtro);
    }

    public function getAllAddressKeys(?array $filtros = []){
        $filtros = ((!empty($filtros)) ? http_build_query($filtros) : '');
        return $this->http->get('/pix/addressKeys?'.$filtros);
    }

    public function getKeys($id){
        return $this->http->get('/pix/addressKeys/'.$id);
    }

    public function addressKeys($type = 'EVP'){
        $dados = [
            'type' => $type,
        ];
        return $this->http->post('/pix/addressKeys',$dados);
    }
    public function deleteKeys($id){
        return $this->http->delete('/pix/addressKeys/'.$id);
    }
    public function qrCodeStatic(?array $dados){
        return $this->http->post('/pix/qrCodes/static',$dados);
    }

}
