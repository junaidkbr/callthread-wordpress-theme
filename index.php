<div class="container-fluid">
	<?php
   get_header();
	?>
	<main id="primary" class="site-main">
		<section class="hero-section">
			<div class="col col-1">
				<div class="hero-section__content">
					<h1 class="hero-section__heading">Lorem ipsum dolor sit amet, consectetur</h1>
					<p class="hero-section__desc">We make it easy to buy, manage and measure calls to your businessall in one place.</p>
					<div class="hero-section__button-group">
						<a href="#" class="btn btn--orange">Sign up</a>
						<a href="#" class="btn btn--outlined-white">Become a Publisher</a>
					</div>
				</div>
			</div>
			<div class="col col-2">
				<div class="hero-section__image">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/banner-main-img.svg'; ?>" alt="hamburger-icon" class="w-full">
				</div>
			</div>
		</section>

		<section class="learn-section">
			<div class="learn-section__container">
				<h2 class="section-title">Buy calls and generate new leads</h2>
				<p class="section-desc">Get more out of your marketing spend with CallThread’s call tracking platform. Reserve clean numbers, quickly and easily configure them for your campaigns, and start tracking.</p>
				<a href="#" class="btn btn--blue">Learn More</a>
			</div>

			<div class="learn-section__main-img">
				<img src="<?php echo get_template_directory_uri() . '/assets/images/learn-main-img.png'; ?>" alt="img" class="w-full">
			</div>
		</section>

		<section class="value-section pull-up">
			<div class="card-wrapper container">
				<div class="card-wrapper__card">
					<div class="card-wrapper__img center">
						<img src="<?php echo get_template_directory_uri() . '/assets/images/label.png'; ?>" alt="img" >
					</div>
					<div class="card-wrapper__content">
						<h3>Value proposition goes here</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut dolor sit amet</p>
					</div>
				</div>
				<div class="card-wrapper__card">
					<div class="card-wrapper__img center">
						<img src="<?php echo get_template_directory_uri() . '/assets/images/label.png'; ?>" alt="img" >
					</div>
					<div class="card-wrapper__content">
						<h3>Value proposition goes here</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut dolor sit amet</p>
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->
</div>
<?php
get_footer();
