<?php

require_once __DIR__ . "/../lib/mysqli.php";

try {
    $mysql = db_connect();

    $sql = "CREATE TABLE IF NOT EXISTS `info_cat` (
              `id` int NOT NULL AUTO_INCREMENT,
              `gender` varchar(45) NOT NULL,
              `place` varchar(100) NOT NULL,
              `age` int unsigned NOT NULL,
              `description` longtext NOT NULL,
              `contact` varchar(100) NOT NULL,
              `coordinates` varchar(45) NOT NULL,
              `info` longtext NOT NULL,
              `id_species` int NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id_UNIQUE` (`id`),
              KEY `specie_cat_idx` (`id_species`),
              CONSTRAINT `specie_cat` FOREIGN KEY (`id_species`) REFERENCES `species_cat` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
    $mysql->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS `species_cat` (
              `id` int NOT NULL AUTO_INCREMENT,
              `name` varchar(45) NOT NULL,
              `description` longtext NOT NULL,
              `img` varchar(200) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id_UNIQUE` (`id`),
              UNIQUE KEY `name_UNIQUE` (`name`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
    $result = $mysql->query($sql);

    $mysql->close();

    printf("Миграция таблиц успешна!");
} catch (Exception $ex) {
    printf("Mysql error: %s\n", $ex->getMessage());
    exit;
}