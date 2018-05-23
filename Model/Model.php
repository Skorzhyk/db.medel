<?php

require_once 'DataBase.php';

abstract class Model
{
    protected $db;

    protected $data;

    protected $tableName;

    public function __construct($data = [])
    {
        $this->db = DataBase::getDB();
        $this->data = $data;
    }

    public function getData($code = null)
    {
        if (!$code) {
            return $this->data;
        }

        if ($this->data[$code]) {
            return $this->data[$code];
        }

        return null;
    }

    public function setData($code, $value)
    {
        $this->data[$code] = $value;
    }

    public function get()
    {
        $data = $this->db->selectRow(
            'SELECT * FROM ' . $this->tableName . ' WHERE id = ' . DataBase::SYM_QUERY,
            [$this->getData('id')]
        );

        foreach ($data as $code => $value) {
            if (!$this->getData($code)) {
                $this->setData($code, $value);
            }
        }

        return $this->getData();
    }

    public function getAll()
    {
        return $this->db->select(
            'SELECT * FROM ' . $this->tableName,
            [$this->getData('id')]
        );
    }

    public function save()
    {
        if (!$this->getData('id')) {
            return $this->create();
        }

        $this->get();

        return $this->update();
    }

    protected function create() { return false; }

    protected function update() { return false; }
}