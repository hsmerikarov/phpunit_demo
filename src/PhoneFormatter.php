<?php

namespace App{
    function __( $text) {
        return  $text;
    }

class PhoneFormatter
{
    public static function format($number, $country_code) {
        $number = str_replace(' ', '', $number);
        $number = str_replace('-', '', $number);
        $number = str_replace('(', '', $number);
        $number = str_replace(')', '', $number);
        $number = ltrim($number, '0');

        $instance = new PhoneFormatter();
        
        if (!empty($country_code)){
            $prefix = $instance->getCountryByCode($country_code);

            if (!empty($prefix['d_code'])) {
                $prefix = ltrim($prefix['d_code'], '+');
            } else {
                $prefix = '';
            }

            if (!empty($prefix)) {
                //$prefix = $prefix->prefix;
                $numberCheck = ltrim($number, '+');
                $numberCheck = ltrim($numberCheck, '0');
                $prefixCheck = ltrim($prefix, '+');

                $formattedNumber = false;

                /* Discard invalid phone numbers */
                if (strlen($numberCheck) < 7 || strlen($numberCheck) > 15) {
                    return false;
                }

                if(is_numeric($number)) {
                    if ((strpos($number,'+') === 0 || strpos($number, '00') === 0) && strpos($numberCheck, $prefixCheck) === 0) {
                        $formattedNumber = '+' . $numberCheck;
                    } else if ((strpos($number,'+') === 0 || strpos($number, '00') === 0) && strpos($numberCheck, $prefixCheck) !== 0){
                        $formattedNumber = $prefixCheck.$numberCheck;
                    } else if (strpos($numberCheck, $prefixCheck) !== 0) {
                        $formattedNumber = $prefix.$numberCheck;
                    } else if (strpos($numberCheck, $prefixCheck) === 0 && strpos($numberCheck, '0') == strlen($prefixCheck)) {
                        $formattedNumber = ltrim($numberCheck, $prefix);
                        $formattedNumber = ltrim($formattedNumber, '0');
                        $formattedNumber = $prefixCheck . $formattedNumber;
                    } else if((strpos($number,'+') !== 0) && (strpos($number,'00') !== 0) && strpos($numberCheck, $prefixCheck) === 0) {
                        $formattedNumber = $number;
                    } else {
                        $formattedNumber = false;
                    }
                }

                return ltrim($formattedNumber, '+');
            } else {
                return ltrim($number, '+');
            }
        }

        return ltrim($number, '+');
    }

    public function getCountryByCode($code) {
        $all_countries = $this->getAllCountries();
        foreach ($all_countries as $country) {
            if ($country['code'] === $code) {
                return $country;
            }
        }
    }

    public function getAllCountries() {
        $countries = array();
        $countries[] = array("code"=>"US","name"=>__('United States'),"d_code"=>"+1");
        $countries[] = array("code"=>"CA","name"=>__('Canada'),"d_code"=>"+1");
        $countries[] = array("code"=>"AU","name"=>__("Australia"),"d_code"=>"+61");
        $countries[] = array("code"=>"GB","name"=>__("United Kingdom"),"d_code"=>"+44");
        $countries[] = array("code"=>"AF","name"=>__("Afghanistan"),"d_code"=>"+93");
        $countries[] = array("code"=>"AL","name"=>__("Albania"),"d_code"=>"+355");
        $countries[] = array("code"=>"DZ","name"=>__("Algeria"),"d_code"=>"+213");
        $countries[] = array("code"=>"AS","name"=>__("American Samoa"),"d_code"=>"+1684");
        $countries[] = array("code"=>"AD","name"=>__("Andorra"),"d_code"=>"+376");
        $countries[] = array("code"=>"AO","name"=>__("Angola"),"d_code"=>"+244");
        $countries[] = array("code"=>"AI","name"=>__("Anguilla"),"d_code"=>"+1");
        $countries[] = array("code"=>"AG","name"=>__("Antigua"),"d_code"=>"+1");
        $countries[] = array("code"=>"AR","name"=>__("Argentina"),"d_code"=>"+54");
        $countries[] = array("code"=>"AM","name"=>__("Armenia"),"d_code"=>"+374");
        $countries[] = array("code"=>"AW","name"=>__("Aruba"),"d_code"=>"+297");
        $countries[] = array("code"=>"AT","name"=>__("Austria"),"d_code"=>"+43");
        $countries[] = array("code"=>"AZ","name"=>__("Azerbaijan"),"d_code"=>"+994");
        $countries[] = array("code"=>"BH","name"=>__("Bahrain"),"d_code"=>"+973");
        $countries[] = array("code"=>"BD","name"=>__("Bangladesh"),"d_code"=>"+880");
        $countries[] = array("code"=>"BB","name"=>__("Barbados"),"d_code"=>"+1");
        $countries[] = array("code"=>"BY","name"=>__("Belarus"),"d_code"=>"+375");
        $countries[] = array("code"=>"BE","name"=>__("Belgium"),"d_code"=>"+32");
        $countries[] = array("code"=>"BZ","name"=>__("Belize"),"d_code"=>"+501");
        $countries[] = array("code"=>"BJ","name"=>__("Benin"),"d_code"=>"+229");
        $countries[] = array("code"=>"BM","name"=>__("Bermuda"),"d_code"=>"+1");
        $countries[] = array("code"=>"BT","name"=>__("Bhutan"),"d_code"=>"+975");
        $countries[] = array("code"=>"BO","name"=>__("Bolivia"),"d_code"=>"+591");
        $countries[] = array("code"=>"BA","name"=>__("Bosnia and Herzegovina"),"d_code"=>"+387");
        $countries[] = array("code"=>"BW","name"=>__("Botswana"),"d_code"=>"+267");
        $countries[] = array("code"=>"BR","name"=>__("Brazil"),"d_code"=>"+55");
        $countries[] = array("code"=>"IO","name"=>__("British Indian Ocean Territory"),"d_code"=>"+246");
        $countries[] = array("code"=>"VG","name"=>__("British Virgin Islands"),"d_code"=>"+1340");
        $countries[] = array("code"=>"BN","name"=>__("Brunei"),"d_code"=>"+673");
        $countries[] = array("code"=>"BG","name"=>__("Bulgaria"),"d_code"=>"+359");
        $countries[] = array("code"=>"BF","name"=>__("Burkina Faso"),"d_code"=>"+226");
        $countries[] = array("code"=>"MM","name"=>__("Burma Myanmar") ,"d_code"=>"+95");
        $countries[] = array("code"=>"BI","name"=>__("Burundi"),"d_code"=>"+257");
        $countries[] = array("code"=>"KH","name"=>__("Cambodia"),"d_code"=>"+855");
        $countries[] = array("code"=>"CM","name"=>__("Cameroon"),"d_code"=>"+237");
        $countries[] = array("code"=>"CV","name"=>__("Cape Verde"),"d_code"=>"+238");
        $countries[] = array("code"=>"KY","name"=>__("Cayman Islands"),"d_code"=>"+1");
        $countries[] = array("code"=>"CF","name"=>__("Central African Republic"),"d_code"=>"+236");
        $countries[] = array("code"=>"TD","name"=>__("Chad"),"d_code"=>"+235");
        $countries[] = array("code"=>"CL","name"=>__("Chile"),"d_code"=>"+56");
        $countries[] = array("code"=>"CN","name"=>__("China"),"d_code"=>"+86");
        $countries[] = array("code"=>"CO","name"=>__("Colombia"),"d_code"=>"+57");
        $countries[] = array("code"=>"KM","name"=>__("Comoros"),"d_code"=>"+269");
        $countries[] = array("code"=>"CK","name"=>__("Cook Islands"),"d_code"=>"+682");
        $countries[] = array("code"=>"CR","name"=>__("Costa Rica"),"d_code"=>"+506");
        $countries[] = array("code"=>"CI","name"=>__("Côte d'Ivoire") ,"d_code"=>"+225");
        $countries[] = array("code"=>"HR","name"=>__("Croatia"),"d_code"=>"+385");
        $countries[] = array("code"=>"CU","name"=>__("Cuba"),"d_code"=>"+53");
        $countries[] = array("code"=>"CY","name"=>__("Cyprus"),"d_code"=>"+357");
        $countries[] = array("code"=>"CZ","name"=>__("Czech Republic"),"d_code"=>"+420");
        $countries[] = array("code"=>"CD","name"=>__("Democratic Republic of Congo"),"d_code"=>"+243");
        $countries[] = array("code"=>"DK","name"=>__("Denmark"),"d_code"=>"+45");
        $countries[] = array("code"=>"DJ","name"=>__("Djibouti"),"d_code"=>"+253");
        $countries[] = array("code"=>"DM","name"=>__("Dominica"),"d_code"=>"+1");
        $countries[] = array("code"=>"DO","name"=>__("Dominican Republic"),"d_code"=>"+1");
        $countries[] = array("code"=>"EC","name"=>__("Ecuador"),"d_code"=>"+593");
        $countries[] = array("code"=>"EG","name"=>__("Egypt"),"d_code"=>"+20");
        $countries[] = array("code"=>"SV","name"=>__("El Salvador"),"d_code"=>"+503");
        $countries[] = array("code"=>"GQ","name"=>__("Equatorial Guinea"),"d_code"=>"+240");
        $countries[] = array("code"=>"ER","name"=>__("Eritrea"),"d_code"=>"+291");
        $countries[] = array("code"=>"EE","name"=>__("Estonia"),"d_code"=>"+372");
        $countries[] = array("code"=>"ET","name"=>__("Ethiopia"),"d_code"=>"+251");
        $countries[] = array("code"=>"FK","name"=>__("Falkland Islands"),"d_code"=>"+500");
        $countries[] = array("code"=>"FO","name"=>__("Faroe Islands"),"d_code"=>"+298");
        $countries[] = array("code"=>"FM","name"=>__("Federated States of Micronesia"),"d_code"=>"+691");
        $countries[] = array("code"=>"FJ","name"=>__("Fiji"),"d_code"=>"+679");
        $countries[] = array("code"=>"FI","name"=>__("Finland"),"d_code"=>"+358");
        $countries[] = array("code"=>"FR","name"=>__("France"),"d_code"=>"+33");
        $countries[] = array("code"=>"GF","name"=>__("French Guiana"),"d_code"=>"+594");
        $countries[] = array("code"=>"PF","name"=>__("French Polynesia"),"d_code"=>"+689");
        $countries[] = array("code"=>"GA","name"=>__("Gabon"),"d_code"=>"+241");
        $countries[] = array("code"=>"GE","name"=>__("Georgia"),"d_code"=>"+995");
        $countries[] = array("code"=>"DE","name"=>__("Germany"),"d_code"=>"+49");
        $countries[] = array("code"=>"GH","name"=>__("Ghana"),"d_code"=>"+233");
        $countries[] = array("code"=>"GI","name"=>__("Gibraltar"),"d_code"=>"+350");
        $countries[] = array("code"=>"GR","name"=>__("Greece"),"d_code"=>"+30");
        $countries[] = array("code"=>"GL","name"=>__("Greenland"),"d_code"=>"+299");
        $countries[] = array("code"=>"GD","name"=>__("Grenada"),"d_code"=>"+1");
        $countries[] = array("code"=>"GP","name"=>__("Guadeloupe"),"d_code"=>"+590");
        $countries[] = array("code"=>"GU","name"=>__("Guam"),"d_code"=>"+1");
        $countries[] = array("code"=>"GT","name"=>__("Guatemala"),"d_code"=>"+502");
        $countries[] = array("code"=>"GN","name"=>__("Guinea"),"d_code"=>"+224");
        $countries[] = array("code"=>"GW","name"=>__("Guinea-Bissau"),"d_code"=>"+245");
        $countries[] = array("code"=>"GY","name"=>__("Guyana"),"d_code"=>"+592");
        $countries[] = array("code"=>"HT","name"=>__("Haiti"),"d_code"=>"+509");
        $countries[] = array("code"=>"HN","name"=>__("Honduras"),"d_code"=>"+504");
        $countries[] = array("code"=>"HK","name"=>__("Hong Kong"),"d_code"=>"+852");
        $countries[] = array("code"=>"HU","name"=>__("Hungary"),"d_code"=>"+36");
        $countries[] = array("code"=>"IS","name"=>__("Iceland"),"d_code"=>"+354");
        $countries[] = array("code"=>"IN","name"=>__("India"),"d_code"=>"+91");
        $countries[] = array("code"=>"ID","name"=>__("Indonesia"),"d_code"=>"+62");
        $countries[] = array("code"=>"IR","name"=>__("Iran"),"d_code"=>"+98");
        $countries[] = array("code"=>"IQ","name"=>__("Iraq"),"d_code"=>"+964");
        $countries[] = array("code"=>"IE","name"=>__("Ireland"),"d_code"=>"+353");
        $countries[] = array("code"=>"IL","name"=>__("Israel"),"d_code"=>"+972");
        $countries[] = array("code"=>"IT","name"=>__("Italy"),"d_code"=>"+39");
        $countries[] = array("code"=>"JM","name"=>__("Jamaica"),"d_code"=>"+1");
        $countries[] = array("code"=>"JP","name"=>__("Japan"),"d_code"=>"+81");
        $countries[] = array("code"=>"JO","name"=>__("Jordan"),"d_code"=>"+962");
        $countries[] = array("code"=>"KZ","name"=>__("Kazakhstan"),"d_code"=>"+7");
        $countries[] = array("code"=>"KE","name"=>__("Kenya"),"d_code"=>"+254");
        $countries[] = array("code"=>"KI","name"=>__("Kiribati"),"d_code"=>"+686");
        //$countries[] = array("code"=>"XK","name"=>"Kosovo","d_code"=>"+381");
        $countries[] = array("code"=>"KW","name"=>__("Kuwait"),"d_code"=>"+965");
        $countries[] = array("code"=>"KG","name"=>__("Kyrgyzstan"),"d_code"=>"+996");
        $countries[] = array("code"=>"LA","name"=>__("Laos"),"d_code"=>"+856");
        $countries[] = array("code"=>"LV","name"=>__("Latvia"),"d_code"=>"+371");
        $countries[] = array("code"=>"LB","name"=>__("Lebanon"),"d_code"=>"+961");
        $countries[] = array("code"=>"LS","name"=>__("Lesotho"),"d_code"=>"+266");
        $countries[] = array("code"=>"LR","name"=>__("Liberia"),"d_code"=>"+231");
        $countries[] = array("code"=>"LY","name"=>__("Libya"),"d_code"=>"+218");
        $countries[] = array("code"=>"LI","name"=>__("Liechtenstein"),"d_code"=>"+423");
        $countries[] = array("code"=>"LT","name"=>__("Lithuania"),"d_code"=>"+370");
        $countries[] = array("code"=>"LU","name"=>__("Luxembourg"),"d_code"=>"+352");
        $countries[] = array("code"=>"MO","name"=>__("Macau"),"d_code"=>"+853");
        $countries[] = array("code"=>"MK","name"=>__("Macedonia"),"d_code"=>"+389");
        $countries[] = array("code"=>"MG","name"=>__("Madagascar"),"d_code"=>"+261");
        $countries[] = array("code"=>"MW","name"=>__("Malawi"),"d_code"=>"+265");
        $countries[] = array("code"=>"MY","name"=>__("Malaysia"),"d_code"=>"+60");
        $countries[] = array("code"=>"MV","name"=>__("Maldives"),"d_code"=>"+960");
        $countries[] = array("code"=>"ML","name"=>__("Mali"),"d_code"=>"+223");
        $countries[] = array("code"=>"MT","name"=>__("Malta"),"d_code"=>"+356");
        $countries[] = array("code"=>"MH","name"=>__("Marshall Islands"),"d_code"=>"+692");
        $countries[] = array("code"=>"MQ","name"=>__("Martinique"),"d_code"=>"+596");
        $countries[] = array("code"=>"MR","name"=>__("Mauritania"),"d_code"=>"+222");
        $countries[] = array("code"=>"MU","name"=>__("Mauritius"),"d_code"=>"+230");
        $countries[] = array("code"=>"YT","name"=>__("Mayotte"),"d_code"=>"+262");
        $countries[] = array("code"=>"MX","name"=>__("Mexico"),"d_code"=>"+52");
        $countries[] = array("code"=>"MD","name"=>__("Moldova"),"d_code"=>"+373");
        $countries[] = array("code"=>"MC","name"=>__("Monaco"),"d_code"=>"+377");
        $countries[] = array("code"=>"MN","name"=>__("Mongolia"),"d_code"=>"+976");
        $countries[] = array("code"=>"ME","name"=>__("Montenegro"),"d_code"=>"+382");
        $countries[] = array("code"=>"MS","name"=>__("Montserrat"),"d_code"=>"+1");
        $countries[] = array("code"=>"MA","name"=>__("Morocco"),"d_code"=>"+212");
        $countries[] = array("code"=>"MZ","name"=>__("Mozambique"),"d_code"=>"+258");
        $countries[] = array("code"=>"NA","name"=>__("Namibia"),"d_code"=>"+264");
        $countries[] = array("code"=>"NR","name"=>__("Nauru"),"d_code"=>"+674");
        $countries[] = array("code"=>"NP","name"=>__("Nepal"),"d_code"=>"+977");
        $countries[] = array("code"=>"NL","name"=>__("Netherlands"),"d_code"=>"+31");
        $countries[] = array("code"=>"AN","name"=>__("Netherlands Antilles"),"d_code"=>"+599");
        $countries[] = array("code"=>"NC","name"=>__("New Caledonia"),"d_code"=>"+687");
        $countries[] = array("code"=>"NZ","name"=>__("New Zealand"),"d_code"=>"+64");
        $countries[] = array("code"=>"NI","name"=>__("Nicaragua"),"d_code"=>"+505");
        $countries[] = array("code"=>"NE","name"=>__("Niger"),"d_code"=>"+227");
        $countries[] = array("code"=>"NG","name"=>__("Nigeria"),"d_code"=>"+234");
        $countries[] = array("code"=>"NU","name"=>__("Niue"),"d_code"=>"+683");
        $countries[] = array("code"=>"NF","name"=>__("Norfolk Island"),"d_code"=>"+672");
        $countries[] = array("code"=>"KP","name"=>__("North Korea"),"d_code"=>"+850");
        $countries[] = array("code"=>"MP","name"=>__("Northern Mariana Islands"),"d_code"=>"+1");
        $countries[] = array("code"=>"NO","name"=>__("Norway"),"d_code"=>"+47");
        $countries[] = array("code"=>"OM","name"=>__("Oman"),"d_code"=>"+968");
        $countries[] = array("code"=>"PK","name"=>__("Pakistan"),"d_code"=>"+92");
        $countries[] = array("code"=>"PW","name"=>__("Palau"),"d_code"=>"+680");
        $countries[] = array("code"=>"PS","name"=>__("Palestine"),"d_code"=>"+970");
        $countries[] = array("code"=>"PA","name"=>__("Panama"),"d_code"=>"+507");
        $countries[] = array("code"=>"PG","name"=>__("Papua New Guinea"),"d_code"=>"+675");
        $countries[] = array("code"=>"PY","name"=>__("Paraguay"),"d_code"=>"+595");
        $countries[] = array("code"=>"PE","name"=>__("Peru"),"d_code"=>"+51");
        $countries[] = array("code"=>"PH","name"=>__("Philippines"),"d_code"=>"+63");
        $countries[] = array("code"=>"PL","name"=>__("Poland"),"d_code"=>"+48");
        $countries[] = array("code"=>"PT","name"=>__("Portugal"),"d_code"=>"+351");
        $countries[] = array("code"=>"PR","name"=>__("Puerto Rico"),"d_code"=>"+1");
        $countries[] = array("code"=>"QA","name"=>__("Qatar"),"d_code"=>"+974");
        $countries[] = array("code"=>"CG","name"=>__("Republic of the Congo"),"d_code"=>"+242");
        $countries[] = array("code"=>"RE","name"=>__("Réunion") ,"d_code"=>"+262");
        $countries[] = array("code"=>"RO","name"=>__("Romania"),"d_code"=>"+40");
        $countries[] = array("code"=>"RU","name"=>__("Russia"),"d_code"=>"+7");
        $countries[] = array("code"=>"RW","name"=>__("Rwanda"),"d_code"=>"+250");
        //$countries[] = array("code"=>"BL","name"=>"Saint Barthélemy" ,"d_code"=>"+590");
        $countries[] = array("code"=>"SH","name"=>__("Saint Helena"),"d_code"=>"+290");
        $countries[] = array("code"=>"KN","name"=>__("Saint Kitts and Nevis"),"d_code"=>"+1");
        //$countries[] = array("code"=>"MF","name"=>"Saint Martin","d_code"=>"+590");
        $countries[] = array("code"=>"PM","name"=>__("Saint Pierre and Miquelon"),"d_code"=>"+508");
        $countries[] = array("code"=>"VC","name"=>__("Saint Vincent and the Grenadines"),"d_code"=>"+1");
        $countries[] = array("code"=>"WS","name"=>__("Samoa"),"d_code"=>"+685");
        $countries[] = array("code"=>"SM","name"=>__("San Marino"),"d_code"=>"+378");
        $countries[] = array("code"=>"ST","name"=>__("São Tomé and Príncipe") ,"d_code"=>"+239");
        $countries[] = array("code"=>"SA","name"=>__("Saudi Arabia"),"d_code"=>"+966");
        $countries[] = array("code"=>"SN","name"=>__("Senegal"),"d_code"=>"+221");
        $countries[] = array("code"=>"RS","name"=>__("Serbia"),"d_code"=>"+381");
        $countries[] = array("code"=>"SC","name"=>__("Seychelles"),"d_code"=>"+248");
        $countries[] = array("code"=>"SL","name"=>__("Sierra Leone"),"d_code"=>"+232");
        $countries[] = array("code"=>"SG","name"=>__("Singapore"),"d_code"=>"+65");
        $countries[] = array("code"=>"SK","name"=>__("Slovakia"),"d_code"=>"+421");
        $countries[] = array("code"=>"SI","name"=>__("Slovenia"),"d_code"=>"+386");
        $countries[] = array("code"=>"SB","name"=>__("Solomon Islands"),"d_code"=>"+677");
        $countries[] = array("code"=>"SO","name"=>__("Somalia"),"d_code"=>"+252");
        $countries[] = array("code"=>"ZA","name"=>__("South Africa"),"d_code"=>"+27");
        $countries[] = array("code"=>"KR","name"=>__("South Korea"),"d_code"=>"+82");
        $countries[] = array("code"=>"ES","name"=>__("Spain"),"d_code"=>"+34");
        $countries[] = array("code"=>"LK","name"=>__("Sri Lanka"),"d_code"=>"+94");
        $countries[] = array("code"=>"LC","name"=>__("St. Lucia"),"d_code"=>"+1");
        $countries[] = array("code"=>"SD","name"=>__("Sudan"),"d_code"=>"+249");
        $countries[] = array("code"=>"SR","name"=>__("Suriname"),"d_code"=>"+597");
        $countries[] = array("code"=>"SZ","name"=>__("Swaziland"),"d_code"=>"+268");
        $countries[] = array("code"=>"SE","name"=>__("Sweden"),"d_code"=>"+46");
        $countries[] = array("code"=>"CH","name"=>__("Switzerland"),"d_code"=>"+41");
        $countries[] = array("code"=>"SY","name"=>__("Syria"),"d_code"=>"+963");
        $countries[] = array("code"=>"TW","name"=>__("Taiwan"),"d_code"=>"+886");
        $countries[] = array("code"=>"TJ","name"=>__("Tajikistan"),"d_code"=>"+992");
        $countries[] = array("code"=>"TZ","name"=>__("Tanzania"),"d_code"=>"+255");
        $countries[] = array("code"=>"TH","name"=>__("Thailand"),"d_code"=>"+66");
        $countries[] = array("code"=>"BS","name"=>__("The Bahamas"),"d_code"=>"+1");
        $countries[] = array("code"=>"GM","name"=>__("The Gambia"),"d_code"=>"+220");
        $countries[] = array("code"=>"TL","name"=>__("Timor-Leste"),"d_code"=>"+670");
        $countries[] = array("code"=>"TG","name"=>__("Togo"),"d_code"=>"+228");
        $countries[] = array("code"=>"TK","name"=>__("Tokelau"),"d_code"=>"+690");
        $countries[] = array("code"=>"TO","name"=>__("Tonga"),"d_code"=>"+676");
        $countries[] = array("code"=>"TT","name"=>__("Trinidad and Tobago"),"d_code"=>"+1");
        $countries[] = array("code"=>"TN","name"=>__("Tunisia"),"d_code"=>"+216");
        $countries[] = array("code"=>"TR","name"=>__("Turkey"),"d_code"=>"+90");
        $countries[] = array("code"=>"TM","name"=>__("Turkmenistan"),"d_code"=>"+993");
        $countries[] = array("code"=>"TC","name"=>__("Turks and Caicos Islands"),"d_code"=>"+1");
        $countries[] = array("code"=>"TV","name"=>__("Tuvalu"),"d_code"=>"+688");
        $countries[] = array("code"=>"UG","name"=>__("Uganda"),"d_code"=>"+256");
        $countries[] = array("code"=>"UA","name"=>__("Ukraine"),"d_code"=>"+380");
        $countries[] = array("code"=>"AE","name"=>__("United Arab Emirates"),"d_code"=>"+971");
        $countries[] = array("code"=>"UY","name"=>__("Uruguay"),"d_code"=>"+598");
        $countries[] = array("code"=>"UZ","name"=>__("Uzbekistan"),"d_code"=>"+998");
        $countries[] = array("code"=>"VU","name"=>__("Vanuatu"),"d_code"=>"+678");
        $countries[] = array("code"=>"VA","name"=>__("Vatican City"),"d_code"=>"+379");
        $countries[] = array("code"=>"VE","name"=>__("Venezuela"),"d_code"=>"+58");
        $countries[] = array("code"=>"VN","name"=>__("Vietnam"),"d_code"=>"+84");
        $countries[] = array("code"=>"WF","name"=>__("Wallis and Futuna"),"d_code"=>"+681");
        $countries[] = array("code"=>"YE","name"=>__("Yemen"),"d_code"=>"+967");
        $countries[] = array("code"=>"ZM","name"=>__("Zambia"),"d_code"=>"+260");
        $countries[] = array("code"=>"ZW","name"=>__("Zimbabwe"),"d_code"=>"+263");
        
        return $countries;
    }
}
}
