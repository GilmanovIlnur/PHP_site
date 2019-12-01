<?php

class MainPageContent implements IContent
{

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
        print <<<HEADER
        <div style="text-align: center; padding-top: 200px">
            <h3 style="color: #ff7c2b">Сайт, предназначенный для курса по PHP. </br> Можно найти кое-что полезное.</h3>
        </div>
        <div>
            <a href="registration.php">Регистрация</a>
            <a href="#">Войти</a>
        </div>
HEADER;
    }
}