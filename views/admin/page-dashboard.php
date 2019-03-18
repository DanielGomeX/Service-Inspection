<?php include ('config/config.php'); ?>
<?php include('library/lib_global.php');
 include('library/lib_inspections.php');
$global = new lib_global(); 
$inspections = new lib_inspections(); 
$x = 1;?>

<div class="container">
	<div class="valign-wrapper">
		<div class="col s12">
			<h3 class="valign-wrapper grey-text text-darken-3"><i class="material-icons medium left">home</i>Dashboard</h3>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m4">
			<a href="?p=customers">
				<div class="card-panel theme-grey-bg white-text">
					<h1 class="center"><?=$global->countAllActive('customers')?></h1>
					<p class="center"><i class="material-icons" style="position: relative;top: 5px;">person_outline</i>&nbsp;Customers</p>
				</div>
			</a>
		</div>
		<div class="col s12 m4">
			<a href="?p=cars">
				<div class="card-panel theme-grey-bg white-text">
					<h1 class="center"><?=$global->countAllActive('cars')?></h1>
					<p class="center"><i class="material-icons" style="position: relative;top: 5px;">directions_car</i>&nbsp;Enlisted Cars</p>
				</div>
			</a>
		</div>
		<div class="col s12 m4">
			<div class="card-panel theme-grey-bg white-text">
				<h1 class="center"><?=$global->countAllActive('inspections')?></h1>
				<p class="center"><i class="material-icons" style="position: relative;top: 5px;">settings</i>&nbsp;Inspections</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="card-panel transparent frosted floating">
				<div class="col s12">
					<div class="row">
						<table class="table responsive-table highlight dataTable no-footer">
							<thead>
								<tr class="hide-on-med-and-down">
										<th>No.</th>
										<th>Inspection</th>
										<th>Owner</th>
										<th>Date Inspected</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($global->inspectionBoard() as $key => $row): ?>
											<tr id="row<?=$row['inspectionId'] ?>">
												<td><?=$x++;?></td>
												<td>
													<p class="blue-text text-darken-4 bold"><a href="?p=inspection&id=<?=$row['inspectionId'];?>" class="tooltipped"  data-position="right" data-tooltip="View Profile">INSPCT#<?=$row['inspectionId'] ?></a></p>
													<p><i class="material-icons left grey-text text-darken-3">directions_car</i><?=$row['plateNumber'] ?></p>
												</td>
												<td>
													<a href="?p=customer&id=<?=$row['customerId'] ?>"><i class="material-icons left grey-text text-darken-3">person_outline</i><?=$row['fullname'] ?></a>
												</td>
												<td>
														<p><i class="material-icons left grey-text text-darken-3">access_time</i>
															<time class="timeago" datetime="<?=$row['dateCreated'] ?>"><?=$row['dateCreated'] ?></time>
														</p>
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