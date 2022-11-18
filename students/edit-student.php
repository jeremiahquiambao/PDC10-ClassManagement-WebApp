<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;

$id = $_GET['id'];
$student = new Student('');
$student->setConnection($connection);
$studentDetails = $student->getById($id);

if (isset($_POST['editStudent'])) {

    try {
        $student->update($_POST['id'], $_POST['name'], $_POST['studentNumber'], $_POST['email'], $_POST['phoneNumber'],  $_POST['program']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
