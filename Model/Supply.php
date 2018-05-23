<?php

require_once 'Model/Model.php';

class Supply extends Model
{
    const TABLE_NAME = 'supply';

    public function __construct($data = [])
    {
        $this->tableName = self::TABLE_NAME;
        parent::__construct($data);
    }

    protected function create()
    {
        return $this->db->query(
            "INSERT INTO " . self::TABLE_NAME . " (status, drone_id, medicines)
            VALUES (" . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ")",
            [$this->getData('status'), $this->getData('drone_id'), $this->getData('medicines')]
        );
    }

    protected function update()
    {
        return $this->db->query(
            'UPDATE ' . $this->tableName . ' SET name = ' . DataBase::SYM_QUERY . ', qty = ' . DataBase::SYM_QUERY . ' WHERE id = ' . DataBase::SYM_QUERY,
            [$this->getData('name'), $this->getData('qty'), $this->getData('id')]
        );
    }
}