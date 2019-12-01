<?php
include "main.php";
set_time_limit(1000);
//дан файл формата .csv   проверяем размер, название, текстовый формат файла
//enctype = multipart/form-data в форму прописать чтобы загружались файлы
//fopen(.. , "r-b"); лишний раз пройтись, узнать количество строк. считывать построчно.

class Rebus implements IContent
{
    private $str;
    private $firstLetters = [];
    private $letters = [];

    function get_title1()
    {

    }

    function get_title2()
    {

    }

    function show_content()
    {

        ?>

        <div  class="shadow-sm p-3 mb-5 bg-#ECF0F1 rounded" style="text-align: center; padding-top: 30px">
            <h5 style="font-family: 'Muli', sans-serif;">Страница, на которой вы можете находить решения математических
             ребусов. Онлайн калькулятор выведет все решения. </h5>
            <form name="form" action="Rebus.php" method="get">
                <input id="inp_R" type="text" value="<?php print $_GET['r'];?>" placeholder="Введите ребус" name="r">
                <input  class="btn btn-success" type="submit" value="Решить" onclick="fixForm()">
                <button type="button" class="btn btn-danger" onclick="clearForm()">X</button>
            </form>
        </div>
        <div style="margin-top: -30px;
                    margin-bottom: 10px;
                    padding-left: 10px;
                    @import url('https://fonts.googleapis.com/css?family=Pacifico&display=swap');
                    font-family: 'Pacifico', cursive;">
            <span id="message"></span>
        </div>

        <section class="a">
            <div class="container-fluid">
                <div class="row">

        <?php
        //$this->generatePermutations(10,10);//n = 10 - количество цифр,  m = количесвтво букв различных.
        if (isset($_GET['r'])){
            $this->str = $_GET['r'];
            $this->findFirstLetters(preg_split("/[+=-]/", $this->str));
            $this->letters = $this->parseInput($this->str);
            $this->generatePermutations(10,count($this->letters));
            ?>
            </div>
            </div>
            </section>
        <script type="text/javascript">
            let count = document.getElementsByClassName("row")[0].getElementsByTagName("p").length;
            document.getElementById("message").innerHTML = "Количество решений ребуса - " + count;
        </script>
            <?
        }
    }
    function findFirstLetters(array $pr){
        foreach ($pr as $promise){
            if (strlen($promise) != 1){
                array_push( $this->firstLetters, $promise{0});
            }
        }

    }

    function checkPossibleSolution(array $permutation){
        $br = false;
        $possibleSolution = [];
        for ($i = 0; $i < count($permutation); $i++){
            if (($permutation[$i] == 0) and (in_array($this->letters[$i], $this->firstLetters))){
                $br = true;
                break;
            }
            $possibleSolution[$this->letters[$i]] = $permutation[$i];
        }
        if (!$br){
            list ($fl, $str) = $this->checkSolutionWithEval($possibleSolution);
            if ($fl && $possibleSolution != []){
                ?>
                <div class="col-md-6 col-xl-2 a1" style="
                        margin: 10px;
                        padding-top: 10px;
                        border: brown 2px solid">
                 <p style="
                        text-align: center;
                        @import url('https://fonts.googleapis.com/css?family=McLaren&display=swap';);
                        font-family: 'McLaren', cursive;">
                    <? print $str?>
                </p>
                </div>
                <?
            }
        }
    }

    function checkSolutionWithEval(array $possibleSolution){
        $strCopy = $this->str;
        foreach ($possibleSolution as $key => $value) {
            $strCopy = str_replace($key, $value, $strCopy);
        }

        $splitted = explode("=", $strCopy);
        try{
             $l = eval('return '.$splitted[0].';');
             $p = eval('return '.$splitted[1].';');
                if ((int)$l == (int)$p){
                return array(true, $strCopy);
            }else{
                return array(false, '');
            }
        }catch (ParseError $exception){
            exit("<h3>Проверьте свои введенные данные, скорее всего вы ошиблись.</h3>");
        }


    }

    function parseInput($str):array
    {
        $str = str_replace(['-', '+', '='], '', $str);
        $split = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);

        $uniqueChars = [];
        foreach ($split as $v)
        {
            if (in_array($v, $uniqueChars))
                continue;
            array_push($uniqueChars, $v);
        }
        if (count($uniqueChars) > 10){
            $count = count($uniqueChars);
            exit("<h3 style='color: red'>У вас ребус содержит $count букв, а цифр всего 10.</h3>");
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

    function generatePermutations(int $n, int $m, $prefix = [])
    {
        if ($m == 0){
            $this->checkPossibleSolution($prefix);
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
