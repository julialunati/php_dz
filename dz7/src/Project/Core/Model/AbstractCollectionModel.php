<?php

namespace Project\Core\Model;

use DB;

abstract class AbstractCollectionModel
{
    protected $db;
    protected $tableName;
    protected $array = [];

    public function __construct()
    {
        $this->db = DB::getDbConnection();
    }

    public function getAll(): self
    {
        return $this->getByAttribute([]);
    }

    public function getByAttribute(array $columnToValue): self
    {
        $preparedQueryList = [];
        foreach (array_keys($columnToValue) as $column) {
            $preparedQueryList[] = "`{$column}` = :{$column}";
        }
        $preparedQuery = "SELECT * FROM `{$this->tableName}`";
        if (count($preparedQueryList)) {
            $preparedQuery .= " WHERE " . implode(" AND ", $preparedQueryList);
        }
        $stm = $this->db->prepare($preparedQuery);
        foreach ($columnToValue as $column => $value) {
            $stm->bindValue($column, $value);
        }
        $stm->execute();
        $this->array = $stm->fetchAll();
        return $this;
    }

    public function getArray()
    {
        return $this->array;
    }

    //query обновления БД
    public function updateStatus($id, $status): bool
    {
        $query = "UPDATE {$this->tableName} SET order_status = '$status' WHERE id = $id";
        $stm = $this->db->prepare($query);
        if($stm->execute()){
            return true;
        }
       
    }
}
