<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'order_id',
        'invoice_date',
        'total_amount',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'invoice_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the client associated with the facture.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the order associated with the facture.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
