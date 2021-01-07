<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '
          1\\d{2,5}|
          [2-9]\\d{3}
        ',
    'PossibleNumberPattern' => '\\d{3,6}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          1\\d{2,5}|
          [2-9]\\d{3}
        ',
    'PossibleNumberPattern' => '\\d{3,6}',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '
          1\\d{2,5}|
          [2-9]\\d{3}
        ',
    'PossibleNumberPattern' => '\\d{3,6}',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '
          1(?:
            0[25-8]|
            1(?:
              0|
              6\\d{3}
            )|
            7(?:
              12|
              77
            )
          )|
          8\\d{3}
        ',
    'PossibleNumberPattern' => '\\d{3,6}',
    'ExampleNumber' => '116000',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '
          1(?:
            2(?:
              12|
              34
            )|
            3(?:
              07|
              13
            )|
            414|
            \\d04
          )|
          [2-79]\\d{3}
        ',
    'PossibleNumberPattern' => '\\d{4}',
    'ExampleNumber' => '7212',
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
            0[01]|
            12
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
            0[0-8]|
            1(?:
              [027]|
              6(?:
                000|
                117
              )
            )|
            2(?:
              0[47]|
              12|
              3[0-24]|
              99
            )|
            3(?:
              0[47]|
              13|
              99
            )|
            4(?:
              0[47]|
              14|
              50|
              99
            )|
            7(?:
              00|
              1[27-9]|
              33|
              65|
              7[17]|
              89
            )|
            81[39]
          )|
          [2-9]\\d{3}
        ',
    'PossibleNumberPattern' => '\\d{3,6}',
    'ExampleNumber' => '112',
  ),
  'standardRate' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'carrierSpecific' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'noInternationalDialling' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'id' => 'BE',
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
