<?php

include "../init.php";
use Models\Teacher;

$id = $_GET['id']??null;

try {
    if(isset($_GET['id'])){
        $teacher = new Teacher('', '', '', '', '');
        $teacher->setConnection($connection);
        $teacher->getById($id);
        $teacher->deleteTeacher();
        echo "<script>window.location.href='index.php?success=3';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}