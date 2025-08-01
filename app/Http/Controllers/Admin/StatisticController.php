<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistics;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistics::all();
        return Inertia::render('Admin/Statistic/Index', compact('statistics'));
    }
}
