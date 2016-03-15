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

	
 abstract class Affiliates_Link_Renderer implements I_Affiliates_Link_Renderer { protected static $IXAP154 = array( 'render' => self::IXAP155, 'content' => null, 'type' => self::IXAP144, 'url' => null, 'a_class' => null, 'a_id' => null, 'a_style' => null, 'a_title' => null, 'a_name' => null, 'a_rel' => null, 'a_rev' => null, 'a_target' => null, 'a_type' => null, 'img_alt' => null, 'img_class' => null, 'img_height' => null, 'img_id' => null, 'img_name' => null, 'img_src' => null, 'img_title' => null, 'img_width' => null, 'attachment_id' => null, 'size' => 'full' ); public static function render_affiliate_link( $IXAP101 = array(), $IXAP156 = null, $IXAP88 = array() ) { $IXAP58 = ''; $IXAP157 = call_user_func( array( $IXAP88['Affiliates_Url_Renderer'], 'render_affiliate_url'), $IXAP101 ); if ( empty( $IXAP156 ) ) { if ( !empty( $IXAP101['content'] ) ) { $IXAP156 = $IXAP101['content']; } else { $IXAP156 = $IXAP157; } } $IXAP158 = array(); $IXAP159 = array(); foreach ( $IXAP101 as $IXAP74 => $IXAP83 ) { if ( strpos($IXAP74, "a_") === 0 ) { if ( $IXAP83 !== null ) { $IXAP158[substr( $IXAP74, 2 )] = $IXAP83; } } else if ( strpos($IXAP74, "img_") === 0 ) { if ( $IXAP83 !== null ) { switch ( $IXAP74 ) { case 'img_height' : if ( preg_match( "/(\d+)(px|\%)?/", $IXAP83, $IXAP24 ) ) { $IXAP160 = intval( $IXAP24[1] ); if ( isset( $IXAP24[2] ) ) { $IXAP161 = $IXAP24[2] == "px" ? "px" : "%"; } else { $IXAP161 = ""; } $IXAP159['height'] = $IXAP160 . $IXAP161; } break; case 'img_width' : if ( preg_match( "/(\d+)(px|\%)?/", $IXAP83, $IXAP24 ) ) { $IXAP162 = intval( $IXAP24[1] ); if ( isset( $IXAP24[2] ) ) { $IXAP163 = $IXAP24[2] == "px" ? "px" : "%"; } else { $IXAP163 = ""; } $IXAP159['width'] = $IXAP162 . $IXAP163; } break; default : $IXAP159[substr( $IXAP74, 4 )] = $IXAP83; } } } } if ( !empty( $IXAP160 ) && !empty( $IXAP162 ) ) { $IXAP164 = array( $IXAP162, $IXAP160 ); } else if ( isset( $IXAP101['size'] ) ) { if ( in_array( $IXAP101['size'], $IXAP88['image_sizes'] ) ) { $IXAP164 = $IXAP101['size']; } else { $IXAP164 = self::$IXAP154['size']; } } $IXAP58 = '<a href="' . $IXAP157 . '"'; foreach( $IXAP158 as $IXAP74 => $IXAP83 ) { $IXAP58 .= ' ' . $IXAP74 . '="' . call_user_func( $IXAP88['esc_attr'], $IXAP83 ) . '"'; } $IXAP58 .= '>'; if ( isset( $IXAP101['attachment_id'] ) ) { $IXAP58 .= call_user_func( $IXAP88['image_retriever'], $IXAP101['attachment_id'], $IXAP164, false, $IXAP159 ); } else if ( isset( $IXAP101['img_src'] ) ) { $IXAP58 .= "<img "; foreach ( $IXAP159 as $IXAP74 => $IXAP83 ) { $IXAP58 .= " $IXAP74=" . '"' . call_user_func( $IXAP88['esc_attr'], $IXAP83 ) . '"'; } $IXAP58 .= ' />'; } else if ( isset( $IXAP101['content'] ) ) { $IXAP58 .= $IXAP101['content']; } else { $IXAP58 .= $IXAP156; } $IXAP58 .= '</a>'; if ( isset( $IXAP101['render'] ) && ( $IXAP101['render'] == self::IXAP165 ) ) { $IXAP58 = htmlentities( $IXAP58, ENT_COMPAT, get_bloginfo( 'charset' ) ); } return $IXAP58; } }