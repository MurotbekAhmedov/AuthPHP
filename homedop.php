<?php
require_once __DIR__ . '/src/helpers.php';

checkAuth();

$user = currentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Document</title>
</head>
<body>
   <div class="form__block form-doc">
   <h1>Создать документ</h1>
    <form  action="src/actions/docsdop.php" method="post" enctype="multipart/form-data">

        <label for="name">Имя</label>
            <input type="text"
            id="name"
            name="name">
            <label for="surename">Фамилия</label>
            <input type="text"
            id="surename"
            name="surename">
            <label for="patronymic">Отчество</label>
            <input type="text"
            id="patronymic"
            name="patronymic">
            <label for="datebirth">Дата рождения</label>
            <input type="date" id="datebirth" name="datebirth" value="2000-01-01" />
            <button type="submit" id="submit">Создать</button>

        </form>
   </div>
</body>
</html>