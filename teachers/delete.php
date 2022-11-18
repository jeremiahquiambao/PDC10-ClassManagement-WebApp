<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$id = $_GET['id'];
$teachers = new Teacher('');
$teachers->setConnection($connection);
$teachers->getById($id);
$teachers->delete();
header("Location: index.php");
exit();
