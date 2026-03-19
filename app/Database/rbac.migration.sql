CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO roles (name, slug) VALUES
('Admin', 'admin'),
('Teacher', 'teacher'),
('Student', 'student'),
('Coordinator', 'coordinator');

ALTER TABLE users
ADD COLUMN role_id INT NULL AFTER id;

ALTER TABLE users
ADD CONSTRAINT fk_users_role
FOREIGN KEY (role_id)
REFERENCES roles(id)
ON DELETE SET NULL;


UPDATE users SET role_id = 1 WHERE email = 'admin@school.edu';
UPDATE users SET role_id = 2 WHERE email = 'teacher@school.edu';
UPDATE users SET role_id = 3 WHERE email = 'student@school.edu';