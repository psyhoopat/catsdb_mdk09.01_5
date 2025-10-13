<?php

require_once "lib/mysqli.php";

$result = get_info_cat();

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
<?php include_once "templates/header.php"; ?>
<main>
    <?php if ($result->num_rows > 0): ?>
        <h1 align="center">Найденные котики</h1>
        <table border="1" cellpadding="3" width="1280px" align="center" style="margin-top: 30px;">
            <thead>
                <tr>
                    <?php while ($row = $result->fetch_field()): ?>
                        <th><?= $row->name ?></th>
                    <?php endwhile; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_row()): ?>
                    <tr>
                        <?php foreach ($row as $key => $value): ?>
                            <td><?= $value ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif ($result->num_rows == 0): ?>
        <div>
            <h1>Таблица пуста</h1>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
