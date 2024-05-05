<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(Request $request, $locale)
    {
        if($locale){
            $request->session()->put('locale', $locale);
        }
        return redirect()->back();
    }
}
