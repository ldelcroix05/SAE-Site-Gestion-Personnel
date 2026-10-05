<?php
class Database
{

    //pattern singleton afin de ne pas avoir une connexion qui se fait à chaque fois que l'on appelle la fonction
    //solution à cela: static, attribut de classe donc appelé une seule fois
    private static $conn = null;
    public static function getConnection()
    {

        if (self::$conn !== null) {
            return self::$conn;
        }

        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', MYHOST, MYPORT, MYDATABASE);

        try {
            self::$conn = new PDO($dsn, MYUSER, MYPASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => true,
            ]);
        } catch (PDOException $exception) {
            trigger_error(htmlspecialchars($exception->getMessage(), ENT_QUOTES), E_USER_ERROR);
        }
        return self::$conn;
    }
}
