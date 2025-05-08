<?php
namespace App\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Customer();
    }

    public function index()
    {
        $result = $this->model->getAll();

        if ($result === false) {
            $error = $this->model->getError();
            $this->render('error', ['error' => $error]);
            return;
        }

        $this->render('customer/index', ['result' => $result]);
    }
}