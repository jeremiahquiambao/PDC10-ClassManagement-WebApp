<?php

namespace Models;
use \PDO;

class Teacher
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $contact;
    protected $employee_number;

    public function __construct($first_name, $last_name, $email, $contact, $employee_number)
	{
		$this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->contact = $contact;
        $this->employee_number = $employee_number;
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

    public function getEmployeeNumber(){
        return $this->employee_number;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM teachers WHERE id=:id';
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
            $this->employee_number = $row['employee_number'];
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getTeacher($id){
		try {
			$sql = 'SELECT * FROM teachers WHERE id=?';
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
			$sql = 'SELECT * FROM classes WHERE teacher_number=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->employee_number
			]);
			$data = $statement->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllTeachers()
	{
		try {
			$sql = 'SELECT * FROM teachers';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addTeacher()
	{
		try {
			$sql = "INSERT INTO teachers SET first_name=?, last_name=?, email=?, contact=?, employee_number=?";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				$this->getFirstName(),
                $this->getLastName(),
                $this->getEmail(),
                $this->getContact(),
                $this->getEmployeeNumber()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function updateTeacher($first_name, $last_name, $email, $contact, $employee_number)
	{
		try {
			$sql = 'UPDATE teachers SET first_name=?, last_name=?, email=?, contact=?, employee_number=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$first_name,
                $last_name,
                $email,
                $contact,
                $employee_number,
				$this->getId()
			]);
			$this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->contact = $contact;
            $this->employee_number = $employee_number;
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function deleteTeacher()
	{
		try {
			$sql = 'DELETE FROM teachers WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}