<?php
declare(strict_types=1);

namespace QtrBk\QBXML;

use DOMDocument;
use DOMNode;

class Document
{
    /**
     * @var DOMDocument $document;
     */
    private $document;

    /**
     * @var DOMNode $messages;
     */
    private $messages;

    /**
     * @var string QBXML version attributed in processing instruction
     */
    protected $version;

    /**
     * Document constructor.
     * @param string $version
     */
    public function __construct(string $version = '13.0')
    {
        $this->version = $version;
    }

    /**
     * @param QBXMLElementInterface $element
     * @return Document
     */
    public function addElement(QBXMLElementInterface $element): Document
    {
        $element->appendTo($this);
        return $this;
    }

    public function render(): string
    {
        return $this->document->saveXml();
    }

    /**
     * @return DOMDocument
     */
    public function getDocument(): \DOMDocument
    {
        if (!$this->document) {
            $doc = new \DOMDocument('1.0', 'UTF-8');
            $qbpi = new \DOMProcessingInstruction('qbxml', "version=\"{$this->version}\"");
            $root = new \DOMElement('QBXML');
            $msgs = new \DOMElement('QBXMLMsgsRq');
            $doc->appendChild($qbpi);
            $doc->appendChild($root)
                ->appendChild($msgs);

            $this->messages = $msgs;
            $this->document = $doc;
        }
        return $this->document;
    }

    /**
     * @return DOMNode
     */
    public function getMessages(): DOMNode
    {
        if (!$this->document) {
            $this->getDocument();
        }
        return $this->messages;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}