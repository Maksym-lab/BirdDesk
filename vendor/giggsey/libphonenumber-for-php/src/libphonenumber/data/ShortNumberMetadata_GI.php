<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[158]\\d{2,5}',
    'PossibleNumberPattern' => '\\d{3,6}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '[158]\\d{2,5}',
    'PossibleNumberPattern' => '\\d{3,6}',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '[158]\\d{2,5}',
    'PossibleNumberPattern' => '\\d{3,6}',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '
          1(?:
            00|
            16\\d{3}|
            23|
            47\\d|
            5[15]|
            9[2-4]
          )|
          555
        ',
    'PossibleNumberPattern' => '\\d{3,6}',
    'ExampleNumber' => '100',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'sharedCost' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'personalNumber' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'voip' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'pager' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'uan' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'emergency' => 
  array (
    'NationalNumberPattern' => '
          1(?:
            12|
            9[09]
          )
        ',
    'PossibleNumberPattern' => '\\d{3}',
    'ExampleNumber' => '112',
  ),
  'voicemail' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'shortCode' => 
  array (
    'NationalNumberPattern' => '
          1(?:
            00|
            1(?:
              2|
              6(?:
                00[06]|
                1(?:
                  1[17]|
                  23
                )
              )|
              8\\d{2}
            )|
            23|
            4(?:
              1|
              7[014]
            )|
            5[015]|
            9[02349]
          )|
          555|
          8(?:
            008?|
            4[0-2]|
            88
          )
        ',
    'PossibleNumberPattern' => '\\d{3,6}',
    'ExampleNumber' => '116000',
  ),
  'standardRate' => 
  array (
    'NationalNumberPattern' => '150',
    'PossibleNumberPattern' => '\\d{3}',
    'ExampleNumber' => '150',
  ),
  'carrierSpecific' => 
  array (
    'NationalNumberPattern' => '
          1(?:
            18\\d{2}|
            23|
            51|
            9[2-4]
          )|
          555|
          8(?:
            00|
            88
          )
        ',
    'PossibleNumberPattern' => '\\d{3,5}',
    'ExampleNumber' => '123',
  ),
  'noInternationalDialling' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'id' => 'GI',
  'countryCode' => 0,
  'internationalPrefix' => '',
  'sameMobileAndFixedLinePattern' => true,
  'numberFormat' => 
  array (
  ),
  'intlNumberFormat' => 
  array (
  ),
  'mainCountryForCode' => false,
  'leadingZeroPossible' => false,
  'mobileNumberPortableRegion' => false,
);
