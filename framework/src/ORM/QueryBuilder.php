<?php
namespace Framework\ORM;

use Framework\ORM\Database;

/**
 * @author aduartem
 */

class QueryBuilder extends Database
{
    protected static $table;
    
    private $_query = '';

    private $_conditions = array();

    public static function fetch($aParams = array())
    {
        $cnx = Database::connect();
        $query = "";
        if(empty($aParams))
        {
            $query = "SELECT * FROM `" . static ::$table . "`";
            $stmt = $cnx->prepare($query);
            $stmt->execute();
        }
        else
        {
            $query = "SELECT * FROM `" . static ::$table . "` WHERE 1=1";

            foreach($aParams as $key => $value)
            {
                $query.=" AND `" . $key . "` = :" . $key;
            }

            $stmt = $cnx->prepare($query);
            $stmt->execute($aParams);
        }
        return $stmt;
    }

    public static function fetchObj($aParams = array())
    {
        $stmt = self::fetch($aParams);
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $cnx = null;
        return $result;
    }

    public static function fetchArray($aParams = array())
    {
        $stmt = self::fetch($aParams);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $cnx = null;
        return $result;
    }

    public static function save($aParams, $id = NULL)
    {
        $cnx    = Database::connect();
        $query  = "";
        if(empty($id))
        {
            $keys   = array_keys($aParams);
            $fields = "(`".join("`, `", $keys)."`)";
            $values = "(:".join(", :", $keys).")";

            $query  = "INSERT INTO `" . static ::$table . "` " . $fields . " VALUES " . $values;
            $stmt = $cnx->prepare($query);

            foreach($aParams as $key => &$value)
            {
                $stmt->bindParam($key, $value);
            }
        }
        else
        {
            $aAux = array();
            foreach($aParams as $key => $value)
            {
                $aAux[] = " `" . $key . "` = :" . $key;
            }
            $set = join(", ", $aAux);

            $query = "UPDATE `" . static ::$table . "` SET " . $set . " WHERE `id` = :id";
            $stmt = $cnx->prepare($query);
            $stmt->bindParam('id', $id);

            foreach($aParams as $key => &$value)
            {
                $stmt->bindParam($key, $value);
            }
        }
        $result = $stmt->execute();
        $cnx    = null;
        return $result;
    }

    public static function delete($aParams = array())
    {
        if(empty($aParams)) return FALSE;

        $cnx = Database::connect();
        
        $query = "DELETE FROM `" . static ::$table . "` WHERE 1=1";

        foreach($aParams as $key => $value)
        {
            $query.=" AND `" . $key . "` = :" . $key;
        }

        $stmt = $cnx->prepare($query);
        $result = $stmt->execute($aParams);
        $cnx    = null;
        return $result;
    }

    public function select($aData = array())
    {
        if(empty($aData))
        {
            $this->_query = "SELECT * ";
        }
        else
        {
            $fields = "`".join("`, `", $aData)."`";
            $this->_query = "SELECT " . $fields;
        }

        $this->_query = $this->_query . " FROM `" . static ::$table . "`";
        return $this;
    }

    public function where($aConditions = array())
    {
        $this->_query = $this->_query . " WHERE 1 = 1 ";

        if( ! empty($aConditions))
        {
            foreach($aConditions as $key => $value)
            {
                $this->_query.= " AND `" . $key . "` = :" . $key;
            }
            $this->_conditions = $aConditions;
        }
        return $this;
    }

    public function like($field, $value, $type = 'containing')
    {
        if($type === 'starting')
            $value = $value . "%";
        elseif($type === 'ending')
            $value = "%" . $value;
        else
            $value = "%" . $value . "%";

        $this->_query = $this->_query . " AND `" . $field . "` LIKE :" . $field;
        $aConditions[$field] = $value;
        $this->_conditions = $aConditions;
        return $this;
    }

    public function get($fetchAssoc = FALSE)
    {
        $cnx = Database::connect();
        $stmt = $cnx->prepare($this->_query);
        $stmt->execute($this->_conditions);
        if($fetchAssoc)
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        else
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $cnx = null;
        return $result;
    }

    public function getRow($fetchAssoc = FALSE)
    {
        $cnx = Database::connect();
        $stmt = $cnx->prepare($this->_query);
        $stmt->execute($this->_conditions);
        if($fetchAssoc)
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        else
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

        $cnx = null;

        if( ! empty($result))
            return $result[0];
        else
            return NULL;
    }

    public function execute()
    {
        $cnx = Database::connect();
        $stmt = $cnx->prepare($this->_query);
        $result = $stmt->execute($this->_params);
        $cnx = null;
        return $result;
    }

    public function orderBy()
    {

    }

    public function groupBy()
    {

    }

    public function limit()
    {

    }

    public function join()
    {

    }
}