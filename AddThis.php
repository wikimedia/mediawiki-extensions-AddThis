<?php
if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'AddThis' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['AddThis'] = __DIR__ . '/i18n';
	wfWarn(
		'Deprecated PHP entry point used for AddThis extension. Please use wfLoadExtension' .
		'instead, see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return true;
} else {
	die( 'This version of the AddThis extension requires MediaWiki 1.29+' );
}
