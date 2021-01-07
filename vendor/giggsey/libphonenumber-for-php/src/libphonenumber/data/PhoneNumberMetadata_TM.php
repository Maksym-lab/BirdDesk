<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[1-6]\\d{7}',
    'PossibleNumberPattern' => '\\d{8}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          (?:
            1(?:
              2\\d|
              3[1-9]
            )|
            2(?:
              22|
              4[0-35-8]
            )|
            3(?:
              22|
              4[03-9]
            )|
            4(?:
              22|
              3[128]|
              4\\d|
              6[15]
            )|
            5(?:
              22|
              5[7-9]|
              6[014-689]
            )
          )\\d{5}
        ',
    'PossibleNumberPattern' => '\\d{8}',
    'ExampleNumber' => '12345678',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '6[2-8]\\d{6}',
    'PossibleNumberPattern' => '\\d{8}',
    'ExampleNumber' => '66123456',
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
  'id' => 'TM',
  'countryCode' => 993,
  'internationalPrefix' => '810',
  'preferredInternationalPrefix' => '8~10',
  'nationalPrefix' => '8',
  'nationalPrefixForParsing' => '8',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
    0 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{2})(\\d{2})',
      'format' => '$1 $2-$3-$4',
      'leadingDigitsPatterns' => 
      array (
        0 => '12',
      ),
      'nationalPrefixFormattingRule' => '(8 $1)',
      'domesticCarrierCodeFormattingRule' => '',
    ),
    1 => 
    array (
      'pattern' => '(\\d{2})(\\d{6})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '6',
      ),
      'nationalPrefixFormattingRule' => '8 $1',
      'domesticCarrierCodeFormattingRule' => '',
    ),
    2 => 
    array (
      'pattern' => '(\\d{3})(\\d)(\\d{2})(\\d{2})',
      'format' => '$1 $2-$3-$4',
      'leadingDigitsPatterns' => 
      array (
        0 => '
              13|
              [2-5]
            ',
      ),
      'nationalPrefixFormattingRule' => '(8 $1)',
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
