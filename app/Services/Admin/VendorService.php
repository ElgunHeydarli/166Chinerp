<?php

namespace App\Services\Admin;

use App\Models\Vendor;
use App\Services\MainService;

class VendorService extends MainService
{
    protected $model = Vendor::class;

    public function getByName(string $name)
    {
        return $this->model::where('vendor_name', $name)->first();
    }

    public function generate_vendor_id(): string
    {
        $vendors_count = count($this->getAll());
        return 'V-00' . $vendors_count + 1;
    }

    public function add_file(Vendor $vendor, $file)
    {
        $vendor_file = $vendor->file;
        if (!is_null($vendor_file)) {
            $vendor_file->update([
                'file' => $file,
            ]);
        } else {
            $vendor->file()->create([
                'file' => $file
            ]);
        }
    }
}
