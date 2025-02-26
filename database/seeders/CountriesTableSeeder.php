<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = 
        [
                [
                    "code"=>"+93",
                    "name"=>"Afghanistan"
                ],
                [
                    "code"=>"+355",
                    "name"=>"Albania"
                ],
                [
                    "code"=>"+213",
                    "name"=>"Algeria"
                ],
                [
                    "code"=>"+1 684",
                    "name"=>"American Samoa"
                ],
                [
                    "code"=>"+376",
                    "name"=>"Andorra"
                ],
                [
                    "code"=>"+244",
                    "name"=>"Angola"
                ],
                [
                    "code"=>"+1 264",
                    "name"=>"Anguilla"
                ],
                [
                    "code"=>"+672",
                    "name"=>"Antarctica",
                ],
                [
                    "code"=>"+1268",
                    "name"=>"Antigua and Barbuda",
                ],
                [
                    "code"=>"+54",
                    "name"=>"Argentina",
                ],
                [
                    "code"=>"+374",
                    "name"=>"Armenia",
                ],
                [
                    "code"=>"+297",
                    "name"=>"Aruba",
                ],
                [
                    "code"=>"+61",
                    "name"=>"Australia",
                ],
                [
                    "id"=>14,
                    "code"=>"+43",
                    "name"=>"Austria",

                ],
                [
                    "id"=>15,
                    "code"=>"+994",
                    "name"=>"Azerbaijan",

                ],
                [
                    "id"=>16,
                    "code"=>"+1 242",
                    "name"=>"Bahamas",

                ],
                [
                    "id"=>17,
                    "code"=>"+973",
                    "name"=>"Bahrain",

                ],
                [
                    "id"=>18,
                    "code"=>"+880",
                    "name"=>"Bangladesh",

                ],
                [
                    "id"=>19,
                    "code"=>"+1 246",
                    "name"=>"Barbados",

                ],
                [
                    "id"=>20,
                    "code"=>"+375",
                    "name"=>"Belarus",

                ],
                [
                    "id"=>21,
                    "code"=>"+32",
                    "name"=>"Belgium",

                ],
                [
                    "id"=>22,
                    "code"=>"+501",
                    "name"=>"Belize",

                ],
                [
                    "id"=>23,
                    "code"=>"+229",
                    "name"=>"Benin",

                ],
                [
                    "id"=>24,
                    "code"=>"+1 441",
                    "name"=>"Bermuda",

                ],
                [
                    "id"=>25,
                    "code"=>"+975",
                    "name"=>"Bhutan",

                ],
                [
                    "id"=>26,
                    "code"=>"+591",
                    "name"=>"Bolivia",

                ],
                [
                    "id"=>27,
                    "code"=>"+387",
                    "name"=>"Bosnia and Herzegovina",

                ],
                [
                    "id"=>28,
                    "code"=>"+267",
                    "name"=>"Botswana",

                ],
                [
                    "id"=>29,
                    "code"=>"+55",
                    "name"=>"Bouvet Island",

                ],
                [
                    "id"=>30,
                    "code"=>"+55",
                    "name"=>"Brazil",

                ],
                [
                    "id"=>31,
                    "code"=>"+246",
                    "name"=>"British Indian Ocean Territory",

                ],
                [
                    "id"=>32,
                    "code"=>"+673",
                    "name"=>"Brunei Darussalam",

                ],
                [
                    "id"=>33,
                    "code"=>"+359",
                    "name"=>"Bulgaria",

                ],
                [
                    "id"=>34,
                    "code"=>"+226",
                    "name"=>"Burkina Faso",

                ],
                [
                    "id"=>35,
                    "code"=>"+257",
                    "name"=>"Burundi",

                ],
                [
                    "id"=>36,
                    "code"=>"+855",
                    "name"=>"Cambodia",

                ],
                [
                    "id"=>37,
                    "code"=>"+237",
                    "name"=>"Cameroon",

                ],
                [
                    "id"=>38,
                    "code"=>"+1",
                    "name"=>"Canada",

                ],
                [
                    "id"=>39,
                    "code"=>"+238",
                    "name"=>"Cape Verde",

                ],
                [
                    "id"=>40,
                    "code"=>"+1345",
                    "name"=>"Cayman Islands",

                ],
                [
                    "id"=>41,
                    "code"=>"+236",
                    "name"=>"Central African Republic",

                ],
                [
                    "id"=>42,
                    "code"=>"+235",
                    "name"=>"Chad",

                ],
                [
                    "id"=>43,
                    "code"=>"+56",
                    "name"=>"Chile",

                ],
                [
                    "id"=>44,
                    "code"=>"+86",
                    "name"=>"China",

                ],
                [
                    "id"=>45,
                    "code"=>"+61",
                    "name"=>"Christmas Island",

                ],
                [
                    "id"=>46,
                    "code"=>"+61",
                    "name"=>"Cocos (Keeling) Islands",

                ],
                [
                    "id"=>47,
                    "code"=>"+57",
                    "name"=>"Colombia",

                ],
                [
                    "id"=>48,
                    "code"=>"+269",
                    "name"=>"Comoros",

                ],
                [
                    "id"=>49,
                    "code"=>"+242",
                    "name"=>"Congo",

                ],
                [
                    "id"=>50,
                    "code"=>"+243",
                    "name"=>"Congo, The Democratic Republic of the",

                ],
                [
                    "id"=>51,
                    "code"=>"+682",
                    "name"=>"Cook Islands",

                ],
                [
                    "id"=>52,
                    "code"=>"+506",
                    "name"=>"Costa Rica",

                ],
                [
                    "id"=>53,
                    "code"=>"+225",
                    "name"=>"Cote d'Ivoire",

                ],
                [
                    "id"=>54,
                    "code"=>"+385",
                    "name"=>"Croatia",

                ],
                [
                    "id"=>55,
                    "code"=>"+53",
                    "name"=>"Cuba",

                ],
                [
                    "id"=>56,
                    "code"=>"+357",
                    "name"=>"Cyprus",

                ],
                [
                    "id"=>57,
                    "code"=>"+420",
                    "name"=>"Czech Republic",

                ],
                [
                    "id"=>58,
                    "code"=>"+45",
                    "name"=>"Denmark",

                ],
                [
                    "id"=>59,
                    "code"=>"+253",
                    "name"=>"Djibouti",

                ],
                [
                    "id"=>60,
                    "code"=>"+1 767",
                    "name"=>"Dominica",

                ],
                [
                    "id"=>61,
                    "code"=>"+1 849",
                    "name"=>"Dominican Republic",

                ],
                [
                    "id"=>62,
                    "code"=>"+593",
                    "name"=>"Ecuador",

                ],
                [
                    "id"=>63,
                    "code"=>"+20",
                    "name"=>"Egypt",

                ],
                [
                    "id"=>64,
                    "code"=>"+503",
                    "name"=>"El Salvador",

                ],
                [
                    "id"=>65,
                    "code"=>"+240",
                    "name"=>"Equatorial Guinea",

                ],
                [
                    "id"=>66,
                    "code"=>"+291",
                    "name"=>"Eritrea",

                ],
                [
                    "id"=>67,
                    "code"=>"+372",
                    "name"=>"Estonia",

                ],
                [
                    "id"=>68,
                    "code"=>"+251",
                    "name"=>"Ethiopia",

                ],
                [
                    "id"=>69,
                    "code"=>"+500",
                    "name"=>"Falkland Islands (Malvinas)",

                ],
                [
                    "id"=>70,
                    "code"=>"+298",
                    "name"=>"Faroe Islands",

                ],
                [
                    "id"=>71,
                    "code"=>"+679",
                    "name"=>"Fiji",

                ],
                [
                    "id"=>72,
                    "code"=>"+358",
                    "name"=>"Finland",

                ],
                [
                    "id"=>73,
                    "code"=>"+33",
                    "name"=>"France",

                ],
                [
                    "id"=>74,
                    "code"=>"+594",
                    "name"=>"French Guiana",

                ],
                [
                    "id"=>75,
                    "code"=>"+689",
                    "name"=>"French Polynesia",

                ],
                [
                    "id"=>76,
                    "code"=>"+262",
                    "name"=>"French Southern and Antarctic Lands",

                ],
                [
                    "id"=>77,
                    "code"=>"+241",
                    "name"=>"Gabon",

                ],
                [
                    "id"=>78,
                    "code"=>"+220",
                    "name"=>"Gambia",

                ],
                [
                    "id"=>79,
                    "code"=>"+995",
                    "name"=>"Georgia",

                ],
                [
                    "id"=>80,
                    "code"=>"+49",
                    "name"=>"Germany",

                ],
                [
                    "id"=>81,
                    "code"=>"+233",
                    "name"=>"Ghana",

                ],
                [
                    "id"=>82,
                    "code"=>"+350",
                    "name"=>"Gibraltar",

                ],
                [
                    "id"=>83,
                    "code"=>"+30",
                    "name"=>"Greece",

                ],
                [
                    "id"=>84,
                    "code"=>"+299",
                    "name"=>"Greenland",

                ],
                [
                    "id"=>85,
                    "code"=>"+1 473",
                    "name"=>"Grenada",

                ],
                [
                    "id"=>86,
                    "code"=>"+590",
                    "name"=>"Guadeloupe",

                ],
                [
                    "id"=>87,
                    "code"=>"+1 671",
                    "name"=>"Guam",

                ],
                [
                    "id"=>88,
                    "code"=>"+502",
                    "name"=>"Guatemala",

                ],
                [
                    "id"=>89,
                    "code"=>"+44",
                    "name"=>"Guernsey",

                ],
                [
                    "id"=>90,
                    "code"=>"+224",
                    "name"=>"Guinea",

                ],
                [
                    "id"=>91,
                    "code"=>"+245",
                    "name"=>"Guinea-Bissau",

                ],
                [
                    "id"=>92,
                    "code"=>"+592",
                    "name"=>"Guyana",

                ],
                [
                    "id"=>93,
                    "code"=>"+509",
                    "name"=>"Haiti",

                ],
                [
                    "id"=>94,
                    "code"=>"+672",
                    "name"=>"Heard Island and McDonald Islands",

                ],
                [
                    "id"=>95,
                    "code"=>"+379",
                    "name"=>"Holy See (Vatican City State)",

                ],
                [
                    "id"=>96,
                    "code"=>"+504",
                    "name"=>"Honduras",

                ],
                [
                    "id"=>97,
                    "code"=>"+852",
                    "name"=>"Hong Kong",

                ],
                [
                    "id"=>98,
                    "code"=>"+36",
                    "name"=>"Hungary",

                ],
                [
                    "id"=>99,
                    "code"=>"+354",
                    "name"=>"Iceland",

                ],
                [
                    "id"=>100,
                    "code"=>"+91",
                    "name"=>"India",

                ],
                [
                    "id"=>101,
                    "code"=>"+62",
                    "name"=>"Indonesia",

                ],
                [
                    "id"=>102,
                    "code"=>"+98",
                    "name"=>"Iran",

                ],
                [
                    "id"=>103,
                    "code"=>"+964",
                    "name"=>"Iraq",

                ],
                [
                    "id"=>104,
                    "code"=>"+353",
                    "name"=>"Ireland",

                ],
                [
                    "id"=>105,
                    "code"=>"+44",
                    "name"=>"Isle of Man",

                ],
                [
                    "id"=>106,
                    "code"=>"+972",
                    "name"=>"Israel",

                ],
                [
                    "id"=>107,
                    "code"=>"+39",
                    "name"=>"Italy",

                ],
                [
                    "id"=>108,
                    "code"=>"+1 876",
                    "name"=>"Jamaica",

                ],
                [
                    "id"=>109,
                    "code"=>"+81",
                    "name"=>"Japan",

                ],
                [
                    "id"=>110,
                    "code"=>"+44",
                    "name"=>"Jersey",

                ],
                [
                    "id"=>111,
                    "code"=>"+962",
                    "name"=>"Jordan",

                ],
                [
                    "id"=>112,
                    "code"=>"+7",
                    "name"=>"Kazakhstan",

                ],
                [
                    "id"=>113,
                    "code"=>"+254",
                    "name"=>"Kenya",

                ],
                [
                    "id"=>114,
                    "code"=>"+686",
                    "name"=>"Kiribati",

                ],
                [
                    "id"=>115,
                    "code"=>"+850",
                    "name"=>"Korea, Democratic Peoples Republic of",

                ],
                [
                    "id"=>116,
                    "code"=>"+82",
                    "name"=>"Korea, Republic of",

                ],
                [
                    "id"=>117,
                    "code"=>"+965",
                    "name"=>"Kuwait",

                ],
                [
                    "id"=>118,
                    "code"=>"+996",
                    "name"=>"Kyrgyzstan",

                ],
                [
                    "id"=>119,
                    "code"=>"+856",
                    "name"=>"Lao Peoples Democratic Republic",

                ],
                [
                    "id"=>120,
                    "code"=>"+371",
                    "name"=>"Latvia",

                ],
                [
                    "id"=>121,
                    "code"=>"+961",
                    "name"=>"Lebanon",

                ],
                [
                    "id"=>122,
                    "code"=>"+266",
                    "name"=>"Lesotho",

                ],
                [
                    "id"=>123,
                    "code"=>"+231",
                    "name"=>"Liberia",

                ],
                [
                    "id"=>124,
                    "code"=>"+218",
                    "name"=>"Libyan Arab Jamahiriya",

                ],
                [
                    "id"=>125,
                    "code"=>"+423",
                    "name"=>"Liechtenstein",

                ],
                [
                    "id"=>126,
                    "code"=>"+370",
                    "name"=>"Lithuania",

                ],
                [
                    "id"=>127,
                    "code"=>"+352",
                    "name"=>"Luxembourg",

                ],
                [
                    "id"=>128,
                    "code"=>"+853",
                    "name"=>"Macao",

                ],
                [
                    "id"=>129,
                    "code"=>"+389",
                    "name"=>"Macedonia",

                ],
                [
                    "id"=>130,
                    "code"=>"+261",
                    "name"=>"Madagascar",

                ],
                [
                    "id"=>131,
                    "code"=>"+265",
                    "name"=>"Malawi",

                ],
                [
                    "id"=>132,
                    "code"=>"+60",
                    "name"=>"Malaysia",

                ],
                [
                    "id"=>133,
                    "code"=>"+960",
                    "name"=>"Maldives",

                ],
                [
                    "id"=>134,
                    "code"=>"+223",
                    "name"=>"Mali",

                ],
                [
                    "id"=>135,
                    "code"=>"+356",
                    "name"=>"Malta",

                ],
                [
                    "id"=>136,
                    "code"=>"+692",
                    "name"=>"Marshall Islands",

                ],
                [
                    "id"=>137,
                    "code"=>"+596",
                    "name"=>"Martinique",

                ],
                [
                    "id"=>138,
                    "code"=>"+222",
                    "name"=>"Mauritania",

                ],
                [
                    "id"=>139,
                    "code"=>"+230",
                    "name"=>"Mauritius",

                ],
                [
                    "id"=>140,
                    "code"=>"+262",
                    "name"=>"Mayotte",

                ],
                [
                    "id"=>141,
                    "code"=>"+52",
                    "name"=>"Mexico",

                ],
                [
                    "id"=>142,
                    "code"=>"+691",
                    "name"=>"Micronesia, Federated States of",

                ],
                [
                    "id"=>143,
                    "code"=>"+373",
                    "name"=>"Moldova, Republic of",

                ],
                [
                    "id"=>144,
                    "code"=>"+377",
                    "name"=>"Monaco",

                ],
                [
                    "id"=>145,
                    "code"=>"+976",
                    "name"=>"Mongolia",

                ],
                [
                    "id"=>146,
                    "code"=>"+382",
                    "name"=>"Montenegro",

                ],
                [
                    "id"=>147,
                    "code"=>"+1664",
                    "name"=>"Montserrat",

                ],
                [
                    "id"=>148,
                    "code"=>"+212",
                    "name"=>"Morocco",

                ],
                [
                    "id"=>149,
                    "code"=>"+258",
                    "name"=>"Mozambique",

                ],
                [
                    "id"=>150,
                    "code"=>"+95",
                    "name"=>"Myanmar",

                ],
                [
                    "id"=>151,
                    "code"=>"+264",
                    "name"=>"Namibia",

                ],
                [
                    "id"=>152,
                    "code"=>"+674",
                    "name"=>"Nauru",

                ],
                [
                    "id"=>153,
                    "code"=>"+977",
                    "name"=>"Nepal",

                ],
                [
                    "id"=>154,
                    "code"=>"+31",
                    "name"=>"Netherlands",

                ],
                [
                    "id"=>155,
                    "code"=>"+64",
                    "name"=>"New Zealand",

                ],
                [
                    "id"=>156,
                    "code"=>"+505",
                    "name"=>"Nicaragua",

                ],
                [
                    "id"=>157,
                    "code"=>"+227",
                    "name"=>"Niger",

                ],
                [
                    "id"=>158,
                    "code"=>"+234",
                    "name"=>"Nigeria",

                ],
                [
                    "id"=>159,
                    "code"=>"+683",
                    "name"=>"Niue",

                ],
                [
                    "id"=>160,
                    "code"=>"+672",
                    "name"=>"Norfolk Island",

                ],
                [
                    "id"=>161,
                    "code"=>"+1 670",
                    "name"=>"Northern Mariana Islands",

                ],
                [
                    "id"=>162,
                    "code"=>"+47",
                    "name"=>"Norway",

                ],
                [
                    "id"=>163,
                    "code"=>"+968",
                    "name"=>"Oman",

                ],
                [
                    "id"=>164,
                    "code"=>"+92",
                    "name"=>"Pakistan",

                ],
                [
                    "id"=>165,
                    "code"=>"+680",
                    "name"=>"Palau",

                ],
                [
                    "id"=>166,
                    "code"=>"+970",
                    "name"=>"Palestinian Territory",

                ],
                [
                    "id"=>167,
                    "code"=>"+507",
                    "name"=>"Panama",

                ],
                [
                    "id"=>168,
                    "code"=>"+675",
                    "name"=>"Papua New Guinea",

                ],
                [
                    "id"=>169,
                    "code"=>"+595",
                    "name"=>"Paraguay",

                ],
                [
                    "id"=>170,
                    "code"=>"+51",
                    "name"=>"Peru",

                ],
                [
                    "id"=>171,
                    "code"=>"+63",
                    "name"=>"Philippines",

                ],
                [
                    "id"=>172,
                    "code"=>"+870",
                    "name"=>"Pitcairn",

                ],
                [
                    "id"=>173,
                    "code"=>"+48",
                    "name"=>"Poland",

                ],
                [
                    "id"=>174,
                    "code"=>"+351",
                    "name"=>"Portugal",

                ],
                [
                    "id"=>175,
                    "code"=>"+1 939",
                    "name"=>"Puerto Rico",

                ],
                [
                    "id"=>176,
                    "code"=>"+974",
                    "name"=>"Qatar",

                ],
                [
                    "id"=>177,
                    "code"=>"+40",
                    "name"=>"Romania",

                ],
                [
                    "id"=>178,
                    "code"=>"+7",
                    "name"=>"Russia",

                ],
                [
                    "id"=>179,
                    "code"=>"+250",
                    "name"=>"Rwanda",

                ],
                [
                    "id"=>180,
                    "code"=>"+290",
                    "name"=>"Saint Helena",

                ],
                [
                    "id"=>181,
                    "code"=>"+1 869",
                    "name"=>"Saint Kitts and Nevis",

                ],
                [
                    "id"=>182,
                    "code"=>"+1 758",
                    "name"=>"Saint Lucia",

                ],
                [
                    "id"=>183,
                    "code"=>"+1 784",
                    "name"=>"Saint Vincent and the Grenadines",

                ],
                [
                    "id"=>184,
                    "code"=>"+685",
                    "name"=>"Samoa",

                ],
                [
                    "id"=>185,
                    "code"=>"+378",
                    "name"=>"San Marino",

                ],
                [
                    "id"=>186,
                    "code"=>"+239",
                    "name"=>"Sao Tome and Principe",

                ],
                [
                    "id"=>187,
                    "code"=>"+966",
                    "name"=>"Saudi Arabia",

                ],
                [
                    "id"=>188,
                    "code"=>"+221",
                    "name"=>"Senegal",

                ],
                [
                    "id"=>189,
                    "code"=>"+381",
                    "name"=>"Serbia",

                ],
                [
                    "id"=>190,
                    "code"=>"+248",
                    "name"=>"Seychelles",

                ],
                [
                    "id"=>191,
                    "code"=>"+232",
                    "name"=>"Sierra Leone",

                ],
                [
                    "id"=>192,
                    "code"=>"+65",
                    "name"=>"Singapore",

                ],
                [
                    "id"=>193,
                    "code"=>"+421",
                    "name"=>"Slovakia",

                ],
                [
                    "id"=>194,
                    "code"=>"+386",
                    "name"=>"Slovenia",

                ],
                [
                    "id"=>195,
                    "code"=>"+677",
                    "name"=>"Solomon Islands",

                ],
                [
                    "id"=>196,
                    "code"=>"+252",
                    "name"=>"Somalia",

                ],
                [
                    "id"=>197,
                    "code"=>"+27",
                    "name"=>"South Africa",

                ],
                [
                    "id"=>198,
                    "code"=>"+34",
                    "name"=>"Spain",

                ],
                [
                    "id"=>199,
                    "code"=>"+94",
                    "name"=>"Sri Lanka",

                ],
                [
                    "id"=>200,
                    "code"=>"+249",
                    "name"=>"Sudan",

                ],
                [
                    "id"=>201,
                    "code"=>"+597",
                    "name"=>"Suriname",

                ],
                [
                    "id"=>202,
                    "code"=>"+46",
                    "name"=>"Sweden",

                ],
                [
                    "id"=>203,
                    "code"=>"+41",
                    "name"=>"Switzerland",

                ],
                [
                    "id"=>204,
                    "code"=>"+963",
                    "name"=>"Syria",

                ],
                [
                    "id"=>205,
                    "code"=>"+886",
                    "name"=>"Taiwan",

                ],
                [
                    "id"=>206,
                    "code"=>"+992",
                    "name"=>"Tajikistan",

                ],
                [
                    "id"=>207,
                    "code"=>"+255",
                    "name"=>"Tanzania",

                ],
                [
                    "id"=>208,
                    "code"=>"+66",
                    "name"=>"Thailand",

                ],
                [
                    "id"=>209,
                    "code"=>"+228",
                    "name"=>"Togo",

                ],
                [
                    "id"=>210,
                    "code"=>"+690",
                    "name"=>"Tokelau",

                ],
                [
                    "id"=>211,
                    "code"=>"+676",
                    "name"=>"Tonga",

                ],
                [
                    "id"=>212,
                    "code"=>"+1 868",
                    "name"=>"Trinidad and Tobago",

                ],
                [
                    "id"=>213,
                    "code"=>"+216",
                    "name"=>"Tunisia",

                ],
                [
                    "id"=>214,
                    "code"=>"+90",
                    "name"=>"Turkey",

                ],
                [
                    "id"=>215,
                    "code"=>"+993",
                    "name"=>"Turkmenistan",

                ],
                [
                    "id"=>216,
                    "code"=>"+688",
                    "name"=>"Tuvalu",

                ],
                [
                    "id"=>217,
                    "code"=>"+256",
                    "name"=>"Uganda",

                ],
                [
                    "id"=>218,
                    "code"=>"+380",
                    "name"=>"Ukraine",

                ],
                [
                    "id"=>219,
                    "code"=>"+971",
                    "name"=>"United Arab Emirates",

                ],
                [
                    "id"=>220,
                    "code"=>"+44",
                    "name"=>"United Kingdom",

                ],
                [
                    "id"=>221,
                    "code"=>"+1",
                    "name"=>"United States",

                ],
                [
                    "id"=>222,
                    "code"=>"+598",
                    "name"=>"Uruguay",

                ],
                [
                    "id"=>223,
                    "code"=>"+998",
                    "name"=>"Uzbekistan",

                ],
                [
                    "id"=>224,
                    "code"=>"+678",
                    "name"=>"Vanuatu",

                ],
                [
                    "id"=>225,
                    "code"=>"+58",
                    "name"=>"Venezuela",

                ],
                [
                    "id"=>226,
                    "code"=>"+84",
                    "name"=>"Vietnam",

                ],
                [
                    "id"=>227,
                    "code"=>"+681",
                    "name"=>"Wallis and Futuna",

                ],
                [
                    "code"=>"+732",
                    "name"=>"Western Sahara",
                ],
                [
                    "code"=>"+967",
                    "name"=>"Yemen",
                ],
                [
                    "code"=>"+260",
                    "name"=>"Zambia",
                ],
                [
                    "code"=>"+263",
                    "name"=>"Zimbabwe",
                ]

        ];

        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country['name'],
                'code'=>   $country['code'],
                'status'=>1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
