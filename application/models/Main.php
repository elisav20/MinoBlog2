<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

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

    public function postsCount() {
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    public function getCategoryID($category_name) {
        $params = [
            'name' => $category_name,
        ];          
        return  $this->db->column('SELECT id_category FROM categories WHERE name = :name', $params);
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

    public function postsList($route) {
        $max = 5;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
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
                                GROUP BY posts.id
                                ORDER BY date DESC LIMIT :start, :max', $params);
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
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
    }

    public function recentPosts() {
        $params = [
            'limit' => 5,
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY date DESC LIMIT :limit', $params);
    }

    public function isCategoryExists($id) {
        $params = [
            'id_category' => $id,
        ];
        return $this->db->column('SELECT id_category FROM categories WHERE id_category = :id_category', $params);
    }

    public function getPostsByCategory ($id) {
        $params = [
            'id_category' => $id,
        ];
        return $this->db->row('SELECT posts.*,
                                        users.id as author,
                                        users.firstname,
                                        users.lastname, 
                                        categories.name as category_name, 
                                        COUNT(comments.id_post) as comments_count
                                FROM posts LEFT JOIN users ON posts.id_user = users.id
                                            LEFT JOIN categories ON posts.id_category = categories.id_category
                                            LEFT JOIN comments ON posts.id = comments.id_post
                                WHERE posts.id_category = :id_category
                                GROUP BY posts.id', $params);
    }

    public function getCategoryById ($id) {
        $params = [
            'id_category' => $id,
        ];
        return $this->db->row('SELECT `name` FROM categories WHERE id_category =  :id_category', $params);
    }

    public function countCategoryPosts ($id) {
        $params = [
            'id_category' => $id,
        ];
        return $this->db->column('SELECT COUNT(id_category) FROM posts WHERE id_category = :id_category', $params);
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

    public function countUserPosts ($id) {
        $params = [
            'id_user' => $id,
        ];
        return $this->db->column('SELECT COUNT(id_user) FROM posts WHERE id_user = :id_user', $params);
    }

    public function getAuthorById ($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT firstname, lastname FROM users WHERE id =  :id', $params);
    }

    public function getCategories () {
        return $this->db->row('SELECT categories.*, COUNT(posts.id_category) as posts_count
                                FROM categories LEFT JOIN posts ON categories.id_category = posts.id_category
                                GROUP BY categories.id_category');
    }

    public function getComments ($id_post) {
        $params = [
            'id_post' => $id_post,
        ];
        return $this->db->row('SELECT * FROM comments WHERE id_post = :id_post', $params);
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

    // public function searchPost() {
    //     function search($text){
    
    //         $text = htmlspecialchars($text);

    //         $get_title = $this->$db->prepare("SELECT id, title FROM posts WHERE title LIKE concat('%', :title, '%')");

    //         $get_title -> execute(array('title' => $text));

    //             while($post = $get_title->fetch(PDO::FETCH_ASSOC)){
    //                 echo '<a href="/post/' .$post['id'] . '">'.$post['title'].'</a>';
    //             }
    //     }
    //     search($_GET['txt']);
    // }
}

?>