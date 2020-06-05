<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class AuthorizationController extends Controller{

    public function loginAction() {

        if (isset($_COOKIE['username'])) {
            $this->view->redirect('main/index/1');
        }

        if (!empty($_POST)) {

            if (!$this->model->loginValidate($_POST)) {
                $this->view->message(0, $this->model->error);
            }

            $this->view->location('main/index/1');
        }

        $vars = [
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
        ];
        $this->view->render('Login', $vars);
    }

    public function registerAction() {
        if (isset($_COOKIE['username'])) {
            $this->view->redirect('main/index/1');
        }
        if (!empty($_POST)) {
            if (!$this->model->infoUserValidate($_POST)) {
                $this->view->message(0, $this->model->error);
            }

            $id = $this->model->userAdd($_POST);
            $this->view->message(1 , 'Success! Please login.');
        }
        $vars = [
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
        ];
        $this->view->render('Register', $vars);
    }

    public function logoutAction() {
        unset($_COOKIE['username']);
        setcookie('username', 'admin', time() - 3600, "/" );
        $this->view->redirect('main/index/1');
        return true;
    }
}

?>