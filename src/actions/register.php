<?php
require_once __DIR__ . '/../helpers.php';

$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
$user = findUser($login);
if (empty($login)) {
    setValidationError('login', 'Неверный логин');
}
if (mb_strlen($login) < 8) {
    setValidationError('login', 'Логин должен быть больше 8 символов');
}


if ($user) {
    setValidationError('login', "Неверный логин пользователь $login уже существует");
}

if (empty($password)) {
    setValidationError('password', 'Пароль пустой');
}
if (mb_strlen($password) < 8) {
    setValidationError('password', 'Пароль должен быть больше 8 символов');
}
if (!preg_match('/[A-Z]/', $password) && preg_match('/\d/', $password) !== 1) {
    setValidationError('password', 'Пароль должен содержать минимум 1 букву заглавную и 1 цифру');
}

  if (!empty($_SESSION['validation'])) {
      setOldValue('login', $login);
      redirect('/register.php');
  }
$pass = password_hash($password, PASSWORD_DEFAULT);
$pdo = getPDO();

$query =  "INSERT INTO `users` (`login`,`password`) VALUES('$login','$pass')";


$stmt = $pdo->prepare($query);
//   $stmt->execute($params);
  try {
      $stmt->execute();
  } catch (\Exception $e) {
      die($e->getMessage());
  }
// if($stmt->rowCount() > 0) {
//     // запрос удался
//     echo("asd");
// } else {
//     echo("asdsas");
//     // запрос по каким-то причинам не выполнен
// }
 redirect('/');
?>