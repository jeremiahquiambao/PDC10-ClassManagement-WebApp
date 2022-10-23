<?php

include "../init.php";
use Models\Student;

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/students')
]);

$template = $mustache->loadTemplate('add');
echo $template->render();

try {
    if(isset($_POST['id'])){
        $student = new Student($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact'], $_POST['program'], $_POST['student_number']);
        $student->setConnection($connection);
        $student->addStudent();
        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}

