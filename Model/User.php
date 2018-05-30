<?php

require_once 'Model/Model.php';

class User extends Model
{
    const TABLE_NAME = 'user';

    public function __construct($data = [])
    {
        $this->tableName = self::TABLE_NAME;
        parent::__construct($data);
    }

    protected function create()
    {
        return $this->db->query(
            'INSERT INTO ' . self::TABLE_NAME . ' (email, password, name)
            VALUES (' . DataBase::SYM_QUERY . ', ' . DataBase::SYM_QUERY . ', ' . DataBase::SYM_QUERY . ')',
            [$this->getData('email'), $this->getData('password'), $this->getData('name')]
        );
    }

    protected function update()
    {
        return $this->db->query(
            'UPDATE ' . $this->tableName . ' SET email = ' . DataBase::SYM_QUERY . ', password = ' . DataBase::SYM_QUERY . ', name = ' . DataBase::SYM_QUERY . ' WHERE id = ' . DataBase::SYM_QUERY,
            [$this->getData('email'), $this->getData('password'), $this->getData('name'), $this->getData('id')]
        );
    }

    public function get()
    {
        if ($this->getData('email')) {
            return $this->login();
        }

        return parent::get();
    }

    public function getByEmail() {
        $user = $this->db->selectRow(
            "SELECT * FROM " . self::TABLE_NAME . " WHERE email = " . DataBase::SYM_QUERY,
            [$this->getData('email')]
        );

        return $user;
    }

    protected function login()
    {
        $userData = $this->getByEmail();
        if ($userData && password_verify($this->getData('password'), $userData['password'])) {
            return $userData['id'];
        }

        return false;
    }
}