<?php
    require_once("lib/nusoap.php");
    $server = new soap_server();
    $server->configureWSDL("PLATO WSDL ","urn:PLATO WSDL ");
    
    function healthCheck() {
        return "<status>good</status>";
    }

    function gethelloworld($name) {
        $myname = "My Name Is <b>".$name . "</b>";
        return $myname;
    }

    function getProd($category) {
        if ($category == "books") {
            return join(",", array(
                "The WordPress Anthology",
                "PHP Master: Write Cutting Edge Code",
                "Build Your Own Website the Right Way"));
        }
        else {
                return "No products listed under that category";
        }
    }

    $server->register("gethelloworld",
        array("name" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:autoClass",
        "urn:autoClass#gethelloworld");

    $server->register("getProd",
        array("product" => "xsd:string"),
        array("products" => "xsd:string"),
        "urn:autoClass",
        "urn:autoClass#getProd");

    $server->register("healthCheck",
        array(),
        array("health" => "xsd:string"),
        "urn:autoClass",
        "urn:autoClass#getProd");
    
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);
?>


