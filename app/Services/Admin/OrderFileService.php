<?php

namespace App\Services\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Order;
use App\Models\OrderImage;

class OrderFileService
{
    use FileUploadTrait;


    public function get_railway_bill(Order $order)
    {
        $railway_bill = $order->railway_bill;
        return [
            'file' => $railway_bill?->file ?? '',
        ];
    }

    public function get_declaration(Order $order)
    {
        $declaration = $order->declaration;
        return [
            'file' => $declaration?->file ?? '',
        ];
    }

    public function get_images(Order $order)
    {
        $order_images = $order->images;
        $images = [];
        foreach ($order_images as $order_image) {
            $images[] = [
                'id' => $order_image->id,
                'image' => $order_image->image
            ];
        }

        return $images;
    }

    public function delete_image(int $id): array
    {
        $order_image = OrderImage::find($id);
        if (is_null($order_image)) return ['status' => 'error', 'message' => 'Şəkil tapılmadı'];
        $this->fileDelete($order_image->image);
        $order_image->delete();
        return ['status' => 'success', 'message' => 'Şəkil silindi'];
    }
}
