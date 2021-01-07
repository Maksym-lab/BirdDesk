<?php
return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '
          0\\d|
          1\\d{2,6}|
          8\\d{3,4}
        ',
    'PossibleNumberPattern' => '\\d{2,6}',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          0\\d|
          1\\d{2,6}|
          8\\d{3,4}
        ',
    'PossibleNumberPattern' => '\\d{2,6}',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '
          0\\d|
          1\\d{2,6}|
          8\\d{3,4}
        ',
    'PossibleNumberPattern' => '\\d{2,6}',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '116000',
    'PossibleNumberPattern' => '\\d{6}',
    'ExampleNumber' => '116000',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '
          1180|
          8(?:
            2\\d{3}|
            [89]\\d{2}
          )
        ',
    'PossibleNumberPattern' => '\\d{4,5}',
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
          0[123]|
          11[023]
        ',
    'PossibleNumberPattern' => '\\d{2,3}',
    'ExampleNumber' => '112',
  ),
  'voicemail' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'shortCode' => 
  array (
    'NationalNumberPattern' => '
          0[1-4]|
          1(?:
            1(?:
              [02-4]|
              6(?:
                000|
                111
              )|
              8[0189]
            )|
            55|
            655|
            77
          )|
          821[57]4
        ',
    'PossibleNumberPattern' => '\\d{2,6}',
    'ExampleNumber' => '112',
  ),
  'standardRate' => 
  array (
    'NationalNumberPattern' => '1181',
    'PossibleNumberPattern' => '\\d{4}',
    'ExampleNumber' => '1181',
  ),
  'carrierSpecific' => 
  array (
    'NationalNumberPattern' => '16\\d{2}',
    'PossibleNumberPattern' => '\\d{4}',
    'ExampleNumber' => '1655',
  ),
  'noInternationalDialling' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'id' => 'LV',
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
