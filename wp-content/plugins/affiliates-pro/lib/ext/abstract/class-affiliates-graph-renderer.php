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

	
 abstract class Affiliates_Graph_Renderer implements I_Affiliates_Graph_Renderer { protected static $IXAP96 = array( 'from_date' => null, 'thru_date' => null, 'days_back' => null, 'interval' => null, 'legend' => true, 'render' => 'graph' ); protected static $IXAP97; protected static $IXAP98 = 7; protected static $IXAP99 = 7; protected static $IXAP100 = 1100; public static function init() { self::$IXAP97 = date( 'Y-m-d', time() ); } static function render_graph( $IXAP101 = array() ) { global $affiliates_db, $IXAP102; $IXAP102++; self::init(); $IXAP58 = ''; $IXAP38 = Affiliates_Affiliate_WordPress::get_user_affiliate_id(); if ( $IXAP38 === false ) { return $IXAP58; } $IXAP103 = isset( $IXAP101['interval'] ) && ( $IXAP101['interval'] !== null ) ? $IXAP101['interval'] : null; $IXAP104 = isset( $IXAP101['render'] ) ? $IXAP101['render'] : self::$IXAP96['render']; switch( $IXAP104 ) { case 'graph' : case 'hits' : case 'visits' : case 'referrals' : case 'accepted' : case 'closed' : case 'pending' : case 'rejected' : break; default : $IXAP104 = self::$IXAP96['render']; } $IXAP105 = isset( $IXAP101['legend'] ) && ( ( $IXAP101['legend'] === true ) || ( $IXAP101['legend'] === 'true' ) ); if ( $IXAP105 ) { $IXAP106 = 'true'; } else { $IXAP106 = 'false'; } $IXAP107 = isset( $IXAP101['days_back'] ) && ( $IXAP101['days_back'] !== null ) ? $IXAP101['days_back'] : self::$IXAP99; if ( $IXAP107 < self::$IXAP99 ) { $IXAP107 = self::$IXAP99; } if ( $IXAP107 > self::$IXAP100 ) { $IXAP107 = self::$IXAP100; } $IXAP31 = isset( $IXAP101['from_date'] ) && ( $IXAP101['from_date'] !== null ) ? $IXAP101['from_date'] : null; $IXAP33 = isset( $IXAP101['thru_date'] ) && ( $IXAP101['thru_date'] !== null ) ? $IXAP101['thru_date'] : null; switch( $IXAP103 ) { case 'month' : $IXAP31 = date( 'Y-m-d', strtotime( 'first day of' ) ); $IXAP33 = date( 'Y-m-d', strtotime( 'last day of' ) ); $IXAP107 = 1 + ( strtotime( $IXAP33 ) - strtotime( $IXAP31 ) ) / ( 3600 * 24 ); break; case 'year' : $IXAP31 = date( 'Y-m-d', strtotime( 'first day of January' ) ); $IXAP33 = date( 'Y-m-d', strtotime( 'last day of December' ) ); $IXAP107 = 1 + ( strtotime( $IXAP33 ) - strtotime( $IXAP31 ) ) / ( 3600 * 24 ); break; } if ( empty( $IXAP33 ) ) { $IXAP33 = self::$IXAP97; } if ( empty( $IXAP31 ) ) { $IXAP31 = date( 'Y-m-d', strtotime( $IXAP33 ) - $IXAP107 * 3600 * 24 ); } $IXAP43 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP108 = $affiliates_db->get_tablename( 'hits' ); $IXAP45 = $affiliates_db->get_tablename( 'referrals' ); $IXAP95 = "SELECT date, sum(count) as hits FROM $IXAP108 WHERE date >= %s AND date <= %s AND affiliate_id = %d GROUP BY date"; $IXAP109 = $affiliates_db->get_objects( $IXAP95, $IXAP31, $IXAP33, intval( $IXAP38 ) ); $IXAP110 = array(); foreach( $IXAP109 as $IXAP111 ) { $IXAP110[$IXAP111->date] = $IXAP111->hits; } $IXAP95 = "SELECT count(DISTINCT IP) visits, date FROM $IXAP108 WHERE date >= %s AND date <= %s AND affiliate_id = %d GROUP BY date"; $IXAP112 = $affiliates_db->get_objects( $IXAP95, $IXAP31, $IXAP33, intval( $IXAP38 ) ); $IXAP113 = array(); foreach( $IXAP112 as $IXAP114 ) { $IXAP113[$IXAP114->date] = $IXAP114->visits; } $IXAP95 = "SELECT count(referral_id) referrals, date(datetime) date FROM $IXAP45 WHERE status = %s AND date(datetime) >= %s AND date(datetime) <= %s AND affiliate_id = %d GROUP BY date"; $IXAP51 = $affiliates_db->get_objects( $IXAP95, AFFILIATES_REFERRAL_STATUS_ACCEPTED, $IXAP31, $IXAP33, intval( $IXAP38 ) ); $IXAP115 = array(); foreach( $IXAP51 as $IXAP15 ) { $IXAP115[$IXAP15->date] = $IXAP15->referrals; } $IXAP51 = $affiliates_db->get_objects( $IXAP95, AFFILIATES_REFERRAL_STATUS_CLOSED, $IXAP31, $IXAP33, intval( $IXAP38 ) ); $IXAP116 = array(); foreach( $IXAP51 as $IXAP15 ) { $IXAP116[$IXAP15->date] = $IXAP15->referrals; } $IXAP51 = $affiliates_db->get_objects( $IXAP95, AFFILIATES_REFERRAL_STATUS_PENDING, $IXAP31, $IXAP33, intval( $IXAP38 ) ); $IXAP117 = array(); foreach( $IXAP51 as $IXAP15 ) { $IXAP117[$IXAP15->date] = $IXAP15->referrals; } $IXAP51 = $affiliates_db->get_objects( $IXAP95, AFFILIATES_REFERRAL_STATUS_REJECTED, $IXAP31, $IXAP33, intval( $IXAP38 ) ); $IXAP118 = array(); foreach( $IXAP51 as $IXAP15 ) { $IXAP118[$IXAP15->date] = $IXAP15->referrals; } $IXAP119 = array(); $IXAP120 = array(); $IXAP121 = array(); $IXAP122 = array(); $IXAP123 = array(); $IXAP124 = array(); $IXAP125 = array(); $IXAP126 = array(); for ( $IXAP127 = -$IXAP107; $IXAP127 <= 0; $IXAP127++ ) { $IXAP128 = date( 'Y-m-d', strtotime( $IXAP33 ) + $IXAP127 * 3600 * 24 ); $IXAP126[$IXAP127] = $IXAP128; if ( isset( $IXAP115[$IXAP128] ) ) { $IXAP119[] = array( $IXAP127, intval( $IXAP115[$IXAP128] ) ); } if ( isset( $IXAP117[$IXAP128] ) ) { $IXAP120[] = array( $IXAP127, intval( $IXAP117[$IXAP128] ) ); } if ( isset( $IXAP118[$IXAP128] ) ) { $IXAP121[] = array( $IXAP127, intval( $IXAP118[$IXAP128] ) ); } if ( isset( $IXAP116[$IXAP128] ) ) { $IXAP122[] = array( $IXAP127, intval( $IXAP116[$IXAP128] ) ); } if ( isset( $IXAP110[$IXAP128] ) ) { $IXAP123[] = array( $IXAP127, intval( $IXAP110[$IXAP128] ) ); } if ( isset( $IXAP113[$IXAP128] ) ) { $IXAP124[] = array( $IXAP127, intval( $IXAP113[$IXAP128] ) ); } if ( $IXAP107 <= ( self::$IXAP98 + self::$IXAP99 ) ) { $IXAP129 = date( 'm-d', strtotime( $IXAP128 ) ); $IXAP125[] = array( $IXAP127, $IXAP129 ); } else if ( $IXAP107 <= 91 ) { $IXAP26 = date( 'd', strtotime( $IXAP128 ) ); if ( $IXAP26 == '1' || $IXAP26 == '15' ) { $IXAP129 = date( 'm-d', strtotime( $IXAP128 ) ); $IXAP125[] = array( $IXAP127, $IXAP129 ); } } else { if ( date( 'd', strtotime( $IXAP128 ) ) == '1' ) { if ( date( 'm', strtotime( $IXAP128 ) ) == '1' ) { $IXAP129 = '<strong>' . date( 'Y', strtotime( $IXAP128 ) ) . '</strong>'; } else { $IXAP129 = date( 'm-d', strtotime( $IXAP128 ) ); } $IXAP125[] = array( $IXAP127, $IXAP129 ); } } } $IXAP130 = json_encode( $IXAP119 ); $IXAP131 = json_encode( $IXAP120 ); $IXAP132 = json_encode( $IXAP121 ); $IXAP133 = json_encode( $IXAP122 ); $IXAP134 = json_encode( $IXAP123 ); $IXAP135 = json_encode( $IXAP124 ); $IXAP136 = json_encode( array( array( intval( -$IXAP107 ), 0 ), array( 0, 0 ) ) ); $IXAP137 = json_encode( $IXAP125 ); $IXAP138 = json_encode( $IXAP126 ); $IXAP139 = isset( $IXAP101['class'] ) ? $IXAP101['class'] : 'affiliate-graph'; $IXAP140 = isset( $IXAP101['id'] ) ? $IXAP101['id'] : 'affiliate-graph-' . $IXAP102; $IXAP141 = isset( $IXAP101['style'] ) ? $IXAP101['style'] : ''; ob_start(); $IXAP142 = $IXAP107 <= 61 ? 'true' : 'false'; ?>
		<div id="<?php echo $IXAP140; ?>" class="<?php echo $IXAP139; ?>" style="<?php echo $IXAP141; ?>"></div>
		<script type="text/javascript">
			(function($){
				$(document).ready(function(){
					var data = [
						<?php if ( $IXAP104 == 'graph' || $IXAP104 == 'hits' ) : ?>
						{
							label : "<?php _e( 'Hits', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP134; ?>,
							lines : { show : true },
							points : { show : <?php echo $IXAP142; ?> },
							yaxis : 2,
							color : '#ccddff'
						},
						<?php endif; ?>
						<?php if ( $IXAP104 == 'graph' || $IXAP104 == 'visits' ) : ?>
						{
							label : "<?php _e( 'Visits', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP135; ?>,
							lines : { show : true },
							points : { show : <?php echo $IXAP142; ?> },
							yaxis : 2,
							color : '#ffddcc'
						},
						<?php endif; ?>
						<?php if ( $IXAP104 == 'graph' || $IXAP104 == 'accepted' || $IXAP104 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Accepted', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP130; ?>,
							color : '#009900',
							bars : { align : "center", show : true, barWidth : 1 },
							hoverable : true,
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP104 == 'graph' || $IXAP104 == 'pending' || $IXAP104 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Pending', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP131; ?>,
							color : '#0000ff',
							bars : { align : "center", show : true, barWidth : 0.6 },
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP104 == 'graph' || $IXAP104 == 'rejected' || $IXAP104 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Rejected', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP132; ?>,
							color : '#ff0000',
							bars : { align : "center", show : true, barWidth : .3 },
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP104 == 'graph' || $IXAP104 == 'closed' || $IXAP104 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Closed', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP133; ?>,
							color : '#333333',
							points : { show : true },
							yaxis : 1
						},
						<?php endif; ?>
						{
							data : <?php echo $IXAP136; ?>,
							lines : { show : false },
							yaxis : 1
						}
					];
	
					var options = {
						xaxis : {
							ticks : <?php echo $IXAP137; ?>
						},
						yaxis : {
							min : 0,
							tickDecimals : 0
						},
						yaxes : [
							{},
							{ position : 'right' }
						],
						grid : {
							hoverable : true
						},
						legend : {
							show : <?php echo $IXAP106; ?>,
							position : 'nw'
						}
					};
	
					$.plot($("#<?php echo $IXAP140; ?>"),data,options);
	
					function statsTooltip(x, y, contents) {
						$('<div id="<?php echo $IXAP140; ?>-tooltip">' + contents + '</div>').css( {
							position: 'absolute',
							display: 'none',
							top: y + 5,
							left: x + 5,
							border: '1px solid #333',
							'border-radius' : '4px',
							padding: '6px',
							'background-color': '#ccc',
							opacity: 0.90
						}).appendTo("body").fadeIn(200);
					}
	
					var tooltipItem = null;
					var statsDates = <?php echo $IXAP138; ?>;
					$("#<?php echo $IXAP140; ?>").bind("plothover", function (event, pos, item) {
						if (item) {
							if (tooltipItem === null || item.dataIndex != tooltipItem.dataIndex || item.seriesIndex != tooltipItem.seriesIndex) {
								tooltipItem = item;
								$("#<?php echo $IXAP140; ?>-tooltip").remove();
								var x = item.datapoint[0];
									y = item.datapoint[1];
								statsTooltip(
									item.pageX,
									item.pageY,
									item.series.label + " : " + y +  '<br/>' + statsDates[x] 
								);
							}
						} else {
							$("#<?php echo $IXAP140;?>-tooltip").remove();
							tooltipItem = null;
						}
					});
				});
			})(jQuery);
		</script>
		<?php
 $IXAP58 .= ob_get_contents(); ob_end_clean(); return $IXAP58; } static function render_hits( $IXAP101 = array() ) { self::init(); $IXAP101['render'] = 'hits'; return self::render_graph( $IXAP101 ); } static function render_visits( $IXAP101 = array() ) { self::init(); $IXAP101['render'] = 'visits'; return self::render_graph( $IXAP101 ); } static function render_referrals( $IXAP101 = array() ) { self::init(); $IXAP101['render'] = 'referrals'; return self::render_graph( $IXAP101 ); } static function render_totals( $IXAP101 = array() ) { self::init(); } } 