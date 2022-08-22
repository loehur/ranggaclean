<?php

require 'app/Config/URL.php';

class Controller extends URL
{

    public $data_user;

    public function data()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true) {
                $this->id_user = $_SESSION['user']['id'];
            }
        }
    }

    public function view($file, $data = [])
    {
        $this->data();
        require_once "app/Views/" . $file . ".php";
    }

    public function model($file)
    {
        require_once "app/Models/" . $file . ".php";
        return new $file();
    }

    public function session_cek()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == False) {
                header("location: " . $this->BASE_URL . "Login");
            }
        } else {
            header("location: " . $this->BASE_URL . "Login");
        }
    }

    public function parameter()
    {
        $_SESSION['user'] = array(
            'nama' => $this->data_user['nama_user'],
            'id' => $this->data_user['id_user'],
        );
    }

    public function parameter_unset()
    {
        unset($_SESSION['user']);
    }

    public function dataSynchrone()
    {
        $where = "id_user = " . $this->id_user;
        $this->data_user = $this->model('M_DB_1')->get_where_row('user', $where);
        $this->parameter_unset();
        $this->parameter();
    }
}
