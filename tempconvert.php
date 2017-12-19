<?php
require_once('lib/nusoap.php');
 
$server = new nusoap_server;
 
$server->configureWSDL('TempConvert', 'urn:TempConvert');
 
$server->wsdl->schemaTargetNamespace = 'urn:TempConvert';

//first simple function
$server->register('CelsiusToFahrenheit',
			array('temp' => 'xsd:double'),  //parameter
			array('return' => 'xsd:double'),  //output
			'urn:TempConvert',   //namespace
			'urn:TempConvert#CelsiusToFahrenheit',  //soapaction
			'rpc', // style
			'encoded', // use
			'CelsiusToFahrenheit');  //description

$server->register('FahrenheitToCelsius',
            array('temp' => 'xsd:double'),  //parameter
            array('return' => 'xsd:double'),  //output
            'urn:TempConvert',   //namespace
            'urn:TempConvert#FahrenheitToCelsius',  //soapaction
            'rpc', // style
            'encoded', // use
            'FahrenheitToCelsius');  //description

function CelsiusToFahrenheit($celsius) {
    $fahrenheit = (($celsius * 9) / 5) + 32;
    return $fahrenheit;
}

function FahrenheitToCelsius($fahrenheit) {
    $celsius = (($fahrenheit - 32) * 5) / 9;
    return $celsius;
}
 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);