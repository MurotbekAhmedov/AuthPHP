<?php
session_start();

require_once __DIR__ . '/config.php';

function redirect(string $path)
{
    header("Location: $path");
    die();
}
function setValidationError(string $fieldName, string $message)
{
    $_SESSION['validation'][$fieldName] = $message;
}

function hasValidationError(string $fieldName)
{
    return isset($_SESSION['validation'][$fieldName]);
}

function validationErrorAttr(string $fieldName)
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function validationErrorMessage(string $fieldName)
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}

function setOldValue($key, $value)
{
    $_SESSION['old'][$key] = $value;
}

function old(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}
function setMessage(string $key, string $message)
{
    $_SESSION['message'][$key] = $message;
}

function hasMessage(string $key)
{
    return isset($_SESSION['message'][$key]);
}

function getMessage(string $key)
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function getPDO()
{
    try {
        return new \PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';charset=utf8;dbname='.DB_NAME,DB_USERNAME,DB_PASSWORD);
    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}

function findUser(string $login)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->execute(['login' => $login]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}


function currentUser()
{
    $pdo = getPDO();

    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function logout()
{
    unset($_SESSION['user']['id']);
    redirect('/');
}

function checkAuth()
{
    if (!isset($_SESSION['user']['id'])) {
        redirect('/');
    }
}

function checkGuest()
{
    if (isset($_SESSION['user']['id'])) {
        redirect('/home.php');
    }
}
function saveCoockie($name,$value){
    setcookie("userPHPsave[$name]", $value,time()+60*60*24, "/",$_SERVER['SERVER_NAME']);
}

?>