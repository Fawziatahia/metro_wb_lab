<?php

namespace App\Controllers;

use App\Models\Post;
use App\Core\Session;

class PostController
{
    public function index()
    {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /login');
            exit;
        }

        $posts = Post::getAllWithUsers();
        
        return $this->view('posts', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /posts');
            exit;
        }

        $content = trim($_POST['content'] ?? '');
        $imagePath = null;

        // Validate content
        if (empty($content) || strlen($content) > 500) {
            Session::set('error', 'Post content must be between 1 and 500 characters');
            header('Location: /posts');
            exit;
        }

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            try {
                $imagePath = $this->handleImageUpload($_FILES['image']);
            } catch (\Exception $e) {
                Session::set('error', $e->getMessage());
                header('Location: /posts');
                exit;
            }
        }

        // Create post
        try {
            Post::create($user['id'], $content, $imagePath);
            Session::set('success', 'Post created successfully!');
        } catch (\Exception $e) {
            Session::set('error', 'Failed to create post: ' . $e->getMessage());
        }

        header('Location: /posts');
        exit;
    }

    private function handleImageUpload($file)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        // Validate file type
        if (!in_array($file['type'], $allowedTypes)) {
            throw new \Exception('Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.');
        }

        // Validate file size
        if ($file['size'] > $maxSize) {
            throw new \Exception('File size exceeds 5MB limit.');
        }

        // Create uploads directory if it doesn't exist
        $uploadDir = __DIR__ . '/../../public/uploads/posts/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('post_', true) . '.' . $extension;
        $filepath = $uploadDir . $filename;

        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            throw new \Exception('Failed to upload file.');
        }

        return '/uploads/posts/' . $filename;
    }

    private function view($viewName, $data = [])
    {
        extract($data);
        ob_start();
        include __DIR__ . '/../Views/' . $viewName . '.php';
        return ob_get_clean();
    }
}