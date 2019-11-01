<?php
include "main.php";

class content implements IContent
{
    function isPrime($num){
        if ($num == 2){
            return true;
        }
        for ($i = 2; $i < $num**(1/2) + 1; $i++){
            if ($num % $i == 0){
                return false;
            }
        }
        return true;
    }

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
        print "
        <h3 style='text-align: center'>Таблица первых 1000 простых чисел</h3>
                    <table style='
                        border-collapse: collapse; 
                        border:solid blue 2px ; 
                        text-align: center; 
                        margin: auto'>";
        $count = 0;
        $currNum = 1;
        while(true) {

            print "<tr>";
            for ($i = 0; $i < 15; $i++) {
                if ($count > 1000){
                    break 2;
                }
                while(true){
                    $currNum++;
                    if ($this->isPrime($currNum)){
                        print "<td style='border: solid red 1px'> $currNum</td>";
                        $count++;
                        break;
                    }
                }
            }
            print "</tr>";
        }
        print "</table>";
    }

}
$p = new main(new content());