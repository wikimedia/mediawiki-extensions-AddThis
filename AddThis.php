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
 * $wgAddThisSBServ1
 * 			- Service code for 1st button in sidebar - service codes: http://www.addthis.com/services/list
 *			  Default is compact - AddThis icon used to access full AddThis popup menu
 * $wgAddThisSBServ1set
 * 			- Settings for 1st button in sidebar - more info: http://www.addthis.com/help/client-api#attribute-config
 * $wgAddThisSBServ2
 * 			- Service code for 2nd button in sidebar
 *			  Default is facebook
 * $wgAddThisSBServ2set
 * 			- Settings for 2nd button in sidebar
 * $wgAddThisSBServ3
 * 			- Service code for 3rd button in sidebar
 *			  Default is twitter
 * $wgAddThisSBServ3set
 * 			- Settings for 3rd button in sidebar
 * $wgAddThisSBServ4
 * 			- Service code for 4th button in sidebar
 *			  Default is google_plusone
 * $wgAddThisSBServ4set
 * 			- Settings for 4th button in sidebar
 *			  Default is g:plusone:count="false" style="margin-top:1px;"
 * $wgAddThisSBServ5
 * 			- Service code for 5th button in sidebar
 *			  Default is email
 * $wgAddThisSBServ5set
 * 			- Settings for 5th button in sidebar
 * $wgAddThisHServ1
 * 			- Service code for 1st button in article header after AddThis icon (which cannot be moved in the header)
 *			  Default is facebook
 * $wgAddThisHServ1set
 * 			- Settings for 1st button in article header
 * $wgAddThisHServ2
 * 			- Service code for 2nd button in article header
 *			  Default is twitter
 * $wgAddThisHServ2set
 * 			- Settings for 2nd button in article header
 * $wgAddThisHServ3
 * 			- Service code for 3rd button in article header
 *			  Default is google_plusone
 * $wgAddThisHServ3set
 * 			- Settings for 3rd button in article header
 *			  Default is g:plusone:count="false" style="margin-top:1px;"
 * $wgAddThisHServ4
 * 			- Service code for 4th button in article header
 *			  Default is linkedin
 * $wgAddThisHServ4set
 * 			- Settings for 4th button in article header
 * $wgAddThisHServ5
 * 			- Service code for 5th button in article header
 *			  Default is tumblr
 * $wgAddThisHServ5set
 * 			- Settings for 5th button in article header
 * $wgAddThisHServ6
 * 			- Service code for 6th button in article header
 *			  Default is stumbleupon
 * $wgAddThisHServ6set
 * 			- Settings for 6th button in article header
 * $wgAddThisHServ7
 * 			- Service code for 7th button in article header
 *			  Default is reddit
 * $wgAddThisHServ7set
 * 			- Settings for 7th button in article header
 * $wgAddThisHServ8
 * 			- Service code for 8th button in article header
 *			  Default is email
 * $wgAddThisHServ8set
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
$wgAddThisSBServ1	 = 'compact';
$wgAddThisSBServ1set = '';
$wgAddThisSBServ2	 = 'facebook';
$wgAddThisSBServ2set = '';
$wgAddThisSBServ3	 = 'twitter';
$wgAddThisSBServ3set = '';
$wgAddThisSBServ4	 = 'google_plusone';
$wgAddThisSBServ4set = 'g:plusone:count="false" style="margin-top:1px;"';
$wgAddThisSBServ5	 = 'email';
$wgAddThisSBServ5set = '';

# Toolbar settings
$wgAddThisHServ1	 = 'facebook';
$wgAddThisHServ1set  = '';
$wgAddThisHServ2	 = 'twitter';
$wgAddThisHServ2set  = '';
$wgAddThisHServ3	 = 'google_plusone';
$wgAddThisHServ3set  = 'g:plusone:count="false" style="margin-top:1px;"';
$wgAddThisHServ4	 = 'linkedin';
$wgAddThisHServ4set  = '';
$wgAddThisHServ5	 = 'tumblr';
$wgAddThisHServ5set  = '';
$wgAddThisHServ6	 = 'stumbleupon';
$wgAddThisHServ6set  = '';
$wgAddThisHServ7	 = 'reddit';
$wgAddThisHServ7set  = '';
$wgAddThisHServ8	 = 'email';
$wgAddThisHServ8set  = '';


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