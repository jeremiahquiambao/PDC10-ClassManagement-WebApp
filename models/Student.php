<?php

namespace Models;
use \PDO;

class Student
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $contact;
    protected $program;
    protected $student_number;

    public function __construct($first_name, $last_name, $email, $contact, $program, $student_number)
	{
		$this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->contact = $contact;
        $this->program = $program;
        $this->student_number = $student_number;
	}

    public function getId(){
        return $this->id;
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function getLastName(){
        return $this->last_name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getContact(){
        return $this->contact;
    }

    public function getProgram(){
        return $this->program;
    }

    public function getStudentNumber(){
        return $this->student_number;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
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
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
			$this->email = $row['email'];
			$this->contact = $row['contact'];
            $this->program = $row['program'];
            $this->student_number = $row['student_number'];
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getStudent($id){
		try {
			$sql = 'SELECT * FROM students WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$id
			]);
			$data = $statement->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getClasses(){
		try {
			$sql = 'SELECT c.name, c.code FROM students AS s JOIN classes_rosters AS cr ON cr.student_number = s.student_number JOIN classes AS c ON c.code = cr.class_code WHERE s.student_number=?;';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->student_number
			]);
			$data = $statement->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getAllStudents()
	{
		try {
			$sql = 'SELECT * FROM students';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addStudent()
	{
		try {
			$sql = "INSERT INTO students SET first_name=?, last_name=?, email=?, contact=?, program=?, student_number=?";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				$this->getFirstName(),
                $this->getLastName(),
                $this->getEmail(),
                $this->getContact(),
                $this->getProgram(),
                $this->getStudentNumber()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function updateStudent($first_name, $last_name, $email, $contact, $program, $student_number)
	{
		try {
			$sql = 'UPDATE students SET first_name=?, last_name=?, email=?, contact=?, program=?, student_number=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$first_name,
                $last_name,
                $email,
                $contact,
                $program,
                $student_number,
				$this->getId()
			]);
			$this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->contact = $contact;
            $this->program = $program;
            $this->student_number = $student_number;
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function deleteStudent()
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
}


?>