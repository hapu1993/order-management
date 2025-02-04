<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUploadRequest;
use App\Repositories\Interfaces\OrderRepositoryInterface;
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
            $data['status_code'] = 1000;
            $data['message'] = "Order Uploaded Successfully";
            $data['data']['link'] = $fileUpload['link'];

            return Response::json($data);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Excel Each Raw Validation errors
            return response()->json([
                'status' => false,
                'status_code' => 2001,
                'message' => 'Validation failed for some rows.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 3000,
                'message' => 'There was an error importing the file.',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}
