<?php
    $show_button = $show_button ?? TRUE;
?>

<nav class="navbar nav-light text-white ml-2 top-nav">
	<div class="nav-item">
		<a class="text-dark home-link nav-link" href="<?= site_url(); ?>"><i class="icon-home"></i></a>
	</div>
	<div class="nav-item ml-auto mr-sm-4">
		<a class="nav-link text-white" role="button" href="http://localhost/flirt/public/testimonials">TESTIMONIALS</a>
	</div>

	<?php if($show_button): ?>
	<div class="nav-item mr-2">
		<a class="btn btn-dark btn-sm nav-link" role="button" href="<?= site_url('book'); ?>">GET THE BOOK</a>
	</div>
	<?php endif; ?>
</nav>
