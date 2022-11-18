<?php

namespace App;
use \PDO;

class ClassRoster
{
	protected $id;
    protected $classCode;
    protected $studentID;
    protected $enrolledAt;

	// Database Connection Object
	protected $connection;

	public function __construct($classCode = null, $studentID = null)
	{
		$this->classCode = $classCode;
		$this->studentID = $studentID;
	}

	public function getId()
	{
		return $this->id;
	}

    public function getCode()
	{
		return $this->classCode;
	}

	public function getEnrolledAt()
	{
		return $this->enrolledAt;
	}

	public function getStudentID()
	{
		return $this->studentID;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO classes_rosters SET classCode=:classCode, studentID=:studentID";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
                ':classCode' => $this->getCode(),
                ':studentID' => $this->getStudentID()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM classes_rosters WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->classCode = $row['classCode'];
			$this->enrolledAt = $row['enrolledAt'];
			$this->studentID = $row['studentID'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getByClassId($classID)
	{
		try {
			$sql = 'SELECT classes_rosters.id AS id, 
			classes.id AS classID,
			students.id AS studentID,
			classes.name AS className, 
			classes_rosters.classCode, 
			students.studentNumber AS studentsNumber, 
			students.name AS studentName, 
			classes_rosters.enrolledAt AS enrolledAt 
			FROM classes_rosters 
			INNER JOIN classes 
			ON classes_rosters.classCode = classes.classCode 
			INNER JOIN students 
			ON classes_rosters.studentID = students.id 
			WHERE classes.id=:classID;';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':classID' => $classID
			]);

			$row = $statement->fetchAll();

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($id, $classCode, $studentID, $enrolledAt)
	{
		try {
			$sql = 'UPDATE classes_rosters SET classCode=:classCode, studentID=:studentID, enrolledAt=:enrolledAt WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id,
				':classCode' => $classCode,
				':studentID' => $studentID,
				':enrolledAt' => $enrolledAt
			]);


		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM classes_rosters WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM classes_rosters';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getRoster(){
		try {
			$sql = 'SELECT classes_rosters.classCode AS classesCode,
			classes.id AS classID,
			studentID, 
			classes.name AS courseName, 
			teachers.name AS teacherName, 
			COUNT(classes_rosters.classCode) AS studentsEnrolled 
			FROM classes_rosters 
			INNER JOIN classes 
			ON classes_rosters.classCode = classes.classCode 
			INNER JOIN teachers 
			ON classes.teacherID = teachers.id
			GROUP BY classesCode;';

			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getStudentInfo($id)
	{
		try {
			$sql = 'SELECT students.name AS studentName,
			students.studentNumber AS studentsNumber,
			students.id AS studentID,
			classes_rosters.enrolledAt AS enrolledAt,
			classes_rosters.id AS rosterID
			FROM students
			INNER JOIN classes_rosters
			ON classes_rosters.studentID = students.id 
			WHERE classes_rosters.studentID=:id';

			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->studentName = $row['studentName'];
			$this->enrolledAt = $row['enrolledAt'];
			$this->studentNumber = $row['studentNumber'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}