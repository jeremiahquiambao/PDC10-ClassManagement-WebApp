<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Course;

if (isset($_POST['submitClass'])) {

    try {
        $course = new Course($_POST['name'], $_POST['description'], $_POST['classCode'], $_POST['teacherID']);
        $course->setConnection($connection);
        $course->save();
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
