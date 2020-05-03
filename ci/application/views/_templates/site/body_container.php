<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>How to Flirt - Get any woman you want</title>
	<meta name="twitter:card" content="summary">
	<meta name="twitter:description" content="Women can be complicated, but what attracts them to you isn't. This book teaches you how to get any woman you want regardless of how you look or how much money you have.
#flirtguide">
	<meta property="og:image" content="<?= asset_url('img/cover.jpg'); ?>">
	<meta name="description"
		content="Women can be complicated, but what attracts them to you isn't. This book teaches you how to get any woman you want regardless of how you look or how much money you have.">
	<meta property="og:type" content="website">
	<meta name="twitter:image" content="<?= asset_url('img/cover.jpg'); ?>">
	<meta name="twitter:title" content="How to flirt - Get any woman you want">
	<link rel="icon" type="image/png" sizes="512x512" href="<?= asset_url('img/school.png'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
	<link rel="stylesheet" href="<?= asset_url('css/styles.min.css'); ?>">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<!-- Footer scripts go here -->
	<?= $footer_scripts ?? '' ?>
</body>

</html>