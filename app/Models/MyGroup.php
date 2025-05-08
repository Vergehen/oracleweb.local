<?php
namespace App\Models;

class MyGroup extends Model
{
    public function getAll()
    {
        try {
            $query = "SELECT * FROM my_group";
            $result = odbc_exec($this->connection, $query);

            if ($result === false) {
                $this->error = "Error executing query: " . odbc_errormsg($this->connection);
                return false;
            }

            $rows = [];
            while ($row = odbc_fetch_array($result)) {
                $rows[] = $row;
            }

            return $rows;
        }
        catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO my_group (FIRST_NAME, LAST_NAME, BIRTH_DATE, PHONE_NUMBER, GROUP_ID) 
                     VALUES ('$data[firstName]', '$data[lastName]', TO_DATE('$data[birthDate]', 'YYYY-MM-DD'), 
                     '$data[phoneNumber]', '$data[groupId]')";

            $result = odbc_exec($this->connection, $query);

            if ($result === false) {
                $this->error = "Error executing query: " . odbc_errormsg($this->connection);
                return false;
            }

            return true;
        }
        catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function update($data)
    {
        try {
            $field = $data['field'];
            $value = $data['value'];
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];

            $query = "UPDATE my_group SET $field = '$value' 
                     WHERE FIRST_NAME = '$firstName' AND LAST_NAME = '$lastName'";

            $result = odbc_exec($this->connection, $query);

            if ($result === false) {
                $this->error = "Error executing query: " . odbc_errormsg($this->connection);
                return false;
            }

            return true;
        }
        catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
}