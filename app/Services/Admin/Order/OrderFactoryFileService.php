<?php

namespace App\Services\Admin\Order;

use App\Models\OrderFactory;

class OrderFactoryFileService
{

    public function add_factory_files(OrderFactory $order_factory, array $data)
    {
        if ($order_factory->file()->exists()) {
            return;
        }

        if (
            empty($data['contract_file']) && empty($data['contract']) &&
            empty($data['invoice_file']) && empty($data['invoice']) &&
            empty($data['packing_list_file']) && empty($data['packing_list'])
        ) {
            return;
        }
        $order_factory->file()->create([
            'is_customer_upload' => !empty($data['is_customer_upload']) ? 1 : 0,
            'contract' => $data['contract'] ?? $data['contract_file'] ?? null,
            'invoice' => $data['invoice'] ?? $data['invoice_file'] ?? null,
            'packing_list' => $data['packing_list'] ?? $data['packing_list_file'] ?? null,
        ]);
    }
}
