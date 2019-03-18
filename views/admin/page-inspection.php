<?php
	include ('config/config.php');
	include('library/lib_inspections.php');
	$inspections = new lib_inspections(); 
	$inspectionId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
	$inspectionDetails= (array) json_decode($inspections->getInspectionRow($inspectionId));
	$lubrication = explode(',',$inspectionDetails['lubrication']);
	$underhood = explode(',',$inspectionDetails['underhood']);
	$underhood = explode(',',$inspectionDetails['underhood']);
	$road = explode(',',$inspectionDetails['road']);

		
	$x = 1;
?>
<div class="row">
	<div class="col s12 m8 offset-m2">
		<div class="row valign-wrapper">
			<div class="col m4 hide-on-small-only">
				<img src="<?= URI::image('others/list.png')?>" class="responsive-img" style="padding: 2.5em;">
			</div>
			<div class="col s12 m8">
				<div class="card transparent floating card-info">
					<div class="card-content">
						<div class="row">
							<div class="col s12">
								<h5 class="blue-text bold text-darken-4">INSPCT#<?=$inspectionDetails['inspectionId']?></h5>
							</div>
						</div>
						<table>
							<tbody>
								<tr>
									<td><i class="material-icons left">credit_card</i>Plate Number</td>
									<td><?=$inspectionDetails['plateNumber']?></td>
								</tr>
								<tr>
									<td><i class="material-icons left">directions_car</i>Car Model</td>
									<td><?=$inspectionDetails['carModel']?></td>
								</tr>
								<tr>
									<td><i class="material-icons left">access_time</i>Date Created</td>
									<td><time class="timeago" datetime="<?=$inspectionDetails['dateCreated'] ?>"><?=$inspectionDetails['dateCreated'] ?></time></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">

			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="card-panel transparent floating">
					<div class="col s12 m12">
						<table class="table responsive-table highlight dataTable no-footer">
							<thead>
								<tr class="hide-on-med-and-down">
									<th><h5 class="grey-text text-darken-3"><i class="material-icons left">opacity</i>Lubrication</h5></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($inspections->showFields('lubrication') as $key => $row):?>
								<tr>
									<td><?=$row['fieldtxt']?></td>
									<td>
											<label>
											<span class="red-text text-darken-2"></span>
											<input type="checkbox" class="field-lubrication" data-id="<?=$row['fieldId']?>" disabled <?php foreach ($lubrication as $key => $value) { echo ($value == $row['fieldId'])? "checked": '';}?>>
											<span class="green-text text-darken-2"></span>
											</label>
									</td>
								</tr>
							<?php endforeach;?>
								</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="card-panel transparent floating">
					<div class="col s12 m12">
						<table class="table responsive-table highlight dataTable no-footer">
							<thead>
								<tr class="hide-on-med-and-down">
									<th><h5 class="grey-text text-darken-3"><i class="material-icons left">settings</i>Underhood/Chassis</h5></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($inspections->showFields('underhood/chasis') as $key => $row):?>
								<tr>
									<td><?=$row['fieldtxt']?></td>
									<td>
											<label>
											<span class="red-text text-darken-2"></span>
											<input type="checkbox" class="field-underhood" data-id="<?=$row['fieldId']?>" disabled <?php foreach ($underhood as $key => $value) { echo ($value == $row['fieldId'])? "checked": '';}?>>
											<span class="green-text text-darken-2"></span>
											</label>
									</td>
								</tr>
							<?php endforeach;?>
								</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="card-panel transparent floating">
					<div class="col s12 m12">
						<table class="table responsive-table highlight dataTable no-footer">
							<thead>
								<tr class="hide-on-med-and-down">
									<th><h5 class="grey-text text-darken-3"><i class="material-icons left">directions</i>Road Testing</h5></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($inspections->showFields('road') as $key => $row):?>
								<tr>
									<td><?=$row['fieldtxt']?></td>
									<td>
											<label>
											<span class="red-text text-darken-2"></span>
											<input type="checkbox" class="field-road" data-id="<?=$row['fieldId']?>" disabled <?php foreach ($road as $key => $value) { echo ($value == $row['fieldId'])? "checked": '';}?>>
											<span class="green-text text-darken-2"></span>
											</label>
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


		