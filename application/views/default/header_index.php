<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]--> 
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]--> 
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]--> 
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]--> 
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]--> 
  <head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Kohana-Bootstrap">
	<meta name="author" content="GongNation">
	<!-- Styles --> 
	<link type="text/css" href="/media/plugin/jquery-ui/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
	<link type="text/css" href="/media/plugin/bootstrap/css/bootstrap.css" rel="stylesheet">
	<!-- bootstrap-responsive.css 用于在多平台设备的自适应 
	<link type="text/css" href="/media/plugin/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	-->
	<link type="text/css" href="/media/css/base.css" rel="stylesheet">
	<!-- icon -->
	<link type="image/x-icon" href="/media/images/favicon.ico" rel="shortcut icon" />
	<link href="/media/images/apple-touch-icon.png" rel="apple-touch-icon">
	<link href="/media/images/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon" >
	<link href="/media/images/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon" >
  </head>
  <body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="/">Kohana-Bootstrap</a>
				<ul class="nav pull-right">
					<li class="dropdown" id="fat-menu">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo __('language:English') ?><b class="caret"></b></a>
						<ul class="dropdown-menu language-list">
						<?php foreach ($languages as $lang => $language) { ?>
							<li><a href="?lang=<?php echo $lang ?>" title="<?php echo $language ?>"><?php echo $language ?></a></li>
						<?php } ?>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
