<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerAccount extends Model
{
    use HasFactory;

    protected $table = 'ledger_accounts'; // opsional, Laravel avtomatik təyin edir

    protected $fillable = [
        'code',           // Məs: "2002"
        'title',          // Məs: "Vendor borc hesabı"
        'type',           // Məs: "asset", "liability", "expense"
        'parent_id',      // Yuxarı hesab
        'description',    // İzah
        'status',         // aktiv/passiv və ya 1/0
    ];

    // 🔁 Ana hesaba aid əlaqə
    public function parent()
    {
        return $this->belongsTo(LedgerAccount::class, 'parent_id');
    }

    // 🔁 Alt hesabları əldə etmək üçün
    public function children()
    {
        return $this->hasMany(LedgerAccount::class, 'parent_id');
    }

    // 📎 Tam başlıq (kodu + adı birləşdirmək üçün)
    public function getFullLabelAttribute()
    {
        return "{$this->code} - {$this->title}";
    }

    // 📂 Aktiv status yoxlaması
    public function isActive(): bool
    {
        return (bool) $this->status;
    }
}
