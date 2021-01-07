<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '
          [24-9]\\d{3,10}|
          3(?:
            [0-46-9]\\d{2,9}|
            5[013-9]\\d{1,8}
          )
        ',
    'PossibleNumberPattern' => '\\d{4,11}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          (?:
            2(?:
              [259]\\d{2,9}|
              [346-8]\\d{3,6}
            )|
            (?:
              [3457]\\d{2}|
              8(?:
                0[2-9]|
                [13-9]\\d
              )|
              9(?:
                0[89]|
                [2-579]\\d
              )
            )\\d{1,8}
          )
        ',
    'PossibleNumberPattern' => '\\d{4,11}',
    'ExampleNumber' => '27123456',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '6[2679][18]\\d{6}',
    'PossibleNumberPattern' => '\\d{9}',
    'ExampleNumber' => '628123456',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '800\\d{5}',
    'PossibleNumberPattern' => '\\d{8}',
    'ExampleNumber' => '80012345',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '90[015]\\d{5}',
    'PossibleNumberPattern' => '\\d{8}',
    'ExampleNumber' => '90012345',
  ),
  'sharedCost' => 
  array (
    'NationalNumberPattern' => '801\\d{5}',
    'PossibleNumberPattern' => '\\d{8}',
    'ExampleNumber' => '80112345',
  ),
  'personalNumber' => 
  array (
    'NationalNumberPattern' => '70\\d{6}',
    'PossibleNumberPattern' => '\\d{8}',
    'ExampleNumber' => '70123456',
  ),
  'voip' => 
  array (
    'NationalNumberPattern' => '
          20(?:
            1\\d{5}|
            [2-689]\\d{1,7}
          )
        ',
    'PossibleNumberPattern' => '\\d{4,10}',
    'ExampleNumber' => '20201234',
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
  'id' => 'LU',
  'countryCode' => 352,
  'internationalPrefix' => '00',
  'nationalPrefixForParsing' => '(15(?:0[06]|1[12]|35|4[04]|55|6[26]|77|88|99)\\d)',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
    0 => 
    array (
      'pattern' => '(\\d{2})(\\d{3})',
      'format' => '$1 $2',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            [2-5]|
            7[1-9]|
            [89](?:
              [1-9]|
              0[2-9]
            )
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    1 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{2})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            [2-5]|
            7[1-9]|
            [89](?:
              [1-9]|
              0[2-9]
            )
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    2 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{3})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '20',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    3 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{2})(\\d{1,2})',
      'format' => '$1 $2 $3 $4',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            2(?:
              [0367]|
              4[3-8]
            )
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    4 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{2})(\\d{3})',
      'format' => '$1 $2 $3 $4',
      'leadingDigitsPatterns' => 
      array (
        0 => '20',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    5 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{2})(\\d{2})(\\d{1,2})',
      'format' => '$1 $2 $3 $4 $5',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            2(?:
              [0367]|
              4[3-8]
            )
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    6 => 
    array (
      'pattern' => '(\\d{2})(\\d{2})(\\d{2})(\\d{1,4})',
      'format' => '$1 $2 $3 $4',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            2(?:
              [12589]|
              4[12]
            )|
            [3-5]|
            7[1-9]|
            8(?:
              [1-9]|
              0[2-9]
            )|
            9(?:
              [1-9]|
              0[2-46-9]
            )
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    7 => 
    array (
      'pattern' => '(\\d{3})(\\d{2})(\\d{3})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '
            70|
            80[01]|
            90[015]
          ',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
    8 => 
    array (
      'pattern' => '(\\d{3})(\\d{3})(\\d{3})',
      'format' => '$1 $2 $3',
      'leadingDigitsPatterns' => 
      array (
        0 => '6',
      ),
      'nationalPrefixFormattingRule' => '',
      'domesticCarrierCodeFormattingRule' => '$CC $1',
    ),
  ),
  'intlNumberFormat' => 
  array (
  ),
  'mainCountryForCode' => false,
  'leadingZeroPossible' => false,
  'mobileNumberPortableRegion' => true,
);
