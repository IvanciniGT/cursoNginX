<?php
$CONFIG = array (
  'htaccess.RewriteBase' => '/',
  'memcache.local' => '\\OC\\Memcache\\APCu',
  'apps_paths' => 
  array (
    0 => 
    array (
      'path' => '/var/www/html/apps',
      'url' => '/apps',
      'writable' => false,
    ),
    1 => 
    array (
      'path' => '/var/www/html/custom_apps',
      'url' => '/custom_apps',
      'writable' => true,
    ),
  ),
  'instanceid' => 'ocvl0pzn2n93',
  'passwordsalt' => '5H05kXepuwjhyt6/vqddoW7gbFYczJ',
  'secret' => 'Ewokup05IMYj3hJlsY8CM215IQXWhIhlF/fhHORfxE9E34oM',
  'trusted_domains' => 
  array (
    0 => '34.255.98.213:8089',
    1 => '34.255.98.213:8090',
    2 => 'ip-172-31-15-80:8089',
    3 => '172.18.0.1:8089',
  ),
  'datadirectory' => '/var/www/html/data',
  'dbtype' => 'mysql',
  'version' => '21.0.1.1',
  'overwrite.cli.url' => 'http://34.255.98.213:8089',
  'dbname' => 'nextcloud',
  'dbhost' => 'db',
  'dbport' => '',
  'dbtableprefix' => 'oc_',
  'mysql.utf8mb4' => true,
  'dbuser' => 'nextcloud',
  'dbpassword' => 'password',
  'installed' => true,
);
