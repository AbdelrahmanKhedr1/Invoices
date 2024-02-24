<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\User;

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

        $all = number_format(Invoice::count());
        $unpaid = number_format(Invoice::where('status_id', 1)->count() / $all * 100, 2);
        $paid = number_format(Invoice::where('status_id', 2)->count() / $all * 100, 2);
        $partpaid = number_format(Invoice::where('status_id', 3)->count() / $all * 100, 2);

        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 150])
            ->labels(['Unpaid', 'Partially Paid', 'Paid'])
            ->datasets([
                [
                    "label" => "Percentage",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(200, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$unpaid, $partpaid, $paid],
                ],

            ])
            ->options([]);

        $chartjs2 = app()->chartjs
            ->name('polarAreaChartTest')
            ->type('polarArea')
            ->size(['width' => 400, 'height' => 217])
            ->labels(['Unpaid', 'Partially Paid', 'Paid'])
            ->datasets([
                [
                    'backgroundColor' => ['#e65668', '#e4a669', '#285fe1'],
                    'hoverBackgroundColor' => ['#e65668', '#e4a669', '#285fe1'],
                    'data' => [$unpaid, $partpaid, $paid]
                ]
            ]);



            $rat1 = number_format(Invoice::where('rate_vat', '10%')->count());
            $rat2 = number_format(Invoice::where('rate_vat', '5%')->count());

        $chartjs3 = app()->chartjs
            ->name('doughnutChartTest')
            ->type('doughnut')
            ->size(['width' => 400, 'height' => 205])
            ->labels(['Rate Vate 10%', 'Rate Vate 5%'])
            ->datasets([
                [
                    "label" => "Nember of Rate Vate",
                    'backgroundColor' => ["rgba(50, 115, 223, 0.31)" , 'rgba(228, 137, 80, 0.31)'],
                    'borderColor' => ["rgba(50, 115, 223, 0.7)" , 'rgba(228, 137, 80, 0.7)'],
                    "pointBorderColor" => ["rgba(50, 115, 223, 0.7)" , 'rgba(228, 137, 80, 0.7)'],
                    "pointBackgroundColor" => ["rgba(50, 115, 223, 0.7)" , 'rgba(228, 137, 80, 0.7)'],
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$rat1, $rat2],
                ],

            ])
            ->options([]);

            $users = User::orderBy('created_at', 'desc')->take(5)->get();
            $invoices = Invoice::orderBy('created_at', 'desc')->take(5)->get();

        return view('home', compact('chartjs', 'chartjs2','chartjs3','users','invoices'));
    }
}
