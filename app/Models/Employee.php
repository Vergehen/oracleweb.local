<?php
namespace App\Models;

class Employee extends Model
{
    public function getAll()
    {
        $result = odbc_exec($this->connection, 'SELECT * FROM SCOTT.EMP');
        if ($result === false) {
            $this->error = 'Помилка під час виконання запиту';
            return false;
        }
        return $result;
    }

    public function getByDeptno($deptno)
    {
        $deptno = (int) $deptno;
        $result = odbc_exec($this->connection, "SELECT * FROM SCOTT.EMP WHERE DEPTNO = $deptno");
        if ($result === false) {
            $this->error = 'Помилка під час виконання запиту';
            return false;
        }
        return $result;
    }
}