<?php
// Load library
require_once 'libdocs.php';

$name = $_POST['name'];
$surename = $_POST['surename'];
$patronymic = $_POST['patronymic'] ;
$datebirth = $_POST['datebirth'] ;
// Initialize class
$htd = new HTML_TO_DOC();
$filename= 'download.doc';

$htmlContent = "
    <p> $name - key1</p>
    <p> $surename - key2</p>
    <p> $patronymic - key3</p>
    <p> $datebirth - key4</p>";
    // $htd->createDoc($htmlContent, "my-document");
    // $htd->createDoc($htmlContent, "my-document", 1);
    $wordDoc = $htd->createDoc($htmlContent, "download");
    if ($wordDoc) {
        echo 'Word document created succesfully';
    }else{
        echo 'Word document failed';
    }
    // Имя скачиваемого файла
$file = "download.doc";

// Контент-тип означающий скачивание
header("Content-Type: application/octet-stream");

// Размер в байтах
header("Accept-Ranges: bytes");

// Размер файла
header("Content-Length: ".filesize($file));

// Расположение скачиваемого файла
header("Content-Disposition: attachment; filename=".$file);

// Прочитать файл
readfile($file);
unlink('download.doc')
    // $htd->createDoc($htmlContent, "my-document.docx");
?>