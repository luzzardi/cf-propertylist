# CFPropertyList

The PHP implementation of Apple's PropertyList can handle XML PropertyLists as well as binary PropertyLists. It offers functionality to easily convert data between worlds, e.g. recalculating timestamps from unix epoch to apple epoch and vice versa. A feature to automagically create (guess) the plist structure from a normal PHP data structure will help you dump your data to plist in no time. 

Note: CFPropertylist was originally hosted on [GitHub](https://github.com/ronhill1394/CFPropertyList)

## Requirements And Limitations

* requires PHP5 (tested with PHP5.2.9 and 5.3.0 on Mac, PHP5.2.1 on Windows)
* requires either [MBString](http://php.net/mbstring) or [Iconv](http://php.net/iconv)
* requires either [BC](http://php.net/bc) or [GMP](http://php.net/gmp) or [phpseclib](http://phpseclib.sourceforge.net/) (see BigIntegerBug for an explanation) - as of CFPropertyList 1.0.1

## License

CFPropertyList is published under the [MIT License](http://www.opensource.org/licenses/mit-license.php).

## Installation

curl -s http://getcomposer.org/installer | php

Add to composer.json to
      "require": {
              .....
              "luzzardi/CFPropertyList":"dev-master"
          },

      "repositories":[
              {
                  "type":"git",
                  "url":"https://github.com/luzzardi/CFPropertyList"
              }
          ]

## Related

* [man(5) plist](http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html)
* [CFBinaryPList.c](http://www.opensource.apple.com/source/CF/CF-476.15/CFBinaryPList.c)
* [CFPropertyList in Ruby](http://rubyforge.org/projects/cfpropertylist/)
* [CFPropertyList in Python](https://github.com/bencochran/CFPropertyList)
* [plist on Wikipedia](http://en.wikipedia.org/wiki/Plist)
