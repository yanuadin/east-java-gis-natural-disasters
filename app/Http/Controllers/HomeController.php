<?php

namespace App\Http\Controllers;

use App\Models\DisasterModel;
use App\Models\TypeOfDisasterModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    protected $YEAR = [
        [
            "id" => 1,
            "value" => 2019,
        ],
        [
            "id" => 2,
            "value" => 2020,
        ],
        [
            "id" => 3,
            "value" => 2021,
        ],
    ];

    public function index(Request $request): Response
    {
        $selected_year = $request->selected_year_id === null ?
            json_encode($this->YEAR[0]) :
            json_encode($this->YEAR[array_search($request->selected_year_id, array_column($this->YEAR, 'id'))]);

        return Inertia::render('Home', [
            'disasters' => DisasterModel::all(),
            'types' => TypeOfDisasterModel::all(),
            'selected_type' => TypeOfDisasterModel::when($request->selected_type_id !== null, function ($q) use ($request) {
                $q->where('id', $request->selected_type_id);
            })->first(),
            'selected_year' => $selected_year,
        ]);
    }
}
