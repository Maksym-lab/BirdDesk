<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[16-9]\\d{2,3}',
    'PossibleNumberPattern' => '\\d{3,4}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '[16-9]\\d{2,3}',
    'PossibleNumberPattern' => '\\d{3,4}',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '[16-9]\\d{2,3}',
    'PossibleNumberPattern' => '\\d{3,4}',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '611',
    'PossibleNumberPattern' => '\\d{3}',
    'ExampleNumber' => '611',
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
    'NationalNumberPattern' => '11[237]',
    'PossibleNumberPattern' => '\\d{3}',
    'ExampleNumber' => '117',
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
            1\\d|
            5[2-9]|
            6[0-256]
          )|
          611|
          7(?:
            10|
            77|
            979
          )|
          8[28]8|
          900
        ',
    'PossibleNumberPattern' => '\\d{3,4}',
    'ExampleNumber' => '117',
  ),
  'standardRate' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'carrierSpecific' => 
  array (
    'NationalNumberPattern' => '
          611|
          7(?:
            10|
            77
          )|
          888|
          900
        ',
    'PossibleNumberPattern' => '\\d{3}',
    'ExampleNumber' => '611',
  ),
  'noInternationalDialling' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'id' => 'BI',
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
