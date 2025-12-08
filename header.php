<?php
/**
 * The header part of Mynote theme.
 *
 * @author Terry Lin
 * @link https://terryl.in/
 *
 * @package WordPress
 * @subpackage Mynote
 * @since 1.0.0
 * @version 2.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5029297274725451" crossorigin="anonymous"></script>
	<meta name="google-adsense-account" content="ca-pub-5029297274725451">
	<script async src="https://fundingchoicesmessages.google.com/i/pub-5029297274725451?ers=1"></script><script>(function() {function signalGooglefcPresent() {if (!window.frames['googlefcPresent']) {if (document.body) {const iframe = document.createElement('iframe'); iframe.style = 'width: 0; height: 0; border: none; z-index: -1000; left: -1000px; top: -1000px;'; iframe.style.display = 'none'; iframe.name = 'googlefcPresent'; document.body.appendChild(iframe);} else {setTimeout(signalGooglefcPresent, 0);}}}signalGooglefcPresent();})();</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<?php
		/**
		 * Hook: mynote_head
		 */
		do_action( 'mynote_head' );

		if ( is_single() ) {
			$thumbnail_url = get_the_post_thumbnail_url( null, 'large' );
			if ( $thumbnail_url ) {
				echo '<link rel="preload" href="' . esc_url( $thumbnail_url ) . '" as="image" />';
			}
		}

		wp_head();
	?>

</head>
<body <?php body_class( mynote_body_class() ); ?>>

	<?php wp_body_open(); ?>

	<?php
		/**
		 * Hook: mynote_header_after
		 */
		do_action( 'mynote_site_wrapper_before' );
	?>

	<div class="wrapper">

		<?php
			/**
			 * Hook: mynote_header_after
			 */
			do_action( 'mynote_header_before' );
		?>

		<header class="header clear" role="banner">
			<div class="container">

				<?php
					/**
					 * Hook: mynote_header
					 *
					 * @hooked mynote_header_navigation - 10
					 */
					do_action( 'mynote_header' );
				?>

			</div><!-- .container -->
		</header>

		<?php
			/**
			 * Hook: mynote_header_after
			 */
			do_action( 'mynote_header_after' );
		?>
