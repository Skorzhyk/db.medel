<?php

class Api
{
    public function execute($engineCode, $action, $data)
    {
        $engineName = strtolower($engineCode);
        $engineName[0] = strtoupper($engineName[0]);

        require_once 'Model/' . $engineName . '.php';

        $engine = new $engineName($data);

        $response = $engine->$action();
        if (is_array($response)) {
            echo json_encode($response);
        } else {
            echo $response;
        }
    }
}