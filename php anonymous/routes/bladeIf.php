<?php
/*
you should first include this file in RouteServiceProvider in map or boot function
 */
Blade::if('checkauth',function($val1=null){
  //if function parameter have datatype you can send "mostafa" and will print it mostafa opposite of directive
  //if function value must send if you not give parameter  default value opposite of directive
  return auth()->check() === false?true:false;
  // auth()->check() return false if he not login
});

 ?>
