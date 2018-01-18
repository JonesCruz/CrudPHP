<?php


class Conexao
{

    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $db_name = "lista";
    private static $conn;

    function __construct()
    {

        if (!self::$conn)
            self::conecta();

    }

    private static function conecta()
    {
        $conn = null;

        try {
            $conn = new mysqli(self::$host, self::$user, self::$pass, self::$db_name);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        self::$conn = $conn;

    }

    /**
     * @return mixed
     */
    public function conn()
    {
        return self::$conn;
    }
}