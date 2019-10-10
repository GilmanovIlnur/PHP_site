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
        $this->show_menu();
        $this->show_head();
        $this->show_content();
        $this->show_footer();
    }

    private function show_head(){
        print <<< HEADER
<!doctype html>
<html>
<head>
<title>{$this->title1}</title>
</head><body>
<div class="title">{$this->title1}</div>
<div class="subtitle">{$this->title2}</div>
HEADER;

    }
    private function show_menu(){
        echo "
        <style>
            body{
                margin: 0;
                padding: 0;
            }
            nav{
                display: flex;
                justify-content: space-around;
                align-items: center;
                min-height: 10px;
                background-color: #454340;
                font-family: 'Poppins', sans-serif;
            }
            .logo{
                width: 300px;
                height: 100px;
                margin-left: 10px;
                display: flex;
                align-items: center;
              
            }
            h4{
                letter-spacing: 5px;
                font-size: 20px;
                 color: #ff7c2b;
            }
            img{
                width: 25px;
                height: 25px;
            }
            
            .links a{
                background-color: darkgray;
                font-size: 15px;
                letter-spacing: 3px;
                color: rgba(144,5,0,0.98);
                text-decoration: none;
                font-weight: bold;
            }
           
            img{
                width: 25px;
                height: 25px;
            }
           
        </style>

        <nav>
            <div class=\"logo\">
                <img src=\"http://www.tsatu.edu.ua/nauka/wp-content/uploads/sites/49/1466703414.png\" alt=\"\">
                <h4>Сайт Ильнура</h4>
            </div>
            <h4>Добро пожаловать!</h4>
            <h4><a href='subsets.php'>Подмножества</a></h4>
        </nav>
        ";

    }

    private function show_content(){
        $this->content->show_content();
    }

    private function show_footer(){
        print "</body></html>";
    }
}




