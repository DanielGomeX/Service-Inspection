<?php
	include ('config/config.php');
	include('library/lib_cars.php');
	$cars = new lib_cars(); $x = 1; 
?>

<div class="container">
	<div class="row">
		<div class="col s12">
			<div class="valign-wrapper">
				<div class="col s8 m6">
					<h3>Cars List</h3>
				</div>
				<div class="col s4 m6">
					<a href="?p=form-car" class="btn btn-large waves-effect waves-light blue darken-2 right hide-on-small-only"><i class="material-icons left">add</i>Enlist New Car</a>
					<a href="?p=form-car" class="btn btn-floating btn-large waves-effect waves-light blue darken-2 right hide-on-med-and-up show-on-small "><i class="material-icons left">add</i></a>

				</div>
			</div>
				
			<div class="card-panel transparent frosted floating">
				<div class="col s12">
					<div class="row">
						<table class="table responsive-table highlight dataTable no-footer">
							<thead>
								<tr class="hide-on-med-and-down">
									<th>No.</th>
										<th>Car Model</th>
										<th>Plate Number</th>
										<th>Owner</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cars->showCars() as $key => $row): ?>
											<tr id="row<?=$row['carId'] ?>">
												<td><?=$x++;?></td>
												<td><?=$row['carModel'] ?></td>
												<td><?=$row['plateNumber'] ?></td>
												<td><?=$row['fullName'] ?></td>
												<td>
													<a href="?p=form-car&id=<?=$row['carId'];?>" class="btn-flat waves-effect waves-green"><i class="material-icons">edit</i></a>
													<button class="btn-flat waves-effect waves-red"><i class="material-icons">delete</i></button>
												</td>
											</tr>
									<?php endforeach;?>
								</tbody>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!--End Card Panel -->

		</div>
	</div>
</div>