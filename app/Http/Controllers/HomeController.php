<?php

namespace App\Http\Controllers;

use App\Models\DisasterModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(): \Inertia\Response
    {
        $disasters = DisasterModel::all();

        return Inertia::render('Home', [
            'disasters' => $disasters
        ]);
    }
}
