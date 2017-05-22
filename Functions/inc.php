<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 10/03/17
 * Time: 01:18 ص
 */
    include_once('Functions/Database.php');
    use PHPtricks\Database\Database;
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
        $form  = "<form class='navbar-form pull-left' method='post' id='language_select'>";
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