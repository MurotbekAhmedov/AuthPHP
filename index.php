<?php
require_once __DIR__ . '/src/helpers.php';

checkGuest();
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
   <div class="form__block">
    <h1>Авторизация</h1>
    <form  action="src/actions/login.php" method="post">
    <?php if(hasMessage('error')): ?>
        <div class="error"><?php echo getMessage('error') ?></div>
    <?php endif; ?>

        <label for="login">Логин</label>
            <input type="text"
            id="login"
            name="login"
            value="<?php echo $_COOKIE["userPHPsave"]["login"] ?? null ?>">
            <?php if(hasValidationError('email')): ?>
            <span class="span"><?php echo validationErrorMessage('email'); ?></span>
        <?php endif; ?>
            <label for="password">Пароль</label>
            <input type="password"
            id="password"
            name="password"
            value="<?php echo $_COOKIE["userPHPsave"]["password"] ?? null ?>">
            >
            <div class="saveform_box">
        <label for="saveform">Запомнить меня</label>
            <input type="checkbox"
            id="saveform"
            name="saveform">
            </div>
            <button type="submit" id="submit">Войти</button>

        </form>
        <p>У меня еще нет <a href="/register.php">аккаунта</a></p>
   </div>
</body>
</html>