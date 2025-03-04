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

CREATE TABLE devices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    category ENUM('Laptop', 'Desktop', 'CCTV', 'Biometric', 'Printer') NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- ✅ Ensure a Super Admin Exists (Insert if not already present)
INSERT INTO users (username, email, password, role, status)
SELECT 'SuperAdmin', 'superadmin@example.com', '$2y$10$hashedpassword123', 'super_admin', 'approved'
WHERE NOT EXISTS (
    SELECT 1 FROM users WHERE role = 'super_admin'
);

CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    followers VARCHAR(255) NOT NULL,
    category ENUM(
        'Live Streaming Host', 'YouTubers', 'Social Media Influencers', 'Bollywood Artist',
        'Mobile/PC Gamers', 'Short Video Creators', 'Podcast Hosts',
        'Lifestyle Bloggers/Vloggers', 'Fitness Influencers'
    ) NOT NULL,
    language VARCHAR(255) NOT NULL,
    professional ENUM('Artist', 'Employee') NOT NULL,
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

