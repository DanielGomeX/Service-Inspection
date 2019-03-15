<?php
	include ('config/config.php');
	include('library/lib_cars.php');
	include('library/lib_customers.php');
	$cars = new lib_cars(); 
	$customers = new lib_customers(); 
	$carId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
	$carDetails= (array) json_decode($cars->getCarRow($carId));
?>
<div class="row">
	<div class="col s12 m8 offset-m2">
		<div class="row">
			<div class="col m4 hide-on-small-only">
				<img src="<?= URI::image('others/settings-1.png')?>" class="responsive-img" style="padding: 2.5em;">
			</div>
			<div class="col s12 m8">
				<div class="card-panel">
					<h5 class="blue-text bold text-darken-4">#<?=$carDetails['plateNumber']?></h5>
					<table>
						<tbody>
							<tr>
								<td>Plate Number</td>
								<td><?=$carDetails['plateNumber']?></td>
							</tr>
							<tr>
								<td>Car Model</td>
								<td><?=$carDetails['carModel']?></td>
							</tr>
							<tr>
								<td>Car Owner</td>
								<td><?=$carDetails['fullname']?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
