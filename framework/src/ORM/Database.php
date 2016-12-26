<?php
namespace Framework\ORM;

/**
 * @author aduartem
 */

class Database
{
    const CONFIG_DATABASES = "app/Config/databases.json";

    public static function connect()
    {
        try
        {
            $oDBs = json_decode(file_get_contents(FCPATH . self::CONFIG_DATABASES), TRUE);
            $cn = new \PDO("mysql:host=".$oDBs['default']['host'].";dbname=".$oDBs['default']['database'], 
                            $oDBs['default']['user'], $oDBs['default']['password']);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $cn;
    }
}