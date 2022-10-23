<?php

include "../init.php";
use Models\TheClass;
use Models\Teacher;

$id = $_GET['id']??null;

$teacher = new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->getAllTeachers();

$class = new TheClass('', '', '', '', '');
$class->setConnection($connection);
$class = $class->getClass($id);

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/classes')
]);

$template = $mustache->loadTemplate('edit');
echo $template->render(compact('all_teachers','class'));

try {
    if(isset($_POST['id'])){
        $update_class = new TheClass('', '', '', '');
        $update_class->setConnection($connection);
        $update_class->getById($_POST['id']);
        $update_class->updateClass($_POST['name'], $_POST['description'], $_POST['code'], $_POST['teacher_number']);
        echo "<script>window.location.href='index.php?success=2';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}

