<?php

namespace NBE\WC;

use WC_Payment_Gateway;

class Payment_Gateway extends WC_Payment_Gateway {
	public function __construct() {
		$this->id                 = 'nbe_gateway'; // payment gateway plugin ID
		$this->icon               = ''; // URL of the icon that will be displayed on checkout page near your gateway name
		$this->has_fields         = false; // in case you need a custom credit card form
		$this->method_title       = __( 'NBE Payment Gateway', 'wc-nbe' );
		$this->method_description = __( 'Secure payments through national bank of egypt', 'wc-nbe' ); // will be displayed on the options page

		// gateways can support subscriptions, refunds, saved payment methods,
		$this->supports = array(
			'products',
			'refunds'
		);

		// Method with all the options fields
		$this->init_form_fields();

		// Load the settings.
		$this->init_settings();
		$this->title       = $this->get_option( 'title' );
		$this->description = $this->get_option( 'description' );

		// This action hook saves the settings
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array(
			$this,
			'process_admin_options'
		) );

		// We need custom JavaScript to obtain a token
		//add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
	}

	/**
	 * Plugin options
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled'     => array(
				'title'       => 'Enable/Disable',
				'label'       => 'Enable NBE Gateway',
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'yes'
			),
			'title'       => array(
				'title'       => 'Title',
				'type'        => 'text',
				'description' => 'This controls the title which the user sees during checkout.',
				'default'     => 'Credit Card',
				'desc_tip'    => true,
			),
			'description' => array(
				'title'       => 'Description',
				'type'        => 'textarea',
				'description' => 'This controls the description which the user sees during checkout.',
				'default'     => 'Pay with your credit card via our super-cool payment gateway.',
			)
		);
	}


}
