<?php
include "connection.php";
include "Model/User.php";
include "DAO.php";
print <<<HEADER
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Регистрация</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
</head>

<body>

<form id="login" method="post" action="registration.php">
    <h1>Форма регистрации</h1>
    <fieldset id="inputs">
        <input id="username" type="text" name="login" placeholder="Логин" autofocus required>   
        <input id="password" type="password" name="password" placeholder="Пароль" required>
        <input id="password" type="password" name="repeatedPassword" placeholder="Повторите пароль" required>
       <input type="text" placeholder="Имя" autofocus required name="name">
        <input type="text" placeholder="Фамилия" autofocus required name="lastName">
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" value="ВОЙТИ">
        <a href="">Забыли пароль?</a><a href="">Регистрация</a>
    </fieldset>
</form>
</body>
</html>

HEADER;
getFields();
function getFields(){
        if (isset($_POST["login"])){
            $user = new User();
            $user->setUsername($_POST["login"]);
            $user->setPassword($_POST["password"]);
            $user->setRepeatedPassword($_POST["repeatedPassword"]);
            $user->setName($_POST["name"]);
            $user->setLastName($_POST["lastName"]);
            $dao = new DAO();
            $res = $dao->registrate($user);
            print ($res == true ? 1: 0);
        }

}

