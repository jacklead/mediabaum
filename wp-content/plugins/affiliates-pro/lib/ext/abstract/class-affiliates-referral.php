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

	
abstract class Affiliates_Referral implements I_Affiliates_Referral { const IXAP13 = 'aff_def_ref_calc_key'; const IXAP14 = 'aff_def_ref_calc_value'; private $IXAP166 = null; private static $IXAP167 = array(); public static function init() { self::register_referral_amount_method( array( __CLASS__, 'example_referral_amount_method' ) ); } public static function example_referral_amount_method( $IXAP38 = null, $IXAP168 = null ) { $IXAP15 = "0"; if ( isset( $IXAP168['base_amount'] ) ) { $IXAP15 = bcmul( "0.1", $IXAP168['base_amount'] ); } return $IXAP15; } public static function register_referral_amount_method( $IXAP169 ) { $IXAP15 = false; if ( is_string( $IXAP169 ) ) { $IXAP169 = explode( "::", $IXAP169 ); if ( count( $IXAP169 ) == 1 ) { $IXAP169 = $IXAP169[0]; } } if ( in_array( $IXAP169, self::$IXAP167 ) ) { $IXAP15 = true; } else if ( ( ( is_array( $IXAP169 ) && ( count( $IXAP169 ) == 2 ) && method_exists( $IXAP169[0], $IXAP169[1] ) ) ) || ( is_string( $IXAP169 ) && function_exists( $IXAP169 ) ) ) { $IXAP23 = bcadd( "0", call_user_func( $IXAP169, null, null ) ); if ( $IXAP23 !== false ) { self::$IXAP167[] = $IXAP169; $IXAP15 = true; } } return $IXAP15; } public static function get_referral_amount_methods() { return self::$IXAP167; } public static function is_referral_amount_method( $IXAP169 ) { return self::get_referral_amount_method( $IXAP169 ); } public static function get_referral_amount_method( $IXAP169 ) { $IXAP170 = @unserialize( $IXAP169 ); if ( $IXAP170 !== false ) { $IXAP169 = $IXAP170; } if ( is_string( $IXAP169 ) ) { $IXAP169 = explode( "::", $IXAP169 ); if ( count( $IXAP169 ) == 1 ) { $IXAP169 = $IXAP169[0]; } } if ( in_array( $IXAP169, self::$IXAP167 ) ) { return $IXAP169; } else { return false; } } } Affiliates_Referral::init(); 