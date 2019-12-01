<?php
include "connection.php";
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
        <input type="text" placeholder="Имя" autofocus required>
        <input type="text" placeholder="Фамилия" autofocus required>
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

        $login = $_POST["login"];
        $password = $_POST["password"];
        $msi = Connection::getConnection();
        //$msi->close();
        $sql1 = "CREATE TABLE test(id INT)";
        $sql = <<<TAG
INSERT INTO usr(login, password, first_name, last_name) 
            VALUES 
                ('login1', 'password1', 'Ильнур', 'Гильманов');
TAG;

        $res = $msi->query($sql);
        print ($res == true ? 1: 0);
        print($login);
        print($password);


}

