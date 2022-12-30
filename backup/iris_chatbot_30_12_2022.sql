/*
 Navicat Premium Data Transfer

 Source Server         : MSQL8
 Source Server Type    : MySQL
 Source Server Version : 80028 (8.0.28)
 Source Host           : localhost:3306
 Source Schema         : iris_chatbot

 Target Server Type    : MySQL
 Target Server Version : 80028 (8.0.28)
 File Encoding         : 65001

 Date: 30/12/2022 13:00:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ai_intents
-- ----------------------------
DROP TABLE IF EXISTS `ai_intents`;
CREATE TABLE `ai_intents`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `static` tinyint(1) NOT NULL DEFAULT 0,
  `project_id` int NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ai_intents
-- ----------------------------
INSERT INTO `ai_intents` VALUES (1, 'chaohoi', 'mo ta', 0, 1, NULL, NULL);
INSERT INTO `ai_intents` VALUES (2, 'hoitienhocphi', 'hoi tien', 0, 1, NULL, NULL);

-- ----------------------------
-- Table structure for ai_patterns
-- ----------------------------
DROP TABLE IF EXISTS `ai_patterns`;
CREATE TABLE `ai_patterns`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pattern` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `intent_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ai_patterns
-- ----------------------------
INSERT INTO `ai_patterns` VALUES (1, 'Chào shop', 1, 'mt 1', NULL, NULL);
INSERT INTO `ai_patterns` VALUES (2, 'Rất vui khi đc chào shop', 1, 'mt2', NULL, NULL);
INSERT INTO `ai_patterns` VALUES (3, 'À nhon na xê ô', 1, 'mt 3', NULL, NULL);

-- ----------------------------
-- Table structure for ai_responses
-- ----------------------------
DROP TABLE IF EXISTS `ai_responses`;
CREATE TABLE `ai_responses`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `intent_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ai_responses
-- ----------------------------
INSERT INTO `ai_responses` VALUES (1, 'Chào bạn', 1, 'Mo ta', NULL, NULL);

-- ----------------------------
-- Table structure for facebook_implement
-- ----------------------------
DROP TABLE IF EXISTS `facebook_implement`;
CREATE TABLE `facebook_implement`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `integration_id` int NULL DEFAULT NULL,
  `verify_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of facebook_implement
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for integrations
-- ----------------------------
DROP TABLE IF EXISTS `integrations`;
CREATE TABLE `integrations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int NULL DEFAULT NULL,
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of integrations
-- ----------------------------

-- ----------------------------
-- Table structure for messenger_implement
-- ----------------------------
DROP TABLE IF EXISTS `messenger_implement`;
CREATE TABLE `messenger_implement`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `integration_id` int NULL DEFAULT NULL,
  `access_token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of messenger_implement
-- ----------------------------
INSERT INTO `messenger_implement` VALUES (1, 222, 'EAAPZC2PLJZBagBAJWraQFK1TSAZAGzLalVo5UM3GbaQmNaTfZB9CPe0lsVRPsQ2sDPETjZBIkjpQ7tHYCjBiYlxqxQgZBu0USnMHnrB3LMwsDuo9QpiQZCY3xZCbpIpRJAbPnl6whLZCRUV9Degd8jmzXMHxhHGOfqizEUZC7vFEF5djoaMGSOLWoX', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (2, 222, 'EAAPZC2PLJZBagBANzjmH8YxDopZCZCZBpxTxk4LszNGi902FO3kLAuPcgR0qFGIkG1I1hJbZC7caOYmZAf1a9YLLQQ1BBWZAHTp8ZAMtQBAIS7llXeyybvjQB5d9QZCZAwxkX8fLgsOUDtEd6gFNK9vphpMfQv5Fs8MgrqC1tXZB6L5Er7M7wsdTrVKS', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (3, 222, 'EAAPZC2PLJZBagBAJvYzs6DiUFSazNtZCwuvmouF0soRF4vZA0iWwnX5o34W8eS0gghNYZA2wx46pxSR5vYOpizgpBRC70dGacZBPtaIVAZAPCROdG28w0nVBVsbOcRvV01UOu6ppa4z4c5SeZATNvCDMUaPyOA1LDZBZCb6eZBAaJrDucsGwFZB0ABQX', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (4, 222, 'EAAPZC2PLJZBagBAF9ImvOgVRRcCMdZCsKUVEklJPGJtxLkRv3WeUb0zTfcZBVMzqU9O345ZCleLY205ZBeFiDgT09AqZBmstVYBBeHKm2uqFb10agmUTP7yCmcANq5FfG29VqHTrbFq8aigXIXbLzb04DveLPu9VNHfyZBvZB4FAeDWp1fTiejVYx', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (5, 222, 'EAAPZC2PLJZBagBALQAR4iq7Nmazv4ZB81BrgjZCy1V3nq1ZCvpZAH5RGjDceHAEuuiy4Jv0na4wLOo1vqxuC7R5yIn1ZAOD9vZA8ZAgWdmujkDShGLbJ1LFZA759ghBEExVPnDgXBa1LQa49sCxhecx35ZCfnhLUyZCtif6lZCg2P79ZC9L6XSy0Tmo0WI', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (6, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (7, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (8, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (9, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (10, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (11, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (12, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (13, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (14, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (15, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (16, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (17, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (18, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (19, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (20, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (21, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (22, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (23, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (24, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (25, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (26, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (27, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (28, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (29, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (30, 222, 'EAAPZC2PLJZBagBAN6TlIjrNhCaVvmulnkMDNqAx4nATKRDHo8vghAgnvEqKN5rTGMOgFEGCujrBC04HRNoNZBgZC1kXfHFkZAL0spjRe6H8ReAVWfZC1Af2eM5PkRAZCDIkKkiyHZA91iTK0vYIWyJCOVs3vYBIO6Y7R7WqOndTd5bx79Cqc2VH15vATSuib70NZBDfnXdxbEYgbrsFyu3wS9', '100987825013465', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (31, 222, 'EAAPZC2PLJZBagBAGHgdcB83aKqXTmVoEbrCbw4WO95ufAK3XgDIWDuWmUn8zSrfp7CEHfHoRx2FjSsVTtyiV1w2byu4E0BcZASsqZAzdUznxCpJ3GMCbJh5Vf0gRP7ZBTCC3ApisZBmqBTpLuGbbPhiKhATpG0iVVNBAhZCL55VaBxZC7N9O0RYGm0yjdzsZB23LI9ZAcpdy8oAHdZArHzaBCbi', '103570608136962', '2007855372753250', NULL, NULL);
INSERT INTO `messenger_implement` VALUES (32, 222, 'EAAPZC2PLJZBagBAJdKpYZBKvjr28Rwa1SI4pnje6X1Ee7LjeUJJZCitjrv4ZBmzHRhvkZCsLbFHZApWxIMYD1mZBJTO80gqxwwWV9CZBbjquFhX45s0OT9ppejHjgAiKmVAfdNsgx0C1y7nuvZBQDiCSUl6fIVeV3bJK3VcfxDZAK1FPzoQKZAsQtPyGS92w2XO7iBXVZBHczfrZBwN2CSmIwldKlT', '996032807143533', '2007855372753250', NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (7, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (8, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (9, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (10, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (20, '2022_11_18_103155_create_ai_tables', 2);
INSERT INTO `migrations` VALUES (21, '2022_11_18_105312_project_table_create', 2);
INSERT INTO `migrations` VALUES (22, '2022_11_29_073014_add_intergration_table', 2);
INSERT INTO `migrations` VALUES (23, '2022_11_29_081500_add_facebook_intergration_tale', 2);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (1, 1, 'Project 1 edit', 'hehe boiz', 1, NULL, '2022-12-02 06:12:14');
INSERT INTO `projects` VALUES (2, 1, 'Project 2', NULL, 1, NULL, NULL);
INSERT INTO `projects` VALUES (3, 1, '1111', '22222', 0, '2022-12-02 04:17:30', '2022-12-02 04:17:30');
INSERT INTO `projects` VALUES (4, 1, 'heheheh', 'boiz', 1, '2022-12-02 04:18:42', '2022-12-02 04:18:42');
INSERT INTO `projects` VALUES (5, 1, 'Đỉnh của chóp project', 'Hehe boiz', 1, '2022-12-02 04:20:32', '2022-12-02 04:20:32');
INSERT INTO `projects` VALUES (6, 1, '111', NULL, 1, '2022-12-02 04:25:37', '2022-12-02 04:25:37');
INSERT INTO `projects` VALUES (7, 1, '1111111111', '22222222222222', 1, '2022-12-02 04:33:36', '2022-12-02 04:33:36');
INSERT INTO `projects` VALUES (8, 1, '1111', NULL, 1, '2022-12-02 04:38:43', '2022-12-02 04:38:43');
INSERT INTO `projects` VALUES (9, 1, 'Project 1 11111111111', NULL, 1, '2022-12-02 06:02:47', '2022-12-02 06:02:47');
INSERT INTO `projects` VALUES (10, 1, 'Project đỉnh của đỉnh', NULL, 1, '2022-12-02 06:03:00', '2022-12-02 06:03:00');
INSERT INTO `projects` VALUES (11, 1, 'Project đỉnh của đỉnh', 'Hahaa', 1, '2022-12-02 06:07:42', '2022-12-02 06:07:42');
INSERT INTO `projects` VALUES (12, 1, 'Project đỉnh của đỉnh haha 11111', 'Hahaa', 1, '2022-12-02 06:07:52', '2022-12-02 06:12:24');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Thanh Do', 'ngocthanh909', 'thanhstp99@gmail.com', 'Faker Address', NULL, '2022-11-17 22:00:58', '$2y$10$pixadWfKJqjT6SK3.aQzZeEhgOWEWvLiP5n9i8mq0VvCRcYeFEo9W', 'SjamfOUmFAY3IhgYFkIVjCsmTNVVKVNAj9Y7cePFajUNG2yWhujytWxBGoxe', '2022-11-18 22:01:08', '2022-11-18 22:01:13');

SET FOREIGN_KEY_CHECKS = 1;
