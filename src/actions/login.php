<?php

require_once __DIR__ . '/../helpers.php';

$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
$saveform = $_POST['saveform'] ?? null;

if (empty($login) || !filter_var($login)) {
    setOldValue('login', $login);
    setValidationError('login', 'Неверный формат логина');
    setMessage('error', 'Ошибка валидации');
    redirect('/');
}
if (!empty($saveform)) {
    saveCoockie('login',$login);
    saveCoockie('password',$password);
}
$user = findUser($login);

if (!$user) {
    setMessage('error', "Пользователь $login не найден");
    redirect('/');
}

if (!password_verify($password, $user['password'])) {
    setMessage('error', 'Неверный пароль');
    redirect('/');
}

$_SESSION['user']['id'] = $user['id'];

  redirect('/home.php');