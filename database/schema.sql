CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'admin', 'user') NOT NULL DEFAULT 'user',
    status ENUM('pending', 'approved') NOT NULL DEFAULT 'pending', -- Default "pending" for new admins
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE blogs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(500),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- ✅ Ensure a Super Admin Exists (Insert if not already present)
INSERT INTO users (username, email, password, role, status)
SELECT 'SuperAdmin', 'superadmin@example.com', '$2y$10$hashedpassword123', 'super_admin', 'approved'
WHERE NOT EXISTS (
    SELECT 1 FROM users WHERE role = 'super_admin'
);
