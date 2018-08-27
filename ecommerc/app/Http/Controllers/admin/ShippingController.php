<?php

namespace App\Http\Controllers\Admin;
use App\Shipping;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\ShippingDatatable;

use Storage;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDatatable $shipping)
    {
        return $shipping->render('admin.shippings.index',['title'=>'shipping Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shippings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * to uplodes the photos in public/storage folder
         * 1-set FILESYSTEM_DRIVER=public in .env file
         * 2-write command "php artisan storage:link"
         * */
        $data=$this->validate(request(),[
            'name_ar'=>'required',
            'name_en'=>'required',
            'user_id'         =>'required|numeric',
            'lat'                =>'sometimes|nullable',
            'lng'                =>'sometimes|nullable',
            'logo'               =>'sometimes|nullable|'.v_image(),// |unique:tablename that you want email be unique for
        ],[],[
            'name_ar'=>trans('admin.manufacture_name_ar'),
            'name_en'=>trans('admin.manufacture_name_en'),
            'user_id'         =>trans('admin.contact_me'),
            'lat'                =>trans('admin.lat'),
            'lng'                =>trans('admin.lng'),
            'logo'=>trans('admin.logo'),
        ]);
        if(request()->hasFile('logo')){
          $data['logo']=up()->uplode([
            'new_name'=>null,
            'file'		=>'logo',
            'path'		=>'shippings',//folder name in storage folder
            'uplode_type'=>'single',

          ]);
        }
        Shipping::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('shippings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping=Shipping::find($id);
        return view('admin.shippings.edit',compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$this->validate(request(),[
            'name_ar'=>'required',
            'name_en'=>'required',
            'user_id'         =>'required|numeric',
            'lat'                =>'sometimes|nullable',
            'lng'                =>'sometimes|nullable',
            'logo'               =>'sometimes|nullable|'.v_image(),// |unique:tablename that you want email be unique for
        ],[],[
            'name_ar'=>trans('admin.manufacture_name_ar'),
            'name_en'=>trans('admin.manufacture_name_en'),
            'user_id'         =>trans('admin.contact_me'),
            'lat'                =>trans('admin.lat'),
            'lng'                =>trans('admin.lng'),
            'logo'=>trans('admin.logo'),
        ]);
      if(request()->hasFile('logo')){
        $data['logo']=up()->uplode([
          'new_name'    =>null,
          'file'		=>'logo',
          'path'		=>'shippings',
          'uplode_type' =>'single',
          'delete_file' =>Shipping::find($id)->logo,
        ]);
      }
      else{
        $data['logo']=Shipping::find($id)->logo;
      }
      Shipping::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('shippings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping=Shipping::find($id);
        Storage::delete($shipping->logo);
        $shipping->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('shippings'));
    }

    public function multi_delete()
    {
      
      if(is_array(request('item'))){
        foreach (request('item') as $id) {
          $shipping=Shipping::find($id);
          Storage::delete($shipping->logo);
          $shipping->delete();
        }
      }else{
        $shipping=Shipping::find(request('item'));
        Storage::delete($shipping->logo);
        $shipping->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('shippings'));
    }
}
