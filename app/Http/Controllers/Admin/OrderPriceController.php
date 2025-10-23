<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\PriceRequest;
use App\Http\Requests\Admin\OrderPriceRequest;
use App\Services\Admin\CommentService;
use App\Services\Admin\OrderService;
use App\Services\UserService;
use Illuminate\Http\Request;

class OrderPriceController extends Controller
{
    public function __construct(
        public OrderService $orderService,
        public CommentService $commentService,
        public UserService $userService
    ) {
    }

    public function update_price(int $id, OrderPriceRequest $request)
    {
        $order = $this->orderService->getById($id);
        $data = $request->validated();
        if (!is_null($data['note'])) {
            $comment_data = [
                'order_id' => $id,
                'user_id' => auth()->id(),
                'text' => $data['note'],
            ];
            $comment = $this->commentService->create($comment_data);
            $users = $this->userService->getCommentSendedUsers(['admin', 'operator']);
            $this->commentService->send_other_users($comment, $users);
        }
        $this->orderService->update_price($order, $data);
        toastr('Qiymət təklifi əlavə olundu');
        return redirect()->back();
    }

    public function set_prices(int $id, PriceRequest $request)
    {
        try {
            $data = $request->validated();
            // $data['total_price'] = $this->orderService->calculate_order_price($data);
            $order = $this->orderService->getById($id);
            $this->orderService->update($id, ['price' => $data['total_price'], 'price_currency' => $data['final_currency']]);
            $this->orderService->add_price_types($order, $data);
            return response([
                'status' => 'success',
                'message' => 'Qiymət əlavə olundu',
                'redirect_url' => route('admin.order.priceless'),
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }
}
