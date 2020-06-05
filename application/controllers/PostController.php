<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class PostController extends Controller{

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
        $this->view->render($vars['data']['title'], $vars);
    }

    public function addAction() {
        $vars = [
            'categories' => $this->model->getCategories(),
            'recentPosts' => $this->model->recentPosts(),
            'id_user' => $this->model->getIdUserByUsername($_COOKIE['username']),
        ];
        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'add')) {
                $this->view->message(0, $this->model->error);
            }
            $id = $this->model->postAdd($_POST);
            $this->view->message(1, 'Post Add!');
            $this->view->redirect('/user/profile/' . $var["id_user"]);
        }
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