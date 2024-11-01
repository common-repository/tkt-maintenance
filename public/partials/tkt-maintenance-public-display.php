<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.tukutoi.com/
 * @since      1.0.0
 *
 * @package    Tkt_Maintenance
 * @subpackage Tkt_Maintenance/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?php wp_head(); ?>

		<style>

			/*There is no other way to load a Dynamic URL saved in WordPress Options into CSS*/
			.tkt-maintenance-bgimg {
				background-image: url( <?php echo esc_url( get_option( $this->plugin_short . '_image', '' ) ); ?> );
			}

		</style>

	</head>

	<body class="tkt-maintenance">

		<div class="tkt-maintenance-bgimg">

			<div class="tkt-maintenance-topleft">

				<img src="<?php echo esc_url( get_option( $this->plugin_short . '_logo', '' ) ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"/>

			</div>

			<div class="tkt-maintenance-middle">

				<h1><?php echo esc_html( get_option( $this->plugin_short . '_header', '' ) ); ?></h1>
				<hr class="tkt-maintenance">
				<p id="tkt-maintenance-timer"></p>

			</div>

			<div class="tkt-maintenance-bottomleft">

				<p><?php echo esc_html( get_option( $this->plugin_short . '_footer', '' ) ); ?></p>

			</div>

		</div>

		<?php

			wp_footer();

		?>

	</body>
	
</html>
