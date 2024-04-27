<?php

namespace App\Http\Controllers;

use App\Models\InvoicesAttachment;
use Illuminate\Http\Request;

class InvoicesAttachmentController extends Controller
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
        $validated = $request->validate([
            'file_name' => 'mimes:png,jpg,pdf,jpeg'
        ], [
            'file_name.mimes' => 'png,jpg,pdf,jpeg الملف يجب ان يكون من الصيغة '
        ]);
        $file = $request->file('pic');
        $file_name = $file->getClientOriginalName();
        $invoice_number = $request->invoice_number;

        $attachment = new InvoicesAttachment();
        $attachment->file_name = $file_name;
        $attachment->invoice_number = $invoice_number;
        $attachment->invoice_id = $request->invoice_id;
        $attachment->Created_by = (Auth()->user()->name);
        $attachment->save();

        $imageName = $request->pic->getClientOriginalName();
        $request->pic->move(public_path('Attachment/' . $invoice_number), $imageName);
        session()->flash('Add', 'تم اضافة الملف بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoicesAttachment $invoicesAttachment)
    {
        //
    }
}
