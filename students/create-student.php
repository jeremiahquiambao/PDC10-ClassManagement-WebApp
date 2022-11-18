<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;

if (isset($_POST['submitStudent'])) {

    try {

        $student = new Student($_POST['name'], $_POST['studentNumber'], $_POST['email'], $_POST['phoneNumber'],  $_POST['program']);
        $student->setConnection($connection);
        $student->save();
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}