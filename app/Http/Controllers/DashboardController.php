<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class DashboardController extends Controller
{
    function index()
    {
        $invoices = Invoice::count() ? Invoice::count() : 1;

        $unPaid = number_format(Invoice::where('Value_Status', 2)->count() / $invoices  * 100, 2);
        $Paid = number_format(Invoice::where('Value_Status', 1)->count() / $invoices * 100, 2);
        $partialPaid = number_format(Invoice::where('Value_Status', 3)->count() / $invoices * 100, 2);


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير الغير مدفوعه', 'الفواتير المدفوعه جزئيا', 'الفواتير المدفوعه '])
            ->datasets([
                [
                    "label" => "نسبة الفواتير الغير مدفوعه",
                    'backgroundColor' => ['rgba(255, 0, 0)'],
                    'data' => [$unPaid]
                ],
                [
                    "label" => "نسبة الفواتير المدفوعه جزئيا",
                    'backgroundColor' => ['rgba(255,165,0)'],
                    'data' => [$partialPaid]
                ],
                [
                    "label" => "نسبة الفواتير المدفوعه ",
                    'backgroundColor' => ['rgba(0,255,0)'],
                    'data' => [$Paid]
                ],

            ])
            ->options([]);



        $chartjs2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير الغير مدفوعه', 'الفواتير المدفوعه جزئيا', 'الفواتير المدفوعه '])
            ->datasets([
                [
                    'backgroundColor' => ['rgba(255,0,0)', 'rgba(255,165,0)', 'rgba(0,255,0)'],
                    'data' => [$unPaid, $partialPaid, $Paid]
                ]
            ])
            ->options([]);


        return view('dashboard', compact('chartjs', 'chartjs2'));
    }
}