<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'product',
        'invoice_number',
        'status_id',
        'rate_vat',
        'value_vat',
        'discount',
        'due_date',
        'total',
        'note',
        'amount_collection',
        'amount_commission',
        'section_id',
        'file',
        'user',
    ];
    public function section() {
        return $this->belongsTo(Section::class);
    }
    public function status() {
        return $this->belongsTo(Status::class);
    }

}
