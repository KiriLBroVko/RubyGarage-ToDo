<?php
	require_once 'app/model.php';
	Model::init();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Task Manager</title>
	<link rel="stylesheet" href="style/layout.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="app/general.js"></script>
</head>
<body>
	<div class="main_wrap">

<?php
	$projects = Model::getAllProjects();
	if ($projects) {
		while ($project = $projects->fetch_assoc()){
?>

		<div class="sector">
			<div class="project" data-list-id="<?php echo $project['id']; ?>">
				<div class="head">
					<div class="title" title="<?php echo $project['name']; ?>"><span><?php echo $project['name']; ?></span></div>
					<div class="buttons">
						<a href="#" class="edit" title="Edit project name"></a>
						<a href="#" class="remove" title="Remove project"></a>
					</div>
				</div>
				<div class="create">
					<form action="#">
						<input type="text" placeholder="Start typing here to create a task...">
						<button title="Add new task">Add task</button>
					</form>
				</div>
				<div class="list">
					<ul>

<?php
	$tasks = Model::getProjectTasks($project['id']);
	if ($tasks) {
		while ($task = $tasks->fetch_assoc()) {
?>

						<li data-task-id="<?php echo $task['id']; ?>">
							<div class="status"><input type="checkbox" <?php if ($task['status'] == 'completed') echo 'checked="checked"'; ?>></div>
							<div class="title"><span><?php echo $task['name']; ?></span></div>
							<div class="buttons">
								<a href="#" class="sort" title="Reorder task"></a>
								<a href="#" class="edit" title="Edit task"></a>
								<a href="#" class="remove" title="Remove task"></a>
							</div>
						</li>

<?php 
		}
	} 
?>

					</ul>
				</div>
			</div>
		</div>

<?php 
		}
	} 
?>

		<div class="sector">
			<a href="#" class="add_list">Add TODO list</a>
		</div>
	</div>


	<!-- Snippets -->
	<div class="new_project_snippet" style="display: none">
		<div class="sector">
			<div class="project" data-list-id="{PROJECT_ID}">
				<div class="head">
					<div class="title" title="New list"><span>New list</span></div>
					<div class="buttons">
						<a href="#" class="edit" title="Edit list name"></a>
						<a href="#" class="remove" title="Remove list"></a>
					</div>
				</div>
				<div class="create">
					<form action="#">
						<input type="text" placeholder="Start typing here to create a task...">
						<button title="Add new task">Add task</button>
					</form>
				</div>
				<div class="list">
					<ul></ul>
				</div>
			</div>
		</div>
	</div>

	<div class="new_task_snippet" style="display: none">
		<li data-task-id="{TASK_ID}">
			<div class="status"><input type="checkbox"></div>
			<div class="title"><span>{TITLE}</span></div>
			<div class="buttons">
				<a href="#" class="sort"></a>
				<a href="#" class="edit"></a>
				<a href="#" class="remove"></a>
			</div>
		</li>
	</div>
</body>
</html>