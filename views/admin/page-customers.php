<?php
	include ('config/config.php');
	include('library/lib_customers.php');
	$customers = new lib_customers(); $x = 1; 
?>

<div class="container">
	<div class="row">
		<div class="col s12">
			<div class="valign-wrapper">
				<div class="col s8 m6">
					<h3 class="valign-wrapper grey-text text-darken-3"><i class="material-icons medium left">person_outline</i>Customers</h3>
				</div>
				<div class="col s4 m6">
					<a href="?p=form-customer" class="btn btn-large waves-effect waves-light  theme-grey-bg white-text right hide-on-small-only"><i class="material-icons left">person_add</i>New Customer</a>
					
				</div>
			</div>
			<div class="card-panel transparent frosted floating">
				<div class="col s12">
					<div class="row">
						<table class="table responsive-table highlight dataTable no-footer">
							<thead>
								<tr class="hide-on-med-and-down">
										<th>No.</th>
										<th style="width: 60%;">Customer</th>
										<th class="center">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($customers->showCustomers() as $key => $row): ?>
											<tr id="row<?=$row['customerId'] ?>">
												<td><?=$x++;?></td>
												<td style="width: 60%;">
													<p class="blue-text text-darken-4 bold"><a href="?p=customer&id=<?=$row['customerId'];?>" class="tooltipped"  data-position="right" data-tooltip="View Profile"><?=$row['fullname'] ?></a></p>
													<p><i class="material-icons left grey-text text-darken-3">location_on</i><?=$row['address'] ?></p>
													<p><i class="material-icons left grey-text text-darken-3">phone</i><?=$row['contactNumber'] ?></p>
												</td>
											
												<td class="center">
														<a href="?p=form-customer&id=<?=$row['customerId'];?>" class="btn theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">edit</i>Edit</a>
														<button class="btn red lighten-1 waves-effect waves-red customer-delete-btn" data-id="<?=$row['customerId'] ?>"><i class="material-icons left">delete</i>Delete</button>
													</div>
												</td>
											</tr>
									<?php endforeach;?>
								</tbody>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!--End Customerd Panel -->
		</div>
	</div>
</div>
<div class="fixed-action-btn">
	<a href="?p=form-customer" class="btn btn-floating pulse btn-large waves-effect waves-light  theme-grey-bg white-text right hide-on-med-and-up show-on-small "><i class="material-icons left">person_add</i></a>
 </div>