<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{
    public function __invoke($id)
    {
        return 'This Is ID '.$id;
    }
}
