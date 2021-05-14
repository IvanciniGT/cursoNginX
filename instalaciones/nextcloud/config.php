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
    0 => 'ec2-54-74-100-250.eu-west-1.compute.amazonaws.com:8090',
    1 => 'ec2-54-74-100-250.eu-west-1.compute.amazonaws.com',
  ),
  
  'datadirectory' => '/var/www/html/data',
  'dbtype' => 'mysql',
  'version' => '21.0.1.1',
  'overwrite.cli.url' => 'http://ec2-54-74-100-250.eu-west-1.compute.amazonaws.com:8090/',
  'trusted_proxies' => ['0.0.0.0/0'],
  'dbname' => 'nextcloud',
  'dbhost' => '54.74.100.250',
  'dbport' => '3307',
  'dbtableprefix' => 'oc_',
  'mysql.utf8mb4' => true,
  'dbuser' => 'nextcloud',
  'dbpassword' => 'password',
  'installed' => true,
);
