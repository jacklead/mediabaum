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

	
 abstract class Affiliates_Affiliate implements I_Affiliates_Affiliate { public static function get_affiliate( $IXAP38 ) { global $affiliates_db; $IXAP43 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP24 = $affiliates_db->get_objects( "SELECT * FROM $IXAP43 WHERE affiliate_id = %d", $IXAP38 ); if ( !empty( $IXAP24 ) ) { return $IXAP24[0]; } else { return null; } } public static function get_affiliate_user_id( $IXAP38 ) { global $affiliates_db; $IXAP43 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP44 = $affiliates_db->get_tablename( 'affiliates_users' ); return $affiliates_db->get_value( "SELECT $IXAP44.user_id FROM $IXAP44 LEFT JOIN $IXAP43 ON $IXAP44.affiliate_id = $IXAP43.affiliate_id WHERE $IXAP44.affiliate_id = %d AND $IXAP43.status ='active'", intval( $IXAP38 ) ); } public static function get_user_affiliate_id( $IXAP9 = null ) { global $affiliates_db; $IXAP15 = false; if ( $IXAP9 !== null ) { $IXAP43 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP44 = $affiliates_db->get_tablename( 'affiliates_users' ); if ( $IXAP38 = $affiliates_db->get_value( "SELECT $IXAP44.affiliate_id FROM $IXAP44 LEFT JOIN $IXAP43 ON $IXAP44.affiliate_id = $IXAP43.affiliate_id WHERE $IXAP44.user_id = %d AND $IXAP43.status ='active'", intval( $IXAP9 ) ) ) { $IXAP15 = $IXAP38; } } return $IXAP15; } public static function get_attribute( $IXAP38, $IXAP74 ) { global $affiliates_db; $IXAP83 = null; if ( $IXAP74 = Affiliates_Attributes::validate_key( $IXAP74 ) ) { $IXAP94 = $affiliates_db->get_tablename( "affiliates_attributes" ); $IXAP83 = $affiliates_db->get_value( "SELECT attr_value FROM $IXAP94 WHERE affiliate_id = %d AND attr_key = %s", intval( $IXAP38 ), $IXAP74 ); } return $IXAP83; } } 