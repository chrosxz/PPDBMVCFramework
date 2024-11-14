<?php

namespace app\core;

/**
** @class Application
** @author chrosxz-alfin-bisma
** @package app\
** @subpackage app\core\
** @description Dipergunakan sebagai class utama
*/
class Response
{
  public function setStatusCode(int $code){
    http_response_code($code);
  }
}
