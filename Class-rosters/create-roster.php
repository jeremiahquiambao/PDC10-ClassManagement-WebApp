<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;
use App\Course;
use App\Student;

$id = $_GET['id'];
$courses = new Course('');
$courses->setConnection($connection);
$course = $courses->getAll();

$students = new Student('');
$students->setConnection($connection);
$student = $students->getAll();

if (isset($_POST['enrollStudent'])) {

    try {
        $roster = new ClassRoster($_POST['classCode'], $_POST['studentID']);
        $roster->setConnection($connection);
        $roster->save();
        // header("Location: " . "view.php?" . "id=". $_GET['id']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
