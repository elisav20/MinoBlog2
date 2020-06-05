<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class UserController extends Controller{

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

        $this->view->render('Profile - ' . $vars["author"]["firstname"] . $vars["author"]["lastname"], $vars);
    }
}

?>