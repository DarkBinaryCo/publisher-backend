<div id="book-bg" class="bg-img mvh-100">
	<?php $this->load->view('_templates/partials/top_nav',['show_button'=>FALSE]); ?>
	<div class="d-flex justify-content-center align-items-center bg-overlay"
		>
		<div class="d-flex align-items-center order-12">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-6 d-xl-flex d-none d-md-block"><img
							class="img-fluid d-flex ml-auto mr-4 cover-img" src="assets/img/cover.jpg" height=""></div>
					<div class="col-12 col-md-6 d-md-flex d-xl-flex flex-column justify-content-center">
						<div>
							<h1 class="text-center cta-text">It's time to&nbsp;<span
									class="text-black">upgrade</span>&nbsp;your game</h1>
						</div>
						<p class="text-center mb-4 cta-description">The ultimate guide to get her to do what you
							want<br></p>

						<form id="formOrderBook" action="<?= site_url('thanks'); ?>">
							<div class="form-group"><input type="email" placeholder="Email address" id="inputBuyerEmail" required><small
									class="text-white o-75">We will send the book to this email</small>
							</div>
							<div class="form-group"><input type="tel" placeholder="Mpesa number"
									id="inputMpesaPhone" required><small class="text-white o-75">Mpesa number you'd like to use
									to purchase the book</small>
							</div>
							<div><button class="btn btn-dark btn-cta" type="submit" id="btnGetBook ">GET THE BOOK -
									<small class="text-muted">KSH.</small> <strike class="text-warning">799</strike>
									599\=</button></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('_templates/partials/footer'); ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
