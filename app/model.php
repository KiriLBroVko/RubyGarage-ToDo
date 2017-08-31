<?php

class Model {

	static public $mysqli;

	static public function init() {
		require 'dbConfig.php';
		self::$mysqli = new mysqli($cfg['host'], $cfg['user'], $cfg['password'], 'tm');
		self::$mysqli->set_charset("utf8");
	}

	static public function getAllProjects() {
		$q = "SELECT * FROM `projects`";
		$res = self::$mysqli->query($q);
		return $res;
	}

	static public function getProjectTasks($project_id) {
		$q = "SELECT * FROM `tasks` WHERE `project_id`='".((int)$project_id)."' ORDER BY `order`";
		$res = self::$mysqli->query($q);
		return $res;
	}

	static public function createProject() {
		$q = "INSERT INTO `projects` VALUES (NULL, 'New list')";
		self::$mysqli->query($q);
		return self::$mysqli->insert_id;
	}

	static public function removeProject($project_id) {
		$q = "DELETE FROM `tasks` WHERE `project_id`='".((int)$project_id)."'";
		self::$mysqli->query($q);
		$q = "DELETE FROM `projects` WHERE `id`='".((int)$project_id)."'";
		return self::$mysqli->query($q);
	}

	static public function addTask($project_id, $description) {
		$q = "INSERT INTO `tasks` VALUES (NULL, 'uncompleted', '".((int)$project_id)."', '".$description."', 0)";
		self::$mysqli->query($q);
		return self::$mysqli->insert_id;
	}

	static public function removeTask($task_id) {
		$q = "DELETE FROM `tasks` WHERE `id`='".((int)$task_id)."'";
		return self::$mysqli->query($q);
	}

	static public function editProject($project_id, $title) {
		$q = "UPDATE `projects` SET `name`='".$title."' WHERE `id`='".((int)$project_id)."'";
		return self::$mysqli->query($q);
	}

	static public function editTask($task_id, $title) {
		$q = "UPDATE `tasks` SET `name`='".$title."' WHERE `id`='".((int)$task_id)."'";
		return self::$mysqli->query($q);
	}

	static public function toggleTask($task_id) {
		$result = self::$mysqli->query("SELECT* FROM `tasks` WHERE `id`='".((int)$task_id)."'");
		$task = $result->fetch_assoc();
		$status = $task['status'];
		$to_status = ($status == 'completed') ? 'uncomplited' : 'completed';
		$q = "UPDATE `tasks` SET `status`='".$to_status."' WHERE `id`='".((int)$task_id)."'";
		return self::$mysqli->query($q);
	}

	static public function sortTasks($orders) {
		foreach ($orders as $order => $id) {
			$q = "UPDATE `tasks` SET `order`='".$order."' WHERE `id`='".((int)$id)."'";
			self::$mysqli->query($q);
		}
	}

}