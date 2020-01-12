<?php

namespace application\models;

use application\core\Model;

class Admin extends Model {

    public $error;

    public function loginValidate($post) {
        $config = require 'application/config/admin.php';
        if ($config['login'] != $_POST['username'] or $config['password'] != $_POST['pass']) {
            $this->error = 'Incorrect Login or Password';
            return false;
        }
        return true;
    }

    public function getCategoryID($category_name) {
        $params = [
            'name' => $category_name,
        ];          
        return  $this->db->column('SELECT id_category FROM categories WHERE name = :name', $params);
    }

        public function categoriesCount() {
        return $this->db->column('SELECT COUNT(id_category) FROM categories');
    }

    public function getCategories () {
        return $this->db->row('SELECT categories.*, COUNT(posts.id_category) as posts_count
                                FROM categories LEFT JOIN posts 
                                                    ON categories.id_category = posts.id_category
                                GROUP BY categories.id_category');
    }

    public function categoryValidate($post) { 

        $name = trim(filter_var($_POST['category_name'], FILTER_SANITIZE_STRING)); 
        
        if(strlen($name) < 3 or strlen($name) > 30){ 
            $this->error = 'The name must contain from 3 to 30 characters.';
            return false; 
        }
        return true;
    }

    public function categoryAdd($post) {
        $name = trim(filter_var($_POST['category_name'], FILTER_SANITIZE_STRING)); 
        $params = [
            'name' => $name,
        ];
        $this->db->query('INSERT INTO `categories`(`name`) VALUES (:name)', $params);
    }

    public function isCategoryExists($id) {
        $params = [
            'id_category' => $id,
        ];
        return $this->db->column('SELECT id_category FROM categories WHERE id_category = :id_category', $params);
    }

    public function insertNewId ($id_category) {
        $new_id = 9;
        $params = [
            'new_id' => $new_id,
            'id_category' => $id_category,
        ];
        $this->db->query('UPDATE `posts` SET id_category = :new_id WHERE id_category = :id_category', $params);
    }

    public function categoryDelete ($id_category) {
        $params = [
            'id_category' => $id_category,
        ];
        $this->db->query('DELETE FROM categories WHERE id_category = :id_category', $params);
    }

    public function postValidate($post, $type) { 

        $title = trim(filter_var($_POST['post_title'], FILTER_SANITIZE_STRING)); 
        $text = trim($_POST['post_text']);
        
        if(strlen($title) < 3 or strlen($title) > 50){ 
            $this->error = 'The title must contain from 3 to 50 characters.';
            return false; 
        } elseif(empty($_FILES['post_photo']['tmp_name']) and $type == 'add') {
            $this->error = 'Select photo';
            return false;
        } elseif (!isset($_POST['category_name'])){ 
            $this->error = 'Select Category.';
            return false; 
        } elseif (strlen($text) < 10 or strlen($text) > 50000){ 
            $this->error = 'The text must contain from 10 to 50000 characters.';
            return false; 
        }
        return true;
    }

    public function postAdd($post) {
        $title = trim(filter_var($_POST['post_title'], FILTER_SANITIZE_STRING)); 
        $text = trim($_POST['post_text']);
        $uploadDir = 'public/images/posts/';
        $uploadedFile = ''; 
            
        $fileName = microtime() . '.' . basename($_FILES["post_photo"]["name"]);
        $targetFilePath = $uploadDir . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            
        $allowTypes = array('jpg', 'jpeg'); 
        if(in_array($fileType, $allowTypes)){ 
            $uploadedFile = $fileName; 
        }

        $id_category = self::getCategoryID($post['category_name']);

        $params = [
            'title' => $title,
            'photo' => $uploadedFile,
            'text' => $post['post_text'],
            'id_category' => $id_category,
            'id_user' => 1,
        ];
        $this->db->query('INSERT INTO `posts`(`title`, `photo`, `text`, `id_category`, `id_user`) VALUES (:title, :photo, :text, :id_category, :id_user)', $params);
        move_uploaded_file($_FILES["post_photo"]["tmp_name"], $targetFilePath);
    }

    public function isPostExists($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    public function postEdit($post, $id) {
        $data = self::postData($id)[0];
        $id_category = self::getCategoryID($post['category_name']);
        $id_user = 1;
        
        $uploadDir = 'public/images/posts/';
        $uploadedFile = $data['photo']; 
        
        if (!empty($_FILES['post_photo']['tmp_name'])) {
            $fileName = microtime() . '.' . basename($_FILES["post_photo"]["name"]);
            $targetFilePath = $uploadDir . $fileName; 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                
            $allowTypes = array('jpg', 'jpeg'); 
            if(in_array($fileType, $allowTypes)){ 
                $uploadedFile = $fileName;
            }
        }

        $params = [
            'id' => $id,
            'title' => $post['post_title'],
            'photo' => $uploadedFile,
            'text' => $post['post_text'],
            'id_category' => $id_category,
            'id_user' => $id_user,
        ];

        $this->db->query('UPDATE posts 
                        SET `title` = :title, `photo` = :photo, `text` = :text, `id_category` = :id_category, `id_user` = :id_user
                        WHERE id = :id', $params);
        if (!empty($_FILES['post_photo']['tmp_name'])) {
            unlink ('public/images/posts/' . $data['photo']);
            move_uploaded_file($_FILES["post_photo"]["tmp_name"], $targetFilePath);
        } 
    }

    public function postDelete ($id) {
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
    }

    public function postData ($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT posts.*, 
                                        users.firstname,
                                        users.lastname, 
                                        categories.name as category_name, 
                                        COUNT(comments.id_post) as comments_count
                                FROM posts LEFT JOIN users ON posts.id_user = users.id
                                            LEFT JOIN categories ON posts.id_category = categories.id_category
                                            LEFT JOIN comments ON posts.id = comments.id_post
                                WHERE posts.id = :id
                                GROUP BY posts.id', $params);
    }

    public function postsCount() {
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    public function postsList($route) {
        $max = 5;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];
        return $this->db->row('SELECT posts.*, 
                                        users.firstname,
                                        users.lastname,
                                        categories.name as category_name
                                FROM posts LEFT JOIN users ON posts.id_user = users.id
                                            LEFT JOIN categories ON posts.id_category = categories.id_category
                                ORDER BY date DESC LIMIT :start, :max', $params);
    }

    public function usersCount() {
        return $this->db->column('SELECT COUNT(id) FROM users');
    }

    public function isUserExists($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM users WHERE id = :id', $params);
    }

    public function getUsers($route) {
        $max = 10;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];
        return $this->db->row('SELECT users.*, COUNT(id_user) as posts_count
                                FROM users LEFT JOIN posts ON users.id = posts.id_user
                                GROUP BY users.id
                                LIMIT :start, :max', $params);
    }

    public function deleteUser($id) {
        $params = [
            'id' => $id,
        ];

        $this->db->query('DELETE FROM users WHERE id = :id', $params);
    }

    public function recentPosts() {
        $params = [
            'limit' => 5,
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY date DESC LIMIT :limit', $params);
    }

    public function getUserPosts($id) {
        $params = [
            'id_user' => $id,
        ];
        return $this->db->row('SELECT posts.*, categories.name as category_name
                                FROM posts LEFT JOIN categories ON posts.id_category = categories.id_category
                                WHERE id_user = :id_user ORDER BY date DESC', $params);
    }
}

?>