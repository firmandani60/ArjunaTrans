CREATE DATABASE IF NOT EXISTS arjunatransdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE arjunatransdb;

CREATE TABLE IF NOT EXISTS hero_sections (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    badge VARCHAR(255) NULL,
    title VARCHAR(160) NOT NULL,
    description TEXT NULL,
    primary_button_label VARCHAR(255) NULL,
    primary_button_url VARCHAR(255) NULL,
    secondary_button_label VARCHAR(255) NULL,
    secondary_button_url VARCHAR(255) NULL,
    image_path TEXT NULL,
    image_alt VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS advantages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(255) NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS services (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(255) NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    image_path TEXT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS about_sections (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    eyebrow VARCHAR(255) NOT NULL DEFAULT 'Tentang Kami',
    title VARCHAR(255) NOT NULL DEFAULT 'Mendefinisikan Ulang Perjalanan Wisata Anda',
    description TEXT NULL,
    vision TEXT NULL,
    mission TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS about_gallery_images (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    about_section_id BIGINT UNSIGNED NOT NULL,
    image_path TEXT NOT NULL,
    alt_text VARCHAR(255) NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_about_gallery_about FOREIGN KEY (about_section_id) REFERENCES about_sections(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS fleets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(255) NULL,
    description TEXT NULL,
    capacity VARCHAR(255) NULL,
    facilities VARCHAR(255) NULL,
    image_path TEXT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS destinations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    route VARCHAR(255) NULL,
    image_path TEXT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS rental_routes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    destination_name VARCHAR(255) NOT NULL,
    route_description VARCHAR(255) NULL,
    elf_long_price BIGINT UNSIGNED NULL,
    medium_bus_price BIGINT UNSIGNED NULL,
    category VARCHAR(255) NULL,
    image_path TEXT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS order_steps (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contact_settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description TEXT NULL,
    address TEXT NULL,
    whatsapp VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    instagram VARCHAR(255) NULL,
    facebook VARCHAR(255) NULL,
    youtube VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
