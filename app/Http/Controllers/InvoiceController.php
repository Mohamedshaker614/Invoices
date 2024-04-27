<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\invoice;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetail;
use App\Models\Section;
use App\Models\SubProduct;
use App\Models\User;
use App\Notifications\AddInvoice;
use App\Notifications\InvoiceNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = invoice::paginate(10);
        $sections = Section::all();
        $subproducts = SubProduct::all();
        return view('InvoiceList.invoices.index', compact('sections', 'invoices', 'subproducts'));
    }

    public function create()
    {
        $sections = Section::all();
        $subproducts = SubProduct::all();
        $invoices = invoice::paginate();
        // dd($subproducts);
        return view('InvoiceList.invoices.create', compact('sections', 'subproducts', 'invoices'));
    }

    public function store(Request $request)
    {


        $validated1 = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'invoice_Date' => 'date|required',
            'Due_date' => 'date|required',
            'section_id' => 'required',
            'product' => 'string|required',
            'Amount_collection' => 'required',
            'Amount_Commission' => 'required',
            'Discount' => 'required',
            'note' => 'string|max:255',
        ]);


        $data = $request->all();
        $invoice = invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);


        $invo = InvoicesDetail::create([
            'id_Invoice' => $invoice->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->section_id,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => Auth::user()->name
        ]);

        $invoice_id = invoice::latest()->first()->id;
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $file_name = $file->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachment = new InvoicesAttachment();
            $attachment->file_name = $file_name;
            $attachment->invoice_number = $invoice_number;
            $attachment->invoice_id = $invoice_id;
            $attachment->Created_by = (Auth()->user()->name);
            $attachment->save();


            //move photo
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachment/' . $invoice_number), $file_name);
        }


        //send mail
        $user = User::first();
        Notification::send($user, new AddInvoice($invoice_id));

        //send notifications
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $byUser = auth()->user()->name;
        $title = "تم إنشاء فاتورة جديدة بواسطة :" . $byUser;
        $a = Notification::send($users, new InvoiceNotifications($invoice_id, $byUser, $title));
        session()->flash('Add_invoice');
        return redirect()->route('invoices.index');
    }


    public function show($id)
    {

        $invoice = invoice::findorFail($id);
        $notification = DB::table('notifications')->where('data->invoice_id', '=', $id)->where('notifiable_id', auth()->user()->id)->first();
        if ($notification) {
            DB::table('notifications')->where('id', $notification->id)->update(['read_at' => now()]);
        }
        $invoices_details = InvoicesDetail::where('id_Invoice', $id)->get();
        $invoice_attachments = InvoicesAttachment::where('invoice_id', $id)->get();
        return view('InvoiceList.invoices.invoice_detail', compact('invoice', 'invoices_details', 'invoice_attachments'));
    }

    public function edit($id)
    {
        $invoice = invoice::where('id', $id)->first();
        $sections = Section::all();
        return view('InvoiceList.invoices.edit', compact('sections', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validated1 = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'invoice_Date' => 'date|required',
            'Due_date' => 'date|required',
            'product' => 'string|required',
            // 'section_id' => $request->section_id,
            'Amount_collection' => 'required',
            'Amount_Commission' => 'required',
            'Discount' => 'required',
            'note' => 'string|max:255',

        ]);


        $data = $request->all();
        $invoice = invoice::findOrFail($id);
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoicedetail = InvoicesDetail::where('id_Invoice', $id)->first();
        $invoicedetail->update([
            'id_Invoice' => $invoice->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->section_id,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => Auth::user()->name
        ]);

        if ($request->hasFile('pic')) {
            $invoice_id = invoice::latest()->first()->id;
            $file = $request->file('pic');
            $file_name = $file->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            $attachment = new InvoicesAttachment();
            $attachment->file_name = $file_name;
            $attachment->invoice_number = $invoice_number;
            $attachment->invoice_id = $invoice_id;
            $attachment->Created_by = (Auth()->user()->name);
            $attachment->save();


            //move photo
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachment/' . $invoice_number), $file_name);
        }
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }


    public function softDelete(Request $request, $id)
    {

        $invoice = invoice::findOrFail($id);
        $detail = InvoicesAttachment::where('invoice_id', $id)->first();

        $page_id = $request->page_id;

        if (!$page_id == 2) {
            if (!empty($detail->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($detail->invoice_number);
            }
            $invoice->forceDelete();
            session()->flash('delete_invoice');
            return redirect()->back();
        } else {
            $invoice->Delete();
            session()->flash('Archive');
            return redirect()->back();
        }
    }

    public function statusPay($id)
    {
        $invoice = invoice::where('id', $id)->first();
        return view('InvoiceList.invoices.statuspay', compact('invoice'));
    }

    public function updateStatusPay(Request $request, $id)
    {
        $validated = $request->validate([
            'Status' => 'required',
            'Payment_Date' => 'required'
        ]);

        $invoice = invoice::findOrFail($id);
        if ($request->Status === 'مدفوعة') {
            $invoice->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date
            ]);
            InvoicesDetail::create([
                'id_Invoice' => $invoice->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->section_id,
                'Status' => 'مدفوعة',
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => Auth::user()->name
            ]);
        } else {
            $invoice->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date
            ]);
            InvoicesDetail::create([
                'id_Invoice' => $invoice->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->section_id,
                'Status' => 'مدفوعة جزئياً',
                'Value_Status' => 3,
                'Payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => Auth::user()->name
            ]);
        }
        session()->flash('edit_status');
        return redirect()->route('invoices.index');
    }


    public function invoicePaid()
    {
        $invoices = invoice::where('Value_Status', 1)->get();
        return view('InvoiceList.invoices.invoice_paid', compact('invoices'));
    }

    public function invoiceUnPaid()
    {
        $invoices = invoice::where('Value_Status', 2)->get();
        return view('InvoiceList.invoices.invoice_unpaid', compact('invoices'));
    }

    public function invoicePartial()
    {
        $invoices = invoice::where('Value_Status', 3)->get();
        return view('InvoiceList.invoices.invoice_partial', compact('invoices'));
    }

    public function printInvoice($id)
    {
        $invoice = invoice::findOrFail($id)->where('id', $id)->first();
        return view('InvoiceList.invoices.printinvoice', compact('invoice'));
    }


    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function markAsRead()
    {
        $user = User::find(auth()->user()->id);
        foreach ($user->unreadnotifications as $notification) {
            $notification->delete();
        }
        return redirect()->back();
    }
}
