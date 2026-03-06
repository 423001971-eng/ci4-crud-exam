<?php
/*
 * This is needed for cookie based authentication to encrypt password in
 * cookie
 */
$cfg['blowfish_secret'] = 'xampp'; /* YOU SHOULD CHANGE THIS FOR A MORE SECURE COOKIE AUTH! */

/*
 * Servers configuration
 */
$i = 0;

/*
 * First server
 */
$i++;

/* Authentication type and info */
$cfg['Servers'][$i]['auth_type'] = 'config';   // 'config' = automatic login using username/password
$cfg['Servers'][$i]['user'] = 'root';          // default XAMPP MySQL user
$cfg['Servers'][$i]['password'] = '';          // default XAMPP MySQL password is empty
$cfg['Servers'][$i]['extension'] = 'mysqli';  
$cfg['Servers'][$i]['AllowNoPassword'] = true; // allow login with empty password

/* Bind to localhost */
$cfg['Servers'][$i]['host'] = 'localhost';     // changed from 127.0.0.1
$cfg['Servers'][$i]['connect_type'] = 'tcp';

/* Optional: disable advanced features if not needed */
// $cfg['Servers'][$i]['controluser'] = 'pma';
// $cfg['Servers'][$i]['controlpass'] = '';

/* Disable advanced phpMyAdmin features to prevent errors */
$cfg['Servers'][$i]['pmadb'] = '';
$cfg['Servers'][$i]['bookmarktable'] = '';
$cfg['Servers'][$i]['relation'] = '';
$cfg['Servers'][$i]['table_info'] = '';
$cfg['Servers'][$i]['table_coords'] = '';
$cfg['Servers'][$i]['pdf_pages'] = '';
$cfg['Servers'][$i]['column_info'] = '';
$cfg['Servers'][$i]['history'] = '';
$cfg['Servers'][$i]['designer_coords'] = '';
$cfg['Servers'][$i]['tracking'] = '';
$cfg['Servers'][$i]['userconfig'] = '';
$cfg['Servers'][$i]['recent'] = '';
$cfg['Servers'][$i]['table_uiprefs'] = '';
$cfg['Servers'][$i]['users'] = '';
$cfg['Servers'][$i]['usergroups'] = '';
$cfg['Servers'][$i]['navigationhiding'] = '';
$cfg['Servers'][$i]['savedsearches'] = '';
$cfg['Servers'][$i]['central_columns'] = '';
$cfg['Servers'][$i]['designer_settings'] = '';
$cfg['Servers'][$i]['export_templates'] = '';
$cfg['Servers'][$i]['favorite'] = '';

/*
 * End of servers configuration
 */
?>