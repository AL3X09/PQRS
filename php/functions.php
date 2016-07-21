<?php

/**
 * Class functions
 * Esta clase almacena metodos genericos de utileria
 * 
 * Bryan Muñoz 
 */
class functions {
    /*
     * Constructor de la clase
     * Bryan Muñoz 
     */

    public function __construct() {
        
    }

    /*
     * function getRealIp()
     * 
     * Obtiene la ip remota del ordenador desde donde se ejecuta el metodo
     * 
     * Bryan Muñoz 
     */

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

    /*
     * function validateRequestParameter()
     * 
     * Valida si exite el valor ingresado en el arreglo global $_REQUEST[]
     * Y valida si es numerico para que retorne un string para concatenar en un json
     * 
     * PARAMETROS 
     * $item -> String que identifica la posicion en el string que retorna
     * $parameterUrl -> Es la pocision a buscar en el arreglo global $_REQUEST[]
     * 
     * RETORNO 
     * String concatenado
     * 
     * Bryan Muñoz
     * 
     */

    public function validateRequestParameter($item, $parameterUrl) {
        if (isset($_REQUEST[$parameterUrl]) && is_numeric($_REQUEST[$parameterUrl])) {
            return "\r\n  \"$item\": $_REQUEST[$parameterUrl]";
        } else if (isset($_REQUEST[$parameterUrl]) && is_string($_REQUEST[$parameterUrl])) {
            return "\r\n  \"$item\": \"$_REQUEST[$parameterUrl]\"";
        }
        return "\r\n  \"$item\": null";
    }
    
    /*
     * function concatComma()
     * 
     * Concatena una coma cuando recibe un valor que NO es null
     * 
     * PARAMETROS
     * $value -> Valor al que se le va a concatenar la coma 
     *  
     * RETORNO
     * Retorna $value concatenado con una coma en caso de que NO se null
     */

    public function concatComma($value) {
        if (!is_null($value)) {
            return $value . ",";
        }
        return $value;
    }

}

new functions();
