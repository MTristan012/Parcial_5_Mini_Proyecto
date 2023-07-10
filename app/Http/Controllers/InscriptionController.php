<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = Inscription::all();

        return view('admin/adminClasses', ["inscriptions" => $inscriptions]);
    }
}
