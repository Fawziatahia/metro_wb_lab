<?php

namespace App\Models;

use PDO;

class Post
{
    private static function connect(): PDO
    {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $db = getenv('DB_NAME') ?: 'metro_web_class';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        return $pdo;
    }

    /**
     * Create a new post
     */
    public static function create(int $userId, string $content, ?string $imagePath = null): int
    {
        $stmt = self::connect()->prepare(
            'INSERT INTO posts (user_id, content, image_path, created_at) VALUES (?, ?, ?, NOW())'
        );
        $stmt->execute([$userId, $content, $imagePath]);
        return (int)self::connect()->lastInsertId();
    }

    /**
     * Get all posts with user information
     */
    public static function getAllWithUsers(): array
    {
        $stmt = self::connect()->query('
            SELECT 
                posts.id,
                posts.content,
                posts.image_path,
                posts.created_at,
                users.id as user_id,
                users.name as user_name,
                users.email as user_email
            FROM posts
            INNER JOIN users ON posts.user_id = users.id
            ORDER BY posts.created_at DESC
        ');
        return $stmt->fetchAll();
    }

    /**
     * Get posts by user ID
     */
    public static function getByUserId(int $userId): array
    {
        $stmt = self::connect()->prepare('
            SELECT 
                posts.id,
                posts.content,
                posts.image_path,
                posts.created_at,
                users.id as user_id,
                users.name as user_name,
                users.email as user_email
            FROM posts
            INNER JOIN users ON posts.user_id = users.id
            WHERE posts.user_id = ?
            ORDER BY posts.created_at DESC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get a single post by ID
     */
    public static function getById(int $postId): ?array
    {
        $stmt = self::connect()->prepare('
            SELECT 
                posts.id,
                posts.content,
                posts.image_path,
                posts.created_at,
                users.id as user_id,
                users.name as user_name,
                users.email as user_email
            FROM posts
            INNER JOIN users ON posts.user_id = users.id
            WHERE posts.id = ?
        ');
        $stmt->execute([$postId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Delete a post
     */
    public static function delete(int $postId, int $userId): bool
    {
        $stmt = self::connect()->prepare('DELETE FROM posts WHERE id = ? AND user_id = ?');
        return $stmt->execute([$postId, $userId]);
    }

    /**
     * Update a post
     */
    public static function update(int $postId, int $userId, string $content): bool
    {
        $stmt = self::connect()->prepare('
            UPDATE posts 
            SET content = ?, updated_at = NOW() 
            WHERE id = ? AND user_id = ?
        ');
        return $stmt->execute([$content, $postId, $userId]);
    }
}