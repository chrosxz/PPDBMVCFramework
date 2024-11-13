<?php

namespace app\core;

/**
 * @class Router
 * @author chrosxz-alfin-bisma
 * @package app\
 * @subpackage app\core\
 * @description Dipergunakan untuk mengatur rute (route) pemanggilan fungsi berdasarkan path URI
 */

class Router
{
  public Request $request;
  protected array $routes = [];

  public function __construct(\app\core\Request $request){
    $this->request = $request;
  }

  /*
  * Method yang menangani method GET
  * @param string $path
  * @param callable $callback
  * @description Menambahkan route yang menangani method GET
  */
  public function get($path, $callback){
    $this->routes['get'][$path] = $callback;
    
  }

  /*
  * Method yang menjalankan aksi
  * @description Pengambilan router berdasarkan path dan menjalankan method yang sesuai
  */
  public function resolve(){
        
    $path = $this->request->getPath();                                                    //Ambil bagian path URI
    $method = $this->request->getMethod();                                                //Ambil nama method yang diinginkan dari URI

    /*
    * Periksa apakah di dalam array routes terdapat pethod (get/post)
    * yang sesuai dengan method dan path yang diinginkan
    * Jika ada, panggil fungsi yang terkait
    * Jika tidak, tampilkan pesan "Route not found" dan keluar program
    */
    $callback = $this->routes[$method][$path] ?? false;

    if ($callback === false){
      return "Route not found";
      exit;
    }

      if (is_string($callback)){
        return $this->renderViews($callback);
      }
    return call_user_func($callback);
  }

  public function renderViews($view){
    // Implementasi render views sesuai kebutuhan
    // Contoh:
    // return file_get_contents(self::$ROOT_DIR. '/views/'. $view. '.php');

    $layoutContent = $this->layoutContent();
    include_once Application::$ROOT_DIR . "/src/views/$view.php";
  }

  protected function layoutContent(){
    // Implementasi layout content sesuai kebutuhan
    // Contoh:
    // return file_get_contents(self::$ROOT_DIR. '/views/layouts/main.php');

    include_once Application::$ROOT_DIR . "/src/views/layouts/main.php";
  }
}