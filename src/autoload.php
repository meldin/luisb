<?php

require '../vendor/autoload.php';

use Luisb\Pse\SoapService;

$e = new SoapService();
$form = array( "bankCode"=>"1022", "bankInterface"=>"0", "returnURL"=>'https://www.google.com.co', "reference"=>"1455", "description"=>"Test", "language"=>"ES", "currency"=>"COP", "totalAmount"=>5000, "taxAmount"=>0.0, "devolutionBase"=>0.0, "tipAmount"=>0,'ipAddress'=>"182.143.213.30","userAgent"=>"Chrome","additionalData"=>"","payer"=>array("documentType"=>"CC","document"=>"12345","emailAddress"=>"aaaasdasa@adasdads.com") );
// var_dump(json_encode(($e->beginTransaction($form)),JSON_UNESCAPED_UNICODE));
//echo $e->findTransaction(1442769029);
echo json_encode($e->bankList(),JSON_PRETTY_PRINT);
