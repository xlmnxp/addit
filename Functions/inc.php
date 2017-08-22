<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 10/03/17
 * Time: 01:18 ص
 */

    session_start();

    include_once('vendor/autoload.php');
    include_once('phptricksORM/Database.php');
    use PHPtricks\Orm\Database;
    $db = Database::connect();

    function pagination($pages,$results,$total,$page){
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
            array_push($result,array("page" => ($page - 1), "name" => ($language->previous), "active" => false ));
        }

        for ($i = $range['start']; $i <= $range['end']; $i++)
        {
            if($i == $page){
                array_push($result,array("page" => ($i), "name" => $i, "active" => true ));
            }else{
                array_push($result,array("page" => ($i), "name" => $i, "active" => false ));
            }
        }

        if ($page < $totalPages){
            array_push($result,array("page" => ($page + 1), "name" => ($language->next), "active" => false ));
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

    function language_select(){
        global $db;
        $_default = $db->table("settings")->where("name","language")->select(["id","value"])[0]->value;
        $form  = "<form class='navbar-form' method='post' id='language_select'>";
        $form .= "<select class='form-control' onchange='this.parentNode.submit()' name='language'>";
        foreach (glob("Languages/*.json") as $filename) {
            $file = json_decode(file_get_contents($filename));
            preg_match('/Languages\/(.*)\.json/', $filename, $matches,PREG_OFFSET_CAPTURE);
            if(isset($_COOKIE["language"])){
                $selected = $_COOKIE["language"] == $matches[1][0] ? 'selected ' : ' ';
            }else{
                $selected = $_default == $matches[1][0] ? 'selected ' : ' ';
            }
            $form .= "<option {$selected}value='{$matches[1][0]}'>{$file->language_name}</option>";
        }
        $form .= "</select>";
        $form .= "</form>";
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
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
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
        $path = $_SERVER['REQUEST_URI'];

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
                'value' => 1
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
                'value' => 1
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
                'value' => 1
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