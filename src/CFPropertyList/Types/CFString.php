<?php
namespace CFPropertyList\Types;
use CFPropertyList\Types\CFType;
use CFPropertyList\CFBinaryPropertyList;

class CFString extends CFType {
    /**
     * Get XML-Node.
     * @param DOMDocument $doc DOMDocument to create DOMNode in
     * @param string $nodeName For compatibility reasons; just ignore it
     * @return DOMNode &lt;string&gt;-Element
     */
    public function toXML(\DOMDocument $doc , $nodeName = '') {
        return parent::toXML($doc, 'string');
    }

    /**
     * convert value to binary representation
     * @param CFBinaryPropertyList The binary property list object
     * @return The offset in the object table
     */
    public function toBinary(CFBinaryPropertyList &$bplist) {
        return $bplist->stringToBinary($this->value);
    }
}
