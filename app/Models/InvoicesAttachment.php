<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesAttachment extends Model
{
    use HasFactory;
    protected $fillable = ['file_name', 'invoice_number', 'Created_by', 'invoice_id'];
    protected $table = 'invoices_attachments';

    public function invoice()
    {
        return $this->belongsTo(invoice::class, 'invoice_id');
    }
}
