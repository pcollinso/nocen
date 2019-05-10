<?php
namespace App\Http\Controllers\Applicant;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('applicant.home');
    }
}
