<?php
declare(strict_types=1);

namespace QtrBk\QBXML;

/**
 * Class HostQuery
 * @package QtrBk\QBXML
 *
 */
class HostQuery implements QBXMLElementInterface
{

    /**
     * @return \DOMElement
     */
    public function get(): \DOMElement
    {
        $el = new \DOMElement('HostQueryRq');
        $el->setAttribute('requestID', 'request_123');
        return $el;
    }

    /**
     * @param Document $document
     * @return void
     */
    public function appendTo(Document $document): void
    {
        $el = new \DOMElement('HostQueryRq');
        $document
            ->getMessages()
            ->appendChild($el)
            ->setAttribute('requestID', 'request_123');
    }
}


