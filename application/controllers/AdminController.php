<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller{

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }
    
    public function loginAction() {
        $this->view->render('Login');
    }

    public function dashboardAction() {
        $this->view->render('Dashboard');
    }

    public function logoutAction() {
        exit('Logout');
    }
}

?>