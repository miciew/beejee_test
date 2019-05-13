<?php

namespace Miciew;


use Miciew\DB\DB;

abstract class Model
{
    protected static $_table;
    protected        $_attributes = [];

    protected function getDB()
    {
        return new DB();
    }

    public static function findAll($orderBy = 'DESC', $orderCollumn = 'id', $limit = null)
    {
        $query = "SELECT * FROM " . static::$_table . "
            ORDER BY {$orderCollumn} {$orderBy}
        ";

        if( ! is_null($limit) )
        {
            $query .= " LIMIT {$limit}";
        }

        $db = (new static())->getDB();
        $db->setClassName(get_called_class());
        return $db->query( $query );
    }

    public static function findByAttributes($queryParams = array())
    {
        $query = self::select($queryParams);

        $db = (new static())->getDB();
        $db->setClassName(get_called_class());

        return $db->query($query, $queryParams);
    }


    public static function findByPk($id)
    {
        $db = (new static())->getDB();
        $query = "SELECT * FROM " . static::$_table . " WHERE id=".$id;
        $getCalledClass = get_called_class();
        $db->setClassName($getCalledClass);

        $result = $db->query( $query );
        if( count($result) > 0) {
            return array_shift($result);
        }

        throw new \InvalidArgumentException("Element {$getCalledClass} #{$id}not founded");
    }

    public function delete()
    {
        $db = $this->getDB();
        $data = array();

        foreach ( $this->_attributes as $key=> $value){
            if($key === 'id') {
                $data[':'.$key] = $value;
                break;
            }
        }

        $query = "DELETE FROM `". static::$_table ."` WHERE `id`=:id";

        return $db->query($query, $data);

    }

    public static function create( array $attributes = [] )
    {
        $model = new static();

        $model->_attributes = array_intersect_key($attributes, array_flip($model->safe()));
        $model->isNewRecord = true;

        $model->save();

        return $model;
    }

    private function insert()
    {
        $cols = array_keys($this->_attributes);
        $data = array();

        foreach ($cols as $index => $col)
        {
            if( is_array( $this->_attributes[$col]) || $col === 'isNewRecord'){
                unset($cols[$index]);
                continue;
            }
            $data[':' . $col] = $this->_attributes[$col];
        }

        $query = '
            INSERT INTO `' . static::$_table . '`
            ('. implode(', ', $cols) .')
            VALUES
            ('. implode(', ', array_keys($data)) .')
        ';

        $db = new Db();
        $res = $db->execute($query, $data);

        $this->id = $db->lastInsertId();

        return $res;
    }

    private function update()
    {
        $data = array();
        $cols = array();

        foreach ( $this->_attributes as $key=> $value)
        {
            if(is_array($value) || $key === 'isNewRecord')
                continue;

            $data[':'.$key] = $value;
            $cols[] = $key .'=:'. $key;
        }

        $query = '
            UPDATE '. static::$_table .'
            SET '.  implode(', ', $cols).'
            WHERE id=:id
        ';



        $db = $this->getDB();
        return $db->execute($query, $data);
    }

    public function save()
    {
        $result = $this->isNewRecord ? $this->insert() : $this->update ();

        return $result;
    }

    public function safe(){
        return array();
    }

    public function __set($name, $value)
    {
        $this->_attributes[$name] = $value;
    }

    public function __get($name) {
        return isset( $this->_attributes[$name]) ? $this->_attributes[$name] : null;
    }

    public function __unset($name) {
        unset( $this->_attributes[$name]);
    }

    public function __isset($name) {
        return isset( $this->_attributes[$name]);
    }

    private static function select($query = array())
    {
        $select = 'SELECT * FROM `' . static::$_table .'` '. static::getQuery($query);
        return $select;
    }


    private static function getQuery($queryParams = array())
    {
        $queryParams = array_change_key_case($queryParams, CASE_UPPER);
        $query = "WHERE ";

        $i = 0;
        foreach ($queryParams as $key=>&$value)
        {
            $i++;
            $query .= "{$key} = '{$value}' ";

            $countQueryParams = count($queryParams);
            if( $countQueryParams  > 0 && $i < $countQueryParams )
            {
                $query .= 'AND ';
            }

        }

        return $query;
    }

    public function __construct()
    {
        isset($this->id) ? $this->_attributes['isNewRecord'] = false : $this->_attributes['isNewRecord'] = true;
    }
}