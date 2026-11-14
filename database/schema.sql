-- Database schema will be defined here.


CREATE DATABASE IF NOT EXISTS ck_website
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE ck_website;


-- =========================================
-- 1. DIVISIONS
-- =========================================

CREATE TABLE divisions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    label_ar VARCHAR(255) NOT NULL,
    label_fr VARCHAR(255) NOT NULL,

    description_ar TEXT NULL,
    description_fr TEXT NULL,

    location_ar VARCHAR(255) NULL,
    location_fr VARCHAR(255) NULL,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- =========================================
-- 2. SERVICES
-- =========================================

CREATE TABLE services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    label_ar VARCHAR(255) NOT NULL,
    label_fr VARCHAR(255) NOT NULL,

    description_ar TEXT NULL,
    description_fr TEXT NULL,

    division_id INT UNSIGNED NOT NULL,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_services_division
        FOREIGN KEY (division_id)
        REFERENCES divisions(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;


-- =========================================
-- 3. DOCUMENT PROCEDURES
-- =========================================

CREATE TABLE document_procedures (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    label_ar VARCHAR(255) NOT NULL,
    label_fr VARCHAR(255) NOT NULL,

    delai_ar VARCHAR(255) NULL,
    delai_fr VARCHAR(255) NULL,

    justified_pappers TEXT NULL,

    service_id INT UNSIGNED NOT NULL,

    online_service_label VARCHAR(255) NULL,
    online_service_url VARCHAR(2048) NULL,

    description_ar TEXT NULL,
    description_fr TEXT NULL,

    is_annexe TINYINT(1) NOT NULL DEFAULT 0,

    pieces TEXT NULL,

    legal_tarif TEXT NULL,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_document_procedures_service
        FOREIGN KEY (service_id)
        REFERENCES services(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;


-- =========================================
-- 4. DOCUMENT PROCEDURE STEPS
-- =========================================

CREATE TABLE document_procedure_steps (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    `position` SMALLINT UNSIGNED NOT NULL,

    label_ar VARCHAR(255) NOT NULL,
    label_fr VARCHAR(255) NOT NULL,

    description_ar TEXT NULL,
    description_fr TEXT NULL,

    document_procedure_id INT UNSIGNED NOT NULL,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_procedure_steps_procedure
        FOREIGN KEY (document_procedure_id)
        REFERENCES document_procedures(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    UNIQUE KEY uq_procedure_step_position (
        document_procedure_id,
        `position`
    )
) ENGINE=InnoDB;


-- =========================================
-- 5. NEIGHBORHOOD
-- =========================================

CREATE TABLE neighborhood (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    label_ar VARCHAR(255) NOT NULL,
    label_fr VARCHAR(255) NOT NULL,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- =========================================
-- 6. URBAN CATEGORY
-- =========================================

CREATE TABLE urban_category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    label_ar VARCHAR(255) NOT NULL,
    label_fr VARCHAR(255) NOT NULL,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- =========================================
-- 7. URBAN REPORTS
-- =========================================

CREATE TABLE urban_reports (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    reference_number VARCHAR(40) NOT NULL UNIQUE,

    status VARCHAR(20) NOT NULL DEFAULT 'Pending',

    urban_cat_id INT UNSIGNED NOT NULL,
    neighborhood_id INT UNSIGNED NOT NULL,

    `location` VARCHAR(255) NOT NULL,

    `object` VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,

    `file` VARCHAR(512) NULL,

    fullname VARCHAR(150) NOT NULL,
    phone_number VARCHAR(30) NOT NULL,
    email VARCHAR(254) NULL,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_urban_reports_category
        FOREIGN KEY (urban_cat_id)
        REFERENCES urban_category(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_urban_reports_neighborhood
        FOREIGN KEY (neighborhood_id)
        REFERENCES neighborhood(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;
