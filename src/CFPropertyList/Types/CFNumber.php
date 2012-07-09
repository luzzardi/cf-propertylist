<?php
namespace CFPropertyList\Types;
use CFPropertyList\Types\CFType;
use CFPropertyList\CFBinaryPropertyList;

class CFNumber extends CFType {
    /**
     * Get XML-Node.
     * Returns &lt;real&gt; if $value is a float, &lt;integer&gt; if $value is an integer.
     * @param DOMDocument $doc DOMDocument to create DOMNode in
     * @param string $nodeName For compatibility reasons; just ignore it
     * @return DOMNode &lt;real&gt; or &lt;integer&gt;-Element
     */
    public function toXML(\DOMDocument $doc,$nodeName="") {
        $ret = 'real';
        if(intval($this->value) == $this->value && !is_float($this->value) && strpos($this->value,'.') === false) {
            $this->value = intval($this->value);
            $ret = 'integer';
        }
        return parent::toXML($doc, $ret);
    }

    /**
     * convert value to binary representation
     * @param CFBinaryPropertyList The binary property list object
     * @return The offset in the object table
     */
    public function toBinary(CFBinaryPropertyList &$bplist) {
        return $bplist->numToBinary($this->value);
    }
}
