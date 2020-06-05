<?php

namespace application\models;

use application\core\Model;

class Categories extends Model {

    public $error;

    public function getCategoryID($category_name) {
        $params = [
            'name' => $category_name,
        ];
        return  $this->db->column('SELECT id_category FROM categories WHERE name = :name', $params);
    }

    public function recentPosts() {
        $params = [
            'limit' => 5,
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :limit', $params);
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

    public function getCategories () {
        return $this->db->row('SELECT categories.*, COUNT(posts.id_category) as posts_count
                                FROM categories LEFT JOIN posts ON categories.id_category = posts.id_category
                                GROUP BY categories.id_category');
    }
}

?>