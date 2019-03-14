<div class="container">
		<div class="row">
			<div class="col l8 offset-l2">
				<div class="login-panel center">
						<img class="login-logo" width="250" src="<?php URI::image('logos/default.png'); ?>">
						<div class="col s10 m8  l10 offset-s1 offset-m2 offset-l1">
							<div class="card-panel grey lighten-3">
								<form id="formLogin" method="POST" action="login.php">
			   						<input type="hidden" name="controller" value="checkauth">
									<div class="container center">
										<!-- LOGIN FIELDS -->
										<div class="row">
											<div class="input-field col s12">
												<input id="username" name="username" type="text" class="validate">
												<label for="username">Username</label>
											</div>
											<div class="input-field col s12">
												<input id="password" name="password" type="password" class="validate">
												<label for="password">Password</label>
											</div>
										</div>
										<button class="btn btn-large waves-effect waves-light theme-blue-bg white-text" type="submit" name="action">Submit
											<i class="material-icons right">send</i>
										</button>
									</div>
								</form>
							</div>
						</div>
						
				</div>
			</div>
		</div>
	</div>	