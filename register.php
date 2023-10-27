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
    <h1>Регистрация</h1>
    <form action="src/actions/register.php" method="post" enctype="multipart/form-data">
        <label for="login">Логин</label>
            <input type="text"
            id="login"
            name="login"
            value="<?php echo old('login') ?>"
            <?php echo validationErrorAttr('login'); ?>>
            <?php if(hasValidationError('login')): ?>
            <span class="span"><?php echo validationErrorMessage('login'); ?></span>
        <?php endif; ?>

            <label for="password">Пароль</label>
            <input type="password"
            id="password"
            name="password">
            <?php if(hasValidationError('password')): ?>
            <span class="span"><?php echo validationErrorMessage('password'); ?></span>
        <?php endif; ?>

            <button type="submit">Регистрация</button>

        </form>
        <p><a href="/index.php">Авторизация</a></p>
   </div>
</body>
</html>