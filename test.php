<?php
require "vendor/autoload.php";

if (!extension_loaded("ffi")) {
    throw new Exception("Could not load FFI: extension not found.");
}

use QtrBk\QBXML\Document;
use QtrBk\QBXML\HostQuery;
use QtrBk\QtrBk;

$qtrbk = new QtrBk();
$doc = new Document();
$msg = new HostQuery();

$xml = $doc->addElement($msg)
    ->render();

$response = $qtrbk->process($xml);

if ($response->isOk()) {
    echo $response->json();
} else {
    echo $response->getError();
}

//$ffi = FFI::cdef(<<<EOH
//struct qtrbk {
//    char * request;
//	const char * response;
//	const char * error;
//	int err;
//};
//char * process_request(struct qtrbk * qb);
//const struct qtrbk* create_qtrbk(const char * xml);
//
//EOH, "QtrBkLib.dll");
//
//$host_query_path = 'C:\Program Files (x86)\Intuit\IDN\QBSDK13.0\samples\xmlfiles\HostQueryRq.xml';
//$xml  = file_get_contents($host_query_path);
//$qb = $ffi->create_qtrbk($xml);
//$ffi->process_request($qb);
//echo FFI::string($qb->response);