<?php

namespace App;
use \PDO;

class Student
{
	protected $id;
	protected $name;
    protected $studentNumber;
	protected $email;
    protected $phoneNumber;
    protected $program;

	// Database Connection Object
	protected $connection;

	public function __construct($name = null, $studentNumber = null, $email = null, $phoneNumber = null, $program = null)
	{
		$this->name = $name;
        $this->studentNumber = $studentNumber;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->program = $program;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

    public function getStudent()
	{
		return $this->studentNumber;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getPhone()
	{
		return $this->phoneNumber;
	}

    public function getProgram()
	{
		return $this->program;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO students SET name=:name, studentNumber=:studentNumber, email=:email, phoneNumber=:phoneNumber, program=:program";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
                ':studentNumber' => $this->getStudent(),
                ':email' => $this->getEmail(),
                ':phoneNumber' => $this->getPhone(),
                ':program' => $this->getProgram()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM students WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->name = $row['name'];
            $this->studentNumber = $row['studentNumber'];
            $this->email = $row['email'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->program = $row['program'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($id, $name, $studentNumber, $email, $phoneNumber, $program)
	{
		try {
			$sql = 'UPDATE students SET name=:name, studentNumber=:studentNumber, email=:email, phoneNumber=:phoneNumber, program=:program WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id,
				':name' => $name,
                ':studentNumber' => $studentNumber,
				':phoneNumber' => $phoneNumber,
				':email' => $email,
				':program' => $program
			]);

			// $this->name = $name;
            // $this->studentNumber = $studentNumber;
            // $this->email = $email;
            // $this->phoneNumber = $phoneNumber;
            // $this->program = $program;


		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM students WHERE id=?';
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
			$sql = 'SELECT * FROM students';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	// public function viewClasses($studentNumber)
	// {
	// 	try {
	// 		$sql = 'SELECT * FROM classes_rosters WHERE studentNumber=:studentNumber';
	// 		$statement = $this->connection->prepare($sql);
	// 		$statement->execute([
	// 			':studentNumber' => $studentNumber
	// 		]);

	// 		$row = $statement->fetchAll();

	// 		return $row;

	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
	// }

	public function getClasses($id)
	{
		try {
			$sql = 'SELECT classes_rosters.id AS rosterCode,
			classes.name AS classesName,
			classes.classCode AS classesCode
			FROM classes_rosters
			INNER JOIN classes
			ON classes_rosters.classCode = classes.id
			WHERE studentNumber=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetchAll();
			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	// Working
	public function viewClasses($studentID)
	{
		try {
			$sql = 'SELECT classes_rosters.id as id, 
			classes_rosters.classCode as classesCode, 
			classes.name as className
			FROM classes_rosters
			INNER JOIN classes
			ON classes_rosters.classCode = classes.classCode 
			WHERE studentID=:studentID';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':studentID' => $studentID
			]);

			$row = $statement->fetchAll();

			// $this->id = $row['id'];
			// $this->name = $row['name'];
            // $this->classCode = $row['classCode'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	// public function getClasses($id)
	// {
	// 	try {
	// 		$sql = 'SELECT classes_rosters.classCode as rosterCode, classes.name as className
	// 		FROM classes_rosters
	// 		INNER JOIN classes
	// 		ON classes_rosters.classCode = classes.classCode
	// 		WHERE studentNumber=:id';

	// 		$statement = $this->connection->prepare($sql);
	// 		$statement->execute([
	// 			':id' => $id
	// 		]);

	// 		$data = $statement->fetchAll();
	// 		return $data;

	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
	// }
}