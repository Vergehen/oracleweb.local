<?php
namespace App\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Employee();
    }

    public function index()
    {
        $result = $this->model->getAll();

        if ($result === false) {
            $error = $this->model->getError();
            $this->render('error', ['error' => $error]);
            return;
        }

        $this->render('employee/index', ['result' => $result]);
    }

    public function search()
    {
        $deptno = isset($_GET['deptno']) ? $_GET['deptno'] : null;
        $result = null;

        if ($deptno !== null) {
            $result = $this->model->getByDeptno($deptno);

            if ($result === false) {
                $error = $this->model->getError();
                $this->render('error', ['error' => $error]);
                return;
            }
        }

        $this->render('employee/search', ['result' => $result, 'deptno' => $deptno]);
    }
}