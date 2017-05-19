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
?>