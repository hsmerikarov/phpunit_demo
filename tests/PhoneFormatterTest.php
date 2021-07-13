<?php
namespace tests;

use PHPUnit\Framework\TestCase;

class PhoneFormatterTest extends TestCase
{

    /**
     * @test
     * @dataProvider dataProviderForTest
     */
    public function positiveTestPhoneFormatting($unformattedPhoneNumber, $countryCode)
    {
        $formattedCode = \App\PhoneFormatter::format($unformattedPhoneNumber, $countryCode);

        $this->assertMatchesRegularExpression('/^\d+(?!(.+))$/', $formattedCode);
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
            'CA phone number without leading zeroes and code to be formatted' => [
                '240 817-4128',
                'CA',
            ],
            'GB phone number without leading zeroes and code to be formatted' => [
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

