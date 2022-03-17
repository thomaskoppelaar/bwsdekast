<?php

	set_include_path('./_protected' . PATH_SEPARATOR . './_protected/classes');
	spl_autoload_register();

	Config::get('bootstrap');
	$page = new Page();
	$page->determine((string) substr($_SERVER['REQUEST_URI'], 1));
	$page->headers();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/css/bws.css" />
		<title>BWS thuispagina &ndash; <?php echo Util::h($page->info['title']); ?></title>
		<meta name="description" content="De Kast houdt al sinds jaar en dag de studentikoze naam der VGSD hoog" />
		<meta name="keywords" content="BWS, VGSD, studenten, Buitenwatersloot, Delft, studentikoos" />
	</head>
	<body>
		<div id="container">
			<header>
				<h1>Buitenwatersloot 25</h1>
				<!--<h2><?php echo Util::h($page->info['title']); ?></h2>-->
			</header>

			<div class="row">
				<?php $page->includeMixin('menu'); ?>

				<div id="content">
					<?php $page->includePage(); ?>
				</div>
			</div>

			<?php $page->includeMixin('footer'); ?>
		</div>
	</body>
</html>