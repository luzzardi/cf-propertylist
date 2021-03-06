<?php

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors','on');

if(!defined('LIBDIR')) {
  define('LIBDIR',dirname(__FILE__).'/../');
}

if(!defined('WRITE_XML_DATA_FILE')) {
  define('WRITE_XML_DATA_FILE',dirname(__FILE__).'/binary.plist');
}

use CFPropertyList\CFPropertyList;
use CFPropertyList\Exceptions\PListException;
use CFPropertyList\Exceptions\IOException;
use CFPropertyList\Types\CFType;
use CFPropertyList\Types\CFDictionary;
use CFPropertyList\Types\CFString;
use CFPropertyList\Types\CFArray;
use CFPropertyList\Types\CFData;
use CFPropertyList\Types\CFDate;
use CFPropertyList\Types\CFBoolean;
use CFPropertyList\Types\CFNumber;

class WriteXMLTest extends PHPUnit_Framework_TestCase {
  public function testWriteFile() {
    $plist = new CFPropertyList();
    $dict = new CFDictionary();

    $names = new CFDictionary();
    $names->add('given-name',new CFString('John'));
    $names->add('surname',new CFString('Dow'));

    $dict->add('names',$names);

    $pets = new CFArray();
    $pets->add(new CFString('Jonny'));
    $pets->add(new CFString('Bello'));
    $dict->add('pets',$pets);

    $dict->add('age',new CFNumber(28));
    $dict->add('birth-date',new CFDate(412035803));

    $plist->add($dict);
    $plist->saveXML(WRITE_XML_DATA_FILE);

    $this->assertTrue(is_file(WRITE_XML_DATA_FILE));

    $plist->load(WRITE_XML_DATA_FILE);

    unlink(WRITE_XML_DATA_FILE);
  }

  public function testWriteString() {
    $plist = new CFPropertyList();
    $dict = new CFDictionary();

    $names = new CFDictionary();
    $names->add('given-name',new CFString('John'));
    $names->add('surname',new CFString('Dow'));

    $dict->add('names',$names);

    $pets = new CFArray();
    $pets->add(new CFString('Jonny'));
    $pets->add(new CFString('Bello'));
    $dict->add('pets',$pets);

    $dict->add('age',new CFNumber(28));
    $dict->add('birth-date',new CFDate(412035803));

    $plist->add($dict);
    $content = $plist->toXML();

    $plist->parse($content);
  }

}


# eof