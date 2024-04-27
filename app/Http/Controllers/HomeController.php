<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير المدفوعة', 'الفواتير الغير مدفوعة', 'الفواتير المدفوعة جزئياً'])
            ->datasets([
                [
                    "label" => "الفواتير",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [round((invoice::where('Value_Status', 1)->count() / invoice::count()) * 100, 2), round((invoice::where('Value_Status', 2)->count() / invoice::count()) * 100, 2), round((invoice::where('Value_Status', 3)->count() / invoice::count()) * 100, 2)]
                ],

            ])
            ->options([]);


        $chartjs2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير المدفوعة', 'الفواتير المدفوعة جزئياً', 'الفواتير الغير مدفوعة'])
            ->datasets([
                [
                    'backgroundColor' => ['#79AC78', '#FFA732', '#B80000'],
                    'hoverBackgroundColor' => ['#79AC78', '#FFA732', '#B80000'],
                    'data' => [round((invoice::where('Value_Status', 1)->count() / invoice::count()) * 100, 2), round((invoice::where('Value_Status', 2)->count() / invoice::count()) * 100, 2), round((invoice::where('Value_Status', 3)->count() / invoice::count()) * 100, 2)]
                ]
            ])
            ->options([]);
        return view('home', compact('chartjs', 'chartjs2'));
    }
}
