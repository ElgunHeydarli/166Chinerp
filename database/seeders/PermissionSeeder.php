<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'İdarə Paneli', 'guard_name' => 'web', 'group_name' => 'Dashboard'],
            ['name' => 'Müştərilər menyu', 'guard_name' => 'web', 'group_name' => 'Müştərilər'],
            ['name' => 'Müştərilər əlavə et', 'guard_name' => 'web', 'group_name' => 'Müştərilər'],
            ['name' => 'Müştərilər düzəliş et', 'guard_name' => 'web', 'group_name' => 'Müştərilər'],
            ['name' => 'Müştərilər sil', 'guard_name' => 'web', 'group_name' => 'Müştərilər'],
            ['name' => 'Sifarişlər menu', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Draft sifarişlər menu', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Təsdiqlənən sifarişlər menu', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'İcrada olan sifarişlər menu', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Bitmiş sifarişlər menu', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'İmtina olunan sifarişlər menu', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Qiymət gözləyən sifarişlər menu', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Draft sifariş əlavə et', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Sifarişi təsdiq et', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Sifarişi düzəlişə göndər', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Sifariş imtina et', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Sifariş bax', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Sifariş məlumatlarını daxil et', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Sifarişi icraya göndər', 'guard_name' => 'web', 'group_name' => 'Sifarişlər'],
            ['name' => 'Kontenynerlər menu', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Bütün konteynerlər', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Yeni konteynerlər', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Konteyner əlavə et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Konteyner təsdiq et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Konteyner düzəliş et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Kontenyner imtina et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya qiymətləri', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya qiyməti əlavə et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya qiyməti düzəliş et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya qiyməti sil', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya tarixləri', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Yoxlamada olan konteynerlər', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya tarixi əlavə et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya tarixi düzəliş et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya tarixi sil', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya tarixi bax', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya tarixi status dəyiş', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Yoxlamaya at', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Rezervasiya tarixini təyin et', 'guard_name' => 'web', 'group_name' => 'Konteynerlər'],
            ['name' => 'Sahibsiz yüklər menu', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Bütün sahibsiz yüklər', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Rezervasiya çin tərəfi', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Sahibsiz yük əlavə et', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Sahibsiz yük təsdiq et', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Railway bill yüklə', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Declaration yüklə', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Konteyner şəkilləri yüklə', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Xərc əlavə et', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Rezervasiya et', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Xidmətlər', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Xidmət əlavə et', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Xidmət düzəliş et', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Xidmət sil', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Xidmət bax', 'guard_name' => 'web', 'group_name' => 'Sahibsiz yüklər'],
            ['name' => 'Digər əməliyyatlar menu', 'guard_name' => 'web', 'group_name' => 'Digər əməliyyatlar'],
            ['name' => 'Vendor management', 'guard_name' => 'web', 'group_name' => 'Digər əməliyyatlar'],
            ['name' => 'Vendor əlavə et', 'guard_name' => 'web', 'group_name' => 'Digər əməliyyatlar'],
            ['name' => 'Vendor düzəliş et', 'guard_name' => 'web', 'group_name' => 'Digər əməliyyatlar'],
            ['name' => 'Vendor bax', 'guard_name' => 'web', 'group_name' => 'Digər əməliyyatlar'],
            ['name' => 'Vendor sil', 'guard_name' => 'web', 'group_name' => 'Digər əməliyyatlar'],
            ['name' => 'Tənzimləmələr menu', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Tərcümələr', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Tərcümə əlavə et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Tərcümə düzəliş et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Tərcümə sil', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Rollar', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Rol əlavə et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Rol düzəliş et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Rol sil', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'İcazələr', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'İcazə əlavə et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'İcazə düzəliş et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'İcazə sil', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Əməkdaşlar', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Əməkdaş bax', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Əməkdaş əlavə et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Əməkdaş düzəliş et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Əməkdaş sil', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Statuslar', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Status əlavə et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Status düzəliş et', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
            ['name' => 'Status sil', 'guard_name' => 'web', 'group_name' => 'Tənzimləmələr'],
        ];

        foreach ($data as $permission_data) {
            $permission_data['status'] = 1;
            $permission = Permission::where('name', $permission_data['name'])->first();
            if (is_null($permission)) Permission::create($permission_data);
        }
    }
}
