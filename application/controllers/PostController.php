<?php

namespace application\controllers;

use application\core\Controller;

class PostController extends Controller{
    
    public function addAction() {
        $this->view->render('Add Post');
    }

    public function editAction() {
        $this->view->render('Edit Post');
    }

    public function deleteAction() {
        exit('Delete');
    }
}

?>