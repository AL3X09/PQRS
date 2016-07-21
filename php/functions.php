<?php

class functions {

    private $method;

    public function __construct() {
        
    }

    private function buildJson($data, $response, $message) {
        $json = "{'response':'" . $response . "', 'message':'" . $message . "', 'data':'" . $data . "'}";
        return $json;
    }

    public function getRealIp() {

        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    public function getValue($array, $id, $url) {

        foreach ($array as $key => $value) {// Se recorre cada registro del arreglo
            //echo $keyValue . "=>". $value1."<br>";        
            if ($key == $id) {
                $json = $this->getJson($url . "?id=" . $array[$id]);
            }
        }
        return $json;
    }

    public function validateRequestParameter($item, $parameterUrl) {
        if (isset($_REQUEST[$parameterUrl]) && is_numeric($_REQUEST[$parameterUrl])) {
            return "\r\n  \"$item\": $_REQUEST[$parameterUrl]";
        } else if (isset($_REQUEST[$parameterUrl]) && is_string($_REQUEST[$parameterUrl])) {
            return "\r\n  \"$item\": \"$_REQUEST[$parameterUrl]\"";
        }
        return "\r\n  \"$item\": null";
    }

    public function concatComma($value) {
        if (!is_null($value)) {
            return $value . ",";
        }
        return $value;
    }

}

new functions();
