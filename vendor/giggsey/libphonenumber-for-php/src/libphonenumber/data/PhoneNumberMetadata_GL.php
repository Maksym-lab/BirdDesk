<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[1-689]\\d{5}',
    'PossibleNumberPattern' => '\\d{6}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          (?:
            19|
            3[1-6]|
            6[14689]|
            8[14-79]|
            9\\d
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{6}',
    'ExampleNumber' => '321000',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '[245][2-9]\\d{4}',
    'PossibleNumberPattern' => '\\d{6}',
    'ExampleNumber' => '221234',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '80\\d{4}',
    'PossibleNumberPattern' => '\\d{6}',
    'ExampleNumber' => '801234',
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
    'NationalNumberPattern' => '3[89]\\d{4}',
    'PossibleNumberPattern' => '\\d{6}',
    'ExampleNumber' => '381234',
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
  'id' => 'GL',
  'countryCode' => 299,
  'internationalPrefix' => '00',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
    0 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{2})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '',
    ),
  ),
  'intlNumberFormat' => 
  array (
  ),
  'mainCountryForCode' => false,
  'leadingZeroPossible' => false,
  'mobileNumberPortableRegion' => false,
);
