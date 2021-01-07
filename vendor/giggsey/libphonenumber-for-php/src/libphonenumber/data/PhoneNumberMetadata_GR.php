<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[26-9]\\d{9}',
    'PossibleNumberPattern' => '\\d{10}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          2(?:
            1\\d{2}|
            2(?:
              2[1-46-9]|
              3[1-8]|
              4[1-7]|
              5[1-4]|
              6[1-8]|
              7[1-5]|
              [89][1-9]
            )|
            3(?:
              1\\d|
              2[1-57]|
              [35][1-3]|
              4[13]|
              7[1-7]|
              8[124-6]|
              9[1-79]
            )|
            4(?:
              1\\d|
              2[1-8]|
              3[1-4]|
              4[13-5]|
              6[1-578]|
              9[1-5]
            )|
            5(?:
              1\\d|
              [29][1-4]|
              3[1-5]|
              4[124]|
              5[1-6]
            )|
            6(?:
              1\\d|
              3[1245]|
              4[1-7]|
              5[13-9]|
              [269][1-6]|
              7[14]|
              8[1-5]
            )|
            7(?:
              1\\d|
              2[1-5]|
              3[1-6]|
              4[1-7]|
              5[1-57]|
              6[135]|
              9[125-7]
            )|
            8(?:
              1\\d|
              2[1-5]|
              [34][1-4]|
              9[1-57]
            )
          )\\d{6}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '2123456789',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '69\\d{8}',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '6912345678',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '800\\d{7}',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '8001234567',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '90[19]\\d{7}',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '9091234567',
  ),
  'sharedCost' => 
  array (
    'NationalNumberPattern' => '
          8(?:
            0[16]|
            12|
            25
          )\\d{7}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '8011234567',
  ),
  'personalNumber' => 
  array (
    'NationalNumberPattern' => '70\\d{8}',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '7012345678',
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
  'id' => 'GR',
  'countryCode' => 30,
  'internationalPrefix' => '00',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
    0 => 
    array (
      'pattern' => '([27]\\d)(\\d{4})(\\d{4})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            21|
            7
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '',
    ),
    1 => 
    array (
      'pattern' => '(\\d{3})(\\d{3})(\\d{4})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            2[2-9]1|
            [689]
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '',
    ),
    2 => 
    array (
      'pattern' => '(2\\d{3})(\\d{6})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '2[2-9][02-9]',
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