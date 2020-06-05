<?php

namespace application\models;

use application\core\Model;

class User extends Model {

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

    public function isUserExists ($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM users WHERE id = :id', $params);
    }

    public function getUserPosts ($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT posts.*, COUNT(comments.id_post) as comments_count, categories.name as category
                                FROM posts LEFT JOIN categories ON posts.id_category = categories.id_category
                                            LEFT JOIN comments ON posts.id = comments.id_post
                                WHERE id_user = :id
                                GROUP BY id
                                ORDER BY date DESC', $params);
    }

    public function getAuthorById ($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT firstname, lastname FROM users WHERE id =  :id', $params);
    }

    public function countUserPosts ($id) {
        $params = [
            'id_user' => $id,
        ];
        return $this->db->column('SELECT COUNT(id_user) FROM posts WHERE id_user = :id_user', $params);
    }

    public function getCategories () {
        return $this->db->row('SELECT categories.*, COUNT(posts.id_category) as posts_count
                                FROM categories LEFT JOIN posts ON categories.id_category = posts.id_category
                                GROUP BY categories.id_category');
    }
}

?>