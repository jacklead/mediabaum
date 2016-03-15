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

	
 interface I_Affiliates_Database { public function create_tables( $IXAP7 = null, $IXAP412 = null ); public function drop_tables(); public function start_transaction(); public function commit(); public function rollback(); public function get_tablename( $name ); public function get_value( $IXAP95 ); public function get_objects( $IXAP95 ); public function query( $IXAP95 ); } interface I_Affiliates_Affiliate { public static function get_affiliate( $IXAP38 ); public static function get_user_affiliate_id( $IXAP9 = null ); } interface I_Affiliates_Affiliates { } interface I_Affiliates_Affiliate_Profile { } interface I_Affiliates_Attributes { } interface I_Affiliates_Referral { public function add_referrals( $IXAP237, $post_id, $IXAP231 = '', $IXAP203 = null, $IXAP233 = null, $IXAP23 = null, $IXAP37 = null, $IXAP232 = null, $IXAP234 = null, $IXAP235 = null, $IXAP236 = false ); public function suggest( $post_id, $IXAP231 = '', $IXAP203 = null, $IXAP23 = null, $IXAP37 = null, $IXAP232 = null ); public function suggest_by_attribute( $IXAP238, $IXAP239, $post_id, $IXAP231 = '', $IXAP203 = null, $IXAP233 = null, $IXAP23 = null, $IXAP37 = null, $IXAP232 = null, $IXAP234 = null, $IXAP236 = false ); public function update( $IXAP258 ); } interface I_Affiliates_Renderer { const IXAP165 = 'code'; const IXAP155 = 'html'; const IXAP148 = 'append'; const IXAP144 = 'auto'; const IXAP152 = 'parameter'; const IXAP153 = 'pretty'; } interface I_Affiliates_Link_Renderer extends I_Affiliates_Renderer { static function render_affiliate_link( $IXAP101 = array(), $IXAP156 = null ); } interface I_Affiliates_Stats_Renderer extends I_Affiliates_Renderer { const IXAP179 = 10; const IXAP209 = 3; const IXAP173 = 'stats-summary'; const IXAP206 = 'stats-referrals'; static function render_affiliate_stats( $IXAP101 = array() ); } interface I_Affiliates_Graph_Renderer extends I_Affiliates_Renderer { static function render_graph( $IXAP101 = array() ); static function render_hits( $IXAP101 = array() ); static function render_visits( $IXAP101 = array() ); static function render_referrals( $IXAP101 = array() ); static function render_totals( $IXAP101 = array() ); } interface I_Affiliates_Totals { } interface I_Affiliates_Url_Renderer extends I_Affiliates_Renderer { static function render_affiliate_url( $IXAP101 = array() ); } interface I_Affiliates_Affiliate_Stats_Renderer { const IXAP179 = 10; } interface I_Affiliates_Validator { static function validate_amount( $IXAP23 ); static function validate_email( $IXAP27 ); }