-- MaxPerry E-Commerce Database Schema

-- Users Table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'customer') DEFAULT 'customer',
    `phone` VARCHAR(20) NULL,
    `address` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Categories Table
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Products Table
-- Products Table
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `sku` VARCHAR(50) NULL UNIQUE,
    `category_id` INT NULL DEFAULT NULL,
    `name` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(150) NOT NULL UNIQUE,
    `description` TEXT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `discount_price` DECIMAL(10, 2) NULL DEFAULT NULL,
    `stock` INT DEFAULT 0,
    `image_url` VARCHAR(255) NULL,
    `video_url` VARCHAR(255) NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Seed Data for Categories
INSERT INTO `categories` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Saten Abiyeler', 'saten-abiyeler', 'Zarif, parlak ve dökümlü saten kumaştan üretilen abiye modelleri.'),
(2, 'Payetli Abiyeler', 'payetli-abiyeler', 'Işıltısıyla göz kamaştıran pullu ve payetli gece elbiseleri.'),
(3, 'Dantelli & Tül Abiyeler', 'dantelli-tul-abiyeler', 'Romantik detaylara sahip dantel ve tül işlemeli özel tasarımlar.'),
(4, 'Yırtmaçlı Abiyeler', 'yirtmacli-abiyeler', 'Modern ve cesur yırtmaç detaylı davet elbiseleri.');

-- Insert Seed Data for Products
INSERT INTO `products` (`category_id`, `name`, `slug`, `description`, `price`, `stock`, `image_url`) VALUES
(1, 'Zümrüt Yeşil Saten Askılı Abiye', 'zumrut-yesil-saten-askili-abiye', 'Zarif degaje yaka detayı, ince askıları ve bacak yırtmacıyla büyüleyici saten abiye.', 2450.00, 15, 'zumrut-saten.jpg'),
(1, 'Rose Gold Degaje Yaka Saten Elbise', 'rose-gold-degaje-yaka-saten-elbise', 'MaxPerry özel serisi, rose gold tonunda dökümlü saten kumaş, şık sırt dekolteli.', 2750.00, 10, 'rose-gold-saten.jpg'),
(2, 'Gümüş Işıltılı Payetli Balık Abiye', 'gumus-isiltili-payetli-balik-abiye', 'Vücudu saran balık kesim, gümüş pul ve payetlerle bezeli, göz alıcı gece elbisesi.', 3890.00, 8, 'gumus-payetli.jpg'),
(2, 'Siyah Gece Yıldızı Payetli Elbise', 'siyah-gece-yildizi-payetli-elbise', 'Klasik siyahın asaletini yırtmaç ve payet ışıltısıyla buluşturan şık tasarım.', 3450.00, 12, 'siyah-payetli.jpg'),
(3, 'Pudra Pembesi Dantelli Tül Abiye', 'pudra-pembesi-dantelli-tul-abiye', 'Açık ton severler için romantik dantel işlemeleri ve uçuş uçuş tül etekli rüya abiye.', 3200.00, 7, 'pudra-dantel.jpg'),
(3, 'Zarif Ekru Helen Abiye', 'zarif-ekru-helen-abiye', 'Gelin adayları ve nikah törenleri için ideal, ekru renk tül askılı Helen model elbise.', 4200.00, 5, 'ekru-helen.jpg'),
(4, 'Gece Mavisi Yırtmaçlı Kadife Abiye', 'gece-mavisi-yirtmacli-kadife-abiye', 'Yumuşacık kadife kumaş, derin bacak yırtmacı ve bel büzgüsüyle modern şıklık.', 2950.00, 9, 'mavi-kadife.jpg');

-- Insert Admin User (Password is 'admin123' hashed with password_hash under default BCRYPT)
-- Hash for 'admin123': $2y$10$f6Bbe1uJ5bIAtXlVlHwZ3e3VlUv8U2QzTqFm1/O3gYgA/8uY6wIHi
-- Insert Admin User (Password is 'admin123' hashed with password_hash under default BCRYPT)
-- Hash for 'admin123': $2y$10$Ge03XPDo0YoxyX6uO1wHB.AAiVmieeeXeSnYeBA8zclpeRo9piJJq
INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
('MaxPerry Yönetici', 'maxperry@maxperryabiye.com', '$2y$10$Ge03XPDo0YoxyX6uO1wHB.AAiVmieeeXeSnYeBA8zclpeRo9piJJq', 'admin');

-- Password Resets Table (Secure Tokens)
CREATE TABLE IF NOT EXISTS `password_resets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(150) NOT NULL,
    `token` VARCHAR(255) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Newsletter Subscribers Table (Secure Email Collection)
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Messages Table (For Vitrin Showroom Inquiries)
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(30) NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
