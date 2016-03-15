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

	
 abstract class Affiliates_Database implements I_Affiliates_Database { private $IXAP88; private $IXAP89; private $IXAP90; private $IXAP91; private $IXAP92; public function __construct( $IXAP88, $IXAP89 = null, $IXAP90 = null, $IXAP91 = null, $IXAP92 = null ) { $this->implementation = $IXAP88; $this->host = $IXAP89; $this->database = $IXAP90; $this->user = $IXAP91; $this->password = $IXAP92; } public function create_tables( $IXAP7 = null, $IXAP8 = null ) { $IXAP93 = ''; if ( ! empty( $IXAP7 ) ) { $IXAP93 = "DEFAULT CHARACTER SET $IXAP7"; } if ( ! empty( $IXAP8 ) ) { $IXAP93 .= " COLLATE $IXAP8"; } $IXAP94 = $this->get_tablename( 'affiliates_attributes' ); if ( $this->get_value( "SHOW TABLES LIKE '" . $IXAP94 . "'" ) != $IXAP94 ) { $IXAP95 = "CREATE TABLE " . $IXAP94 . " (
				affiliate_id BIGINT(20) UNSIGNED NOT NULL,
				attr_key     VARCHAR(100) NOT NULL,
				attr_value   LONGTEXT DEFAULT NULL,
				PRIMARY KEY  (affiliate_id, attr_key),
				INDEX        aff_attr_akv (affiliate_id, attr_key, attr_value(100)),
				INDEX        aff_attr_ka (attr_key, affiliate_id),
				INDEX        aff_attr_kva (attr_key, attr_value(100), affiliate_id)
			) $IXAP93;"; $this->query( $IXAP95 ); } } public function drop_tables() { $IXAP94 = $this->get_tablename( 'affiliates_attributes' ); $IXAP95 = "DROP TABLE IF EXISTS " . $IXAP94 . ";"; $this->query( $IXAP95 ); } } 