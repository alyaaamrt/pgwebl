<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;
use App\Models\PolygonsModel;
use App\Models\PolylinesModel;

class TableController extends Controller
{
    public function __construct()
    {
        $this->point = new PointsModel();
        $this->polyline = new PolylinesModel();
        $this->polygon = new PolygonsModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Table',
            'points' => $this->point->all(),
        ];

        return view('table', $data);
    }
}
