<?php

namespace App;
use \PDO;

class Teacher
{
	protected $id;
	protected $name;
	protected $email;
    protected $phoneNumber;
    protected $teacherCode;

	// Database Connection Object
	protected $connection;

	public function __construct($name = null, $email = null, $phoneNumber = null, $teacherCode = null)
	{
		$this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->teacherCode = $teacherCode;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getPhone()
	{
		return $this->phoneNumber;
	}

    public function getCode()
	{
		return $this->teacherCode;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO teachers SET name=:name, email=:email, phoneNumber=:phoneNumber, teacherCode=:teacherCode";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
                ':email' => $this->getEmail(),
                ':phoneNumber' => $this->getPhone(),
                ':teacherCode' => $this->getCode()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
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
			$this->name = $row['name'];
            $this->email = $row['email'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->teacherCode = $row['teacherCode'];

			return $row;
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($id, $name, $email, $phoneNumber, $teacherCode)
	{
		try {
			$sql = 'UPDATE teachers SET name=:name, email=:email, phoneNumber=:phoneNumber, teacherCode=:teacherCode WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id,
				':name' => $name,
				':phoneNumber' => $phoneNumber,
				':email' => $email,
				':teacherCode' => $teacherCode
			]);

			// $this->name = $name;
            // $this->email = $email;
            // $this->phoneNumber = $phoneNumber;
            // $this->teacherCode = $teacherCode;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
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

	public function viewClasses($teacherID)
	{
		try {
			$sql = 'SELECT * FROM classes WHERE teacherID=:teacherID';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':teacherID' => $teacherID
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

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM teachers';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}