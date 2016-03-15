<?php
	
/**
 * Copyright 2011 "kento" Karim Rahimpur - www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
abstract class Affiliates_Attributes implements I_Affiliates_Attributes { protected static $IXAP78; const IXAP54 = 'paypal_email'; const IXAP79 = 'referral.amount'; const IXAP80 = 'referral.amount.method'; const IXAP81 = 'referral.rate'; const IXAP82 = 'coupons'; public static function init() { self::$IXAP78 = array( self::IXAP54 => __( 'PayPal Email', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP79 => __( 'Referral Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP80 => __( 'Referral Amount Method', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP81 => __( 'Referral Rate', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP82 => __( 'Coupons', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } public static function get_keys() { return self::$IXAP78; } public static function validate_key( $IXAP74 ) { if ( key_exists( $IXAP74, self::$IXAP78 ) ) { return $IXAP74; } else { return false; } } public static function validate_value( $IXAP74, $IXAP83 ) { $IXAP84 = new Affiliates_Validator(); $IXAP15 = false; switch ( $IXAP74 ) { case self::IXAP54 : $IXAP15 = $IXAP84->validate_email( $IXAP83 ); break; case self::IXAP79 : case self::IXAP81 : $IXAP15 = $IXAP84->validate_amount( $IXAP83 ); break; case self::IXAP80 : $IXAP15 = Affiliates_Referral::is_referral_amount_method( $IXAP83 ); break; case self::IXAP82 : $IXAP83 = trim( $IXAP83 ); $IXAP85 = explode( ",", $IXAP83 ); $IXAP86 = array(); foreach( $IXAP85 as $IXAP87 ) { $IXAP87 = trim( $IXAP87 ); if ( !empty( $IXAP87 ) && !in_array( $IXAP87, $IXAP86 ) ) { $IXAP86[] = $IXAP87; } } $IXAP83 = implode( ",", $IXAP86 ); if ( !empty( $IXAP83 ) ) { $IXAP15 = $IXAP83; } break; } return $IXAP15; } } Affiliates_Attributes::init(); 