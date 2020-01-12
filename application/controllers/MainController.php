<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class MainController extends Controller{
    
    public function indexAction() {
        $pagination = new Pagination($this->route, $this->model->postsCount(), 5);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route),
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
        ];
        $this->view->render('Home', $vars);
    }

    public function categoriesAction() {
        $vars = [
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
        ];
        $this->view->render('Categories', $vars);
    }

    public function categoryAction() {
        if (!$this->model->isCategoryExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $vars = [
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
            'posts' => $this->model->getPostsByCategory($this->route['id']),
            'category' => $this->model->getCategoryById($this->route['id'])[0],
            'count_posts' => $this->model->countCategoryPosts($this->route['id']),
        ];
        $this->view->render('Category', $vars);
    }

    public function contactAction() {
        $vars = [
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
        ];

        if (!empty($_POST)) {
            if (!$this->model->contactValidate($_POST)) {
                $this->view->message('0', $this->model->error);
            }
            $name = trim(filter_var($_POST['contact-name'], FILTER_SANITIZE_STRING));
            $email = trim(filter_var($_POST['contact-email'], FILTER_SANITIZE_EMAIL));
            $subject = trim(filter_var($_POST['contact-subject'], FILTER_SANITIZE_STRING));
            $message = trim(filter_var($_POST['contact-message'], FILTER_SANITIZE_STRING));
            
            $my_email = "testmino87@gmail.com";
            $sub = "=?utf-8?B?".base64_encode("$subject")."?=";
            $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/plain; charset=utf-8\r\n";

            mail($my_email, $sub, $message, $headers);
            $this->view->message('1', 'Email was successfully sent ');
        }
        $this->view->render('Contact', $vars);
    }

    public function postAction() {
        if (!$this->model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {
            if (!$this->model->commentValidate($_POST)) {
                $this->view->message(0, $this->model->error);
            }
            
            $id = $this->model->commentAdd($_POST, $this->route['id']);
            $this->view->message(1, 'Comment Add!');
        }
        $vars = [
            'data' => $this->model->postData($this->route['id'])[0],
            'comments' => $this->model->getComments($this->route['id']),
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
        ];
        $this->view->render('Post', $vars);
    }

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

    public function profileAction () {
        if (!$this->model->isUSerExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        
        $vars = [
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'posts' => $this->model->getUserPosts($this->route['id']),
            'author' => $this->model->getAuthorById($this->route['id'])[0],
            'count_posts' => $this->model->countUserPosts($this->route['id']),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
        ];

        $this->view->render('Profile', $vars);
    }

    public function logoutAction() {
        unset($_COOKIE['username']);
        setcookie('username', 'admin', time() - 3600, "/" );
        $this->view->redirect('main/index/1');
        return true;
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
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
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
            $this->view->location('edit');
        }
        $vars = [
            'data' => $this->model->postData($this->route['id'])[0],
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
        ];
        $this->view->render('Edit Post', $vars);
    }

    public function deleteAction() {
        if (!$this->model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->postDelete($this->route['id']);
        $this->view->redirect('main/index/1');
    }
}

?>