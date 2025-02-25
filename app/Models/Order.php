<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'customer_name', 'email', 'phone', 'address', 'total', 'status',
    ];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    
    public static function getStatusName($status)
    {
        $statuses = [
            'pending' => 'В ожидании',
            'processing' => 'Обрабатывается',
            'completed' => 'Завершён',
            'canceled' => 'Отменён',
        ];

        return $statuses[$status] ?? $status;
    }

}

