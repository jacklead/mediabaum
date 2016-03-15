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

	
class Affiliates_Validator implements I_Affiliates_Validator { public static function validate_amount( $IXAP23 ) { $IXAP15 = null; if ( preg_match( "/([0-9,]+)?(\.[0-9]+)?/", $IXAP23, $IXAP24 ) ) { if ( isset( $IXAP24[1] ) ) { $IXAP25 = str_replace(",", "", $IXAP24[1] ); } else { $IXAP25 = "0"; } if ( isset( $IXAP24[2] ) ) { $IXAP26 = substr( $IXAP24[2], 1, AFFILIATES_REFERRAL_AMOUNT_DECIMALS ); } else { $IXAP26 = "0"; } if ( isset( $IXAP24[0] ) && sizeof( $IXAP24 > 1 ) && ( isset( $IXAP24[1] ) || isset( $IXAP24[2] ) ) ) { $IXAP15 = $IXAP25 . "." . $IXAP26; } } return $IXAP15; } public static function validate_email( $IXAP27 ) { $IXAP15 = false; $IXAP28 = filter_var( $IXAP27, FILTER_VALIDATE_EMAIL ); if ( ( $IXAP28 !== false ) && ( $IXAP28 === $IXAP27 ) ) { $IXAP15 = $IXAP28; } return $IXAP15; } } 