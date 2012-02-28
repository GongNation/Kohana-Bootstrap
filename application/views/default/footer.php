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
	<script type="text/javascript" src="/media/plugin/path-menu/js/jquery.transform-0.9.3.min.js"></script>
	<script type="text/javascript" src="/media/plugin/path-menu/js/path-menu.js"></script>
	<?php foreach ($scripts as $script) echo HTML::script($script, NULL, NULL, TRUE), "\n" ?>
	<script type="text/javascript" src="/media/js/modernizr-2.5.2.custom.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(e) {
			var menu_all_in = new PathMenuObj('pathmenu',{
				'PathPosition': {position:'relative', top:0,right:0, width:40, height:40},
				'mainButton': [
					{'bg':'','css':'','cover':'/media/images/avatar-40x40.jpg','html':''},
					{'bg':'','css':'','cover':'','html':'','angle':-405,'speed':200}
				],
				'Button': {'bg':'','css':{width:40,height:40},'cover':'/media/images/avatar-40x40.jpg'},
				'itemButtons': [
					{'bg':'','css':'','cover':'<i class="icon-user icon-white"></i>','href':'#','target':''},
					{'bg':'','css':'','cover':'<i class="icon-cog icon-white"></i>','href':'/settings','target':''},
					{'bg':'','css':'','cover':'<i class="icon-map-marker icon-white"></i>','href':'#','target':''},
					{'bg':'','css':'','cover':'<i class="icon-picture icon-white"></i>','href':'#','target':''},
					{'bg':'','css':'','cover':'<i class="icon-pencil icon-white"></i>','href':'#','target':''},
					{'bg':'','css':'','cover':'<i class="icon-off icon-white"></i>','href':'/logout','target':''}
					//......
				],
				'ICount': 6,
				'AppendTo': '#system-menu-in',
				'Radius': 150
			});
			$('.cmd-frd .close').click(function(){
				$this = $(this);
				$this.parent().hide(); 
			});
		});
	</script>
  </body>
</html>
