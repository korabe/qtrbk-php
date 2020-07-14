<?php
declare(strict_types=1);

namespace QtrBk\QBXML;


interface QBXMLElementInterface
{
    /**
     * @param Document $document
     * @return void
     */
    public function appendTo(Document $document): void;
}