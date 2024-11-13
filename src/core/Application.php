<?php

namespace app\core;

/**
 * @class Application
 * @author chrosxz-alfin-bisma
 * @package app\
 * @subpackage app\core\
 * @description Dipergunakan sebagai class utama
 */

class Application
{
  public static string $ROOT_DIR;
  public Router $router;
  public Request $request;

  public function __construct($rootPath){
    /*
    $this->router = new Router();
    $this->request = new Request();
    */
    self::$ROOT_DIR = $rootPath;
    $this->request = new Request();
    $this->router = new Router($this->request);

  }

  public function run(){
    echo $this->router->resolve();
  }
}
