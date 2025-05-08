<?php
namespace App\Controllers;

use App\Models\MyGroup;

class MyGroupController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new MyGroup();
    }

    public function index()
    {
        $result = $this->model->getAll();

        if ($result === false) {
            $error = $this->model->getError();
            $this->render('error', ['error' => $error]);
            return;
        }

        $this->render('mygroup/index', ['result' => $result]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'birthDate' => $_POST['birthDate'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'groupId' => $_POST['groupId'] ?? ''
            ];

            $result = $this->model->create($data);

            if ($result === false) {
                $error = $this->model->getError();
                $this->render('error', ['error' => $error]);
                return;
            }

            header('Location: /mygroup');
            exit;
        }

        $this->render('mygroup/create');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'field' => $_POST['field'] ?? '',
                'value' => $_POST['value'] ?? ''
            ];

            $result = $this->model->update($data);

            header('Content-Type: application/json');
            if ($result === false) {
                echo json_encode(['success' => false, 'error' => $this->model->getError()]);
            } else {
                echo json_encode(['success' => true]);
            }
            exit;
        }
    }
}