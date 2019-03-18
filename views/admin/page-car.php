<?php
	include ('config/config.php');
	include('library/lib_cars.php');
	include('library/lib_customers.php');
	include('library/lib_inspections.php');
	$cars = new lib_cars(); 
	$customers = new lib_customers(); 
	$inspections = new lib_inspections(); 
	$carId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
	$carDetails= (array) json_decode($cars->getCarRow($carId));
	$x = 1;
?>
<div class="row">
	<div class="col s12 m8 offset-m2">
		<div class="row valign-wrapper">
			<div class="col m4 hide-on-small-only">
				<img src="<?= URI::image('others/settings-1.png')?>" class="responsive-img" style="padding: 2.5em;">
			</div>
			<div class="col s12 m8">
				<div class="card transparent floating card-info">
					<div class="card-content">
						<div class="row">
							<div class="col s6">
								<h5 class="blue-text bold text-darken-4"><?=$carDetails['plateNumber']?></h5>
							</div>
							<div class="col s6">
								<a href="?p=form-car&id=<?=$carDetails['carId'];?>" class="right btn theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">edit</i>Edit Profile</a>
							</div>
						</div>
						<table>
							<tbody>
								<tr>
									<td><i class="material-icons left">location_on</i>Car Model</td>
									<td><?=$carDetails['carModel']?></td>
								</tr>
								<tr>
									<td><i class="material-icons left">phone</i>Car Owner</td>
									<td><?=$carDetails['fullname']?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="card-action">
						<div class="row valign-wrapper">
							<div class="col s12">
								<a href="?p=form-inspection&id=<?=$carDetails['carId'];?>" class="btn theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">add</i>New Inspection</a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<h5 class="grey-text text-darken-3 uppercase">Inspection Records</h5>
		<div class="card-panel transparent frosted floating">
			<div class="col s12">
				<div class="row">
					<table class="table responsive-table highlight dataTable no-footer">
						<thead>
							<tr class="hide-on-med-and-down">
									<th>No.</th>
									<th style="width: 40%;">Inspection</th>
									<th>Date Created</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($inspections->showInspectionsByCar($carId) as $key => $row): ?>
										<tr id="row<?=$row['inspectionId'] ?>">
											<td><?=$x++;?></td>
											<td style="width: 40%;">
												<p class="blue-text text-darken-4 bold"><a href="?p=inspection&id=<?=$row['inspectionId'];?>" class="tooltipped"  data-position="right" data-tooltip="View Details">Inspection #<?=$row['inspectionId'] ?></a></p>
											</td>
											<td>
												<p><i class="material-icons left grey-text text-darken-3">access_time</i>
													<time class="timeago" datetime="<?=$row['dateCreated'] ?>"></time>
												</p>
											</td>
											<td>
												<button class="btn red lighten-1 waves-effect waves-red inspection-delete-btn" data-id="<?=$row['inspectionId'] ?>"><i class="material-icons left">delete</i>Delete</button>
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
