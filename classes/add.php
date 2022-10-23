<?php

include "../init.php";
use Models\TheClass;
use Models\Teacher;

$teacher = new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->getAllTeachers();
$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/classes')
]);

$template = $mustache->loadTemplate('add');
echo $template->render(compact('all_teachers'));


try {
    if(isset($_POST['id'])){
        $class = new TheClass($_POST['name'],$_POST['description'],$_POST['code'],$_POST['teacher_number']);
        $class->setConnection($connection);
        $class->addClass();
        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    }
} catch (Exception $e) {
    header('Location: index.php?error=' . $e->getMessage());
    exit();
}

