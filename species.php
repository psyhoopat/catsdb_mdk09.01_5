<?php

require_once "lib/mysqli.php";

$result = get_species_cat();

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/static/styles.css">
</head>
<body>
<?php include_once("templates/header.php"); ?>
<main>
    <div>
        <?php if ($result->num_rows > 0): ?>
            <table border="1" width="100%">
                <thead>
                <tr>
                    <th>Вид породы</th>
                    <th>Описание</th>
                    <th>Фото</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['name']?></td>
                        <td><?= $row['description']?></td>
                        <td><img src="<?= $row['img']?>" alt="img"></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif ($result->num_rows == 0): ?>
            <h1>Данные отсуствуют</h1>
        <?php endif; ?>
    </div>
</main>
</body>
</html>