<?php
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
 

// retrieve the table and key from the path
$service = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$temperature = array_shift($request)+0;
 


function CelsiusToFahrenheit($celsius) {
    $fahrenheit = (($celsius * 9) / 5) + 32;
    return $fahrenheit;
}

function FahrenheitToCelsius($fahrenheit) {
    $celsius = (($fahrenheit - 32) * 5) / 9;
    return $celsius;
}
 

if ($service == "CelsiusToFahrenheit") {
    $json = array();

    $convert = CelsiusToFahrenheit($temperature);

    $temp = array(
        'celsius' => $convert
    );
    array_push($json, $temp);

    $jsonString = json_encode($temp);
    echo $jsonString;
}

if ($service == "FahrenheitToCelsius") {
    $json = array();

    $convert = FahrenheitToCelsius($temperature);

    $temp = array(
        'fahrenheit' => $convert
    );
    array_push($json, $temp);

    $jsonString = json_encode($temp);
    echo $jsonString;
}
 
