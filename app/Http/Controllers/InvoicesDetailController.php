<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoicesDetail $invoicesDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = invoice::where('id', $id)->first();
        $invoices_details = InvoicesDetail::where('id_Invoice', $id)->get();
        $invoice_attachments = InvoicesAttachment::where('invoice_id', $id)->get();
        // dd($invoices_details);
        return view('InvoiceList.invoices.invoice_detail', compact('invoice', 'invoices_details', 'invoice_attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoicesDetail $invoicesDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoicesDetail $invoicesDetail)
    {
        //
    }

    public function showFile($invoice_number, $file_name)
    {
        $filepath = $invoice_number . '/' . $file_name;
        $files = Storage::disk('public_uploads')->path($filepath);
        return response()->file($files);
    }

    public function download($invoice_number, $file_name)
    {
        $filepath = $invoice_number . '/' . $file_name;
        $download = Storage::disk('public_uploads')->path($filepath);
        return response()->download($download);
    }

    public function deletefile(Request $request, $id)
    {
        $file = InvoicesAttachment::findOrFail($id);
        $file->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
