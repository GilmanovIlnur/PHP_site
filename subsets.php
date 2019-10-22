<?php
include "main.php";
//Алгоритм Нарайяны Лиса + Волк = Звери; Синус + Синус = Тангенс - Тангенс Пример.
class subsets implements IContent{
    private $num;
    private $subsets = [];

    function get_title1()
    {
        return "";
    }

    function get_title2()
    {
        return "";
    }

    function show_content()
    {
        print <<< HEADER
<div class="shadow-sm p-3 mb-5 bg-#ECF0F1 rounded" style="text-align: center; padding-top: 30px" class="page">
    <h5 style="font-family: 'Muli', sans-serif;">Введите число n от [0,16]. Вы получите все подмножества n-элементного множества. </h5>
    <form name="form" action="subsets.php" method="post" onsubmit="return validateForm()">
        <input type="text" name="number">
        </br>
        <input type="checkbox" name="sort">
        Отсортировать подмножества?
        </br>
        <button type="submit" class="btn btn-success">Получить</button>
    </form>
</div>

HEADER;


        if (isset($_POST["number"])){
            $this->num = $_POST["number"];
            print ("<h3 style='text-align: center'>Вы ввели число - $this->num</h3> </br>");
            $this->find_subsets();
        }

    }
    function find_subsets(){
        $array = [];
        for ($i = 0; $i <= $this->num; $i++){
            $array[$i - 1] = $i;
        }
        $count = 0;
        for ($i = 0; $i < 2**$this->num; $i++){
            $subset = [];
            $binary_array = $this->convert_to_binary_system($i);
            $k =0;
            for ($j = 0; $j < count($binary_array); $j++){
                if ($binary_array[$j] == 1){
                    $subset[$k] = $array[$j];
                    $k++;
                }
            }
            $this->subsets[$count] = $subset;
            $count++;
        }
        if (isset($_POST["sort"])) {
            $this->sortSubsets();
        }
        $this->print_subsets();

    }

    function sortSubsets(){
        for ($i = 0; $i < count($this->subsets) - 1; $i++){
            $num = $this->findElementsNumber($this->subsets[$i]);
            for ($j = $i+1; $j < count($this->subsets); $j++){
                $curr = $this->findElementsNumber($this->subsets[$j]);
                if ((int)$num > (int)$curr){
                    $temp = $this->subsets[$i];
                    $this->subsets[$i] = $this->subsets[$j];
                    $this->subsets[$j] = $temp;
                    $num = $this->findElementsNumber($this->subsets[$i]);
                }
            }
        }
    }

    function findElementsNumber($array){
        $num = '';
        for ($i = 0; $i < count($array); $i++){
            if ($array[$i] != 0){
                $num = $num.$array[$i];
            }
        }
        if ($num == ''){
            return 0;
        }
        return $num;
    }

    function print_subsets(){
        print <<<HEADER
<table class="table table-striped">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Подмножество</th>
    </tr>
  </thead>
    <tbody>
HEADER;
        $count = 1;

        for ($i = 0; $i < count($this->subsets); $i++){
            $str = "{ ";
            for ($j=0; $j < count($this->subsets[$i]); $j++){
                $str = $str.$this->subsets[$i][$j]." ";

            }
            $str = $str."}";
            print "
                     <th scope=\"row\">$count</th>
                        <td>$str</td>
                    </tr>";
            $count ++;

        }
        print "</tbody></table>";
    }

    function convert_to_binary_system($number){
        for ($i = 0; $i < $this->num; $i++){
            $array[$i] = 0;
        }
        $h = 0;
        if ($number != 0){
            while ($number != 1){
                $array[count($array) - 1 - $h] = $number % 2;
                $number = (int)($number/2);
                $h += 1;
            }
            $array[count($array) - $h - 1] = 1;
            return $array;
        }else{
            return [];
        }
    }
}

$p = new main(new subsets());

