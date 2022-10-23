<?php

include "../init.php";
use Models\Teacher;


$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/teachers')
]);

$template = $mustache->loadTemplate('add');
echo $template->render();

try {
    if(isset($_POST['id'])){
        $teacher = new Teacher($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact'], $_POST['employee_number']);
        $teacher->setConnection($connection);
        $teacher->addTeacher(); 
        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    }
} catch (Exception $e) {
    header('Location: index.php?error=' . $e->getMessage());
}