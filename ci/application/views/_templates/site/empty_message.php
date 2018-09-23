<?php //* Used to display empty messages or missing information messages
	//* Current example uses bootstrap 4.x
	$title = $title ?? 'Missing Information';
	$message = $message ?? 'Could not find the information you were looking for';
	$button = $button ?? NULL;
	$_button_text = '';
	$_button_link = '#';

	if(is_array($button) && !empty($button))
	{
		$_button_link = $button['link'] ?? $_button_link;
		$_button_text = $button['text'] ?? $_button_text;
	}
?>
<div class="jumbotron text-center">
	<?php if(!empty($title)): ?>
	<h3><?= $title; ?></h3>
	<?php endif;?>
	
	<p class="lead"><?= $message; ?></p>

	<?php if(!empty($_button_text)): ?>
	<a href="#" class="btn btn-large btn-primary"><?= $_button_text; ?></a>
	<?php endif;?>
</div>
