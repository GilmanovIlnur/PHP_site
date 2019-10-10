<?php
include "main.php";
class content implements IContent{
    private $num;

    function get_title1()
    {
        return "";
    }

    function get_title2()
    {
        return "Подмножества";
    }

    function show_content()
    {
        print <<< HEADER
<form action="subsets.php" method="post">
    <input type="text" name="number">
    </br>
    <input type="submit" value="Отправить">
</form>
HEADER;
        $this->num = $_POST["number"];
        $this->find_subsets();
    }
    function find_subsets(){
        $array = [];
        $subset = [];
        for ($i = 0; $i <= $this->num; $i++){
            $array[$i - 1] = $i;
        }
        for ($i = 0; $i < 2**$this->num; $i++){
            $binary_array = $this->convert_to_binary_system($i);
            for ($j = 0; $j < count($binary_array); $j++){
                if ($binary_array[$j] == 1){
                    $subset[$j] = $array[$j];
                }

            }
            print_r($subset);
//            for ($i = 0; $i < count($subset); $i++){
//                print($subset[$i]);
//                print("</br>");
//            }
        }
    }

    function convert_to_binary_system($number){
        for ($i = 0; $i < $this->num; $i++){
            $array[$i] = 0;
        }
        $h = 0;
        if ($number != 0){
            while ($number != 1){
                $array[count($array) - 1 - $h] = $number % 2;
                $number = (int)$number/2;
                $h += 1;
                $array[count($array) - $h - 1] = 1;
                return $array;
            }
        }else{
            return [];
        }
    }
}

$p = new main(new content());

