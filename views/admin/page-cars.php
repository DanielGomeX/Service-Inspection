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
					<h3 class="valign-wrapper grey-text text-darken-3"><i class="material-icons medium left">directions_car</i>Cars</h3>
				</div>
				<div class="col s4 m6">
					<a href="?p=form-car" class="btn btn-large waves-effect waves-light  theme-grey-bg white-text right hide-on-small-only"><i class="material-icons left">add</i>Enlist New Car</a>
					

				</div>
			</div>
			<div class="card-panel transparent frosted floating">
				<div class="col s12">
					<div class="row">
						<table class="table responsive-table highlight dataTable no-footer">
							<thead>
								<tr class="hide-on-med-and-down">
									<th>No.</th>
										<th>Car Info</th>
										<th>Owner</th>
										<th class="center">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cars->showCars() as $key => $row): ?>
											<tr id="row<?=$row['carId'] ?>">
												<td><?=$x++;?></td>
												<td>
													<p class="blue-text text-darken-4 bold"><a href="?p=car&id=<?=$row['carId'];?>" class="tooltipped"  data-position="right" data-tooltip="View Profile"><i class="material-icons left grey-text text-darken-3">credit_card</i><?=$row['plateNumber'] ?></a></p>
													<p><i class="material-icons left grey-text text-darken-3">directions_bus</i><?=$row['carModel'] ?></p>
												</td>
												<td><?=$row['fullName'] ?></td>
												<td class="center">
														<a href="?p=form-car&id=<?=$row['carId'];?>" class="btn theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">edit</i>Edit</a>
														<button class="btn red lighten-1 waves-effect waves-red car-delete-btn" data-id="<?=$row['carId'] ?>"><i class="material-icons left">delete</i>Delete</button>
													</div>
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
<div class="fixed-action-btn">
  <a href="?p=form-car" class="btn btn-floating pulse btn-large waves-effect waves-light  theme-grey-bg white-text right hide-on-med-and-up show-on-small "><i class="material-icons left">add</i></a>
 </div>