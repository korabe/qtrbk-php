<?php

require "vendor/autoload.php";

use QtrBk\QtrBk;

$qtrbk = new QtrBk();

// XML file installed with the QuickBooks SDK
$host_query_xml = 'C:\Program Files (x86)\Intuit\IDN\QBSDK13.0\samples\xmlfiles\HostQueryRq.xml';
$qbxml_rq = file_get_contents($host_query_xml);
$qtrbk->process($qbxml_rq);

if ($qtrbk->hasErrors()) {
    echo "{$qtrbk->getQbXmlResponse()}\n";
    echo "{$qtrbk->getErrors()}\n";
    exit($qtrbk->getExitCode());
}

echo "{$qtrbk->getQbXmlResponse()}\n";