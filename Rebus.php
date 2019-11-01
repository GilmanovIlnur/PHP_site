<?php
include "main.php";
set_time_limit(1000);

class Rebus implements IContent
{
    private $permutations = [];
    private $str;
    private $firstLetters = [];

    function get_title1()
    {

    }

    function get_title2()
    {

    }

    function show_content()
    {
        ?>
    <form action="Rebus.php" method="get">
        <input type="text" placeholder="Введите ребус" name="r">
        </br>
        <input type="submit" value="Решить">
    </form>
        <?php

        //$this->generatePermutations(10,10);//n = 10 - количество цифр,  m = количесвтво букв различных.
        if (isset($_GET['r'])){
            //print (strlen("a"));
            $this->str = $_GET['r'];
            $this->findFirstLetters(preg_split("/[+=-]/", $this->str));
//            $ma ="8";
//            $p = eval('return '.$ma.';');
//            print $p;
            $letters = $this->parseInput($this->str);
            print_r($letters);
            $this->generatePermutations(10,count($letters));
            $this->findSolution($letters);

        }
    }
    function findFirstLetters(array $pr){
        foreach ($pr as $promise){
            if (strlen($promise) != 1){
                array_push( $this->firstLetters, $promise{0});
            }
        }
    }

    function findSolution(array $letters){

        foreach ($this->permutations as $permutation){
            $possibleSolution = [];
            for ($i = 0; $i < count($permutation); $i++){
                //print_r($permutation);
                if (($permutation[$i] == 0) and (in_array($letters[$i], $this->firstLetters))){
                    continue 2;
                }
                $possibleSolution[$letters[$i]] = $permutation[$i];
            }
            list ($fl, $str) = $this->checkSolution($possibleSolution);
            if ($fl){
                print $str;
                print "</br>";
            }
        }
    }

    function checkSolution(array $possibleSolution){
        //print_r($possibleSolution);
        $strc = $this->str;
        foreach ($possibleSolution as $key => $value) {
            $strc = str_replace($key, $value, $strc);
        }

        $splitted = explode("=", $strc);
        //print_r($splitted);
        $l = eval('return '.$splitted[0].';');
        $p = eval('return '.$splitted[1].';');

            if ((int)$l == (int)$p){
                return array(true, $strc);
            }else{
                return array(false, '');
            }
    }

    function parseInput($str):array
    {
        $str = str_replace([' ', '(', ')', '-', '+', '='], '', $str);
        $split = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);

        $uniqueChars = [];
        foreach ($split as $v)
        {
            if (in_array($v, $uniqueChars))
                continue;
            array_push($uniqueChars, $v);
        }
        return $uniqueChars;
    }

    function find($n, $arr){
        foreach ($arr as $item) {
            if ($item == $n){
                return true;
            }
        }
        return false;
    }
    function printArray(array $arr){
        foreach ($arr as $elem){
            print "$elem ";
        }
        print "</br>";
    }

    function generatePermutations(int $n, int $m, $prefix = [])
    {
        if ($m == 0){
            array_push($this->permutations, $prefix);
            //$this->printArray($prefix);
            return;
        }
        for ($i = 0; $i < $n; $i++){
            if ($this->find($i, $prefix) or ($prefix == [] and $i == 0)){
                continue;
            }
            array_push($prefix, $i);
            $this->generatePermutations($n, $m - 1, $prefix);
            array_pop($prefix);
        }

    }

}

new main(new Rebus());
