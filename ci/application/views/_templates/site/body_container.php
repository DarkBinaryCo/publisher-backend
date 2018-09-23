<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="<?= asset_url('favicon.ico');?>"/>
	<title><?= @$page_title; ?></title>

	<!-- Header scripts go here -->
	<?= $header_scripts ?? '' ?>

</head>
<body>
<?php if(!empty($header_content)): ?>
<header>
<?= $header_content; ?>
</header>
<?php endif;?>

<main>
<?= $page_content ?? ''; ?>
</main>

<?php if(!empty($footer_content)): ?>
<footer>
<?= $footer_content; ?>
</footer>
<?php endif;?>

<!-- Footer scripts go here -->
<?= $footer_scripts ?? '' ?>
</body>
</html>

