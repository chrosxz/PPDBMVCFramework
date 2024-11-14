<?php
/*  
** @author chrosxz-alfin-bisma
** @purpose file pertama yang dieksekusi oleh server
** @fileoverview Menjalankan aplikasi PPDB
*/

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');

$app->router->get('/contact', 'contact');

$app->router->post('/contact', function(){
  return  'Data yang dikirimkan';
});
  

$app->run();