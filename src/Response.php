<?php
declare(strict_types=1);

namespace QtrBk;

use FFI;

/**
 * Class Response
 * @package QtrBk
 */
class Response
{
    public $cStruct;

    public function __construct($cStruct)
    {
        $this->cStruct = $cStruct;
    }

    public function __destruct()
    {
       FFI::free($this->cStruct);
    }

    public function xml()
    {
        return $this->cStruct->response;
    }

    public function json()
    {
        $xml = simplexml_load_string($this->cStruct->response);
        return json_encode($xml);
    }

    public function getError()
    {
        return $this->cStruct->error;
    }

    public function isOk()
    {
        return $this->cStruct->err === 0;
    }
}