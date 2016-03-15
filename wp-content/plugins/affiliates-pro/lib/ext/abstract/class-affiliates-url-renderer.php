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

	
 abstract class Affiliates_Url_Renderer implements I_Affiliates_Url_Renderer { protected static $IXAP143 = array( 'type' => self::IXAP144, 'url' => null ); static function render_affiliate_url( $IXAP101 = array(), $IXAP88 = array() ) { $IXAP58 = ''; if ( $IXAP38 = call_user_func( array( $IXAP88['Affiliates_Affiliate'], 'get_user_affiliate_id' ) ) ) { $IXAP145 = call_user_func( $IXAP88['affiliate_id_encoder'], $IXAP38 ); } else { $IXAP145 = 'affiliate-id'; } if ( !isset( $IXAP101['type'] ) ) { $IXAP101['type'] = self::IXAP144; } if ( isset( $IXAP101['url'] ) ) { $IXAP146 = $IXAP101['url']; } else { $IXAP146 = ''; } $IXAP147 = isset( $IXAP101['pname'] ) ? $IXAP101['pname'] : 'affiliates'; switch ( $IXAP101['type'] ) { case self::IXAP148 : $IXAP149 = '?'; if ( !empty( $IXAP101['url'] ) ) { $IXAP150 = parse_url( $IXAP146, PHP_URL_QUERY ); if ( !empty( $IXAP150 ) ) { $IXAP149 = '&'; } } $IXAP151 = $IXAP149 . $IXAP147 . '=' . $IXAP145; if ( empty( $IXAP101['url'] ) ) { $IXAP58 = $IXAP151; } else { $IXAP58 = $IXAP101['url'] . $IXAP151; } break; case self::IXAP152 : $IXAP58 = $IXAP146 . '?' . $IXAP147 . '=' . $IXAP145; break; case self::IXAP153 : $IXAP58 = $IXAP146 . '/' . $IXAP147 . '/' . $IXAP145; break; case self::IXAP144 : default : if ( isset( $IXAP101['use_parameter'] ) && $IXAP101['use_parameter'] ) { $IXAP58 = $IXAP146 . '/' . $IXAP147 . '/' . $IXAP145; } else { $IXAP58 = $IXAP146 . '?' . $IXAP147 . '=' . $IXAP145; } break; } return $IXAP58; } }