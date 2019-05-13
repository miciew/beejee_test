<?php

namespace Miciew\DB;


use Miciew\Configs\Config;

class DB
{
    private $property = array();

    protected $pdo = null;

    protected $className = 'stdClass';

    public function __construct()
    {
        $this->property = Config::getInstance()->getConfigs()['database'];

        $this->pdo = new \PDO("{$this->connection}:host={$this->host};dbname={$this->database};charset=utf8", $this->username, $this->password);

    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function query($query, $params = array())
    {
        if( ! isset($this->pdo) )
        {
            throw new \PDOException('Dont connected');
        }

        $sth = $this->pdo->prepare($query);
        $sth->execute($params);

        $data = $sth->fetchAll(\PDO::FETCH_CLASS, $this->className);

        return $data;
    }

    public function setClassName( $className )
    {
        $this->className = $className;
    }

    public function execute($query, $params = array())
    {
        if( $this->pdo )
        {
            $sth = $this->pdo->prepare($query);

            if ( ! $sth->execute($params) ) {
                //echo '<pre> '; print_r($sth->errorInfo()); echo '<br>'. __FILE__ . ' ' . __LINE__ .'</pre>'; die;
            }
        }
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function __set($name, $value)
    {
        if($name === 'attributes' && is_array($value))
        {
            foreach ($value as $key => $v)
            {
                $this->property[$key] = $v;
            }
        }
        else
        {
            $this->property[$name] = $value;
        }
    }

    public function __isset($name) {
        return isset($this->property[$name]);
    }

    public function __unset($name) {
        unset($this->property[$name]);
    }

    public function __get($name) {
        return $this->property[$name];
    }
}
