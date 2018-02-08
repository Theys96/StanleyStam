<div class="card my-3">
	<div class="card-header">
		<h4 class="card-title text-center">Huidige actiepunten</h4>
	</div>
	<div class="card-block">
		<?php
		$todos = $Model->currentTodos();
		foreach ($todos as $todo) {
			$data = $todo->data();
			echo '<div class="row table-row my-1 p-2">';
			echo '<div class="col-md-3 text-bold">' . $data['name'] . '</div>';
			echo '<div class="col-md-3 text-justify">';
			printListHighlighted($data['organisators'], $_SESSION['user']);
			echo '</div>';
			echo '<div class="col-md-6 todo-text"><b>' . formatData($data['status_date'], $data['status_date']) . '</b> - ' . $data['status'] . '</div>';
			echo '</div>';
		}
		?>
	</div>
</div>

<div class="card my-3">
	<div class="card-header">
		<h4 class="card-title text-center">Gearchiveerde actiepunten</h4>
	</div>
	<div class="card-block">
		<?php
		$todos = $Model->archivedTodos();
		foreach ($todos as $todo) {
			$data = $todo->data();
			echo '<div class="row table-row my-1 p-2">';
			echo '<div class="col-md-3 text-bold">' . $data['name'] . '</div>';
			echo '<div class="col-md-3 text-justify">';
			printListHighlighted($data['organisators'], $_SESSION['user']);
			echo '</div>';
			echo '<div class="col-md-6 todo-text"><b>' . formatData($data['status_date'], $data['status_date']) . '</b> - ' . $data['status'] . '</div>';
			echo '</div>';
		}
		?>
	</div>
</div>

