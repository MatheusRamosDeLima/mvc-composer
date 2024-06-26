<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;
use App\Models\BlogModel;

class BlogController extends Controller {
    private BlogModel $db;

    public function index() {
        $this->db = new BlogModel;

        $categories = $this->db->getAll('categories');
        $posts = $this->db->getAll('posts');

        $view = new View('Blog/index', 'All posts');
        $this->viewWithTemplate($view, [
            'categories' => $categories,
            'posts' => $posts,
            'postCategory' => function($post) {
                return $this->db->getObject('categories', 'id', $post->categoryid)->name;
            }
        ]);
    }

    public function category(string $categoryName) {
        $this->db = new BlogModel;

        $category = $this->db->getObject('categories', 'name', $categoryName);
        if ($category) {
            $categoryPosts = $this->db->getArray('posts', 'categoryid', $category->id);
            $view = new View('Blog/category', "Posts about $categoryName");
            $this->viewWithTemplate($view, [
                'categoryName' => $categoryName,
                'posts' => $categoryPosts
            ]);
        }
        else $this->error404();
    }

    public function get(string $postId) {
        $this->db = new BlogModel;

        $post = $this->db->getObject('posts', 'id', $postId);
        if ($post) {
            $view = new View('Blog/get', "$post->name");
            $this->viewWithTemplate($view, [
                'postName' => $post->name,
                'postContent' => $post->content,
                'postCategory' => $this->db->getObject('categories', 'id', $post->categoryid)->name
            ]);
        }
        else $this->error404();
    }
}