<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUploadRequest;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    protected $orderRepo;
    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }
    public function uploadOrder(OrderUploadRequest $request)
    {
        try {

            $fileUpload = $this->orderRepo->upload($request->file('file'));



            $data['status'] = true;
            $data['status_code'] = Config::get('azbow.order_success')['code'];
            $data['message'] = Config::get('azbow.order_success')['message'];
            $data['data']['link'] = $fileUpload['link'];

            return Response::json($data);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Excel Each Raw Validation errors
            return response()->json([
                'status' => false,
                'status_code' => Config::get('azbow.order_row_validation_errors')['code'],
                'message' => Config::get('azbow.order_row_validation_errors')['message'],
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => Config::get('azbow.order_server_errors')['code'],
                'message' => Config::get('azbow.order_server_errors')['message'],
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}
