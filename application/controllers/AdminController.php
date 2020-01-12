<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class AdminController extends Controller{

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }
    
    public function loginAction() {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/dashboard');
        }
        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message(0, $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('admin/dashboard');
        }
        $this->view->render('Login');
    }

    public function dashboardAction() {
        $vars = [
            'postsCount' => $this->model->postsCount(),
            'categoriesCount' => $this->model->categoriesCount(),
            'usersCount' => $this->model->usersCount(),
            'adminPosts' => $this->model->getUserPosts($id = 1),
        ];
        $this->view->render('Dashboard', $vars);
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }

    public function usersAction() {
        $pagination = new Pagination($this->route, $this->model->usersCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'users' => $this->model->getUsers($this->route),
        ];
        $this->view->render('Users', $vars);
    }

    public function deleteUserAction() {
        if (!$this->model->isUSerExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->deleteUser($this->route['id']);
        $this->view->redirect('admin/users/1');
    }

    public function postsAction() {
        $pagination = new Pagination($this->route, $this->model->postsCount(), 5);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route),
        ];
        $this->view->render('Posts', $vars);
    }

    public function categoriesAction() {
        if (!empty($_POST)) {
            if (!$this->model->categoryValidate($_POST)) {
                $this->view->message(0, $this->model->error);
            }
            $id = $this->model->categoryAdd($_POST);
            $this->view->message(1, 'Category Add!');
        }
        $vars = [
            'categories' => $this->model->getCategories(),
        ];
        $this->view->render('Categories', $vars);
    }

    public function postAction() {
        if (!$this->model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $vars = [
            'data' => $this->model->postData($this->route['id'])[0],
        ];
        $this->view->render('Post', $vars);
    }

    public function deleteCategoryAction() {
        if (!$this->model->isCategoryExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->insertNewId($this->route['id']);
        $this->model->categoryDelete($this->route['id']);
        $this->view->redirect('admin/categories');
    }

    public function addAction() {
        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'add')) {
                $this->view->message(0, $this->model->error);
            }
            $id = $this->model->postAdd($_POST);
            $this->view->message(1, 'Post Add!');
        }
        $vars = [
            'categories' => $this->model->getCategories(),
        ];
        $this->view->render('Add New Post', $vars);
    }

    public function editAction() {
        if (!$this->model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'edit')) {
                $this->view->message(0, $this->model->error);
            }
            $this->model->postEdit($_POST, $this->route['id']);
            $this->view->message(1, 'Post Updated');
        }
        $vars = [
            'data' => $this->model->postData($this->route['id'])[0],
            'categories' => $this->model->getCategories(),
        ];
        $this->view->render('Edit Post', $vars);
    }

    public function deleteAction() {
        if (!$this->model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->postDelete($this->route['id']);
        if ($this->route['action'] == 'dashboard') {
            $this->view->redirect('admin/dashboard');
        } else {
            $this->view->redirect('admin/posts/1');
        }
    }
}

?>