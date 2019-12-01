<?php

interface IContent{
    function get_title1();
    function get_title2();
    function show_content();
}
class main
{
    private $title1;
    private $title2;
    private $content;
    public function __construct($content)
    {
        $this->title1 = $content->get_title1();
        $this->title2 = $content->get_title2();
        $this->content = $content;
        $this->show_page();
    }

    private function show_page(){
        $this->show_head();
        $this->show_menu();
        $this->show_content();
        $this->show_footer();
    }

    private function show_head(){
        print <<< HEADER
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/main.css">
<meta charset="UTF-8">
<script src="js/js.js"></script>
<title>{$this->title1}</title>
</head><body>
<div class="title">{$this->title1}</div>
<div class="subtitle">{$this->title2}</div>
HEADER;

    }
    private function show_menu(){
        print <<<HEADER
        <nav class="menu">
         
                <h4>Сайт Ильнура</h4>
            
            <h4>Добро пожаловать!</h4>
            <ul>
                <li><a href="index.php">Главная страница</a>
                <li><a href="#">Задачи</a>
                    <ul class="tasks">
                        <li><a href="content.php">1000 простых чисел</a></li>
                        <li><a href="subsets.php">Подмножества</a></li>
                        <li><a href="Rebus.php">Ребусы</a></li>
                         <li><a href="ParserCSV.php">Разбиение файла на страницы</a></li>
                    </ul>
                </li>
            </ul>
            
        </nav>
HEADER;

    }

    private function show_content(){
        $this->content->show_content();
    }

    private function show_footer(){
        print "</body></html>";
    }
}




