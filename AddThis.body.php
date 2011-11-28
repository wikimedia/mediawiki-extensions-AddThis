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
		global $wgAddThispubid, $wgAddThisHeader, $wgAddThisMain, $wgAddThisMainpage, $wgRequest, $wgAddThisHServ, $wgAddThisBackground, $wgAddThisBorder; 
 # Localisation for "Share"
		$share = wfMsg( 'addthis' );
 # Output AddThis widget
		$output .='<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style" id="addthistoolbar" style="background:'.$wgAddThisBackground.'; border-color:'.$wgAddThisBorder.';">
				<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4eb75def4ec6488b" class="addthis_button_compact">&nbsp;' . $share . '</a><span class="addthis_separator">&nbsp;</span>';
		foreach ( $wgAddThisHServ as $n => $a ) {
			$output .= '<a class="addthis_button_'.$wgAddThisHServ[$n]["service"].'" '.$wgAddThisHServ[$n]["attribs"].'></a>';
		}
		$output .='</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
			<!-- AddThis Button END -->';
		return $output;
        }


/**
 * Function for sidebar portlet
 *
 */
	static function AddThisSidebar( $skin, &$bar ) {
		global $wgOut, $wgAddThispubid, $wgAddThisSidebar, $wgAddThisSBServ;
 # Load css stylesheet
			$wgOut->addModuleStyles( 'ext.addThis' );
 # Check setting to enable/disable sidebar portlet
		if(strtolower($wgAddThisSidebar) == 'true') {
 # Output AddThis widget
			$bar['addthis'] = '<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style" id="addthissidebar">';
			foreach ( $wgAddThisSBServ as $n => $a ) {
				$bar['addthis'] .= '<a class="addthis_button_'.$wgAddThisSBServ[$n]["service"].'" '.$wgAddThisSBServ[$n]["attribs"].'></a>';
			}
			$bar['addthis'] .= '</div>
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
		global $wgOut, $wgAddThispubid, $wgAddThisHeader, $wgAddThisMain, $wgAddThisMainpage, $wgRequest, $wgAddThisHServ, $wgAddThisBackground, $wgAddThisBorder; 
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
					<div class="addthis_toolbox addthis_default_style" id="addthistoolbar" style="background:'.$wgAddThisBackground.'; border-color:'.$wgAddThisBorder.';">
						<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4eb75def4ec6488b" class="addthis_button_compact">&nbsp;' . $share . '</a><span class="addthis_separator">&nbsp;</span>');
				foreach ( $wgAddThisHServ as $n => $a ) {
					$wgOut->addHTML('<a class="addthis_button_'.$wgAddThisHServ[$n]["service"].'" '.$wgAddThisHServ[$n]["attribs"].'></a>');
				}
				$wgOut->addHTML('</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$wgAddThispubid.'"></script>
					<!-- AddThis Button END -->');
			}
		}
	return true;
	}
}