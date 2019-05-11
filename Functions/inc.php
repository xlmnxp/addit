<?php
/**

 * User: xlmnxp
 * Date: 10/03/17
 * Time: 01:18 ص
 */

    session_start();

    include_once('vendor/autoload.php');
    include_once('phptricksORM/Database.php');
    use PHPtricks\Orm\Database;
    $db = Database::connect();

    function pagination($pages,$results,$total,$page,$args = ""){
        global $language;

        $result = array();
        if ($page < 1) $page = 1;

        $numberOfPages = $pages;
        $resultsPerPage = $results;
        $numberOfRows = $total;
        $totalPages = ceil($numberOfRows / $resultsPerPage);

        $halfPages = floor($numberOfPages / 2);
        $range = array('start' => 1, 'end' => $totalPages);
        $isEven = ($numberOfPages % 2 == 0);
        $atRangeEnd = $totalPages - $halfPages;

        if($isEven)
        {
            $atRangeEnd++;
        }

        if($totalPages > $numberOfPages)
        {
            if($page <= $halfPages){
                $range['end'] = $numberOfPages;
            }
            elseif ($page >= $atRangeEnd){
                $range['start'] = $totalPages - $numberOfPages + 1;
            }
            else
            {
                $range['start'] = $page - $halfPages;
                $range['end'] = $page + $halfPages;
                if($isEven) $range['end']--;
            }
        }

        if($page > 1){
            array_push($result,array("page" => '?page=1' . ($args ? '&' . $args : ''), "name" => ($language->first), "active" => false ));
            array_push($result,array("page" => '?page=' . ($page - 1) . ($args ? '&' . $args : ''), "name" => ($language->previous), "active" => false ));
        }
        for ($i = $range['start']; $i <= $range['end']; $i++)
        {
            if($i == $page){
                array_push($result,array("page" => "?page=$i" . ($args ? '&' . $args : ''), "name" => $i, "active" => true ));
            }else{
                array_push($result,array("page" => "?page=$i" . ($args ? '&' . $args : ''), "name" => $i, "active" => false ));
            }
        }


        if ($page < $totalPages){
            array_push($result,array("page" => '?page=' . ($page + 1) . ($args ? '&' . $args : ''), "name" => ($language->next), "active" => false ));
            array_push($result,array("page" => "?page=$totalPages" . ($args ? '&' . $args : ''), "name" => ($language->last), "active" => false ));
        }

        return $result;
    }

    function setlanguage($to){
        global $db,$languageName;
        if($to == "default"){
            $_default = $db->table("settings")->where("name","language")->select(["id","value"])[0]->value;
            $languageName = $_default;
            return $_default;
        }else{
            $languageName = $to;
            return $to;
        }
    }

    function language_select($select = ""){
        global $db;
        $_default   = $db->table("settings")->where("name","language")->select(["id","value"])[0]->value;
        $form       = "";
        foreach (glob("{$select}Languages/*.json") as $filename) {
            $file = json_decode(file_get_contents($filename));
            preg_match('/Languages\/(.*)\.json/', $filename, $matches,PREG_OFFSET_CAPTURE);
            if(isset($_COOKIE["language"])){
                $selected = $_COOKIE["language"] == $matches[1][0] ? 'selected ' : ' ';
            }else{
                $selected = $_default == $matches[1][0] ? 'selected ' : ' ';
            }
            $form .= "<option {$selected}value='{$matches[1][0]}'> {$file->language_name} </option>";
        }
        return $form;
    }

    function template_select($select = "../"){
        global $default;
        $form = "";
        foreach (glob("{$select}Templates/*") as $filename) {
            preg_match('/Templates\/(.*)/', $filename, $matches,PREG_OFFSET_CAPTURE);
            $selected = $default['template'] == $matches[1][0] ? 'selected ' : ' ';

            $form .= "<option {$selected}value='{$matches[1][0]}'> {$matches[1][0]} </option>";
        }
        return $form;
    }

    function getIp(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = getCountries();

        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    /**
     * update Statistics
     */
    function updateStatistics(){
        global $db;
        $day = date("Y-m-d");
        $month = date("Y-m");
        $year = date("Y");
        $path = "".$_SERVER['REQUEST_URI'];

        $getYear = $db->table("statistics")->where('name',$year)->select(['id','value']);
        $getMonth = $db->table("statistics")->where('name',$month)->select(['id','value']);
        $getDay = $db->table("statistics")->where('name',$day)->select(['id','value']);

        if($getYear[0]){
            $db->table("statistics")->where('id',$getYear[0]->id)->update([
                'date' => date('Y-m-d H:i:s'),
                'value' => $getYear[0]->value + 1
            ]);
        }else{
            $db->table("statistics")->insert([
                'id' => null,
                'date' => date('Y-m-d H:i:s'),
                'name' => $year,
                'value' => 1,
                'ip' => getIp()
            ]);
        }

        if($getMonth[0]){
            $db->table("statistics")->where('id',$getMonth[0]->id)->update([
                'date' => date('Y-m-d H:i:s'),
                'value' => $getMonth[0]->value + 1
            ]);
        }else{
            $db->table("statistics")->insert([
                'id' => null,
                'date' => date('Y-m-d H:i:s'),
                'name' => $month,
                'value' => 1,
                'ip' => getIp()
            ]);
        }

        if($getDay[0]){
            $db->table("statistics")->where('id',$getDay[0]->id)->update([
                'date' => date('Y-m-d H:i:s'),
                'value' => $getDay[0]->value + 1
            ]);
        }else{
            $db->table("statistics")->insert([
                'id' => null,
                'date' => date('Y-m-d H:i:s'),
                'name' => $day,
                'value' => 1,
                'ip' => getIp()
            ]);
        }

        $db->table("statistics")->insert([
            'id' => null,
            'date' => date('Y-m-d H:i:s'),
            'name' => date('Y-m-d H:i:s'),
            'value' => $path,
            'ip' => getIp()
        ]);
    }

    function getStatistics($peer= 'day'){
        global $db;

        $year = date("Y");
        $month = date("Y-m");
        $day = date("Y-m-d");

        switch ($peer){
            case 'year':
                $getYear = $db->table("statistics")->where('name',$year)->select(['id','value']);
                if($getYear[0]){
                    return $getYear[0]->value;
                }else{
                    return false;
                }
                break;
            case 'month':
                $getMonth = $db->table("statistics")->where('name',$month)->select(['id','value']);
                if($getMonth[0]){
                    return $getMonth[0]->value;
                }else{
                    return false;
                }
                break;
            case 'day':
                $getDay = $db->table("statistics")->where('name',$day)->select(['id','value']);
                if($getDay[0]){
                    return $getDay[0]->value;
                }else{
                    return false;
                }
                break;

            default:
                return false;
        }
    }

    /**
     * @return array
     */
    function getCountries(){
        return array("AF" => "Afghanistan (‫افغانستان‬‎)", "AX" => "Åland Islands (Åland)", "AL" => "Albania (Shqipëri)", "DZ" => "Algeria (‫الجزائر‬‎)", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AG" => "Antigua and Barbuda", "AR" => "Argentina", "AM" => "Armenia (Հայաստան)", "AW" => "Aruba", "AC" => "Ascension Island", "AU" => "Australia", "AT" => "Austria (Österreich)", "AZ" => "Azerbaijan (Azərbaycan)", "BS" => "Bahamas", "BH" => "Bahrain (‫البحرين‬‎)", "BD" => "Bangladesh (বাংলাদেশ)", "BB" => "Barbados", "BY" => "Belarus (Беларусь)", "BE" => "Belgium (België)", "BZ" => "Belize", "BJ" => "Benin (Bénin)", "BM" => "Bermuda", "BT" => "Bhutan (འབྲུག)", "BO" => "Bolivia", "BA" => "Bosnia and Herzegovina (Босна и Херцеговина)", "BW" => "Botswana", "BV" => "Bouvet Island", "BR" => "Brazil (Brasil)", "IO" => "British Indian Ocean Territory", "VG" => "British Virgin Islands", "BN" => "Brunei", "BG" => "Bulgaria (България)", "BF" => "Burkina Faso", "BI" => "Burundi (Uburundi)", "KH" => "Cambodia (កម្ពុជា)", "CM" => "Cameroon (Cameroun)", "CA" => "Canada", "IC" => "Canary Islands (islas Canarias)", "CV" => "Cape Verde (Kabu Verdi)", "BQ" => "Caribbean Netherlands", "KY" => "Cayman Islands", "CF" => "Central African Republic (République centrafricaine)", "EA" => "Ceuta and Melilla (Ceuta y Melilla)", "TD" => "Chad (Tchad)", "CL" => "Chile", "CN" => "China (中国)", "CX" => "Christmas Island", "CP" => "Clipperton Island", "CC" => "Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))", "CO" => "Colombia", "KM" => "Comoros (‫جزر القمر‬‎)", "CD" => "Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)", "CG" => "Congo (Republic) (Congo-Brazzaville)", "CK" => "Cook Islands", "CR" => "Costa Rica", "CI" => "Côte d’Ivoire", "HR" => "Croatia (Hrvatska)", "CU" => "Cuba", "CW" => "Curaçao", "CY" => "Cyprus (Κύπρος)", "CZ" => "Czech Republic (Česká republika)", "DK" => "Denmark (Danmark)", "DG" => "Diego Garcia", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic (República Dominicana)", "EC" => "Ecuador", "EG" => "Egypt (‫مصر‬‎)", "SV" => "El Salvador", "GQ" => "Equatorial Guinea (Guinea Ecuatorial)", "ER" => "Eritrea", "EE" => "Estonia (Eesti)", "ET" => "Ethiopia", "FK" => "Falkland Islands (Islas Malvinas)", "FO" => "Faroe Islands (Føroyar)", "FJ" => "Fiji", "FI" => "Finland (Suomi)", "FR" => "France", "GF" => "French Guiana (Guyane française)", "PF" => "French Polynesia (Polynésie française)", "TF" => "French Southern Territories (Terres australes françaises)", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia (საქართველო)", "DE" => "Germany (Deutschland)", "GH" => "Ghana (Gaana)", "GI" => "Gibraltar", "GR" => "Greece (Ελλάδα)", "GL" => "Greenland (Kalaallit Nunaat)", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GG" => "Guernsey", "GN" => "Guinea (Guinée)", "GW" => "Guinea-Bissau (Guiné Bissau)", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heard & McDonald Islands", "HN" => "Honduras", "HK" => "Hong Kong (香港)", "HU" => "Hungary (Magyarország)", "IS" => "Iceland (Ísland)", "IN" => "India (भारत)", "ID" => "Indonesia", "IR" => "Iran (‫ایران‬‎)", "IQ" => "Iraq (‫العراق‬‎)", "IE" => "Ireland", "IM" => "Isle of Man", "IL" => "Israel (‫ישראל‬‎)", "IT" => "Italy (Italia)", "JM" => "Jamaica", "JP" => "Japan (日本)", "JE" => "Jersey", "JO" => "Jordan (‫الأردن‬‎)", "KZ" => "Kazakhstan (Казахстан)", "KE" => "Kenya", "KI" => "Kiribati", "XK" => "Kosovo (Kosovë)", "KW" => "Kuwait (‫الكويت‬‎)", "KG" => "Kyrgyzstan (Кыргызстан)", "LA" => "Laos (ລາວ)", "LV" => "Latvia (Latvija)", "LB" => "Lebanon (‫لبنان‬‎)", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libya (‫ليبيا‬‎)", "LI" => "Liechtenstein", "LT" => "Lithuania (Lietuva)", "LU" => "Luxembourg", "MO" => "Macau (澳門)", "MK" => "Macedonia (FYROM) (Македонија)", "MG" => "Madagascar (Madagasikara)", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania (‫موريتانيا‬‎)", "MU" => "Mauritius (Moris)", "YT" => "Mayotte", "MX" => "Mexico (México)", "FM" => "Micronesia", "MD" => "Moldova (Republica Moldova)", "MC" => "Monaco", "MN" => "Mongolia (Монгол)", "ME" => "Montenegro (Crna Gora)", "MS" => "Montserrat", "MA" => "Morocco (‫المغرب‬‎)", "MZ" => "Mozambique (Moçambique)", "MM" => "Myanmar (Burma) (မြန်မာ)", "NA" => "Namibia (Namibië)", "NR" => "Nauru", "NP" => "Nepal (नेपाल)", "NL" => "Netherlands (Nederland)", "NC" => "New Caledonia (Nouvelle-Calédonie)", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger (Nijar)", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "MP" => "Northern Mariana Islands", "KP" => "North Korea (조선 민주주의 인민 공화국)", "NO" => "Norway (Norge)", "OM" => "Oman (‫عُمان‬‎)", "PK" => "Pakistan (‫پاکستان‬‎)", "PW" => "Palau", "PS" => "Palestine (‫فلسطين‬‎)", "PA" => "Panama (Panamá)", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru (Perú)", "PH" => "Philippines", "PN" => "Pitcairn Islands", "PL" => "Poland (Polska)", "PT" => "Portugal", "PR" => "Puerto Rico", "QA" => "Qatar (‫قطر‬‎)", "RE" => "Réunion (La Réunion)", "RO" => "Romania (România)", "RU" => "Russia (Россия)", "RW" => "Rwanda", "BL" => "Saint Barthélemy (Saint-Barthélemy)", "SH" => "Saint Helena", "KN" => "Saint Kitts and Nevis", "LC" => "Saint Lucia", "MF" => "Saint Martin (Saint-Martin (partie française))", "PM" => "Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)", "WS" => "Samoa", "SM" => "San Marino", "ST" => "São Tomé and Príncipe (São Tomé e Príncipe)", "SA" => "Saudi Arabia (‫المملكة العربية السعودية‬‎)", "SN" => "Senegal (Sénégal)", "RS" => "Serbia (Србија)", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SX" => "Sint Maarten", "SK" => "Slovakia (Slovensko)", "SI" => "Slovenia (Slovenija)", "SB" => "Solomon Islands", "SO" => "Somalia (Soomaaliya)", "ZA" => "South Africa", "GS" => "South Georgia & South Sandwich Islands", "KR" => "South Korea (대한민국)", "SS" => "South Sudan (‫جنوب السودان‬‎)", "ES" => "Spain (España)", "LK" => "Sri Lanka (ශ්‍රී ලංකාව)", "VC" => "St. Vincent & Grenadines", "SD" => "Sudan (‫السودان‬‎)", "SR" => "Suriname", "SJ" => "Svalbard and Jan Mayen (Svalbard og Jan Mayen)", "SZ" => "Swaziland", "SE" => "Sweden (Sverige)", "CH" => "Switzerland (Schweiz)", "SY" => "Syria (‫سوريا‬‎)", "TW" => "Taiwan (台灣)", "TJ" => "Tajikistan", "TZ" => "Tanzania", "TH" => "Thailand (ไทย)", "TL" => "Timor-Leste", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "Trinidad and Tobago", "TA" => "Tristan da Cunha", "TN" => "Tunisia (‫تونس‬‎)", "TR" => "Turkey (Türkiye)", "TM" => "Turkmenistan", "TC" => "Turks and Caicos Islands", "TV" => "Tuvalu", "UM" => "U.S. Outlying Islands", "VI" => "U.S. Virgin Islands", "UG" => "Uganda", "UA" => "Ukraine (Україна)", "AE" => "United Arab Emirates (‫الإمارات العربية المتحدة‬‎)", "GB" => "United Kingdom", "US" => "United States", "UY" => "Uruguay", "UZ" => "Uzbekistan (Oʻzbekiston)", "VU" => "Vanuatu", "VA" => "Vatican City (Città del Vaticano)", "VE" => "Venezuela", "VN" => "Vietnam (Việt Nam)", "WF" => "Wallis and Futuna", "EH" => "Western Sahara (‫الصحراء الغربية‬‎)", "YE" => "Yemen (‫اليمن‬‎)", "ZM" => "Zambia", "ZW" => "Zimbabwe" );
    }

    /**
     * @return array
     */
    function getCategories(){
        global $db;
        return $db->table("categories")->select();
    }


    function recaptcha_vaild($secret_key) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $secret_key,
            'response' => $_POST["g-recaptcha-response"]
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded",
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success= json_decode($verify);

        return $captcha_success->success;
    }

    class formValidate
    {
        //Here we store the generated form key
        private $formKey;

        //Here we store the old form key (more info at step 4)
        private $old_formKey;

        //The constructor stores the form key (if one excists) in our class variable
        function __construct()
        {
            //We need the previous key so we store it
            if(isset($_SESSION['form_key']))
            {
                $this->old_formKey = $_SESSION['form_key'];
            }
        }

        //Function to generate the form key
        private function generateKey()
        {
            //Get the IP-address of the user
            $ip = $_SERVER['REMOTE_ADDR'];

            //We use mt_rand() instead of rand() because it is better for generating random numbers.
            //We use 'true' to get a longer string.
            //See http://www.php.net/mt_rand for a precise description of the function and more examples.
            $uniqid = uniqid(mt_rand(), true);

            //Return the hash
            return md5($ip . $uniqid);
        }


        //Function to output the form key
        public function outputKey()
        {
            //Generate the key and store it inside the class
            $this->formKey = $this->generateKey();
            //Store the form key in the session
            $_SESSION['form_key'] = $this->formKey;

            //Output the form key
            return "<input type='hidden' name='form_key' id='form_key' value='".$this->formKey."' />";
        }


        //Function that validated the form key POST data
        public function validate()
        {
            //We use the old formKey and not the new generated version
            if($_POST['form_key'] == $this->old_formKey)
            {
                //The key is valid, return true.
                return true;
            }
            else
            {
                //The key is invalid, return false.
                return false;
            }
        }
    }