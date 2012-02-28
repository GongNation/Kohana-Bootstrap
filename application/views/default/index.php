		<div class="hero-unit welcome-page">
			<div class="row">
				<div class="span8">
					<div class="carousel slide" id="welcome-Carousel">
						<div class="carousel-inner">
							<div class="item active">
								<img alt="" src="/media/images/welcome-item-1.jpg">
								<div class="carousel-caption">
									<h4>Hello World!</h4>
									<p><?php echo __('Welcome to Kohana-Bootstrap') ?></p>
								</div>
							</div>
							<div class="item">
								<img alt="" src="/media/images/welcome-item-2.jpg">
								<div class="carousel-caption">
									<h4>Hello World2!</h4>
									<p><?php echo __('Welcome to Kohana-Bootstrap') ?></p>
								</div>
							</div>
							<div class="item">
								<img alt="" src="/media/images/welcome-item-3.jpg">
								<div class="carousel-caption">
									<h4>Hello World3!</h4>
									<p><?php echo __('Welcome to Kohana-Bootstrap') ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="span4 pull-right">
					<form method="post" action="<?php echo Kohana::$base_url.Route::get('index')->uri(array('action' => 'login')) ?>" class="form-horizontal span3 form-actions form-login pull-right">
						<div class="control-group">
							<div class="input-prepend" id="login-input-login">
								<span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="login" autocomplete="off" placeholder="<?php echo __('Username or Email')?>">
							</div>
						</div>
						<div class="control-group">
							<div class="input-prepend" id="login-input-password">
								<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" autocomplete="off" placeholder="<?php echo __('Password')?>">
							</div>
						</div>
						<div class="control-group">
							<div class="pull-left">
								<label class="checkbox pull-left"><input type="checkbox" name="remember" value="true"><?php echo __('Remember me')?></label>&nbsp;·&nbsp;<a href="#"><?php echo __('Forget password?')?></a>
							</div>
							<button type="submit" class="btn btn-primary pull-right"><?php echo __('Log in')?></button>
						</div>
					</form>
					<form method="post" action="<?php echo Kohana::$base_url.Route::get('index')->uri(array('action' => 'signup')) ?>" class="form-horizontal span3 form-actions form-signup pull-right">
						<div class="control-group">
							<div class="input-prepend" id="signup-input-username">
								<span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" autocomplete="off" placeholder="<?php echo __('Username')?>">
							</div>
						</div>
						<div class="control-group">
							<div class="input-prepend" id="signup-input-email">
								<span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="email" autocomplete="off" placeholder="<?php echo __('Email')?>">
							</div>
						</div>
						<div class="control-group">
							<div class="input-prepend" id="signup-input-password">
								<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" autocomplete="off" placeholder="<?php echo __('Password')?>">
							</div>
						</div>
						<div class="control-group"><button type="submit" class="btn btn-success pull-right"><?php echo __('Sign up')?></button></div>
					</form>
				</div>
			</div>
		</div>
