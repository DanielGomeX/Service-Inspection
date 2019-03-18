<?php
	include ('config/config.php');
	include('library/lib_cars.php');
	include('library/lib_customers.php');
	$cars = new lib_cars(); 
	$customers = new lib_customers(); 
	$customerId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
	$customerDetails= (array) json_decode($customers->getCustomerRow($customerId));
	$x = 1;
?>
<div class="row">
	<div class="col s12 m8 offset-m2">
		<div class="row valign-wrapper">
			<div class="col m4 hide-on-small-only">
				<img src="<?= URI::image('others/id-card-2.png')?>" class="responsive-img" style="padding: 2.5em;">
			</div>
			<div class="col s12 m8">
				<div class="card transparent floating card-info">
					<div class="card-content">
						<div class="row">
							<div class="col s6">
								<h5 class="blue-text bold text-darken-4"><?=$customerDetails['fullname']?></h5>
							</div>
							<div class="col s6">
								<a href="?p=form-customer&id=<?=$customerDetails['customerId'];?>" class="right btn theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">edit</i>Edit Profile</a>
							</div>
						</div>
						<table>
							<tbody>
								<tr>
									<td><i class="material-icons left">location_on</i>Address</td>
									<td><?=$customerDetails['address']?></td>
								</tr>
								<tr>
									<td><i class="material-icons left">phone</i>Contact Number</td>
									<td><?=$customerDetails['contactNumber']?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="card-action">
						<div class="row valign-wrapper">
							<div class="col s12">
								<a href="?p=form-car&c=<?=$customerDetails['customerId'];?>" class="btn theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">add</i>Add New Car</a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="card-panel transparent floating">
					<div class="col s12 m12">
						<table class="table responsive-table highlight dataTable no-footer">
								<thead>
									<tr class="hide-on-med-and-down">
										<th>Car Info</th>
										<th class="center">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cars->showCarsByCustomer($customerId) as $key => $row): ?>
											<tr id="row<?=$row['carId'] ?>">
												<td>
													<p class="blue-text text-darken-4 bold"><a href="?p=car&id=<?=$row['carId'];?>" class="tooltipped"  data-position="right" data-tooltip="View Profile"><i class="material-icons left grey-text text-darken-3">credit_card</i><?=$row['plateNumber'] ?></a></p>
													<p><i class="material-icons left grey-text text-darken-3">directions_bus</i><?=$row['carModel'] ?></p>
												</td>
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
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>
