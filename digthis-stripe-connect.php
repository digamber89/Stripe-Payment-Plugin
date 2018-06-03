<?php
/*
 * Plugin Name: Digthis Stripe Connect
 */


require( 'vendor/autoload.php' );

function digthis_complete_transaction() {
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey( "sk_test_lEpDKQ1r7tpInW2RDcXJWziL" );

	// Token is created using Checkout or Elements!
	// Get the payment token ID submitted by the form:
	if ( ! isset( $_POST ) || empty( $_POST['stripeToken'] ) ) {
		return false;
	}
	$token = $_POST['stripeToken'];


	$charge = \Stripe\Charge::create( [
		'amount'      => 100,
		'currency'    => 'usd',
		'description' => 'Example charge',
		'source'      => $token,
	] );

	file_put_contents( plugin_dir_path( __FILE__ ) . 'log', var_export( $charge, true ) );
	die;

}
add_action( 'init', 'digthis_complete_transaction' );
