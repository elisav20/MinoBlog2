<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller{
    
    public function indexAction() {
        $this->view->render('Home');
    }

    public function categoriesAction() {
        $this->view->render('Categories');
    }

    public function contactAction() {
        if (!empty($_POST)) {
            $this->view->message('Success', 'Email was successfully sent ');
        }
        $this->view->render('Contact');
    }

    public function postAction() {
        $this->view->render('Post');
    }

    public function authorizationAction() {
        $this->view->render('Authorization');
    }
}

?>