<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[19]\\d{2,4}',
    'PossibleNumberPattern' => '\\d{3,5}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '[19]\\d{2,4}',
    'PossibleNumberPattern' => '\\d{3,5}',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '[19]\\d{2,4}',
    'PossibleNumberPattern' => '\\d{3,5}',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
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
          10[0-2]|
          999
        ',
    'PossibleNumberPattern' => '\\d{3}',
    'ExampleNumber' => '999',
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
            0(?:
              [0-39]|
              5(?:
                0\\d|
                [1-4]
              )|
              6\\d{2}|
              7[0-4]|
              8[0-29]
            )|
            1[6-9]|
            2(?:
              2[0-5]|
              [34]
            )|
            3(?:
              1\\d?|
              3\\d|
              6[3-6]
            )|
            4(?:
              0\\d|
              1\\d{2}
            )|
            5[2-9]
          )|
          9(?:
            594|
            99
          )
        ',
    'PossibleNumberPattern' => '\\d{3,5}',
    'ExampleNumber' => '103',
  ),
  'standardRate' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'carrierSpecific' => 
  array (
    'NationalNumberPattern' => '9594',
    'PossibleNumberPattern' => '\\d{4}',
  ),
  'noInternationalDialling' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'id' => 'BD',
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
