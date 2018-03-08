<?php
/*
Plugin Name: Multiple Featured Images
Description: Enables multiple featured images for all post types. Comes with a widget for displaying the featured images.
Version: 0.4.3
Author: Marcus Kober
Author URI: http://www.koeln-dialog.de/
Text Domain: multiple-featured-images
Domain Path: /languages
*/

/*  Copyright 2016 Marcus Kober (m.kober@koeln-dialog.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

define( 'KDMFI_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'KDMFI_PLUGIN_FILE', __FILE__ );


if( !class_exists( 'KdMfi' ) ) {

    // Bootstrap Class
    class KdMfi {
        public static $version = '0.4.3';
        public static $prefix = 'kdmfi_';
        public static $app;

        public static function autoload( $className ) {
            if( strpos($className, '\\' ) !== false ) {
                $classPath = explode( '\\', $className );

                if( $classPath[0] == 'kdmfi' ) {
                    $fileName = KDMFI_PLUGIN_PATH.$classPath[1].DIRECTORY_SEPARATOR.$classPath[2].'.php';
                    require_once $fileName;
                }
            }
        }

    }

    spl_autoload_register( array( 'KdMfi', 'autoload' ), true, true );
    KdMfi::$app = new \kdmfi\Controller\KdMfiApp();
}

?>