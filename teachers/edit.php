<?php

include "../init.php";
use Models\Teacher;

$id = $_GET['id']??null;

$teacher = new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$teacher = $teacher->getTeacher($id);

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/teachers')
]);

$template = $mustache->loadTemplate('edit');
echo $template->render(compact('teacher'));

try {
    if(isset($_POST['id'])){
        $update_teacher = new Teacher('', '', '', '', '');
        $update_teacher->setConnection($connection);
        $update_teacher->getById($_POST['id']);
        $update_teacher->updateTeacher($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact'], $_POST['employee_number']);
        echo "<script>window.location.href='index.php?success=2';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error=" . $e->getMessage()  . "';</script>";
}