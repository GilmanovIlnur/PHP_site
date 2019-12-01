<?php


class DAO
{
    private static $msi;
    public function __construct()
    {
        self::$msi = connection::getConnection();
    }

    public function registrate(User $user){
        $login = $user->getUsername();
        $stmt = self::$msi->prepare("SELECT u.id from usr u where login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->bind_result($id);
        $c = 0;
        while($stmt->fetch()){
            $c++;
        }
        if ($c == 0){

            $checkPassword = $user->getPassword() == $user->getRepeatedPassword();
            if ($checkPassword){
                print "here";
                $login = $user->getUsername();
                $pswd = $user->getPassword();
                $name = $user->getName();
                $lastName = $user->getLastName();
                $sql = "INSERT INTO usr(login, password, first_name, last_name)
            VALUES
                ('$login', '$pswd', '$name', '$lastName')";
                print $sql;
                self::$msi->query($sql);
            }
        }
        return false;

    }

}