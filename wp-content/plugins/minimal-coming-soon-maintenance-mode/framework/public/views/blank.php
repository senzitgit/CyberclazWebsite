<?php

/**
 * Renders the blank template for the plugin.
 *
 * @link       http://www.69signals.com
 * @since      1.0
 * @package    Signals_Maintenance_Mode
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $options['title']; ?></title>
<?php if ( ! empty( $options['favicon'] ) ) : ?>
<link rel="shortcut icon" href="<?php echo esc_url_raw( $options['favicon'] ); ?>" />
<?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo SIGNALS_CSMM_URL; ?>/framework/public/css/basic.css" />
<script src='//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js'></script>
<script>
	WebFont.load( {
		google: {
			families: ['<?php echo $options["header_font"]; ?>', '<?php echo $options["secondary_font"]; ?>']
		}
	} );
</script>
<?php

	// user defined css for the blank mode
	if ( ! empty( $options['custom_css'] ) ) {
		echo '<style>' . "\r\n";
		echo stripslashes( $options['custom_css'] ) . "\r\n";
		echo '</style>' . "\r\n";
	}

?>
</head>
<body>
	<?php

		// Custom html
		// Nothing else will be included here since we are serving a blank template
		$custom_html = stripslashes( $options['custom_html'] );

		if ( ! empty( $custom_html ) && false !== strpos( $custom_html, '{{form}}' ) ) {
			if ( ! empty( $options['mailchimp_api'] ) && ! empty( $options['mailchimp_list'] ) ) {
				// Checking if the form is submitted or not
				if ( isset( $_POST['signals_email'] ) ) {
					// Processing begins
					$signals_email = strip_tags( $_POST['signals_email'] );

					if ( '' === $signals_email ) {
						$code 		= 'danger';
						$response 	= __( 'Please provide your email address.', 'signals' );
					} else {
						$signals_email = filter_var( strtolower( trim( $signals_email ) ), FILTER_SANITIZE_EMAIL );

						if ( strpos( $signals_email, '@' ) ) {
							require_once SIGNALS_CSMM_PATH . '/framework/admin/include/classes/class-mailchimp.php';

							$signals_connect 	= new MailChimp( $options['mailchimp_api'] );
							$signals_response 	= $signals_connect->call( 'lists/subscribe', array(
								'id'            => $options['mailchimp_list'],
								'email'         => array( 'email' => $signals_email ),
								'double_optin'  => false,
								'send_welcome'  => true
							) );


							// Showing message as per the response from the mailchimp server
							if ( isset( $signals_response['code'] ) && 214 !== $signals_response['code'] ) {
								$code 		= 'danger';
								$response 	= __( 'Oops! Something went wrong.', 'signals' );
							} elseif ( isset( $signals_response['code'] ) && 214 === $signals_response['code'] ) {
								$code 		= 'success';
								$response 	= __( 'You are already subscribed!', 'signals' );
							} else {
								$code 		= 'success';
								$response 	= __( 'Thank you! We\'ll be in touch!', 'signals' );
							}
						} else {
							$code 			= 'danger';
							$response 		= __( 'Please provide a valid email address.', 'signals' );
						}
					}
				} // signals_email

				// Subscription form
				// Displaying errors as well if they are set
				$subscription_form = '<div class="subscription">';

				if ( isset( $code ) && isset( $response ) ) {
					$subscription_form .= '<div class="signals-alert signals-alert-' . $code . '">' . $response . '</div>';
				}

				$subscription_form .= '<form role="form" method="post">
					<input type="text" name="signals_email" placeholder="' . esc_attr( $options['input_text'] ) . '">
					<input type="submit" name="submit" value="' . esc_attr( $options['button_text'] ) . '">
				</form>';
				$subscription_form .= '</div>';

				// Replacing the form placeholder
				$custom_html = str_replace( '{{form}}', $subscription_form, $custom_html );
			} // mailchimp_api && mailchimp_list
		} // custom_html

		// Output the user defined html
		echo $custom_html;

	?>


	<!-- Maintenance Mode Plugin by 69signals (http://www.69signals.com) -->
	<!-- We are a creative digital agency. We love to weave the web, simple but amazing. We create flawless web and mobile applications. -->
</body>
</html>