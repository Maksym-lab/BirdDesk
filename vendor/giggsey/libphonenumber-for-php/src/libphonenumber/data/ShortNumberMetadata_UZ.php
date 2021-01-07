<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[04]\\d{1,4}',
    'PossibleNumberPattern' => '\\d{2,5}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '[04]\\d{1,4}',
    'PossibleNumberPattern' => '\\d{2,5}',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '[04]\\d{1,4}',
    'PossibleNumberPattern' => '\\d{2,5}',
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
          0(?:
            0[123]|
            [123]|
            50
          )
        ',
    'PossibleNumberPattern' => '\\d{2,3}',
    'ExampleNumber' => '01',
  ),
  'voicemail' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'shortCode' => 
  array (
    'NationalNumberPattern' => '
          0(?:
            0[123]|
            [123]|
            50
          )|
          45400
        ',
    'PossibleNumberPattern' => '\\d{2,5}',
    'ExampleNumber' => '01',
  ),
  'standardRate' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'carrierSpecific' => 
  array (
    'NationalNumberPattern' => '45400',
    'PossibleNumberPattern' => '\\d{5}',
    'ExampleNumber' => '45400',
  ),
  'noInternationalDialling' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'id' => 'UZ',
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
