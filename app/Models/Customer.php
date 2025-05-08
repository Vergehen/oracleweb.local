<?php
namespace App\Models;

class Customer extends Model
{
    protected $columnCount;
    
    public function getAll()
    {
        $result = odbc_exec($this->connection, 'SELECT * FROM DEMO.CUSTOMER');
        if ($result === false) {
            $this->error = 'Помилка під час виконання запиту: ' . odbc_errormsg($this->connection);
            return false;
        }

        $this->columnCount = odbc_num_fields($result);

        return $result;
    }
}