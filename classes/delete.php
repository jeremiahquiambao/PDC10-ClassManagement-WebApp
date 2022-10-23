<?php

include "../init.php";
use Models\TheClass;

$id = $_GET['id']??null;

try {
    if(isset($_GET['id'])){
        $class = new TheClass('', '', '', '');
        $class->setConnection($connection);
        $class->getById($id);
        $class->deleteClass();
        echo "<script>window.location.href='index.php?success=3';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}