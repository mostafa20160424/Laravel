<?php
//to create controller you should write (php artisan make:controller controller name)

//to create controller in folder you should write (php artisan make:controller folderName/controllerName)

//to create controller with All Function you should write (php artisan make:controller controllerName --resource)

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{

    public function index()
    {
        return "Show Data For All Users";
    }


    public function create()
    {
        return "Create New User";
    }


    public function store(Request $request)
    {
        return "Store New User";
    }


    public function show($id)
    {
        return "Take Id For One User And Show Its Information";
    }


    public function edit($id)
    {
        return "Edit User By ID";
    }

    public function update(Request $request, $id)
    {
        return "Update User Information"; 
    }


    public function destroy($id)
    {
        return "Delete Member By ID";
    }
}
