<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use App\PhoneFormatter;

class PhoneFormatterTest extends TestCase
{

    /**
     * @test
     * @dataProvider dataProviderForTest
     */
    public function positiveTestPhoneFormatting($unformattedPhoneNumber, $code)
    {
        $phoneFormatter = new PhoneFormatter();
        
        //Get country array entry
        $countryInformation = $phoneFormatter->getCountryByCode($code);
        
        //Extract coutry code
        $countryDCode = $countryInformation['d_code'];
        $formattedDCode = str_replace('+', '', $countryDCode);
        
        //Construct regex
        $pcreExpression = '/^'.$formattedDCode.'\d+(?!(.+))$/';
        
        $formattedCode = \App\PhoneFormatter::format($unformattedPhoneNumber, $code);

        $this->assertMatchesRegularExpression($pcreExpression, $formattedCode);
    }
    
    public function dataProviderForTest()
    {
        return [
            'US phone number with + and country code to be formatted' => [
                '+1-240-817-4128',
                'US',
            ],
            'US phone number without + and country code to be formatted' => [
                '240-817-4128',
                'US',
            ],
            'US phone number with leading zeroes to be formatted' => [
                '00240-817-4128',
                'US',
            ],
            'CA phone number without leading zeroes to be formatted' => [
                '240 817-4128',
                'CA',
            ],
            'GB phone number with leading empty spaces to be formatted' => [
                '     1632-960473',
                'GB',
            ],
            'BG phone number with country code in brackets' => [
                '(+359)888 888 777',
                'BG',
            ]

        ];
    }
}

