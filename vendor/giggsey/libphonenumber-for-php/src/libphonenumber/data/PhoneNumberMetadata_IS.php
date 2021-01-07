<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '
          [4-9]\\d{6}|
          38\\d{7}
        ',
    'PossibleNumberPattern' => '\\d{7,9}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          (?:
            4(?:
              1[0-24-6]|
              2[0-7]|
              [37][0-8]|
              4[0-245]|
              5[0-3568]|
              6\\d|
              8[0-36-8]
            )|
            5(?:
              05|
              [156]\\d|
              2[02578]|
              3[013-7]|
              4[03-7]|
              7[0-2578]|
              8[0-35-9]|
              9[013-689]
            )|
            87[23]
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{7}',
    'ExampleNumber' => '4101234',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '
          38[589]\\d{6}|
          (?:
            6(?:
              1[1-8]|
              3[089]|
              4[0167]|
              5[019]|
              [67][0-69]|
              9\\d
            )|
            7(?:
              5[057]|
              7\\d|
              8[0-36-8]
            )|
            8(?:
              2[0-5]|
              3[0-4]|
              [469]\\d|
              5[1-9]
            )
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{7,9}',
    'ExampleNumber' => '6111234',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '800\\d{4}',
    'PossibleNumberPattern' => '\\d{7}',
    'ExampleNumber' => '8001234',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '90\\d{5}',
    'PossibleNumberPattern' => '\\d{7}',
    'ExampleNumber' => '9011234',
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
    'NationalNumberPattern' => '49\\d{5}',
    'PossibleNumberPattern' => '\\d{7}',
    'ExampleNumber' => '4921234',
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
    'NationalNumberPattern' => '
          (?:
            6(?:
              2[0-8]|
              49|
              8\\d
            )|
            87[0189]|
            95[48]
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{7}',
    'ExampleNumber' => '6201234',
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
  'id' => 'IS',
  'countryCode' => 354,
  'internationalPrefix' => '00',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
    0 => 
    array (
      'pattern' => '(\\d{3})(\\d{4})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '[4-9]',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '',
    ),
    1 => 
    array (
      'pattern' => '(3\\d{2})(\\d{3})(\\d{3})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '3',
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
  'mobileNumberPortableRegion' => true,
);
