<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;
use App\Course;

$id = $_GET['id'];
$getRosters = new ClassRoster('');
$getRosters->setConnection($connection);
$rosters = $getRosters->getByClassId($id);

$getCourse = new Course('');
$getCourse->setConnection($connection);
$course = $getCourse->getById($id);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDC10 - Class Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="m-5 p-3">
        <ul class="nav nav-pills shadow p-3 mb-5 bg-body rounded">
            <li class="nav-item">
                <a class="nav-link text-bg-light" href="/pdc10-class-management/Courses/index.php">Classes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-bg-light" href="/pdc10-class-management/Students/index.php">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-bg-light" href="/pdc10-class-management/Teachers/index.php">Teachers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-bg-dark active" aria-current="page" href="index.php">Class Rosters</a>
            </li>
        </ul>
        <div class="m-3 p-2">
            <div class="card mb-4 shadow">
                <div class="card-header">
                    Students Enrolled In <b><?php echo $course['name'] ?></b>
                </div>
                <div class="card-body">
                    <a role="button" class="btn btn-secondary m-3" href="add.php?id=<?php echo $_GET['id'] ?>" name="add">Add Roster</a>
                    <a role="button" class="btn btn-outline-secondary m-3" href="index.php">Back to Rosters</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Student Number</th>
                                <th>Student Name</th>
                                <th>Enrolled Date</th>
                                <th>
                                    <a role="button" href="add.php?id=<?php echo $_GET['id']; ?>" name="add">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                        </svg>
                                    </a>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rosters as $info) {
                                $studentID = $info['studentID'];
                                $viewStudents = new ClassRoster('');
                                $viewStudents->setConnection($connection);
                                $students = $viewStudents->getStudentInfo($studentID);
                            ?>
                                <tr>
                                    <!-- <th scope="row"><?php echo $students['rosterID'] ?></th> -->
                                    <th><?php echo $students['studentsNumber'] ?></th>
                                    <td><?php echo $students['studentName'] ?></td>
                                    <td><?php echo $students['enrolledAt'] ?></td>
                                    <td>
                                        <a role="button" href="edit.php?id=<?php echo $info['id']; ?>" name="edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Do you want to unenroll?');" href = "delete.php?id=<?php echo $info['id']; ?>&course=<?php echo $_GET['id'] ?>" role="button" name="delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>