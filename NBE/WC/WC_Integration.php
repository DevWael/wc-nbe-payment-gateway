<?php


namespace NBE\WC;


class WC_Integration {
	/**
	 * This action hook registers our PHP class as a WooCommerce payment gateway
	 */
	public function gate_way_class( $gateways ) {
		$gateways[] = 'NBE\WC\Payment_Gateway';

		return $gateways;
	}
}
