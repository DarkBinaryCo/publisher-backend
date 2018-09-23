<?php //* Used as template for displaying document contents ~ html may change depending on css framework used
	//* Current example uses bootstrap 4.x
	$document_title = $document_title ?? 'Document Title'; 
	$document_body = $document_body ?? '<p>Empty document body</p>';
?>
<div class="container">
	<div class="card shadow-sm">
		<div class="card-body p-4 p-sm-5">
			<h3><?= $document_title; ?></h3>
			<?= $document_body; ?>
		</div>
	</div>
</div>
