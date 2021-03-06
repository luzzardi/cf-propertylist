<?php
namespace CFPropertyList\Types;
use CFPropertyList\Types\CFType;
use CFPropertyList\CFBinaryPropertyList;

class CFArray extends CFType implements \Iterator, \ArrayAccess {
/**
* Position of iterator {@link http://php.net/manual/en/class.iterator.php}
* @var integer
*/
protected $iteratorPosition = 0;


/**
* Create new CFType.
* @param array $value Value of CFType
*/
public function __construct($value=array()) {
$this->value = $value;
}

/**
* Set the CFType's value
* <b>Note:</b> this dummy does nothing
* @return void
*/
public function setValue($value) {
}

/**
* Add CFType to collection.
* @param CFType $value CFType to add to collection, defaults to null which results in an empty {@link CFString}
* @return void
* @uses $value for adding $value
*/
public function add(CFType $value=null) {
// anything but CFType is null, null is an empty string - sad but true
if( !$value )
$value = new CFString();

$this->value[] = $value;
}

/**
* Get CFType from collection.
* @param integer $key Key of CFType to retrieve from collection
* @return CFType CFType found at $key, null else
* @uses $value for retrieving CFType of $key
*/
public function get($key) {
if(isset($this->value[$key])) return $this->value[$key];
return null;
}

/**
* Remove CFType from collection.
* @param integer $key Key of CFType to removes from collection
* @return CFType removed CFType, null else
* @uses $value for removing CFType of $key
*/
public function del($key) {
if(isset($this->value[$key])) unset($this->value[$key]);
}


/************************************************************************************************
*    S E R I A L I Z I N G
************************************************************************************************/

/**
* Get XML-Node.
* @param DOMDocument $doc DOMDocument to create DOMNode in
* @param string $nodeName For compatibility reasons; just ignore it
* @return DOMNode &lt;array&gt;-Element
*/
public function toXML(\DOMDocument $doc,$nodeName="") {
$node = $doc->createElement('array');

foreach($this->value as $value) $node->appendChild($value->toXML($doc));
return $node;
}

/**
* convert value to binary representation
* @param CFBinaryPropertyList The binary property list object
* @return The offset in the object table
*/
public function toBinary(CFBinaryPropertyList &$bplist) {
return $bplist->arrayToBinary($this);
}

/**
* Get CFType's value.
* @return array primitive value
* @uses $value for retrieving primitive of CFType
*/
public function toArray() {
$a = array();
foreach($this->value as $value) $a[] = $value->toArray();
return $a;
}


/************************************************************************************************
*    I T E R A T O R   I N T E R F A C E
************************************************************************************************/

/**
* Rewind {@link $iteratorPosition} to first position (being 0)
* @link http://php.net/manual/en/iterator.rewind.php
* @return void
* @uses $iteratorPosition set to 0
*/
public function rewind() {
$this->iteratorPosition = 0;
}

/**
* Get Iterator's current {@link CFType} identified by {@link $iteratorPosition}
* @link http://php.net/manual/en/iterator.current.php
* @return CFType current Item
* @uses $iteratorPosition identify current key
*/
public function current() {
return $this->value[$this->iteratorPosition];
}

/**
* Get Iterator's current key identified by {@link $iteratorPosition}
* @link http://php.net/manual/en/iterator.key.php
* @return string key of the current Item
* @uses $iteratorPosition identify current key
*/
public function key() {
return $this->iteratorPosition;
}

/**
* Increment {@link $iteratorPosition} to address next {@see CFType}
* @link http://php.net/manual/en/iterator.next.php
* @return void
* @uses $iteratorPosition increment by 1
*/
public function next() {
$this->iteratorPosition++;
}

/**
* Test if {@link $iteratorPosition} addresses a valid element of {@link $value}
* @link http://php.net/manual/en/iterator.valid.php
* @return boolean true if current position is valid, false else
* @uses $iteratorPosition test if within {@link $iteratorKeys}
* @uses $iteratorPosition test if within {@link $value}
*/
public function valid() {
return isset($this->value[$this->iteratorPosition]);
}

/************************************************************************************************
*    ArrayAccess   I N T E R F A C E
************************************************************************************************/

/**
* Determine if the array's key exists
* @param string $key the key to check
* @return bool true if the offset exists, false if not
* @link http://php.net/manual/en/arrayaccess.offsetexists.php
* @uses $value to check if $key exists
* @author Sean Coates <sean@php.net>
   */
  public function offsetExists($key) {
    return isset($this->value[$key]);
  }

  /**
   * Fetch a specific key from the CFArray
   * @param string $key the key to check
   * @return mixed the value associated with the key; null if the key is not found
   * @link http://php.net/manual/en/arrayaccess.offsetget.php
   * @uses get() to get the key's value
   * @author Sean Coates <sean@php.net>
   */
  public function offsetGet($key) {
    return $this->get($key);
  }

  /**
   * Set a value in the array
   * @param string $key the key to set
   * @param string $value the value to set
   * @return void
   * @link http://php.net/manual/en/arrayaccess.offsetset.php
   * @uses setValue() to set the key's new value
   * @author Sean Coates <sean@php.net>
   */
  public function offsetSet($key, $value) {
    return $this->setValue($value);
  }

  /**
   * Unsets a value in the array
   * <b>Note:</b> this dummy does nothing
   * @param string $key the key to set
   * @return void
   * @link http://php.net/manual/en/arrayaccess.offsetunset.php
   * @author Sean Coates <sean@php.net>
   */
  public function offsetUnset($key) {

  }


}