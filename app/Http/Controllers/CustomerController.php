<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('report.customer_report', compact('sections'));
    }

    public function SearchInvoice(Request $request)
    {
        if ($request->section_id && $request->product && $request->start_at == '' && $request->end_at == '') {
            $invoices = invoice::select('*')->where('section_id', '=', $request->section_id)->where('product', '=', $request->product)->get();
            $sections = Section::all();

            return view('report.customer_report', compact('sections'))->with('details', $invoices);
        } else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $sections = Section::all();
            $invoices = invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', '=', $request->section_id)->where('product', '=', $request->product)->get();
            return view('report.customer_report', compact('start_at', 'end_at', 'sections'))->with('details', $invoices);
        }
    }
}
