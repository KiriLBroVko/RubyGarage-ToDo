$(document).ready(function(){
	$(".project .list ul").sortable({
		placeholder: "ui-state-highlight",
		axis: "y",
		cursor: "move",
		containment: "parent",
		stop: function( event, ui ) {
			sortTasks($(this).closest('.project'));
		}
	});

	// create list
	$('a.add_list').click(function(){
		addProject();
		return false;
	});

	// create task 
	$(".main_wrap").on("submit", ".create form", function(){
		addTask($(this).find('input').val(), $(this).closest('.project'));
		return false;
	});

	// remove list
	$(".main_wrap").on("click", ".head a.remove", function(){
		if (confirm('Remove list "'+$(this).closest(".project").find('.head .title').text()+'"?')){
			removeProject($(this).closest(".project"));
		}
		return false;
	});

	// remove task
	$(".main_wrap").on("click", ".list a.remove", function(){
		removeTask($(this).closest("li"));
		return false;
	});

	// rename list
	$(".main_wrap").on("click", ".head a.edit", function(){
		var title_dom = $(this).closest('.project').find('.head .title');
		title_dom.append('<form onsubmit="return false"><input type="text" value="'+title_dom.find('span').text()+'"></form>');
		title_dom.find('input').trigger('focus');
		title_dom.find('span').hide();
		return false;
	});

	$(".main_wrap").on("blur", ".head .title input", function(){
		editProject($(this).closest('.project'));
		return false;
	});
	$(".main_wrap").on("submit", ".head .title form", function(){
		editProject($(this).closest('.project'));
		return false;
	});

	// rename task
	$(".main_wrap").on("click", ".list a.edit", function(){
		var title_dom = $(this).closest('li').find('.title');
		title_dom.append('<form onsubmit="return false"><input type="text" value="'+title_dom.find('span').text()+'"></form>');
		title_dom.find('input').trigger('focus');
		title_dom.find('span').hide();
		return false;
	});

	$(".main_wrap").on("blur", ".list .title input", function(){
		editTask($(this).closest('li'));
		return false;
	});
	$(".main_wrap").on("submit", ".list .title form", function(){
		editTask($(this).closest('li'));
		return false;
	});

	// update task status
	$(".main_wrap").on("click", ".list .status input", function(){
		statusTask($(this).closest('li'));
	});

});


function addProject() {
	$.ajax({
		type: "POST",
		url: 'app/ajaxModel.php',
		data: { action: 'createList'	},
		success: function(new_id){
			if (new_id > 0) {
				var snip = $('.new_project_snippet').html();
				snip = snip.replace("{PROJECT_ID}", new_id);
				$('a.add_list').closest('.sector').before(snip);
				$(".project .list ul").sortable({
					placeholder: "ui-state-highlight",
					axis: "y",
					cursor: "move",
					containment: "parent",
					stop: function( event, ui ) {
						sortTasks($(this).closest('.project'));
					}
				});
			}
		}
	});
}

function addTask(text, project) {
	if (text.length == 0) return false;
	var project_id = project.attr('data-list-id');
	project.find('.create input').val('');
	$.ajax({
		type: "POST",
		url: 'app/ajaxModel.php',
		data: { action: 'addTask', project_id: project_id, desc: text},
		success: function(new_id){
			var snip = $('.new_task_snippet').html();
			snip = snip.replace("{TITLE}", text);
			snip = snip.replace("{TASK_ID}", new_id);
			project.find('.list ul').prepend(snip);
			sortTasks(project);
		}
	});
}


function removeProject(project) {
	var project_id = project.attr('data-list-id');
	$.ajax({
		type: "POST",
		url: 'app/ajaxModel.php',
		data: { action: 'removeList', project_id: project_id },
		success: function(){
			project.closest('.sector').remove();
		}
	});
}

function removeTask(elem) {
	var task_id = elem.attr('data-task-id');
	$.ajax({
		type: "POST",
		url: 'app/ajaxModel.php',
		data: { action: 'removeTask', task_id: task_id },
		success: function(){
			elem.remove();
		}
	});
}


function editProject(project) {
	var title_dom = project.find('.head .title');
	var title = title_dom.find('input').val();
	var project_id = project.attr('data-list-id');
	title_dom.find('form').remove();
	title_dom.find('span').show();
	if (title.length == 0) {
		return false;
	} else {
		$.ajax({
			type: "POST",
			url: 'app/ajaxModel.php',
			data: { action: 'editProject', project_id: project_id, title: title },
			success: function(){
				title_dom.find('span').text(title);
			}
		});
	}
}

function editTask(task) {
	var title_dom = task.find('.title');
	var title = title_dom.find('input').val();
	var task_id = task.attr('data-task-id');
	title_dom.find('form').remove();
	title_dom.find('span').show();
	if (title.length == 0) {
		return false;
	} else {
		$.ajax({
			type: "POST",
			url: 'app/ajaxModel.php',
			data: { action: 'editTask', task_id: task_id, title: title },
			success: function(){
				title_dom.find('span').text(title);
			}
		});
	}
}


function statusTask(elem) {
	var task_id = elem.attr('data-task-id');
	$.ajax({
		type: "POST",
		url: 'app/ajaxModel.php',
		data: { action: 'toggleTask', task_id: task_id},
		success: function(){
			title_dom.find('span').text(title);
		}
	});
}


function sortTasks(project) {
	var list = project.find('.list ul li');
	var orders = [];
	list.each(function(){
		orders.push($(this).attr('data-task-id'));
	});
	$.ajax({
		type: "POST",
		url: 'app/ajaxModel.php',
		data: { action: 'sortTasks', orders: orders},
	});
}
