<?php

include "../init.php";
use Models\Student;

$id = $_GET['id']??null;

$student = new Student('', '', '', '', '', '');
$student->setConnection($connection);
$student = $student->getStudent($id);

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/students')
]);

$template = $mustache->loadTemplate('edit');
echo $template->render(compact('student'));

try {
    if(isset($_POST['id'])){
        $update_student = new Student('', '', '', '', '', '');
        $update_student->setConnection($connection);
        $update_student->getById($_POST['id']);
        $update_student->updatestudent($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact'], $_POST['program'], $_POST['student_number']);
        echo "<script>window.location.href='index.php?success=2';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}