<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesDetail extends Model
{
    use HasFactory;
    protected $fillable = ['id_Invoice', 'invoice_number', 'product', 'Section', 'Status', 'Value_Status', 'Payment_Date', 'note', 'user'];
    protected $table = 'invoices_details';



    public function invoice()
    {
        return $this->belongsTo(invoice::class, 'invoice_id ');
    }
}
