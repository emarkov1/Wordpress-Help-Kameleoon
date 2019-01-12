<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package mise
 */

get_header(); ?>
<style>
	#page{
		margin-top: 90px;
		padding-left: 20px;
	}
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">Oops ! That page can't be found.</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>Maybe try one of our categories or a search?</p>

					<?php
						get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
		<script>
		if(document.location.href.match('/de/')){
			document.querySelector('.error-404 .page-title').innerHTML = 'Oops ! Diese Seite kann nicht gefunden werden.';
			document.querySelector('.error-404 .page-content > p').innerHTML = 'Es sieht so aus, als wäre an diesem Ort nichts gefunden worden. Vielleicht versuchen Sie einen der links unten oder eine Suche?';
		}else if( document.location.href.match('/fr/') ){
			document.querySelector('.error-404 .page-title').innerHTML = "Oups ! Cet article n'a pas l'air d'exister";
			document.querySelector('.error-404 .page-content > p').innerHTML = 'Vous pouvez effectuer une recherche ci-dessous ou visiter nos catégories.';
		}

		</script>

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
