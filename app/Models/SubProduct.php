<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    use HasFactory;
    protected $fillable = ['Product_name', 'description', 'section_id'];
    protected $table = 'sub_products';


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
