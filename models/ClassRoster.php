<?php

namespace Models;
use \PDO;

class ClassRoster
{
    protected $id;
    protected $class_code;
    protected $student_number;
    protected $enrolled_at;
    protected $is_active;

    public function __construct($class_code, $student_number, $is_active = true)
	{
		$this->class_code = $class_code;
		$this->student_number = $student_number;
        $this->is_active = $is_active;
	}

    public function getId(){
        return $this->id;
    }

    public function getClassCode(){
        return $this->class_code;
    }

    public function getStudentNumber(){
        return $this->student_number;
    }

    public function isActive(){
        return $this->is_active;
    }

    public function isEnrolledAt(){
        date_default_timezone_set('Asia/Manila');
        return $this->enrolled_at = date('Y-m-d H:i:s');
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
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
			$this->class_code = $row['class_code'];
            $this->student_number = $row['student_number'];
            $this->is_active = $row['is_active'];
            $this->enrolled_at = $row['enrolled_at'];
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAllClassesRosters()
	{
		try {
			$sql = 'SELECT DISTINCT(c.code), c.name, CONCAT(t.first_name, \' \', t.last_name) AS teacher_name, (SELECT COUNT(student_number) FROM classes_rosters WHERE class_code = c.code)  AS number_of_students, (SELECT DISTINCT(is_active) FROM classes_rosters WHERE class_code = c.code) AS is_active FROM classes AS C JOIN teachers AS t ON c.teacher_number = t.employee_number;';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getClassStudents($class_code)
	{
		try {
			$sql = 'SELECT cr.id, s.first_name, s.last_name, s.student_number, s.email, s.contact, s.program, cr.enrolled_at FROM classes_rosters AS cr JOIN students AS s ON cr.student_number = s.student_number WHERE cr.class_code=:class_code';
			$data = $this->connection->prepare($sql);
			$data->execute([
				':class_code' => $class_code
			]);
			return $data->fetchAll();
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getClass($code){
		try {
			$sql = 'SELECT * FROM classes WHERE code =:code';
			$data = $this->connection->prepare($sql);
			$data->execute([
				':code' => $code
			]);
			return $data->fetch();
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addStudentToRoster()
	{
		try {
			$sql = "INSERT INTO classes_rosters (class_code, student_number, is_active, enrolled_at) SELECT ?,?,?,? WHERE NOT EXISTS (Select * FROM classes_rosters WHERE class_code=? AND student_number=?) LIMIT 1;";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				$this->getClassCode(),
                $this->getStudentNumber(),
                $this->isActive(),
                $this->isEnrolledAt(),
				$this->getClassCode(),
                $this->getStudentNumber(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function updateClassRoster($class_code, $student_number, $is_active, $enrolled_at)
	{
		try {
			$sql = 'UPDATE classes_rosters SET class_code=?, student_number=?, is_active=?, enrolled_at=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$class_code,
                $student_number,
                $is_active,
				$enrolled_at,
                $this->getId()
			]);
			$this->class_code = $class_code;
            $this->student_number = $student_number;
            $this->is_active = $is_active;
			$this->enrolled_at = $enrolled_at;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function deleteClassRoster()
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
}