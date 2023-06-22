<?php
class Model
{
    
    public $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function getData($url)
    {
        $ch = curl_init($url);
        $headers = array(
            'Content-Type: application/json'
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    function sendData($url, $data, $method){
        // Configuración de la solicitud cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Envío de solicitud cURL y captura de respuesta
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_error($ch);

        // Comprobación de respuesta y encabezados
        if ($response === false || $info['http_code'] !== 200) {
            echo 'Error: ' . $error;
        } else {
            $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            if ($content_type !== 'application/json') {
                echo 'Error: Respuesta incorrecta Content-Type';
            } else {
                $data = json_decode($response, true);
                // procesar los datos recibidos
            }
        }

        // Limpiar cURL
        curl_close($ch);
        return $data;
    }

}
