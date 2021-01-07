<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[3589]\\d{9}',
    'PossibleNumberPattern' => '\\d{7}(?:\\d{3})?',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          345(?:
            2(?:
              22|
              44
            )|
            444|
            6(?:
              23|
              38|
              40
            )|
            7(?:
              4[35-79]|
              6[6-9]|
              77
            )|
            8(?:
              00|
              1[45]|
              25|
              [48]8
            )|
            9(?:
              14|
              4[035-9]
            )
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{7}(?:\\d{3})?',
    'ExampleNumber' => '3452221234',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '
          345(?:
            32[1-9]|
            5(?:
              1[67]|
              2[5-7]|
              4[6-8]|
              76
            )|
            9(?:
              1[67]|
              2[3-9]|
              3[689]
            )
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '3453231234',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '
          8(?:
            00|
            44|
            55|
            66|
            77|
            88
          )[2-9]\\d{6}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '8002345678',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '
          900[2-9]\\d{6}|
          345976\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '9002345678',
  ),
  'sharedCost' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'personalNumber' => 
  array (
    'NationalNumberPattern' => '
          5(?:
            00|
            33|
            44|
            66|
            77
          )[2-9]\\d{6}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '5002345678',
  ),
  'voip' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'pager' => 
  array (
    'NationalNumberPattern' => '345849\\d{4}',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '3458491234',
  ),
  'uan' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'emergency' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'voicemail' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'shortCode' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
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
  'id' => 'KY',
  'countryCode' => 1,
  'internationalPrefix' => '011',
  'nationalPrefix' => '1',
  'nationalPrefixForParsing' => '1',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
  ),
  'intlNumberFormat' => 
  array (
  ),
  'mainCountryForCode' => false,
  'leadingDigits' => '345',
  'leadingZeroPossible' => false,
  'mobileNumberPortableRegion' => false,
);
