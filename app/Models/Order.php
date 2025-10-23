<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'apply_date',
        'delivery_date',
        'price',
        'price_currency',
        'weight',
        'cube',
        'referrer',
        'loading_point',
        'address',
        'note',
        'security_mode',
        'is_evaluate',
        'ready_status',
        'product_name',
        'first_car_count',
        'second_car_count',
        'stackable',
        'number_of_places',
        'msds',
        'exportable',
        'tax_id',
        'supplier_address',
        'internal_transport',
        'mix_full',
        'container_count',
        'cbm',
        'order_status',
        'status',
        'handover',
        'customer_id',
        'warehouse_id',
        'customs_clearance_id',
        'incoterm_id',
        'container_type_id',
        'user_id',
        'city_id',
        'district_id',
        'about_booking_date_id',
        'transportation_type_id',
        'transportation_service_id',
        'transportation_id',
        'first_car_type_id',
        'second_car_type_id',
    ];

    protected $casts = [
        'apply_date' => 'datetime',
        'delivery_date' => 'datetime',
        'status' => OrderStatus::class,
        'width' => 'float',
        'height' => 'float',
        'length' => 'float',
        // 'mix_full' => OrderMixFull::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function customs_clearance()
    {
        return $this->belongsTo(CustomsClearance::class, 'customs_clearance_id');
    }

    public function incoterm()
    {
        return $this->belongsTo(Incoterm::class, 'incoterm_id');
    }

    public function container_type()
    {
        return $this->belongsTo(ContainerType::class, 'container_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function about_booking_date()
    {
        return $this->belongsTo(AboutBookingDate::class, 'about_booking_date_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function transportation_type()
    {
        return $this->belongsTo(TransportationType::class, 'transportation_type_id');
    }

    public function transportation_service()
    {
        return $this->belongsTo(TransportationService::class, 'transportation_service_id');
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class, 'transportation_id');
    }

    public function reject()
    {
        return $this->hasOne(OrderReject::class, 'order_id');
    }

    public function prices()
    {
        return $this->hasMany(OrderPrice::class, 'order_id');
    }

    public function sizes()
    {
        return $this->hasMany(OrderSize::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(OrderPayment::class, 'order_id');
    }

    public function expenses()
    {
        return $this->hasMany(OrderExpense::class, 'order_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function receives()
    {
        return $this->hasMany(Receive::class, 'order_id');
    }

    public function price_types()
    {
        return $this->hasMany(OrderPriceType::class, 'order_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'order_id');
    }

    public function status_changes()
    {
        return $this->hasMany(OrderStatusChange::class, 'order_id');
    }

    public function files()
    {
        return $this->hasMany(OrderFile::class, 'order_id');
    }

    public function reads()
    {
        return $this->hasMany(OrderRead::class, 'order_id');
    }

    public function first_car_type()
    {
        return $this->belongsTo(CarType::class, 'first_car_type_id');
    }

    public function second_car_type()
    {
        return $this->belongsTo(CarType::class, 'second_car_type_id');
    }

    public function services()
    {
        return $this->hasMany(OrderService::class, 'order_id');
    }

    // protected static function booted()
    // {
    //     static::created(function (Order $order) {
    //         $ratio = $order->weight / $order->cbm;
    //         $userService = app(UserService::class);
    //         $users = $userService->get_notification_users($order);
    //         if ($ratio > 320) {
    //             foreach ($users as $key => $user) {
    //                 $user->notify(new CBMWeightNotification($order));
    //             }
    //         }
    //     });
    // }
}
