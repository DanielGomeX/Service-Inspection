<div class="container">
		<div class="row">
			<div class="col l8 offset-l2">
				<div class="login-panel center">
						<div class="col s10 m8  l10 offset-s1 offset-m2 offset-l1">
							<img class="login-logo" width="250" src="<?php URI::image('logos/default.png'); ?>">
							<div class="card  theme-grey-bg white-text floating">
								<div class="card-content">
									<form id="formLogin" method="POST" action="javascript:void(0);">
				   						<input type="hidden" name="controller" value="checkauth">
										<div class="center">
											<!-- LOGIN FIELDS -->
											<div class="row">
												<div class="input-field col s12 m10 offset-m1">
													<i class="material-icons prefix white-text">person_outline</i>
													<input id="username" name="username" type="text" class="validate">
													<label for="username">Username</label>
												</div>
												<div class="input-field col s12 m10 offset-m1">
													<i class="material-icons prefix white-text">lock_outline</i>
													<input id="password" name="password" type="password" class="validate">
													<label for="password">Password</label>
												</div>
											</div>
											<button class="btn btn-large waves-effect waves-light theme-yellow-bg" type="submit" name="action">Login
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
	</div>	