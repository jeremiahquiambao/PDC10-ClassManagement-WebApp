<?php

require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacher = $teachers->getAll();

if (isset($_POST['submitTeacher'])) {

    try {
        $teacher = new Teacher($_POST['name'], $_POST['email'], $_POST['phoneNumber'], $_POST['teacherCode']);
        $teacher->setConnection($connection);
        $teacher->save(); 
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
    
}

?>