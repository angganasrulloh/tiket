<center>
			<div class="row-fluid">
				<div class="well span5 center login-box" style="width:500px; text-align:center;">
					<div class="alert alert-info">
			  Silahkan login dengan Username dan Password anda
					</div>
					<form class="form-horizontal" action="log.php?op=in" method="post" name="loginform">
                    <input type="hidden" name="form_name" value="loginform">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<div class="input-group">
									<span class="input-group-addon">User Name</span>
                                	<input autofocus class="form-control" name="username" id="user" type="text" placeholder="Username" />
                                </div>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
                            	<div class="input-group">
									<span class="input-group-addon">Password&nbsp;&nbsp;</span>
                                    <input class="form-control" name="pass" id="pass" type="password" placeholder="Password" />
                            	</div>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" value="rememberme"/>
							Ingatkan saya</label></div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button name="login" type="submit" class="btn btn-primary">Login</button> 
							<a class="btn btn-danger"  href="?page=index"> Kembali </a>
						  </p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
</center>