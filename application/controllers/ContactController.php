<?php

namespace application\controllers;

use application\core\Controller;

class ContactController extends Controller{

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
}

?>