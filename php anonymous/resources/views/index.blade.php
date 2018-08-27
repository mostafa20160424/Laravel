@include('header')
@include('messages')

  <h1 style="text-align:center">News</h1>
@yield('content')
@yield('js')
@include('footer')
<?php //@include(filename,[key=>value]) you can print $key in the filename ?>
