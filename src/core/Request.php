<?php

namespace app\core;

/**
** @class Request
** @author chrosxz-alfin-bisma
** @package app\
** @subpackage app\core\
** @description digunakan untuk menangani permintaan super global variabel $_SERVER['REQUEST_URI'] dan $_SERVER['PATH_INFO']
*/
class Request
{
  /* @function getPath 
  ** @return string
  ** @description Mengambil nilai $_SERVER['REQUEST_URI'] atau dari URL
  */

  public function getPath(){
    $path = $_SERVER['REQUEST_URI'] ?? '/';                                   //diasumsukan bahwa isinya adalah kosong (false) atau sama dengan '/'
    $position = strpos($path,'?');                                            //cari posisi tanda tanya pada URI

    //Periksa posisi ? pada URI
    if($position === false){
      return $path;                                                           //Jika tanda tanya tidak ditemukan, kembalikan nilai path (final path)
    }

    //Jika tanda tanya ditemukan
    return substr($path,0,$position);                                        //Ambil bagian dari path mulai posisi ke 0 sampai posisi tanda tanya
  }

  /* @function getMethod
  ** @return string
  ** @description Mengambil nilai $_SERVER['REQUEST_METHOD'] atau dari URL (GET atau POST)
  */
  public function getMethod(){
    
    return strtolower($_SERVER['REQUEST_METHOD']);

  }
}
