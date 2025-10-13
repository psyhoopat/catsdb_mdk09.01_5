<?php

require_once __DIR__ . "/../lib/mysqli.php";

try {
    $mysql = db_connect();

    $sql = "CREATE TABLE IF NOT EXISTS `species_cat` (
              `id` int NOT NULL AUTO_INCREMENT,
              `name` varchar(45) NOT NULL,
              `description` longtext NOT NULL,
              `img` varchar(200) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id_UNIQUE` (`id`),
              UNIQUE KEY `name_UNIQUE` (`name`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
    $mysql->query($sql);

    $result = $mysql->query("SELECT * FROM `species_cat`");
    if($result->num_rows == 0) {
        // seed data
        $sql = "INSERT INTO `species_cat` (`id`, `name`, `description`, `img`) VALUES 
               (1,'Длинношёрстные','Считается, что длинношерстные кошки появились в теплых странах в результате случайных мутаций и близкородственного скрещивания. Первые кошки с длинной шерстью были завезены в Европу в 16 веке из Малой Азии. Итальянский путешественник, который доставил пушистых красавиц в Италию, подарил несколько животных папе римскому. Вскоре персы попали во Францию, где им удалось покорить сердца аристократов и самого кардинала Ришелье.','/static/img/dlinn.jpg'),
               (2,'Полудлинношерстные','Полудлинношерстные кошки завоевали сердца людей уже давно. Их существует великое множество, разных окрасов и темпераментов, но все они обладают великолепной мягкой шерстью. Представители полудлинношерстных пород асковы и пушисты, и хлопот с ними тоже достаточно, хоть, разумеется, меньше, чем с длинношерстными. ','/static/img/poludlinn.jpg'),
               (3,'Короткошёрстные','Короткошерстные породы кошек являются наиболее предпочтительным вариантом для семей с маленькими детьми, занятых людей, не имеющих возможности тратить время на ежедневное тщательное вычесывание, а также для тех, кому приглянулись представители одного из красивейших представителей короткошерстного братства.','/static/img/korotko.jpg');";
        $mysql->query($sql);
    }

    $sql = "CREATE TABLE IF NOT EXISTS `info_cat` (
              `id` int NOT NULL AUTO_INCREMENT,
              `gender` varchar(45) NOT NULL,
              `place` varchar(100) NOT NULL,
              `date` datetime NOT NULL,
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

    $mysql->close();

    printf("Миграция таблиц успешна!");
} catch (Exception $ex) {
    printf("Mysql error: %s\n", $ex->getMessage());
    exit;
}