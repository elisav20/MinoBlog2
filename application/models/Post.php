<?php

namespace application\models;

use application\core\Model;

class Post extends Model {

    public $error;

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

    public function getCategoryID($category_name) {
        $params = [
            'name' => $category_name,
        ];
        return  $this->db->column('SELECT id_category FROM categories WHERE name = :name', $params);
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
        $id_user = self::getIdUserByUsername($_COOKIE['username']);

        $params = [
            'title' => $title,
            'photo' => $uploadedFile,
            'text' => $post['post_text'],
            'id_category' => $id_category,
            'id_user' => $id_user,
        ];
        $this->db->query('INSERT INTO `posts`(`title`, `photo`, `text`, `id_category`, `id_user`) VALUES (:title, :photo, :text, :id_category, :id_user)', $params);
        move_uploaded_file($_FILES["post_photo"]["tmp_name"], $targetFilePath);
    }

    public function postEdit($post, $id) {
        $data = self::postData($id)[0];
        $id_category = self::getCategoryID($post['category_name']);
        $id_user = self::getIdUserByUsername($_COOKIE['username']);

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

    public function isPostExists($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    public function postData ($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT posts.*,
                                        users.firstname,
                                        users.lastname,
                                        categories.id_category as category,
                                        categories.name as category_name,
                                        COUNT(comments.id_post) as comments_count
                                FROM posts LEFT JOIN users ON posts.id_user = users.id
                                            LEFT JOIN categories ON posts.id_category = categories.id_category
                                            LEFT JOIN comments ON posts.id = comments.id_post
                                WHERE posts.id = :id
                                GROUP BY posts.id', $params);
    }

    public function postDelete ($id) {
        $data = self::postData($id)[0];
        $params = [
            'id' => $id,
        ];
        unlink ('public/images/posts/' . $data['photo']);
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
    }

    public function recentPosts() {
        $params = [
            'limit' => 5,
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY date DESC LIMIT :limit', $params);
    }

    public function getComments ($id_post) {
        $params = [
            'id_post' => $id_post,
        ];
        return $this->db->row('SELECT * FROM comments WHERE id_post = :id_post ORDER BY date DESC', $params);
    }

    public function commentValidate ($post) {
        $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));

        if(strlen($username) < 3 or strlen($username) > 30){
            $this->error = 'The username must contain from 3 to 30 characters.';
            return false;
        } elseif (strlen($comment) < 3 or strlen($comment) > 1000){
            $this->error = 'The text must contain from 3 to 1000 characters.';
            return false;
        }
        return true;
    }

    public function commentAdd($post, $id) {
        $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));

        $params = [
            'comment' => $comment,
            'id_post' => $id,
            'username' =>$username,
            'email' => $email,
        ];
        $this->db->query ('INSERT INTO `comments`(comment, id_post, username, email)
                            VALUES (:comment, :id_post, :username, :email)' , $params);
    }

    public function getIdUserByUsername ($username = null) {
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

}

?>