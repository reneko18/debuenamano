<?php

if (!function_exists('sanitizeString')) {
    function sanitizeString($string) {
        $unwantedArray = [
            'ñ' => 'n', 'Ñ' => 'N', 
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 
            '/' => ''
        ];
        return strtr($string, $unwantedArray);
    }
}
