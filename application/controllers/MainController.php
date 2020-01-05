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
            if (!$this->model->contactValidate($_POST)) {
                $this->view->message('Error', $this->model->error);
            }
            $name = trim(filter_var($_POST['contact-name'], FILTER_SANITIZE_STRING));
            $email = trim(filter_var($_POST['contact-email'], FILTER_SANITIZE_EMAIL));
            $subject = trim(filter_var($_POST['contact-subject'], FILTER_SANITIZE_STRING));
            $message = trim(filter_var($_POST['contact-message'], FILTER_SANITIZE_STRING));
            
            $my_email = "testmino87@gmail.com";
            $sub = "=?utf-8?B?".base64_encode("$subject")."?=";
            $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/plain; charset=utf-8\r\n";

            mail($my_email, $sub, $message, $headers);
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