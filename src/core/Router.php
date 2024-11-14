<?php

namespace app\core;

/*
** @class Router
** @author chrosxz-alfin-bisma
** @package app\
** @subpackage app\core\
** @description Dipergunakan untuk mengatur rute (route) pemanggilan fungsi berdasarkan path URI
*/

class Router
{
  public Request $request;
  public Response $response;
  protected array $routes = [];

  /*
  ** Router Constructor
  ** @param \app\core\Request $request
  ** @param \app\core\Response $response
  */
  public function __construct(Request $request, Response $response){
    $this->request = $request;
    $this->response = $response;
  }

  /*
  ** Method yang menangani method GET
  ** @param string $path
  ** @param callable $callback
  ** @description Menambahkan route yang menangani method GET
  */
  public function get($path, $callback){
    $this->routes['get'][$path] = $callback;
    
  }

  /* Method yang menangani method POST
  ** @param string $path
  ** @param callable $callback
  ** @description Menambahkan route yang menangani method POST
  */
  public function post($path, $callback){
    $this->routes['post'][$path] = $callback;
    
  }

  /*
  ** Method yang menjalankan aksi
  ** @description Pengambilan router berdasarkan path dan menjalankan method yang sesuai
  */
  public function resolve(){
        
    $path = $this->request->getPath();                                                    //Ambil bagian path URI
    $method = $this->request->getMethod();                                                //Ambil nama method yang diinginkan dari URI

    /*
    ** Periksa apakah di dalam array routes terdapat pethod (get/post)
    ** yang sesuai dengan method dan path yang diinginkan
    ** Jika ada, panggil fungsi yang terkait
    ** Jika tidak, tampilkan pesan "Not Found" atau router method dan path tidak ditemukan
    */
    $callback = $this->routes[$method][$path] ?? false;                                   //Jika route = null maka isi dengan false

    if ($callback === false){
      //Application::$app->response->setStatusCode(404);
      $this->response->setStatusCode(404);
      return "Not Found";
    }

    if (is_string($callback)){                                                            //Periksa apakah $callback berisi string
      return $this->renderView($callback);                                               //Panggil fungsi renderview sesuai dengan isi $callback
    }

    return call_user_func($callback);
  }

  /*
  ** Method yang menampilkan views
  ** @param string $view
  ** @description Mengambil file view yang diinginkan kemudian dimasukkan (injection) ke dalam tampilan utama
  ** Jadi pada view yang diinginkan tidak perlu membuat pengulangn script yang sama seperti header, menu, dan footer
  */
  public function renderView($view){

    $layoutContent = $this->layoutContent();                                              //ambil output tampilan utama (php html)
    $viewContent = $this->renderOnlyView($view);                                   //ambil output content

    //Masukkan (inject) output content ke dalam output view pada bagian {{content}}
    //Caranya adalah dengan me-replace bagian {{content}} pada main content dengan bagian output content
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  /*
  ** Method yang mengambil output tampilan utama (php html)
  ** @description Mengambil output tampilan utama yang diletakkan di file main.php
  ** Biasanya berisi html (tanpa bagian utama / content) yang terdiri dari:
  ** - Header
  ** - Menu
  ** - Footer
  */
  protected function layoutContent(){
    ob_start();                                                                           //start output caching view
    include_once Application::$ROOT_DIR . "/src/views/layouts/main.php";                  //tambahkan output scipt tampilan utama (php html)
    return ob_get_clean();                                                                //bersihkan output cache view
  }

  protected function renderOnlyView($view){
    ob_start();                                                                           //start output caching view
    include_once Application::$ROOT_DIR . "/src/views/$view.php";                         //tambahkan output scipt tampilan utama (php html)
    return ob_get_clean();                                                                //bersihkan output cache view
  }
}