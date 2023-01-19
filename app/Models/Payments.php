<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Payments extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'payments';

    protected $fillable = [
        'user_id', 'amount', 'status'
    ];

    public function create_table($data)
    {
        $payments = new Payments();
        $payments->user_id = $data['user_id'];
        $payments->amount = $data['amount'];
        $payments->status = 'hold';
        $payments->save();
        return $payments;
    }

    public function update_table($data)
    {

        $payments = Payments::find($data['id']);
        $payments->status = $data['status'];
        $payments->save();
        return $payments;
    }


    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }


    public function table_name()
    {
        return $this->table;
    }
}
