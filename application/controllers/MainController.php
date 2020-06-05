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
}

?>