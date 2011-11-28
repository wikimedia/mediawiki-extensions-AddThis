<?php
/**
 * MediaWiki extension to add AddThis widget in a portlet in the sidebar and page header.
 * Installation instructions can be found on
 * http://www.mediawiki.org/wiki/Extension:AddThis
 *
 * @addtogroup Extensions
 * @author Gregory Varnum
 * @license GPL
 *
 * Loosely based on the Google Translator extension by Joachim De Schrijver
 * Thank you to Johnduhart for feedback
 */
 
/**
 * Exit if called outside of MediaWiki
 */
if( !defined( 'MEDIAWIKI' ) ) {
        echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
        die( 1 );
}
 

/**
 * SETTINGS
 * --------
 * The following variables may be reset in your LocalSettings.php file.
 *
 * $wgAddThispubid
 * 			- AddThis Profile ID - more info: http://www.addthis.com/help/profiles
 * $wgAddThisBackground
 * 			- Background color for AddThis toolbox displayed in article header
 *			  Default is #f6f6f6
 * $wgAddThisBorder
 * 			- Border color for AddThis toolbox displayed in article header
 *			  Default is #a7d7f9
 * $wgAddThisSidebar
 * 			- Display AddThis widget as sidebar portlet
 *			  Default is true
 * $wgAddThisHeader
 * 			- Display AddThis widget in article headers
 *			  Default is true
 * $wgAddThisMain
 * 			- Display AddThis widget on main page
 *			  Default is true
 * $wgAddThisSBServ[1]
 * 			- Service code for 1st button in sidebar - service codes: http://www.addthis.com/services/list
 *			  Default is compact - AddThis icon used to access full AddThis popup menu
 * $wgAddThisSBServ['1set']
 * 			- Settings for 1st button in sidebar - more info: http://www.addthis.com/help/client-api#attribute-config
 * $wgAddThisSBServ[2]
 * 			- Service code for 2nd button in sidebar
 *			  Default is facebook
 * $wgAddThisSBServ['2set']
 * 			- Settings for 2nd button in sidebar
 * $wgAddThisSBServ[3]
 * 			- Service code for 3rd button in sidebar
 *			  Default is twitter
 * $wgAddThisSBServ['3set']
 * 			- Settings for 3rd button in sidebar
 * $wgAddThisSBServ[4]
 * 			- Service code for 4th button in sidebar
 *			  Default is google_plusone
 * $wgAddThisSBServ['4set']
 * 			- Settings for 4th button in sidebar
 *			  Default is g:plusone:count="false" style="margin-top:1px;"
 * $wgAddThisSBServ[5]
 * 			- Service code for 5th button in sidebar
 *			  Default is email
 * $wgAddThisSBServ['5set']
 * 			- Settings for 5th button in sidebar
 * $wgAddThisHServ[1]
 * 			- Service code for 1st button in article header after AddThis icon (which cannot be moved in the header)
 *			  Default is facebook
 * $wgAddThisHServ['1set']
 * 			- Settings for 1st button in article header
 * $wgAddThisHServ[2]
 * 			- Service code for 2nd button in article header
 *			  Default is twitter
 * $wgAddThisHServ['2set']
 * 			- Settings for 2nd button in article header
 * $wgAddThisHServ[3]
 * 			- Service code for 3rd button in article header
 *			  Default is google_plusone
 * $wgAddThisHServ['3set']
 * 			- Settings for 3rd button in article header
 *			  Default is g:plusone:count="false" style="margin-top:1px;"
 * $wgAddThisHServ[4]
 * 			- Service code for 4th button in article header
 *			  Default is linkedin
 * $wgAddThisHServ['4set']
 * 			- Settings for 4th button in article header
 * $wgAddThisHServ[5]
 * 			- Service code for 5th button in article header
 *			  Default is tumblr
 * $wgAddThisHServ['5set']
 * 			- Settings for 5th button in article header
 * $wgAddThisHServ[6]
 * 			- Service code for 6th button in article header
 *			  Default is stumbleupon
 * $wgAddThisHServ['6set']
 * 			- Settings for 6th button in article header
 * $wgAddThisHServ[7]
 * 			- Service code for 7th button in article header
 *			  Default is reddit
 * $wgAddThisHServ['7set']
 * 			- Settings for 7th button in article header
 * $wgAddThisHServ[8]
 * 			- Service code for 8th button in article header
 *			  Default is email
 * $wgAddThisHServ['8set']
 * 			- Settings for 8th button in article header
 */

$wgAddThispubid		 = '';

# Default values for most options
$wgAddThisBackground = '#f6f6f6';
$wgAddThisBorder	 = '#a7d7f9';
$wgAddThisSidebar	 = 'true';
$wgAddThisHeader	 = 'true';
$wgAddThisMain		 = 'true';

# Sidebar settings
$wgAddThisSBServ = array(
	1 => 'compact',
	'1set' => '',
	2 => 'facebook',
	'2set' => '',
	3 => 'twitter',
	'3set' => '',
	4 => 'google_plusone',
	'4set' => 'g:plusone:count="false" style="margin-top:1px;"',
	5 => 'email',
	'5set' => '', 
);

# Toolbar settings
$wgAddThisHServ = array(
	1 => 'facebook',
	'1set' => '',
	2 => 'twitter',
	'2set' => '',
	3 => 'google_plusone',
	'3set' => 'g:plusone:count="false" style="margin-top:1px;"',
	4 => 'linkedin',
	'4set' => '',
	5 => 'tumblr',
	'5set' => '', 
	6 => 'stumbleupon',
	'6set' => '', 
	7 => 'reddit',
	'7set' => '', 
	8 => 'email',
	'8set' => '', 
);


/**
 * Credits
 *
 */
$wgExtensionCredits['other'][] = array(
	'name'           => 'AddThis',
	'version'        => '1.0e',
	'author'         => '[http://en.wikipedia.org/wiki/User:Varnent Gregory Varnum]',
	'description'    => 'Adds [http://www.addthis.com AddThis button] to the sidebar and page header',
	'descriptionmsg' => 'addthis-desc',
	'url'            => 'http://www.mediawiki.org/wiki/Extension:AddThis',
);


/**
 * Register class and localisations
 *
 */
$dir = dirname(__FILE__) . '/';
$wgAutoloadClasses['AddThis'] = $dir . 'AddThis.body.php';
$wgExtensionMessagesFiles['AddThis'] = $dir . 'AddThis.i18n.php';


$wgResourceModules['ext.addThis'] = array(
	'styles' => 'addThis.css',
	'localBasePath' => dirname( __FILE__ ),
	'remoteExtPath' => 'AddThis',
);


/**
 * Hooks
 *
 */
$wgHooks['ArticleViewHeader'][] = 'AddThis::AddThisHeader';
$wgHooks['ParserFirstCallInit'][] = 'addThisHeaderTag';
$wgHooks['SkinBuildSidebar'][] = 'AddThis::AddThisSidebar';


/**
 * Register parser hook
 *
 * @param $parser Parser
 */
function addThisHeaderTag( &$parser ) {
	$parser->setHook( 'addthis', 'AddThis::parserHook' );
	return true;
}