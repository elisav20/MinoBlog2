<?php

namespace application\models;

use application\core\Model;

class Authorization extends Model {

    public $error;

    public function loginValidate($post) {
        $userName = trim(filter_var($_POST['login-username'], FILTER_SANITIZE_STRING));
        $pass = trim(filter_var($_POST['login-pass'], FILTER_SANITIZE_STRING));

        $hash = "ddghus454fdkgdkjvz324567";
        $pass = md5($pass . $hash);

        $params = [
            'username' => $userName,
            'pass' => $pass,
        ];
        $result = $this->db->row('SELECT * FROM users WHERE `username` = :username AND `pass` = :pass', $params);
        if (!$result) {
            $this->error = 'Incorrect login or password';
            return false;
        }
        setcookie('username', $userName, time() + 3600, "/" );
        return true;
        $this->view->redirect('/');
    }

    public function isUsernameExists($username) {
        $params = [
            'username' => $username,
        ];
        return $this->db->column('SELECT id FROM users WHERE username = :username', $params);
    }

    public function isEmailExists($email) {
        $params = [
            'email' => $email,
        ];
        return $this->db->column('SELECT id FROM users WHERE email = :email', $params);
    }

    public function infoUserValidate($_post) {

        $firstName = trim(filter_var($_POST['signup-firstname'], FILTER_SANITIZE_STRING));
        $lastName = trim(filter_var($_POST['signup-lastname'], FILTER_SANITIZE_STRING));
        $userName = trim(filter_var($_POST['signup-username'], FILTER_SANITIZE_STRING));
        $userExists = self::isUsernameExists($userName);
        $email = trim(filter_var($_POST['signup-email'], FILTER_SANITIZE_EMAIL));
        $emailExists = self::isEmailExists($email);
        $pass = trim(filter_var($_POST['signup-pass'], FILTER_SANITIZE_EMAIL));

        if(strlen($firstName) < 3 or strlen($firstName) > 30){
            $this->error = 'The firstname must contain from 3 to 30 characters.';
            return false;
        } elseif(strlen($lastName) < 3 or strlen($lastName) > 30) {
            $this->error = 'The lastname must contain from 3 to 30 characters.';
            return false;
        } elseif(strlen($userName) < 3 or strlen($userName) > 30) {
            $this->error = 'The username must contain from 3 to 30 characters.';
            return false;
        } elseif($userExists) {
            $this->error = 'This username exists';
            return false;
        } elseif(strlen($email) < 3) {
            $this->error = 'Incorrect Email Adress';
            return false;
        } elseif($emailExists) {
            $this->error = 'This email exists';
            return false;
        } elseif(strlen($pass) < 3) {
            $this->error = 'Password must contain at least 3 characters.';
            return false;
        }
        return true;
    }

    public function isUserExists ($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM users WHERE id = :id', $params);
    }

    public function userAdd ($_post) {
        $firstName = trim(filter_var($_POST['signup-firstname'], FILTER_SANITIZE_STRING));
        $lastName = trim(filter_var($_POST['signup-lastname'], FILTER_SANITIZE_STRING));
        $userName = trim(filter_var($_POST['signup-username'], FILTER_SANITIZE_STRING));
        $email = trim(filter_var($_POST['signup-email'], FILTER_SANITIZE_EMAIL));
        $pass = trim(filter_var($_POST['signup-pass'], FILTER_SANITIZE_STRING));

        $hash = "ddghus454fdkgdkjvz324567";
        $pass = md5($pass . $hash);
        $params = [
            'firstname' => $firstName,
            'lastname' => $lastName,
            'username' =>$userName,
            'email' => $email,
            'pass' => $pass,
        ];
        $this->db->query ('INSERT INTO `users`(firstname, lastname, username, email, pass)
                            VALUES (:firstname, :lastname, :username, :email, :pass)' , $params);
    }

    public function getCategories () {
        return $this->db->row('SELECT categories.*, COUNT(posts.id_category) as posts_count
                                FROM categories LEFT JOIN posts ON categories.id_category = posts.id_category
                                GROUP BY categories.id_category');
    }

    public function recentPosts() {
        $params = [
            'limit' => 5,
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :limit', $params);
    }
}

?>