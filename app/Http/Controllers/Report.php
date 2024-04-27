<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Request;

class Report extends Controller
{
    public function index()
    {
        return view('report.invoices_report');
    }

    public function search(Request $request)
    {
        $radio = $request->radio;
        if ($radio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = invoice::select('*')->where('Status', '=', $request->type)->get();
                $type = $request->type;
                return view('report.invoices_report', compact('type'))->with('details', $invoices);
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;
                $invoices = invoice::whereBetween('invoice_Date', ['$start_at', '$end_at'])->where('Status', '=', $request->type)->get();
                return view('report.invoices_report', compact('type', 'start_at', 'end_at'))->with('details', $invoices);
            }
        } else {
            $invoices = invoice::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('report.invoices_report')->with('details', $invoices);
        }
    }
}
