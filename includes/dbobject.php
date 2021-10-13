<?php

abstract class DbObject
{
    protected static $db_table;
    protected static $db_table_fields;
    public static function findAll()
    {
        return static::findByQuery("SELECT * FROM " . static::$db_table);
    }

    public static function findByID($userID)
    {
        global $db;
        $theResultArray = self::findByQuery("SELECT * FROM " . static::$db_table . " WHERE id=$userID LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    public static function findByQuery($sql)
    {
        global $db;
        $resultSet = $db->query($sql);
        $theObjectArray = array();

        while($row = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)) {
            $theObjectArray[] = static::inst($row);
        }

        return $theObjectArray;
    }

    public static function inst($theRecord)
    {
        $callingClass = get_called_class();
        $theObject = new $callingClass;

        foreach ($theRecord as $theAttribute => $value) {
            if($theObject->hasTheAttribute($theAttribute)) {
                $theObject->$theAttribute = $value;
            }
        }
        return $theObject;
    }

    protected function hasTheAttribute($theAttribute)
    {
        $objectProperties = get_object_vars($this);

        return array_key_exists($theAttribute, $objectProperties);
    }

    protected function properties()
    {
        $properties = array();

        foreach (static::$db_table_fields as $db_field){
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }

        return $properties;
    }

    protected function cleanProperties()
    {
        global $db;

        $clean_properties = array();

        foreach($this->properties() as $key => $value){
            $clean_properties[$key] = $db->escapeString($value);
        }

        return $clean_properties;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $db;
        $properties = $this->properties();
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

        if($db->query($sql)){
            $this->id = $db->insertID();
            return true;

        } else {

            return false;

        }
    }

    public function update()
    {
        global $db;
        $properties = $this->properties();
        $properties_pairs = array();

        foreach($properties as $key => $value) {

            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id=" . $db->escapeString($this->id);

        $db->query($sql);

        return (mysqli_affected_rows($db->connection) == 1) ? true : false;
    }

    public function delete()
    {
        global $db;
        $sql = "DELETE FROM " . static::$db_table . " WHERE id=" . $db->escapeString($this->id);
        $sql .= " LIMIT 1";

        $db->query($sql);

        return (mysqli_affected_rows($db->connection) == 1) ? true : false;
    }
}


 ?>
