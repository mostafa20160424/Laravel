<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Uplode extends Controller
{
    public function uplode()
    {
      $nicename=[];
      $i=1;
      foreach ( request()->file('file') as $file) {
        $nicename[] = 'The File '.$i;
        //foreach file validation
        //ex:if file 1 you uplode extendsion !=jpg,jpeg,png will print The File 1 .error you specify at bottom
        $i++;
      }
    // $this->validate(request(),['input name.*'=>'required|file type|mimes:extentions...']);
    // file.* if it array mean uplode more than one file
      $this->validate(request(),['file.*'=>'required|image|mimes:jpg,jpeg,png'],[],$nicename);
      $files=request()->file('file');//=request('file')
      $i=1;
      foreach ($files as $file) {
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $min = $file->getMimeType();
        $relpath=$file->getRealPath();
        $file->move(public_path('uplodes'),$i.'.'.$extension);//path,name
        $i++;
      }
      return back();
      // request()->hasFile('input name')
      //request()->all() return object have all values return from the form
    }
}
