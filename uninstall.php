<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete options
delete_option( 'MEDME-setting' );
delete_option( 'MEDME-setting-1' );
delete_option( 'MEDME-setting-2' );
delete_option( 'MEDME-setting-3' );

// Deprecated options
delete_option( 'MEDME-setting-4' );
delete_option( 'MEDME-setting-5' );
delete_option( 'MEDME-setting-6' );

// For site options in Multisite
delete_site_option( 'MEDME-setting' );
delete_site_option( 'MEDME-setting-1' );
delete_site_option( 'MEDME-setting-2' );
delete_site_option( 'MEDME-setting-3' );

// Deprecated site options in Multisite
delete_site_option( 'MEDME-setting-4' );
delete_site_option( 'MEDME-setting-5' );
delete_site_option( 'MEDME-setting-6' );
