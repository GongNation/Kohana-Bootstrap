		<div class="footer">
			<p>
				<a href="/about" title="<?php echo __('About') ?>"><?php echo __('About') ?></a>&nbsp;·
				<a href="/contact" title="<?php echo __('Contact') ?>"><?php echo __('Contact') ?></a>&nbsp;·
				<a href="/jobs" title="<?php echo __('Jobs') ?>"><?php echo __('Jobs') ?></a>&nbsp;·
				<a href="/service" title="<?php echo __('Service') ?>"><?php echo __('Service') ?></a>&nbsp;·
				<a href="/privacy" title="<?php echo __('Privacy') ?>"><?php echo __('Privacy') ?></a>&nbsp;·
				<a href="/feedback" title="<?php echo __('Feedback') ?>"><?php echo __('Feedback') ?></a>&nbsp;·
				&copy; Kohana-Bootstrap 2012
			</p>
		</div>
	</div><!-- /container -->
	
	<!--scripts-->
	<script type="text/javascript" src="/media/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/media/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="/media/plugin/bootstrap/js/bootstrap.js"></script>
	<?php foreach ($scripts as $script) echo HTML::script($script, NULL, NULL, TRUE), "\n" ?>
	<script type="text/javascript" src="/media/js/modernizr-2.5.2.custom.min.js"></script>
	<!-- customer scripts -->
	<script>
		$(function(){
			$('.carousel').carousel();
			$('#welcome-Carousel').carousel({
				interval: 5000
			});
<?php
// 登录出错提示
if (isset($login_error) AND $login_error !== FALSE) 
{
	switch ($login_error)
	{
		case 1:
			$login_error_id = "#login-input-login";
			$login_error_title = __('Email dose not exists!');
			$login_error_input = ".form-login input[name='login']";
		break;
		
		case 2:
			$login_error_id = "#login-input-login";
			$login_error_title = __('Username dose not exists!');
			$login_error_input = ".form-login input[name='login']";
		break;
		
		case 3:
			$login_error_id = "#login-input-password";
			$login_error_title = __('Password is incorrect!');
			$login_error_input = ".form-login input[name='password']";
		break;
	}
?>
			$('<?php echo $login_error_id ?>').tooltip({
				placement: 'left',
				title: '<?php echo $login_error_title ?>',
				trigger: 'manual'
			});
			$('<?php echo $login_error_id ?>').tooltip('show');
			$("<?php echo $login_error_input ?>").focus(function(){
				$('<?php echo $login_error_id ?>').tooltip('hide');
			});
<?php
}
// 注册出错提示
if (isset($signup_error) AND $signup_error !== FALSE) 
{
	switch ($signup_error)
	{
		case -1:
?>
			$('#signup-input-username').tooltip({
				placement: 'left',
				title: '<?php echo __('Username has been registered!') ?>',
				trigger: 'manual'
			});
			$('#signup-input-username').tooltip('show');
			$('.form-signup input[name="username"]').focus(function(){
				$('#signup-input-username').tooltip('hide');
			});
<?php
		break;
		
		case -2:
?>
			$('#signup-input-email').tooltip({
				placement: 'left',
				title: '<?php echo __('Email has been registered!') ?>',
				trigger: 'manual'
			});
			$('#signup-input-email').tooltip('show');
			$('.form-signup input[name="email"]').focus(function(){
				$('#signup-input-email').tooltip('hide');
			});
<?php
		break;
		
		case -3:
?>
			$('#signup-input-username').tooltip({
				placement: 'left',
				title: '<?php echo __('Username has been registered!') ?>',
				trigger: 'manual'
			});
			$('#signup-input-username').tooltip('show');
			$('.form-signup input[name="username"]').focus(function(){
				$('#signup-input-username').tooltip('hide');
			});
			
			$('#signup-input-email').tooltip({
				placement: 'left',
				title: '<?php echo __('Email has been registered!') ?>',
				trigger: 'manual'
			});
			$('#signup-input-email').tooltip('show');
			$('.form-signup input[name="email"]').focus(function(){
				$('#signup-input-email').tooltip('hide');
			});
<?php
		break;
	}
}
?>
		});
	</script>
  </body>
</html>
