<?php
namespace CFPropertyList\Types;
use CFPropertyList\CFBinaryPropertyList;

abstract class CFType {
  /**
   * CFType nodes
   * @var array
   */
  protected $value = null;

  /**
   * Create new CFType.
   * @param mixed $value Value of CFType
   */
  public function __construct($value=null) {
    $this->setValue($value);
  }

  /************************************************************************************************
   *    M A G I C   P R O P E R T I E S
   ************************************************************************************************/

  /**
   * Get the CFType's value
   * @return mixed CFType's value
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Set the CFType's value
   * @return void
   */
  public function setValue($value) {
    $this->value = $value;
  }

  /************************************************************************************************
   *    S E R I A L I Z I N G
   ************************************************************************************************/

  /**
   * Get XML-Node.
   * @param DOMDocument $doc DOMDocument to create DOMNode in
   * @param string $nodeName Name of element to create
   * @return DOMNode Node created based on CType
   * @uses $value as nodeValue
   */
  public function toXML(\DOMDocument $doc, $nodeName) {
    $text = $doc->createTextNode($this->value);
    $node = $doc->createElement($nodeName);
    $node->appendChild($text);
    return $node;
  }

  /**
   * convert value to binary representation
   * @param CFBinaryPropertyList The binary property list object
   * @return The offset in the object table
   */
  public abstract function toBinary(CFBinaryPropertyList &$bplist);

  /**
   * Get CFType's value.
   * @return mixed primitive value
   * @uses $value for retrieving primitive of CFType
   */
  public function toArray() {
    return $this->getValue();
  }

}
