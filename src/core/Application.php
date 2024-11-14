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
  public Response $response;
  public static Application $app;                                                 //property static dari class Application

  public function __construct($rootPath){
    
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;                                                       //menyimpan instance class Application ke property static $app
    $this->request = new Request();
    $this->response = new Response();
    

    /*
    $this->router = new Router();
    $this->request = new Request();
    */
    $this->router = new Router($this->request, $this->response);

  }

  public function run(){
    echo $this->router->resolve();
  }
}
