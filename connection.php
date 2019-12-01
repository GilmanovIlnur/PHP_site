<?php
class connection{
    private static $msi;

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        $host = "localhost";
        $port = 3305;
        $db = "phpcourse";
        $user = "ilnur";
        $password = "ilnur";
        self::$msi = new mysqli(
            $host,
            $user,
            $password,
            $db,
            $port
        );
    }

    public static function getConnection(){
        if (!self::$msi || self::$msi->close()){
            new connection();
        }
        return self::$msi;
    }

    /*public static function query($sql){
        return self::$msi->query($sql);
    }*/



}
