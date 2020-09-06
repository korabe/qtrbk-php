<?php
declare(strict_types=1);

namespace QtrBk;

use FFI;
use RuntimeException;

/**
 * Class QtrBk
 * @package QtrBk
 */
final class QtrBk
{
    const QTRBK_DLL = "QtrBkLib.dll";

    private static $dll;
    private static $ffi;
    private $qb;

    /**
     * QtrBk constructor.
     * @param ?resource $ffi
     * @throws RuntimeException
     */
    public function __construct($ffi = null)
    {
        if (!extension_loaded("ffi")) {
            throw new RuntimeException("Could not load FFI: extension not found");
        }

        self::$ffi = $ffi;

        self::$dll = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . self::QTRBK_DLL;

        if (!self::$ffi) {
            self::$ffi = \FFI::cdef("
                struct qtrbk {
                    const char * request;
                    const char * response;
                    const char * error;
                    int err;
                };
                void process_request(struct qtrbk * qb);
                struct qtrbk* create_qtrbk(const char * xml);
            ", self::$dll);
        }
    }

    /**
     * @param string $xml
     * @return QtrBk
     */
    public function process(string $xml): self
    {
        $this->qb = self::$ffi->create_qtrbk($xml);
        self::$ffi->process_request($this->qb);
        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        if (is_object($this->qb)) {
            return ($this->qb->err !== 0);
        }
        return false;
    }

    /**
     * @return int
     */
    public function getExitCode(): int
    {
        return is_object($this->qb) ? $this->qb->err : 0;
    }

    /**
     * @return string
     */
    public function getErrors(): string
    {
        return  is_object($this->qb) ? FFI::string($this->qb->error) : '';
    }

    /**
     * @return string
     */
    public function getQbXmlResponse(): string
    {
        return is_object($this->qb) ? FFI::string($this->qb->response) : '';
    }

    /**
     * @return mixed
     */
    public static function getFFI()
    {
        return self::$ffi;
    }
}

