<?php
if (!defined('MEDIAWIKI')) die();
/**
 * Class file for the AddThis extension
 *
 * @addtogroup Extensions
 * @license GPL
 */
class AddThis {

	/**
	 * Parser hook for the <addthis /> tag extension.
	 *
	 * @param $parser
	 * @return string
	 */
	public static function parserHook( $parser ) {
		global $wgAddThispubid, $wgAddThisHServ, $wgAddThisBackground, $wgAddThisBorder;

		# Localisation for "Share"
		$share = wfMsg( 'addthis' );
		# Output AddThis widget
		$output ='<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style" id="addthistoolbar" style="background:'.$wgAddThisBackground.'; border-color:'.$wgAddThisBorder.';">
				<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid='.$wgAddThispubid.'" class="addthis_button_compact">&nbsp;' . $share . '</a><span class="addthis_separator">&nbsp;</span>';

		$output .= self::makeLinks( $wgAddThisHServ );
		$output .='</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
			<!-- AddThis Button END -->';

		return $output;
	}

	/**
	 * Function for article header toolbar
	 *
	 * @param $article Article
	 * @param $outputDone
	 * @param $pcache
	 * @return bool
	 */
	public static function AddThisHeader( &$article, &$outputDone, &$pcache ) {
		global $wgOut, $wgAddThispubid, $wgAddThisHeader, $wgAddThisMain,
		       $wgRequest, $wgAddThisHServ, $wgAddThisBackground, $wgAddThisBorder;

		# Localisation for "Share"
		$share = wfMsg( 'addthis' );
		# Check if page is in main namespace
		$title = $article->getTitle();
		# Check setting to enable/disable article header tooblar
		if ( $wgAddThisHeader ) {
			# Check if article is mainpage set by [[MediaWiki:Mainpage]]
			if ( $wgRequest->getText( 'title' ) == str_replace( ' ', '_', wfMsg( 'mainpage' ) ) ) {
                # Check setting to enable/disable article header toolbar on mainpage
				if( !$wgAddThisMain ) {
					return true;
				}
			}

			# Check if page is in content namespace
			if ( MWNamespace::isContent( $title->getNamespace() ) ) {
				# Output AddThis widget
				$wgOut->addHTML('<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style" id="addthistoolbar" style="background:'.$wgAddThisBackground.'; border-color:'.$wgAddThisBorder.';">
						<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid='.$wgAddThispubid.'" class="addthis_button_compact">&nbsp;' . $share . '</a><span class="addthis_separator">&nbsp;</span>');

				$wgOut->addHTML( self::makeLinks( $wgAddThisHServ ) );

				$wgOut->addHTML('</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
					<!-- AddThis Button END -->');
			}
		}

		return true;
	}

	/**
	 * Function for sidebar portlet
	 *
	 * @param $skin
	 * @param $bar
	 * @return array|bool|string
	 */
	public static function AddThisSidebar( $skin, &$bar ) {
		global $wgOut, $wgAddThispubid, $wgAddThisSidebar, $wgAddThisSBServ;

		# Load css stylesheet
		$wgOut->addModuleStyles( 'ext.addThis' );
		# Check setting to enable/disable sidebar portlet
		if ( $wgAddThisSidebar ) {
			# Output AddThis widget
			$bar['addthis'] = '<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style" id="addthissidebar">';

			$bar['addthis'] .= self::makeLinks( $wgAddThisSBServ );

			$bar['addthis'] .= '</div>
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
				<!-- AddThis Button END -->';

			// FIXME: This is a hook, should we really be returning a string here?
			return $bar;
		}
		return true;
	}

	/**
	 * Converts an array definition of links into HTML tags
	 *
	 * @param $links array
	 * @return string
	 */
	protected static function makeLinks( $links ) {
		$html = '';
		foreach ( $links as $link ) {
			$attribs = isset( $link['attribs'] ) ? $link['attribs'] : '';

			$html .= '<a class="addthis_button_' . $link['service'] . '" ' . $attribs . '></a>';
		}

		return $html;
	}
}