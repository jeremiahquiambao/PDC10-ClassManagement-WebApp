<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Course;
use App\Teacher;

$id = $_GET['id'];
$course = new Course('');
$course->setConnection($connection);
$courseDetails = $course->getById($id);

$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacher = $teachers->getAll();

if (isset($_POST['editClass'])) {

    try {
        $course->update($_POST['id'], $_POST['name'], $_POST['classCode'], $_POST['description'], $_POST['teacherID']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}