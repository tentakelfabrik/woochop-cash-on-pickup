<?php

/*
Plugin Name:       WooChop - Cash On Pickup
Plugin URI:        https://wordpress.org/plugins/woochop-cash-on-pickup/
Description:       A WooCommerce Extension that adds the payment gateway "Cash On Pickup"
Version:           2.0
Author:            Björn Hase
Author URI:        https://tentakelfabrik.de
Text Domain:       woochop-cash-on-pickup
Domain Path:       /i18n
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
GitHub Plugin URI: https://github.com/tentakelfabrik/woochop-cash-on-pickup
WC tested up to:   3.4
*/

/**
 * WooChop - Cash On Pickup
 * Copyright (C) 2013-2014 Pinch Of Code. All rights reserved.
 * Copyright (C) 2017-2018 Marian Kadanka. All rights reserved.
 * Copyright (C) 2020 Björn Hase, Tentakelfabrik. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

define('WOOCHOP_CASH_ON_PICKUP_ID', 'woochop_cash_on_pickup');

/**
 *  Start the plugin
 *
 */
function woochop_cash_on_pickup_init()
{
	global $woocommerce;

	if (!isset($woocommerce)) {
		return;
	}

	require_once('classes/class.woochop_gateway_cash_on_pickup.php');
}
add_action('plugins_loaded', 'woochop_cash_on_pickup_init');

/**
 *  Add WooChop WooCommerce payment gateways
 *
 *  @param $methods
 *  @return array
 *
 */
function woochop_cash_on_pickup_register_gateway($methods)
{
	$methods[] = 'WooChop_Gateway_Cash_On_Pickup';
	return $methods;
}
add_filter('woocommerce_payment_gateways', 'woochop_cash_on_pickup_register_gateway');

/**
 *  Uninstall the plugin
 *
 */
function woochop_cash_on_pickup_uninstall()
{
    delete_option('woocommerce_'.WOOCHOP_CASH_ON_PICKUP_ID.'_settings');
}
register_uninstall_hook(__FILE__, 'woochop_cash_on_pickup_uninstall');