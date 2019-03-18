<?php
	include ('config/config.php');
	include('library/lib_inspections.php');
	include('library/lib_cars.php');
	$inspections = new lib_inspections(); 
	$cars = new lib_cars(); 
	$carId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);

?>
<div class="container">
	<div class="row">
		<div class="col s12 m10 offset-m1">
			<h3 class="center">Service Inspection Form</h3>
			<p class="mute-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua.</p>
				<form id="inspectionForm" method="post" action="javascript:void(0);">
					<input type="hidden" id="inspectionId" name="inspectionId"> 
					<input type="hidden" id="lubrication" name="lubrication"> 
					<input type="hidden" id="underhood" name="underhood"> 
					<input type="hidden" id="road" name="road"> 
					<input type="hidden" name="controller" id="controller" value="updateInsert" class="inspection-field">

					<div class="card-panel">
						<div class="input-field col s12">
							<i class="material-icons prefix">directions_car</i>
							<select name="carId" required>
							<option value="" disabled selected>Choose Car</option>
							<?php foreach($cars->showCars() as $key => $row):?>
								<option value="<?=$row['carId'];?>" <?=(isset($carDetails['carId']) && !empty($carDetails['carId']) && $row['carId'] === $carDetails['carId']) ?  'selected': (isset($carId) && !empty($carId) && $row['carId'] === $carId) ? 'selected' :'' ;?>>#<?=$row['plateNumber'];?> - <?=$row['carModel'];?></option>
							<?php endforeach;?>
							</select>
							<label data-error="Select an option">Select Car</label>
						</div>
						<div class="clearfix"></div>
					</div>
					

					<ul class="collapsible">
						<li>
						<div class="collapsible-header"><i class="material-icons">opacity</i>Lubrication</div>
						<div class="collapsible-body">
							<table>
								<?php foreach ($inspections->showFields('lubrication') as $key => $row):?>
									<tr>
										<td><?=$row['fieldtxt']?></td>
										<td>
											<div class="switch">
												<label>
												<span class="red-text text-darken-2">Replace</span>
												<input type="checkbox" class="field-lubrication" data-id="<?=$row['fieldId']?>">
												<span class="lever"></span>
												<span class="green-text text-darken-2">Check</span>
												</label>
											</div>
										</td>
									</tr>
								<?php endforeach;?>
							</table>
						</div>
						</li>
						<li>
						<div class="collapsible-header"><i class="material-icons">settings</i>Underhood / Chassis Operations</div>
						<div class="collapsible-body">
							<table>
								<?php foreach ($inspections->showFields('underhood/chasis') as $key => $row):?>
									<tr>
										<td><?=$row['fieldtxt']?></td>
										<td>
											<div class="switch">
												<label>
												<span class="red-text text-darken-2">Replace</span>
												<input type="checkbox" class="field-underhood" data-id="<?=$row['fieldId']?>">
												<span class="lever"></span>
												<span class="green-text text-darken-2">Check</span>
												</label>
											</div>
										</td>
									</tr>
								<?php endforeach;?>
							</table>
						</div>
						</li>
						<li>
						<div class="collapsible-header"><i class="material-icons">directions</i>Road Test</div>
						<div class="collapsible-body">
							<table>
								<?php foreach ($inspections->showFields('road') as $key => $row):?>
									<tr>
										<td><?=$row['fieldtxt']?></td>
										<td>
											<div class="switch">
												<label>
												<span class="red-text text-darken-2">Replace</span>
												<input type="checkbox" class="field-road" data-id="<?=$row['fieldId']?>">
												<span class="lever"></span>
												<span class="green-text text-darken-2">Check</span>
												</label>
											</div>
										</td>
									</tr>
								<?php endforeach;?>
							</table>
						</div>
						</li>
					</ul>
					<div class="row">
						<div class="col s12 center">
							<button type="submit" class="btn btn-large theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">save</i>Save</button>
						</div>
					</div>

				</form>
		</div>
	</div>
</div>