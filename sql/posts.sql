-- Add this to your database after the users table

CREATE TABLE IF NOT EXISTS posts (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED NOT NULL,
  content TEXT NOT NULL,
  image_path VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY user_id (user_id),
  KEY created_at (created_at),
  CONSTRAINT posts_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optional: Add some sample posts
-- INSERT INTO posts (user_id, content, created_at) VALUES
-- (1, 'Hello everyone! This is my first post on AuthBoard.', NOW()),
-- (1, 'Excited to be part of this community!', NOW()),
-- (1, 'What are your thoughts on web development in 2025?', NOW());