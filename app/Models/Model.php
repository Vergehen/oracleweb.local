<?php
namespace App\Models;

class Model
{
    protected $connection;
    protected $error;

    public function __construct()
    {
        try {
            $this->connection = Database::getConnection();
        }
        catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public function getError()
    {
        return $this->error;
    }
}