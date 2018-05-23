<?php

require_once 'Model/Model.php';

class Drone extends Model
{
    const TABLE_NAME = 'drone';

    public function __construct($data = [])
    {
        $this->tableName = self::TABLE_NAME;
        parent::__construct($data);
    }

    protected function create()
    {
        return $this->db->query(
            'INSERT INTO ' . $this->tableName . ' (name, qty)
            VALUES (' . DataBase::SYM_QUERY . ', ' . DataBase::SYM_QUERY .')',
            [$this->getData('status'), $this->getData('coords')]
        );
    }

    protected function update()
    {
        return $this->db->query(
            'UPDATE ' . $this->tableName . ' SET name = ' . DataBase::SYM_QUERY . ', qty = ' . DataBase::SYM_QUERY . ' WHERE id = ' . DataBase::SYM_QUERY,
            [$this->getData('status'), $this->getData('coords'), $this->getData('id')]
        );
    }
}