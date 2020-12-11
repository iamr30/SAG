/*
 Navicat Premium Data Transfer

 Source Server         : cdu-sys
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:3306
 Source Schema         : cdu-sys

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 06/12/2020 15:38:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_status
-- ----------------------------
DROP TABLE IF EXISTS `account_status`;
CREATE TABLE `account_status`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_userCDU` bigint(20) NULL DEFAULT NULL,
  `balance` float NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf16 COLLATE = utf16_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of account_status
-- ----------------------------

-- ----------------------------
-- Table structure for areas
-- ----------------------------
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of areas
-- ----------------------------
INSERT INTO `areas` VALUES (1, 'Gimnasio');
INSERT INTO `areas` VALUES (2, 'Alberca');
INSERT INTO `areas` VALUES (3, 'Cancha');

-- ----------------------------
-- Table structure for assigned_schedules
-- ----------------------------
DROP TABLE IF EXISTS `assigned_schedules`;
CREATE TABLE `assigned_schedules`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_userCDU` bigint(20) NULL DEFAULT NULL,
  `id_schedules` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expiration_date` timestamp(0) NULL DEFAULT NULL,
  `amount` float NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_userCDU`(`id_userCDU`) USING BTREE,
  INDEX `id_schedules`(`id_schedules`) USING BTREE,
  CONSTRAINT `assigned_schedules_ibfk_1` FOREIGN KEY (`id_userCDU`) REFERENCES `users_cdu` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `assigned_schedules_ibfk_2` FOREIGN KEY (`id_schedules`) REFERENCES `schedules` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of assigned_schedules
-- ----------------------------
INSERT INTO `assigned_schedules` VALUES (1, 1, 5, '2020-09-18 19:36:13', '2020-11-22 19:49:56', '2020-12-19 17:22:34', 1);
INSERT INTO `assigned_schedules` VALUES (3, 3, 1, '2020-09-18 19:36:47', '2020-09-18 19:36:47', '2020-12-29 15:47:45', 1);
INSERT INTO `assigned_schedules` VALUES (4, 4, 2, '2020-09-18 19:37:01', '2020-09-18 19:37:01', NULL, 1);
INSERT INTO `assigned_schedules` VALUES (5, 5, 3, '2020-09-18 19:37:18', '2020-09-18 19:37:18', NULL, 1);
INSERT INTO `assigned_schedules` VALUES (6, 2, 5, '2020-11-28 17:38:32', '2020-11-28 17:38:59', '2021-02-28 17:40:26', 3);
INSERT INTO `assigned_schedules` VALUES (8, 1, 1, '2020-11-29 18:39:15', '2020-11-29 18:39:15', NULL, 1);

-- ----------------------------
-- Table structure for attendances_record
-- ----------------------------
DROP TABLE IF EXISTS `attendances_record`;
CREATE TABLE `attendances_record`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_userscdu` bigint(20) NULL DEFAULT NULL,
  `date` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_cdu`(`id_userscdu`) USING BTREE,
  CONSTRAINT `users_cdu` FOREIGN KEY (`id_userscdu`) REFERENCES `users_cdu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of attendances_record
-- ----------------------------
INSERT INTO `attendances_record` VALUES (1, 2, '2020-10-05 03:36:08', '2020-10-06 03:36:11', '2020-10-13 03:36:14');
INSERT INTO `attendances_record` VALUES (2, 1, '2020-10-29 03:36:23', '2020-10-07 03:36:28', '2020-10-07 03:36:31');

-- ----------------------------
-- Table structure for cards
-- ----------------------------
DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_card` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_userCDU` bigint(20) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_userCDU`(`id_userCDU`) USING BTREE,
  CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`id_userCDU`) REFERENCES `users_cdu` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cards
-- ----------------------------

-- ----------------------------
-- Table structure for concepts
-- ----------------------------
DROP TABLE IF EXISTS `concepts`;
CREATE TABLE `concepts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `concept` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `agreement` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cost` float(11, 2) NULL DEFAULT NULL,
  `clabe` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of concepts
-- ----------------------------

-- ----------------------------
-- Table structure for condonations
-- ----------------------------
DROP TABLE IF EXISTS `condonations`;
CREATE TABLE `condonations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_assigned` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `expiration_date` date NULL DEFAULT NULL,
  `percentage` float NULL DEFAULT 0,
  `scholarship_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_assigned`(`id_assigned`) USING BTREE,
  INDEX `user_id_index`(`user_id`) USING BTREE,
  CONSTRAINT `condonations_ibfk_1` FOREIGN KEY (`id_assigned`) REFERENCES `assigned_schedules` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of condonations
-- ----------------------------

-- ----------------------------
-- Table structure for courses
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_discipline` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `id_level` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `date_start` date NULL DEFAULT NULL,
  `date_end` date NULL DEFAULT NULL,
  `cost` int(11) NULL DEFAULT NULL,
  `reference` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_discipline`(`id_discipline`) USING BTREE,
  INDEX `id_level`(`id_level`) USING BTREE,
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `disciplines` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES (1, 'Natacion 13', 1, 1, '2020-09-01', '2020-10-30', 200, '21313141243');
INSERT INTO `courses` VALUES (3, 'Box 1', 2, 3, '2020-09-01', '2020-10-22', 250, '23423432');
INSERT INTO `courses` VALUES (4, 'Box 2', 2, 4, '2020-09-02', '2020-10-28', 350, '321414323');
INSERT INTO `courses` VALUES (5, 'Gimnasia 1', 3, 5, '2020-09-01', '2020-10-29', 200, '3423432424');
INSERT INTO `courses` VALUES (6, 'Clavados 1', 4, 6, '2020-09-01', '2020-10-29', 300, '3454365564');

-- ----------------------------
-- Table structure for data_rows
-- ----------------------------
DROP TABLE IF EXISTS `data_rows`;
CREATE TABLE `data_rows`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `data_rows_data_type_id_foreign`(`data_type_id`) USING BTREE,
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_rows
-- ----------------------------
INSERT INTO `data_rows` VALUES (1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1);
INSERT INTO `data_rows` VALUES (2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2);
INSERT INTO `data_rows` VALUES (3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3);
INSERT INTO `data_rows` VALUES (4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4);
INSERT INTO `data_rows` VALUES (5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5);
INSERT INTO `data_rows` VALUES (6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6);
INSERT INTO `data_rows` VALUES (7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7);
INSERT INTO `data_rows` VALUES (8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8);
INSERT INTO `data_rows` VALUES (9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10);
INSERT INTO `data_rows` VALUES (10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11);
INSERT INTO `data_rows` VALUES (11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12);
INSERT INTO `data_rows` VALUES (12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1);
INSERT INTO `data_rows` VALUES (13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2);
INSERT INTO `data_rows` VALUES (14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3);
INSERT INTO `data_rows` VALUES (15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4);
INSERT INTO `data_rows` VALUES (16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1);
INSERT INTO `data_rows` VALUES (17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2);
INSERT INTO `data_rows` VALUES (18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3);
INSERT INTO `data_rows` VALUES (19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4);
INSERT INTO `data_rows` VALUES (20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5);
INSERT INTO `data_rows` VALUES (21, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9);

-- ----------------------------
-- Table structure for data_types
-- ----------------------------
DROP TABLE IF EXISTS `data_types`;
CREATE TABLE `data_types`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `model_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `policy_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `data_types_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `data_types_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_types
-- ----------------------------
INSERT INTO `data_types` VALUES (1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', '', 1, 0, NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `data_types` VALUES (2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `data_types` VALUES (3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');

-- ----------------------------
-- Table structure for disciplines
-- ----------------------------
DROP TABLE IF EXISTS `disciplines`;
CREATE TABLE `disciplines`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_area` bigint(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_area`(`id_area`) USING BTREE,
  CONSTRAINT `disciplines_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of disciplines
-- ----------------------------
INSERT INTO `disciplines` VALUES (1, 'Natacion', 2);
INSERT INTO `disciplines` VALUES (2, 'Box', 1);
INSERT INTO `disciplines` VALUES (3, 'Gimnasia', 1);
INSERT INTO `disciplines` VALUES (4, 'Clavados', 2);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for instructors
-- ----------------------------
DROP TABLE IF EXISTS `instructors`;
CREATE TABLE `instructors`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of instructors
-- ----------------------------
INSERT INTO `instructors` VALUES (1, 'Pedro', 'pedro@coach.sag', '45784936', '2020-09-18 14:29:53', '2020-11-10 12:30:21');
INSERT INTO `instructors` VALUES (2, 'Mauricio', 'mauricio@coach.sag', '3123758698', '2020-09-18 14:30:14', '2020-09-18 14:30:14');
INSERT INTO `instructors` VALUES (4, 'Laurasss', 'laura@coach.sag', '3245718946', '2020-09-18 14:30:52', '2020-11-22 20:47:12');

-- ----------------------------
-- Table structure for levels
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_discipline` bigint(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_discipline`(`id_discipline`) USING BTREE,
  CONSTRAINT `levels_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `disciplines` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES (1, 'Natacion Basica', 1);
INSERT INTO `levels` VALUES (2, 'Natacion Avanzada', 1);
INSERT INTO `levels` VALUES (3, 'Box Basico', 2);
INSERT INTO `levels` VALUES (4, 'Box Avanzado', 2);
INSERT INTO `levels` VALUES (5, 'Gimnasia Basica', 3);
INSERT INTO `levels` VALUES (6, 'Clavados Basicos', 4);

-- ----------------------------
-- Table structure for menu_items
-- ----------------------------
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `menu_items_menu_id_foreign`(`menu_id`) USING BTREE,
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_items
-- ----------------------------
INSERT INTO `menu_items` VALUES (1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.dashboard', NULL);
INSERT INTO `menu_items` VALUES (2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 5, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.media.index', NULL);
INSERT INTO `menu_items` VALUES (3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 3, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.users.index', NULL);
INSERT INTO `menu_items` VALUES (4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 2, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.roles.index', NULL);
INSERT INTO `menu_items` VALUES (5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 9, '2020-11-18 01:58:19', '2020-11-18 01:58:19', NULL, NULL);
INSERT INTO `menu_items` VALUES (6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 10, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.menus.index', NULL);
INSERT INTO `menu_items` VALUES (7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 11, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.database.index', NULL);
INSERT INTO `menu_items` VALUES (8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 12, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.compass.index', NULL);
INSERT INTO `menu_items` VALUES (9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 13, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.bread.index', NULL);
INSERT INTO `menu_items` VALUES (10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 14, '2020-11-18 01:58:19', '2020-11-18 01:58:19', 'voyager.settings.index', NULL);
INSERT INTO `menu_items` VALUES (11, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 13, '2020-11-18 01:58:30', '2020-11-18 01:58:30', 'voyager.hooks', NULL);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `menus_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'admin', '2020-11-18 01:58:19', '2020-11-18 01:58:19');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_userCDU` bigint(20) NULL DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `expiration_date` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `amount` float NOT NULL,
  `id_assigned` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_userCDU`(`id_userCDU`) USING BTREE,
  INDEX `id_assigned`(`id_assigned`) USING BTREE,
  CONSTRAINT `id_assigned` FOREIGN KEY (`id_assigned`) REFERENCES `assigned_schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`id_userCDU`) REFERENCES `users_cdu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES (1, 2, '21313141243', 'pago noviembre 4', '2020-11-28 17:40:26', '2020-11-28 17:40:26', '2020-11-29 17:47:21', 400, 6);

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_permission_id_index`(`permission_id`) USING BTREE,
  INDEX `permission_role_role_id_index`(`role_id`) USING BTREE,
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES (1, 1);
INSERT INTO `permission_role` VALUES (1, 2);
INSERT INTO `permission_role` VALUES (2, 1);
INSERT INTO `permission_role` VALUES (3, 1);
INSERT INTO `permission_role` VALUES (4, 1);
INSERT INTO `permission_role` VALUES (5, 1);
INSERT INTO `permission_role` VALUES (6, 1);
INSERT INTO `permission_role` VALUES (7, 1);
INSERT INTO `permission_role` VALUES (8, 1);
INSERT INTO `permission_role` VALUES (9, 1);
INSERT INTO `permission_role` VALUES (10, 1);
INSERT INTO `permission_role` VALUES (11, 1);
INSERT INTO `permission_role` VALUES (12, 1);
INSERT INTO `permission_role` VALUES (13, 1);
INSERT INTO `permission_role` VALUES (14, 1);
INSERT INTO `permission_role` VALUES (15, 1);
INSERT INTO `permission_role` VALUES (16, 1);
INSERT INTO `permission_role` VALUES (16, 2);
INSERT INTO `permission_role` VALUES (17, 1);
INSERT INTO `permission_role` VALUES (17, 2);
INSERT INTO `permission_role` VALUES (18, 1);
INSERT INTO `permission_role` VALUES (18, 2);
INSERT INTO `permission_role` VALUES (19, 1);
INSERT INTO `permission_role` VALUES (19, 2);
INSERT INTO `permission_role` VALUES (20, 1);
INSERT INTO `permission_role` VALUES (21, 1);
INSERT INTO `permission_role` VALUES (22, 1);
INSERT INTO `permission_role` VALUES (23, 1);
INSERT INTO `permission_role` VALUES (24, 1);
INSERT INTO `permission_role` VALUES (25, 1);
INSERT INTO `permission_role` VALUES (26, 1);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `permissions_key_index`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'browse_admin', NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (2, 'browse_bread', NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (3, 'browse_database', NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (4, 'browse_media', NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (5, 'browse_compass', NULL, '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (6, 'browse_menus', 'menus', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (7, 'read_menus', 'menus', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (8, 'edit_menus', 'menus', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (9, 'add_menus', 'menus', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (10, 'delete_menus', 'menus', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (11, 'browse_roles', 'roles', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (12, 'read_roles', 'roles', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (13, 'edit_roles', 'roles', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (14, 'add_roles', 'roles', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (15, 'delete_roles', 'roles', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (16, 'browse_users', 'users', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (17, 'read_users', 'users', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (18, 'edit_users', 'users', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (19, 'add_users', 'users', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (20, 'delete_users', 'users', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (21, 'browse_settings', 'settings', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (22, 'read_settings', 'settings', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (23, 'edit_settings', 'settings', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (24, 'add_settings', 'settings', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (25, 'delete_settings', 'settings', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `permissions` VALUES (26, 'browse_hooks', NULL, '2020-11-18 01:58:30', '2020-11-18 01:58:30');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'Administrator', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `roles` VALUES (2, 'user', 'Normal User', '2020-11-18 01:58:19', '2020-11-18 01:58:19');
INSERT INTO `roles` VALUES (3, 'usercdu', 'UsuarioCDU', '2020-11-19 17:48:19', '2020-11-19 17:48:37');

-- ----------------------------
-- Table structure for schedules
-- ----------------------------
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_course` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `id_instructor` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `m` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `t` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `w` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `r` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `f` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `capacity` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_course`(`id_course`) USING BTREE,
  INDEX `id_instructor`(`id_instructor`) USING BTREE,
  CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of schedules
-- ----------------------------
INSERT INTO `schedules` VALUES (1, 3, 2, '07:00-08:00', NULL, '07:00-08:00', NULL, '07:00-08:00', NULL, 30);
INSERT INTO `schedules` VALUES (2, 4, 2, NULL, '07:00-09:00', NULL, '07:00-09:00', NULL, NULL, 40);
INSERT INTO `schedules` VALUES (3, 6, 1, '13:00-15:00', NULL, '13:00-15:00', NULL, NULL, NULL, 25);
INSERT INTO `schedules` VALUES (4, 5, 4, NULL, NULL, '09:00-11:00', NULL, '09:00-11:00', NULL, 25);
INSERT INTO `schedules` VALUES (5, 1, 1, '13:00-15:00', NULL, '13:00-15:00', NULL, NULL, NULL, 25);

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `settings_key_unique`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site');
INSERT INTO `settings` VALUES (2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site');
INSERT INTO `settings` VALUES (3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site');
INSERT INTO `settings` VALUES (4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', '', '', 'text', 4, 'Site');
INSERT INTO `settings` VALUES (5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin');
INSERT INTO `settings` VALUES (6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin');
INSERT INTO `settings` VALUES (7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin');
INSERT INTO `settings` VALUES (8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin');
INSERT INTO `settings` VALUES (9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin');
INSERT INTO `settings` VALUES (10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '', '', 'text', 1, 'Admin');

-- ----------------------------
-- Table structure for translations
-- ----------------------------
DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `translations_table_name_column_name_foreign_key_locale_unique`(`table_name`, `column_name`, `foreign_key`, `locale`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of translations
-- ----------------------------

-- ----------------------------
-- Table structure for turnstiles
-- ----------------------------
DROP TABLE IF EXISTS `turnstiles`;
CREATE TABLE `turnstiles`  (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `port` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `controller` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of turnstiles
-- ----------------------------

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles`  (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`) USING BTREE,
  INDEX `user_roles_user_id_index`(`user_id`) USING BTREE,
  INDEX `user_roles_role_id_index`(`role_id`) USING BTREE,
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_roles
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'users/default.png',
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `settings` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, NULL, 'ZEUS', 'zeusrene@live.com.mx', 'users/default.png', NULL, '$2y$10$vFB2iM4n8wuMr1mZkyiAD.pdoK3pDgH7EHp6gN0pd1w.nqBT.w5J2', NULL, NULL, '2020-09-18 18:58:27', '2020-09-18 18:58:27');
INSERT INTO `users` VALUES (2, 3, 'Zeus Rene Pallares Avina', 'zeus.pallares@hotmail.com', 'users/default.png', NULL, '$2y$10$.I3GnimoVCBOQEbYfIy4Buii6RpTPkp/zIREzhDS2Y8iQ6UcYwDO6', NULL, '{\"locale\":\"en\"}', '2020-09-18 19:18:06', '2020-11-22 18:22:35');
INSERT INTO `users` VALUES (3, 2, 'Ana Atenea Pallares Avina', 'ana.pallares@hotmail.com', 'users/default.png', NULL, '$2y$10$V2T8OxfKqqF7gOXcSFCM7OKjF4qstQgrb3Cyj/K8p8Z3e7O03h9ES', NULL, '{\"locale\":\"en\"}', '2020-09-18 19:18:44', '2020-11-18 02:27:26');
INSERT INTO `users` VALUES (4, 1, 'Luis Cortes', 'luis@hotmail.com', 'users/default.png', NULL, '$2y$10$XN9yb9LP8M5NNTIaDFZ7Eun8ZyksFa1oNvoDU3UTmDkQqJfVDq21O', NULL, '{\"locale\":\"en\"}', '2020-09-18 19:19:14', '2020-11-18 02:09:07');
INSERT INTO `users` VALUES (5, 2, 'Juan Perez', 'juan@hotmail.com', 'users/default.png', NULL, '$2y$10$vf9x5L1lIX5F.fgFk5Oa3O93ZgU75RO7ySjiEVTDlVHCll9vmSC1i', NULL, '{\"locale\":\"en\"}', '2020-09-18 19:20:45', '2020-11-18 02:37:45');
INSERT INTO `users` VALUES (6, 2, 'Beatriz Solano', 'betty@hotmail.com', 'users/default.png', NULL, '$2y$10$kiKOneVje8FKok5JYKEP0udgGla0Fz.k2F89nzgUIQbo7UuVEnTTq', NULL, '{\"locale\":\"en\"}', '2020-09-18 19:21:17', '2020-11-18 02:37:35');
INSERT INTO `users` VALUES (9, 1, 'Oscar Lopez', 'oscar@voyager.com', 'users/November2020/ENoP5912M3yL0B7zu08c.png', NULL, '$2y$10$CF8FaZWyebXPOoPQBz/dA.wgQTIPdNQHco9x9enpwDrSwyd1CbCau', NULL, '{\"locale\":\"en\"}', '2020-11-18 02:05:50', '2020-11-18 02:47:15');
INSERT INTO `users` VALUES (12, 2, 'Nuevo usuario', 'newusario@mail.com', 'users/November2020/hBYmLS6i5ocFrsAJQwOo.jpeg', NULL, '$2y$10$9ce99.u4SvB/vpk1cIV7j.XjIEb516zwUmHWGT93RELbpyGbklvzS', NULL, '{\"locale\":\"en\"}', '2020-11-18 02:48:13', '2020-11-18 02:48:13');
INSERT INTO `users` VALUES (13, 2, 'Nuevo user', 'nuevo@gmail.com', 'users/default.png', NULL, '$2y$10$arduitDa.Wc0fqJcCxJ0Wey1jiRjTkZDVkMvOriCy5Jydxl1zWymy', NULL, NULL, '2020-11-19 17:37:39', '2020-11-19 17:37:39');
INSERT INTO `users` VALUES (14, 3, 'NuevoUsuario', 'nuevo@usuario.com', 'users/default.png', NULL, '$2y$10$d.qWN8zqoCe6sHDAl3VizOujGK3TvSbQzloeKfL10OPAAxYvd0Bm2', NULL, NULL, '2020-11-19 17:42:43', '2020-11-19 17:42:43');
INSERT INTO `users` VALUES (15, 3, 'Isaac', 'isaac@mail.com', 'users/default.png', NULL, '$2y$10$d2fUhKzSeLFZ.iCyQkQRv.t4Nq7yBKbcHEJFdMPJIaUTdNpV9ogsK', NULL, NULL, '2020-11-28 17:42:09', '2020-11-28 17:42:09');

-- ----------------------------
-- Table structure for users_cdu
-- ----------------------------
DROP TABLE IF EXISTS `users_cdu`;
CREATE TABLE `users_cdu`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pic` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  `amount` float NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id_index`(`user_id`) USING BTREE,
  CONSTRAINT `users_cdu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users_cdu
-- ----------------------------
INSERT INTO `users_cdu` VALUES (1, 'Zeus Rene Pallares Avina', NULL, '34234234234', 'zeus.pallares@hotmail.com', NULL, 1, 0, 2);
INSERT INTO `users_cdu` VALUES (2, 'Ana Atenea Pallares Avina', NULL, '12341432143', 'ana.pallares@hotmail.com', NULL, 1, 0, 3);
INSERT INTO `users_cdu` VALUES (3, 'Luis Cortes', 'Ep9qDPHhvKj9zVOI9yp4yVYLWU6vje0uY49k7lcQ.png', '21431231', 'luis@hotmail.com', NULL, 1, 0, 4);
INSERT INTO `users_cdu` VALUES (4, 'Juan Perez', NULL, '45234524523', 'juan@hotmail.com', NULL, 1, 0, 5);
INSERT INTO `users_cdu` VALUES (5, 'Beatriz Solano', NULL, '12341234', 'betty@hotmail.com', NULL, 1, 0, 6);
INSERT INTO `users_cdu` VALUES (6, 'NuevoUsuario', NULL, '2132323232', 'nuevo@usuario.com', '12132211333', 1, 0, 14);
INSERT INTO `users_cdu` VALUES (7, 'Isaac', 'MPR9H9ff6d2cgVZvZjOG7liK8sWGhYV41vX0tHFB.png', '212232112312', 'isaac@mail.com', '3232231221', 1, 0, 15);

SET FOREIGN_KEY_CHECKS = 1;
