<?php

require_once 'Model/Model.php';

class Medicine extends Model
{
    const TABLE_NAME = 'medicine';

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
            [$this->getData('name'), $this->getData('qty')]
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