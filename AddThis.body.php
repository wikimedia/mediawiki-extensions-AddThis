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
 */
	public static function parserHook( $parser ) {
		global $wgOut, $wgAddThispubid, $wgAddThisHeader, $wgAddThisHServ1, $wgAddThisHServ1set, $wgAddThisHServ2, $wgAddThisHServ2set, $wgAddThisHServ3, $wgAddThisHServ3set, $wgAddThisHServ4, $wgAddThisHServ4set, 
			   $wgAddThisHServ5, $wgAddThisHServ5set, $wgAddThisHServ6, $wgAddThisHServ6set, $wgAddThisHServ7, $wgAddThisHServ7set, $wgAddThisHServ8, $wgAddThisHServ8set, $wgAddThisBackground, $wgAddThisBorder; 
 # Localisation for "Share"
		$share = wfMsg( 'addthis' );
 # Output AddThis widget
		$output .='<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style" id="addthistoolbar" style="background:'.$wgAddThisBackground.'; border-color:'.$wgAddThisBorder.';">
				<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4eb75def4ec6488b" class="addthis_button_compact">&nbsp;' . $share . '</a><span class="addthis_separator">&nbsp;</span>
				<a class="addthis_button_'.$wgAddThisHServ1.'" '.$wgAddThisHServ1set.'></a>
				<a class="addthis_button_'.$wgAddThisHServ2.'" '.$wgAddThisHServ2set.'></a>
				<a class="addthis_button_'.$wgAddThisHServ3.'" '.$wgAddThisHServ3set.'></a>
				<a class="addthis_button_'.$wgAddThisHServ4.'" '.$wgAddThisHServ4set.'></a>
				<a class="addthis_button_'.$wgAddThisHServ5.'" '.$wgAddThisHServ5set.'></a>
				<a class="addthis_button_'.$wgAddThisHServ6.'" '.$wgAddThisHServ6set.'></a>
				<a class="addthis_button_'.$wgAddThisHServ7.'" '.$wgAddThisHServ7set.'></a>
				<a class="addthis_button_'.$wgAddThisHServ8.'" '.$wgAddThisHServ8set.'></a>
			</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
			<!-- AddThis Button END -->';
		return $output;
        }


/**
 * Function for sidebar portlet
 *
 */
	static function AddThisSidebar( $skin, &$bar ) {
		global $wgOut, $wgAddThispubid, $wgAddThisSidebar, $wgAddThisSBServ1, $wgAddThisSBServ2, $wgAddThisSBServ3, $wgAddThisSBServ4, $wgAddThisSBServ5, $wgAddThisSBServ1set, $wgAddThisSBServ2set, 
			   $wgAddThisSBServ3set, $wgAddThisSBServ4set, $wgScriptPath, $wgAddThisSBServ5set;
 # Load css stylesheet
			$wgOut->addModuleStyles( 'ext.addThis' );
 # Check setting to enable/disable sidebar portlet
		if(strtolower($wgAddThisSidebar) == 'true') {
 # Output AddThis widget
			$bar['addthis'] = '<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style" id="addthissidebar">
					<a class="addthis_button_'.$wgAddThisSBServ1.'" '.$wgAddThisSBServ1set.'></a>
					<a class="addthis_button_'.$wgAddThisSBServ2.'" '.$wgAddThisSBServ2set.'></a>
					<a class="addthis_button_'.$wgAddThisSBServ3.'" '.$wgAddThisSBServ3set.'></a>
					<a class="addthis_button_'.$wgAddThisSBServ4.'" '.$wgAddThisSBServ4set.'></a>
					<a class="addthis_button_'.$wgAddThisSBServ5.'" '.$wgAddThisSBServ5set.'></a>
				</div>
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
				<!-- AddThis Button END -->';
			return $bar;
		}
		return true;
	}


/**
 * Function for article header toolbar
 *
 */
	public static function AddThisHeader( &$article, &$outputDone, &$pcache ) {
		global $wgOut, $wgAddThispubid, $wgAddThisHeader, $wgAddThisMain, $wgAddThisMainpage, $wgRequest, $wgAddThisHServ1, $wgAddThisHServ1set, $wgAddThisHServ2, $wgAddThisHServ2set, $wgAddThisHServ3,
			   $wgAddThisHServ3set, $wgAddThisHServ4, $wgAddThisHServ4set, $wgAddThisHServ5, $wgAddThisHServ5set, $wgAddThisHServ6, $wgAddThisHServ6set, $wgAddThisHServ7, $wgAddThisHServ7set, $wgAddThisHServ8, 
			   $wgAddThisHServ8set, $wgAddThisBackground, $wgAddThisBorder; 
 # Localisation for "Share"
	$share = wfMsg( 'addthis' );
 # Check if page is in main namespace
	$title = $article->getTitle();
 # Check setting to enable/disable article header tooblar
		if(strtolower($wgAddThisHeader) == 'true') {
 # Check if article is mainpage set by [[MediaWiki:Mainpage]]
			if ($wgRequest->getText( 'title' )==str_replace( ' ', '_', wfMsg( 'mainpage' ) ) ) {
 # Check setting to enable/disable article header toolbar on mainpage
				if(strtolower($wgAddThisMain) == 'false') {
					return true;
					}
				}
 # Check if page is in content namespace
			if ( MWNamespace::isContent( $title->getNamespace() ) ) {
 # Output AddThis widget
				$wgOut->addHTML('<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style" id="addthisheader" style="background:'.$wgAddThisBackground.'; border-color:'.$wgAddThisBorder.';">
						<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4eb75def4ec6488b" class="addthis_button_compact">&nbsp;' . $share . '</a><span class="addthis_separator">&nbsp;</span>
						<a class="addthis_button_'.$wgAddThisHServ1.'" '.$wgAddThisHServ1set.'></a>
						<a class="addthis_button_'.$wgAddThisHServ2.'" '.$wgAddThisHServ2set.'></a>
						<a class="addthis_button_'.$wgAddThisHServ3.'" '.$wgAddThisHServ3set.'></a>
						<a class="addthis_button_'.$wgAddThisHServ4.'" '.$wgAddThisHServ4set.'></a>
						<a class="addthis_button_'.$wgAddThisHServ5.'" '.$wgAddThisHServ5set.'></a>
						<a class="addthis_button_'.$wgAddThisHServ6.'" '.$wgAddThisHServ6set.'></a>
						<a class="addthis_button_'.$wgAddThisHServ7.'" '.$wgAddThisHServ7set.'></a>
						<a class="addthis_button_'.$wgAddThisHServ8.'" '.$wgAddThisHServ8set.'></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
					<!-- AddThis Button END -->');
			}
		}
	return true;
	}
}