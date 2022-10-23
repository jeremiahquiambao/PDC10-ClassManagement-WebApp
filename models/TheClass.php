<?php

namespace Models;
use \PDO;

class TheClass
{
    protected $id;
    protected $name;
    protected $description;
    protected $code;
    protected $teacher_number;
    protected $connection;

    public function __construct($name, $description, $code, $teacher_number)
	{
		$this->name = $name;
		$this->description = $description;
        $this->code = $code;
        $this->teacher_number = $teacher_number;
	}

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getCode(){
        return $this->code;
    }

    public function getTeacher(){
        return $this->teacher_number;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM classes WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->name = $row['name'];
			$this->description = $row['description'];
			$this->code = $row['code'];
            $this->teacher_number = $row['teacher_number'];
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getClass($id){
		try {
			$sql = 'SELECT c.id, c.name, c.description, c.code, c.teacher_number, CONCAT(t.first_name,\' \', t.last_name) AS teacher_name FROM classes AS c JOIN teachers AS t ON c.teacher_number = t.employee_number WHERE c.id=?';
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

	public function getAllClasses()
	{
		try {
			$sql = 'SELECT c.id, c.name, c.description, c.code, c.teacher_number, CONCAT(t.first_name,\' \', t.last_name) AS teacher_name FROM classes AS c JOIN teachers AS t ON c.teacher_number = t.employee_number;';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addClass()
	{
		try {
			$sql = "INSERT INTO classes SET name=:name, description=:description, code=:code, teacher_number=:teacher_number";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
                ':description' => $this->getDescription(),
                ':code' => $this->getCode(),
                ':teacher_number' => $this->getTeacher()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function updateClass($name, $description, $code, $teacher_number)
	{
		try {
			$sql = 'UPDATE classes SET name=?, description=?, code=?, teacher_number=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$name,
				$description,
                $code,
                $teacher_number,
				$this->getId()
			]);
			$this->name = $name;
            $this->description = $description;
            $this->code = $code;
            $this->teacher_number = $teacher_number;
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function deleteClass()
	{
		try {
			$sql = 'DELETE FROM classes WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}