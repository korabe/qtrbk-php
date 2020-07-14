<?php
declare(strict_types=1);

namespace QtrBk;

use FFI;

/**
 * Class QtrBk
 * @package QtrBk
 */
class QtrBk
{
    const QTRBK_DLL = "QtrBkLib.dll";

    protected $ffi;

    public function __construct()
    {
        if (!extension_loaded("ffi")) {
            throw new \Exception("Could not load FFI: extension not found");
        }

        $cdef = [
            "struct qtrbk {",
            "const char * request;",
            "const char * response;",
            "const char * error;",
            "int err;",
            "};",
            "char * process_request(struct qtrbk * qb);",
            "const struct qtrbk* create_qtrbk(const char * xml);",
        ];

        $this->ffi = FFI::cdef(implode(PHP_EOL, $cdef), self::QTRBK_DLL);
    }

    /**
     * @param string $xml
     * @return Response
     */
    public function process(string $xml): Response
    {
        $request = $this->ffi->create_qtrbk($xml);
        $this->ffi->process_request($request);
        return new Response($request);
    }
}

