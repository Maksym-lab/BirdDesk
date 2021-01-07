<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[1458]\\d{5,9}',
    'PossibleNumberPattern' => '\\d{6,10}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '89162\\d{4}',
    'PossibleNumberPattern' => '\\d{8,9}',
    'ExampleNumber' => '891621234',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '
          14(?:
            5\\d|
            71
          )\\d{5}|
          4(?:
            [0-2]\\d|
            3[0-57-9]|
            4[47-9]|
            5[0-25-9]|
            6[6-9]|
            7[03-9]|
            8[17-9]|
            9[017-9]
          )\\d{6}
        ',
    'PossibleNumberPattern' => '\\d{9}',
    'ExampleNumber' => '412345678',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '
          1(?:
            80(?:
              0\\d{2}
            )?|
            3(?:
              00\\d{2}
            )?
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{6,10}',
    'ExampleNumber' => '1800123456',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '190[0126]\\d{6}',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '1900123456',
  ),
  'sharedCost' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'personalNumber' => 
  array (
    'NationalNumberPattern' => '500\\d{6}',
    'PossibleNumberPattern' => '\\d{9}',
    'ExampleNumber' => '500123456',
  ),
  'voip' => 
  array (
    'NationalNumberPattern' => '550\\d{6}',
    'PossibleNumberPattern' => '\\d{9}',
    'ExampleNumber' => '550123456',
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
  'id' => 'CC',
  'countryCode' => 61,
  'internationalPrefix' => '(?:14(?:1[14]|34|4[17]|[56]6|7[47]|88))?001[14-689]',
  'preferredInternationalPrefix' => '0011',
  'nationalPrefix' => '0',
  'nationalPrefixForParsing' => '0',
  'sameMobileAndFixedLinePattern' => false,
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