<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$id = $_GET['id'];
$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacherDetails = $teachers->getById($id);

if (isset($_POST['editTeacher'])) {

    try {
        $teachers->update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phoneNumber'], $_POST['teacherCode']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
