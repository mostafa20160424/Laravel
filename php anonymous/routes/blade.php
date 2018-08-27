<?php
/*
you should first include this file in RouteServiceProvider in map or boot function
 */
Blade::directive('test',function($val1){
  //directive function parameter not have datatype you can send "mostafa" and will print it "mostafa"
  if ($val1 == 2018) {
    return "This Year is 2018";
  }else{
    return "welcome";
  }
});

 ?>
