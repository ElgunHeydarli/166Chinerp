<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'fin',
        'position',
        'mmc',
        'phone',
        'gender',
        'education_id',
        'branch_id',
        'country_id',
        'gross_salary',
        'cash',
        'bank',
        'government_payment',
        'net_salary',
        'start_date',
        'end_date',
        'currency',
        'name',
        'image',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'net_salary' => 'float',
        'gross_salary' => 'float',
        'cash'=>'float',
        'bank' => 'float',
        'government_payment' => 'float',
        'gender' => Gender::class,
    ];

    public function comment_reads()
    {
        return $this->hasMany(CommentRead::class, 'user_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
