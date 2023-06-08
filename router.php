<?php
// $url_path = trim( $_SERVER[ 'REQUEST_URI' ], '/' );

// if ( ! $url_path ) {
//     include( 'index.php' );
//     return;
// }

// $route = explode("/", $url_path);
// $_GET['controller'] = $route[0];
// $_GET['action'] = $route[1];

// if( ! preg_match( '/[.]/', $url_path ) ) {
//     include( 'index.php');
//     return;
// }

// if( preg_match( '/[.css]/', $url_path ) ) {
//     header("Content-type: text/css");
//     include( $url_path );
// }