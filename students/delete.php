<?php

include "../init.php";
use Models\Student;

$id = $_GET['id']??null;

try {
    if(isset($_GET['id'])){
        $student = new Student('', '', '', '', '', '');
        $student->setConnection($connection);
        $student->getById($id);
        $student->deletestudent();
        echo "<script>window.location.href='index.php?success=3';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}