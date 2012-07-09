<?php
/**
 * Examples for how to use CFPropertyList
 * Read an XML PropertyList
 * @package plist
 * @subpackage plist.examples
 */

// just in case...
error_reporting( E_ALL );
ini_set( 'display_errors', 'on' );

/**
 * Require CFPropertyList
 */
require_once("bootstrap.php");

use CFPropertyList\Exceptions\PListException;
use CFPropertyList\Exceptions\IOException;
use CFPropertyList\CFPropertyList;
use CFPropertyList\CFTypeDetector;
use CFPropertyList\Types\CFType;
use CFPropertyList\Types\CFDictionary;
use CFPropertyList\Types\CFString;
use CFPropertyList\Types\CFArray;
use CFPropertyList\Types\CFData;
use CFPropertyList\Types\CFDate;
use CFPropertyList\Types\CFBoolean;
use CFPropertyList\Types\CFNumber;


/*
 * create a new CFPropertyList instance which loads the sample.plist on construct.
 * since we know it's an XML file, we can skip format-determination
 */
$plist = new CFPropertyList( dirname(__FILE__).'/sample.xml.plist', CFPropertyList::FORMAT_XML );

/*
 * retrieve the array structure of sample.plist and dump to stdout
 */

echo '<pre>';
var_dump( $plist->toArray() );
echo '</pre>';

?>