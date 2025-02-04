<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Upload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OrdersImport implements ToModel, WithValidation, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $upload;
    protected $orderCount;

    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
        $this->orderCount = array();
    }
    public function model(array $row)
    {
        try {

            // create order customer
            $customer = $this->createCustomer($row);

            // create product
            $product = $this->createProduct($row);

            // create order
            $order = $this->createOrder($row, $customer);


            if (!isset($this->orderCount[$order->ref_no])) {
                $order->products()->detach();
                $this->orderCount[$order->ref_no] = $order->ref_no;
            }

            $productData[$product->id] = [
                'qty' => $row[6],
                'item_price' => $row[5],
                'customer_id' => $customer->id,
                'date' => $row[3],
            ];


            $order->products()->syncWithoutDetaching($productData);

            return $order;
        } catch (\Exception $e) {

            throw $e;
        }
    }
    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string',   // Column 0 should be a string (customer name)
            '1' => 'required|email',    // Column 1 should be a valid email (customer email)
            '2' => 'required|numeric',  // Column 2 should be a number (order number)
            '3' => 'required|date',     // Column 3 should be a valid date (order date)
            '4' => 'required|string',   // Column 4 should be a string (product name)
            '5' => 'required|numeric',  // Column 5 should be a number (product price)
            '6' => 'required|numeric',  // Column 6 should be a number (quantity)
        ];
    }

    public function createCustomer($row)
    {
        $customer = Customer::updateOrCreate(
            [
                "email" => $row[1]
            ],
            [
                "name" => $row[0]
            ]
        );
        return $customer;
    }
    public function createProduct($row)
    {
        $product = Product::updateOrCreate([
            "name" => $row[4]
        ], [
            "price" => $row[5]
        ]);

        return $product;
    }

    public function createOrder($row, $customer)
    {
        $order = Order::updateOrCreate([
            "ref_no" => $row[2]
        ], [
            "order_date" => Date('Y-m-d H:i:s'),
            "upload_id" => $this->upload->id
        ]);

        return $order;
    }
}
