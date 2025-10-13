<?php

require_once "lib/mysqli.php";
require_once "lib/setting.php";

$url = $_SESSION['server_url']."form.php";

$result = get_species_cat();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = $_POST["gender"];
    $date = $_POST["date"];
    $id_species = $_POST["specie"];
    $place = $_POST["place"];
    $age = $_POST["age"];
    $contact = $_POST["contact"];
    $coordinates = $_POST["coordinates"];
    $description = $_POST["description"];
    $info = $_POST["info"];

    create_post_cat($gender, $place, $date, $age, $description, $contact, $coordinates, $info, $id_species);
    $_SESSION['success'] = 'Успешно!';

    header("Location: $url");
    exit;
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма добавления</title>
    <link rel="stylesheet" href="/static/styles.css">
</head>
<body>
<?php include_once("templates/header.php"); ?>
<main>

    <div class="error">
        <?php echo !empty($_SESSION['error']) ? $_SESSION['error'] : '';?>
    </div>
    <div class="success">
        <?php echo !empty($_SESSION['success']) ? $_SESSION['success'] : ''; ?>
    </div>
    <form action="<?= $url ?>" method="POST">
        <h1>Форма добавления</h1>
        <div class="form-row-radio">
            <label for="man">Кот</label>
            <input id="man" class="right-radio" name="gender" type="radio" value="Кот">
        </div>
        <div class="form-row-radio">
            <label for="women">Кошка</label>
            <input id="women" class="right-radio" name="gender" type="radio" value="Кошка">
        </div>
        <div>
            <label for="species">Вид породы</label>
            <select class="input" name="specie" id="species">
                <option value="">--select--</option>
                <?php foreach ($result as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="date">Дата нахождения</label>
            <input id="date" class="input" name="date" type="date" placeholder="Дата" required/>
        </div>
        <div>
            <label for="place">Наденое местоположение</label>
            <input id="place" class="input" name="place" type="text" placeholder="Местоположение" required/>
        </div>
        <div>
            <label for="place">Координаты нашедшего</label>
            <input id="place" class="input" name="coordinates" type="text" placeholder="Координаты" required/>
        </div>
        <div>
            <label for="age">Возраст</label>
            <input id="age" class="input" name="age" min="0" max="50" type="number" placeholder="Возраст" required/>
        </div>
        <div>
            <label for="contact">Контакты</label>
            <input id="contact" class="input" name="contact" type="tel" placeholder="+7 999 999 99 99" required/>
        </div>
        <div>
            <label for="description">Описание</label>
            <textarea name="description" class="input" id="description" cols="30" rows="10" placeholder="Описание" required></textarea>
        </div>
        <div>
            <label for="info">Доп. описание</label>
            <textarea name="info" class="input" id="info" cols="30" rows="10" placeholder="Доп описание" required></textarea>
        </div>
        <button type="submit">Отправить</button>
        <button type="reset">Сбросить</button>
    </form>

</main>
</body>
</html>

<?php unset($_SESSION['error']); unset($_SESSION['success']); ?>