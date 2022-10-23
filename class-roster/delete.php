<?php

include "../init.php";
use Models\ClassRoster;

$id = $_GET['id']??null;

try {
    if(isset($_GET['id'])){
        $class_roster = new ClassRoster('', '');
        $class_roster->setConnection($connection);
        $class_roster->getById($id);
        $class_roster->deleteClassRoster();
        $code = $class_roster->getClassCode();
        echo "<script>window.location.href='edit.php?success=3&code=" . $code . "';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}

#echo '<pre>';
#var_dump($class_roster);