<?php
$wsdl = "http://10.245.7.74/yiiws/wssikka/index.php?r=wssikka/wsdl";
$username = "wssikka";
$password = "Wssikka20140117";
$options = array(
     'login' => $username,
     'password' => $password
);
$client = new SoapClient($wsdl, $options);
$params = [
      'nik' => "1671102505860012"
    ];
$result = $client->cekPegawaiFromNIK(array('param' => $params));
// print_r($client->cekPegawaiFromNIK->($params));
// echo '<pre>';
// print_r($client->__getFunctions());
// echo '</pre>';


// $sc = new SoapClient($wsdl, $options);
// $params = array('nik' => '1671102505860012');
// $result = $sc->__soapCall('cekPegawaiFromNIK', array('parameters' => $params));

echo '<pre>';

if (is_soap_fault($result)) 
{
    trigger_error("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})", E_USER_ERROR);
}
else {
	print_r($result);
}


// print_r($result);
// echo '<br/>';
// print_r ($result->cekPegawaiFromNIKResult->nm_peg);
// echo '<br/>';
// print_r ($result->cekPegawaiFromNIKResult);

echo '</pre>';