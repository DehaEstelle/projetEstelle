
<?php
require_once('../App/Config.php');
abstract class Model
{
    protected static function getDB()
    {
        static $db = null;
        try {   
        $db = new PDO("mysql:host=$host;dbname=$dbname;chartset=utf8", $username, $password);

        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    }
}

