<?php

namespace App\Services\Admin\Order;

use App\Models\OrderFactory;
use App\Models\Product;

class OrderFactoryProductService
{
    public function getProductIds(array $data): array
    {
        $product_ids = [];
        foreach ($data as $product_name) {
            $product = Product::where('name', $product_name)->first();
            if (is_null($product)) {
                $product = Product::create(['name' => $product_name, 'status' => 1]);
            }
            $product_ids[] = $product->id;
        }
        return $product_ids;
    }

    public function add_products(OrderFactory $order_factory, array $product_ids)
    {
        $order_factory->products()->delete();
        foreach ($product_ids as $product_id) {
            $order_factory->products()->create([
                'product_id' => $product_id
            ]);
        }
    }
}
