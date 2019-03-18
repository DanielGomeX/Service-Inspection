<?php
	include ('config/config.php');
	include('library/lib_customers.php');
	$customers = new lib_customers(); 
	$customerId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
	$customerDetails= (array) json_decode($customers->getCustomerRow($customerId));
?>

<div class="container">
	<div class="row">
		<div class="col s12 m8 offset-m2">
			<h3 class="center">Customer Form</h3>
			<p class="mute-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua.</p>
			<div class="card-panel transparent frosted floating">
				<div class="col s12 ">
					
					<div class="row">
						<form id="customerForm" method="post" action="javascript:void(0);">
							<input type="hidden" id="customerId" name="customerId" value="<?=$customerId;?>"> 
							<input type="hidden" name="controller" id="controller" value="updateInsert" class="customer-field">
							<div class="input-field col s12">
								<i class="material-icons prefix">person_outline</i>
								<input id="fullname" name="fullname" type="text" value="<?= (isset($customerDetails['fullname']) && !empty($customerDetails['fullname'])) ? $customerDetails['fullname']: null;?>" class="validate customer-field" required>
								<label for="fullname">Full Name</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">location_on</i>
								<input id="address" name="address" type="text" value="<?= (isset($customerDetails['address']) && !empty($customerDetails['address'])) ? $customerDetails['address']: null;?>" class="validate customer-field" required>
								<label for="address">Address</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">phone</i>
								<input id="contactNumber" name="contactNumber" type="text" value="<?= (isset($customerDetails['contactNumber']) && !empty($customerDetails['contactNumber'])) ? $customerDetails['contactNumber']: null;?>" class="validate customer-field" required>
								<label for="contactNumber">Contact Number</label>
							</div>
							<div class="row">
								<div class="col s12 center">
									<button type="submit" class="btn btn-large theme-grey-bg white-text waves-effect waves-light"><i class="material-icons left">save</i>Save</button>
								</div>
							</div>
						 </form>
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!--End Customerd Panel -->

		</div>
	</div>
</div>