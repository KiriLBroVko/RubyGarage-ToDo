<?php
require_once 'model.php';

Model::init();

switch ($_POST['action']) {

	case 'createList':
		echo Model::createProject();
		break;

	case 'removeList':
		Model::removeProject($_POST['project_id']);
		break;

	case 'addTask':
		echo Model::addTask($_POST['project_id'], $_POST['desc']);
		break;

	case 'removeTask':
		Model::removeTask($_POST['task_id']);
		break;

	case 'editProject':
		Model::editProject($_POST['project_id'], $_POST['title']);
		break;

	case 'editTask':
		Model::editTask($_POST['task_id'], $_POST['title']);
		break;

	case 'toggleTask':
		Model::toggleTask($_POST['task_id']);
		break;

	case 'sortTasks':
		Model::sortTasks($_POST['orders']);
		break;	
}