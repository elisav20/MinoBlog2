<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class CategoriesController extends Controller{

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
}

?>