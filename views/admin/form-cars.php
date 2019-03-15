<?php
	include ('config/config.php');
	include('library/lib_cars.php');
	include('library/lib_customers.php');
	$cars = new lib_cars(); 
	$customers = new lib_customers(); 
	$carId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
	$carDetails= (array) json_decode($cars->getCarRow($carId));
?>

<div class="container">
	<div class="row">
		<div class="col s12 m8 offset-m2">
			<h3 class="center">Car Form</h3>
			<p class="mute-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua.</p>
			<div class="card-panel transparent frosted floating">
				<div class="col s12 ">
					<div class="row">
						<form id="carForm" method="post" action="javascript:void(0);">
							<input type="hidden" id="carId" name="carId" value="<?=$carId;?>"> 
							<input type="hidden" name="controller" id="controller" value="updateInsert" class="car-field">
							<div class="input-field col s12">
								<i class="material-icons prefix">person_outline</i>
								<select name="customerId" required>
								<option value="" disabled selected>Choose Customer</option>
								<?php foreach($customers->showCustomers() as $key => $row):?>
									<option value="<?=$row['customerId'];?>" <?=(isset($carDetails['customerId']) && !empty($carDetails['customerId']) && $row['customerId'] === $carDetails['customerId']) ? 'selected': '';?>><?=$row['fullname'];?></option>
								<?php endforeach;?>
								</select>
								<label data-error="Select an option">Car Owner</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">directions_bus</i>
								<input id="carModel" name="carModel" type="text" value="<?= (isset($carDetails['carModel']) && !empty($carDetails['carModel'])) ? $carDetails['carModel']: null;?>" class="validate car-field" required>
								<label for="carModel">Car Model</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">credit_card</i>
								<input id="plateNumber" name="plateNumber" type="text" value="<?= (isset($carDetails['plateNumber']) && !empty($carDetails['plateNumber'])) ? $carDetails['plateNumber']: null;?>" class="validate car-field" required>
								<label for="plateNumber">Plate Number</label>
							</div>
							<div class="row">
								<div class="col s12 center">
									<button type="submit" class="btn btn-large orange accent-3 waves-effect waves-light"><i class="material-icons left">save</i>Save</button>
								</div>
							</div>
						 </form>
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!--End Card Panel -->

		</div>
	</div>
</div>