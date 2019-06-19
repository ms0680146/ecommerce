<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class StaticHtmlController extends Controller
{
    public function thanks()
    {
        return view('thanks');
    }
}