<?php

namespace application\models;

use application\core\Model;

class Contact extends Model {

    public $error;

    public function recentPosts() {
        $params = [
            'limit' => 5,
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :limit', $params);
    }

    public function getIdUserByUsername ($username) {
        $params = [
            'username' => $username,
        ];
        return $this->db->column('SELECT id FROM users WHERE username =  :username', $params);
    }

    public function getCategories () {
        return $this->db->row('SELECT categories.*, COUNT(posts.id_category) as posts_count
                                FROM categories LEFT JOIN posts ON categories.id_category = posts.id_category
                                GROUP BY categories.id_category');
    }

    public function contactValidate($post) {
        $nameLen = iconv_strlen($_POST['contact-name']);
        $subjectLen = iconv_strlen($_POST['contact-subject']);
        $textLen = iconv_strlen($_POST['contact-message']);
        if ($nameLen < 3 or $nameLen > 20) {
            $this->error = 'The name must contain from 3 to 20 characters.';
            return false;
        } elseif (!filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Incorect Email adress';
            return false;
        } elseif ($subjectLen < 3 or $subjectLen > 50) {
            $this->error = 'The subject must contain from 3 to 50 characters.';
            return false;
        } elseif ($textLen < 10 or $textLen > 500) {
            $this->error = 'The message must contain from 10 to 500 characters.';
            return false;
        }
        return true;
    }
}

?>