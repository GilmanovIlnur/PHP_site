<?php
include "main.php";

class ParserCSV implements IContent
{
    private $fileName;
    private $page;
    private $countOfRecords;
    private $rowCountInFile;

    public function __construct()
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <?
        $this->countOfRecords = isset($_REQUEST["count"])? $_REQUEST["count"] : 100;
        $this->page = isset($_REQUEST["page"])? $_REQUEST["page"] : 1;
    }

    function get_title1()
    {
        // TODO: Implement get_title1() method.
    }

    function get_title2()
    {
        // TODO: Implement get_title2() method.
    }

    function show_content()
    {
        ?>
        <div class="load shadow-sm p-3 mb-5 bg-white rounded" style="margin-top: 3px; height: 100px; display: flex; justify-content: center">
            <form style="padding-top: 17px" action="ParserCSV.php" method="post" enctype = "multipart/form-data">
                <input type="file" name="f" value="<?print $_FILES["f"]["name"]?>">
                <button style="margin-left: 5px" type="submit" class="btn btn-success">Загрузить</button>
            </form>
        </div>

        <?

        if (isset($_FILES["f"]) || isset($_REQUEST["f"])){
            if (isset($_FILES["f"])){
                $this->fileName = $_FILES["f"]["name"];
//                if ($_FILES["f"]["type"] == ".csv" && $_FILES["f"]["size"] < 128){move_uploaded_file()
//
//                }else{
//                    exit("Неверный формат или размер файла.");
//                }

            }else{
                $this->fileName = $_REQUEST["f"];
            }

            $file_handle = fopen($this->fileName, "rb");
            $this->processFile($file_handle);
        }
    }
    function processFile($file)
    {
        $this->rowCountInFile = $this->findRowCount($file);
        $countOfPages = ($this->rowCountInFile - 1) % $this->countOfRecords == 0 ?
            ($this->rowCountInFile - 1)/$this->countOfRecords :
            (int)(($this->rowCountInFile - 1)/$this->countOfRecords) + 1;
        $this->printSelect();
        $this->printPagination($countOfPages);
        $this->parseAndPrintFile();
        $this->printSelect();
        $this->printPagination($countOfPages);

    }

    public function checkPagination($countOfPages){
        for ($i = 1; $i <= 3; $i++){
            if ($this->page == $i){
                return true;
            }
        }
        for ($i = $countOfPages - 2; $i <= $countOfPages; $i++){
            if ($this->page == $i){
                return true;
            }
        }
        return false;
    }

    function printPagination($countOfPages){
        ?>
            <div class="block" style="display: flex;justify-content: center ">
                <a style="margin-top: 10px; margin-bottom: 10px" href="ParserCSV.php?page=<?print ($this->page == 1? 1: $this->page-1)?>&f=<?print $this->fileName?>&count=<?print $this->countOfRecords?>"><div class="button" style="width: 70px; height: 40px; padding-top: 5px; border: 1px solid aliceblue; text-align: center; ">Назад</div></a>
                <?
                if ($countOfPages <= 6){
                    for ($i = 1; $i <= $countOfPages; $i++){
                        $this->printPaginationElem($i);
                    }

                }else if ($countOfPages > 6 && $this->checkPagination($countOfPages)){
                    for ($i = 1 ; $i <= 3; $i++){
                        $this->printPaginationElem($i);
                    }
                    if ($this->page == 3){
                        $this->printPaginationElem(4);
                    }
                    print "...";
                    if ($this->page == $countOfPages-2){
                        $this->printPaginationElem($countOfPages -3);
                    }
                    for ($i = $countOfPages-2 ; $i <= $countOfPages; $i++){
                        $this->printPaginationElem($i);
                    }
                }else{
                    for ($i = 1 ; $i <= 3; $i++){
                        $this->printPaginationElem($i);
                    }
                    print "...";
                    for ($i = $this->page - 1 ; $i <= $this->page + 1; $i++){
                        $this->printPaginationElem($i);
                    }
                    print "...";
                    for ($i = $countOfPages-2 ; $i <= $countOfPages; $i++){
                        $this->printPaginationElem($i);
                    }
                }

                ?>
                <a style="margin-top: 10px; margin-bottom: 10px" href="ParserCSV.php?page=<?print ($countOfPages == $this->page? $countOfPages: $this->page + 1)?>&f=<?print $this->fileName?>&count=<?print $this->countOfRecords?>"><div class="button" style="width: 70px; height: 40px; padding-top: 5px; border: 1px solid aliceblue; text-align: center; ">Вперед</div></a>
            </div>
        <?
    }
    private  function printPaginationElem($i){
        ?>
        <a style="margin-top: 10px; margin-bottom: 10px" href="ParserCSV.php?page=<?print $i?>&f=<?print $this->fileName?>&count=<?print $this->countOfRecords?>"><div class="button" style="width: 40px; height: 40px; padding-top: 5px; border: 1px solid aliceblue;text-align: center; <? if($this->page == $i) echo"background-color: F3FFAC;"; ?>"><?print $i?></div></a>

        <?
    }

    function findRowCount($file)
    {
        $k = 0;
        while (($l = fgets($file)) !== false) {
            $k++;
        }
        return $k;
    }

    public function parseAndPrintFile()
    {
        $file = fopen($this->fileName, "rb");
        $l = $l = fgets($file);
        print $l;
        $spl = explode(";", $l);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><? print($spl[0])?></th>
                    <th scope="col"><? print($spl[1])?></th>
                    <th scope="col"><? print($spl[2])?></th>
                </tr>
            </thead>
        <tbody>
<?
        $firstStr = $this->countOfRecords*($this->page - 1);
        $k = 1;
        while ($firstStr >= $k){
            $k++;
            fgets($file);

        }
        $k = 1;
        while ( ($l = fgets($file)) !== false && $k <= $this->countOfRecords) {
            $this->parseLine($l, $k);
            $k ++;
        }
        ?>
        </tbody>
        </table>
<?

    }

    private function parseLine($l, $k)
    {
        $array = [];
        $domain = substr(strstr($l, ';'), 1);
        $domain = strrev($domain);
        $domain = substr(strstr($domain, ';'), 1);
        $domain = strrev($domain);

        $array[0] = explode(";",$l)[0];
        $array[1] = $domain;
        $array[2] = end(explode(";",$l));

        ?>
<tr>
    <th scope="row"><?print $k?></th>
    <td><?print htmlentities($array[0])?></td>
    <td><?print htmlentities($array[1])?></td>
    <td><?print htmlentities($array[2]) ?></td>
</tr>
    <?

    }

    private function printSelect()
    {
        ?>
        <div style="display: flex; justify-content: center;" class="selectForm">
            <h5 style="margin-right: 10px">Сколько записей показать?</h5>

            <form method="get" action="ParserCSV.php">
                <select style="margin-right: 10px" name="count">
                    <option value="100" <? if($this->countOfRecords == 100) echo"selected"; ?>>100</option>
                    <option value="50" <? if($this->countOfRecords == 50) echo"selected"; ?>>50</option>
                    <option value="30" <? if($this->countOfRecords == 30) echo"selected"; ?>>30</option>
                    <option value="10" <? if($this->countOfRecords == 10) echo"selected"; ?>>10</option>
                </select>
                <input type="hidden" name="page" value="<?print $this->page?>"/>
                <input type="hidden" name="f" value="<?print $this->fileName?>"/>
                <button type="submit" class="btn btn-info">ОК</button>
            </form>
        </div>
        <?
    }
}


new main(new ParserCSV());