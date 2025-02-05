<?php

namespace App\Repositories;

use App\Imports\OrdersImport;
use App\Models\Upload;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class OrderRepository implements OrderRepositoryInterface
{


    public function upload($file)
    {

        try {

            $path = $file->store('excel');

            $upload = Upload::create(['reference' => uniqid(), 'status' => 1]);

            $excelUpload = Excel::import(new OrdersImport($upload), storage_path('app/private/' . $path));
            
            $latestUpload = Upload::with(['orders','orders.orderItems','orders.products'])->find($upload->id);

            $pdf = Pdf::loadView('pdfs.order-details', ['upload' => $latestUpload])->setPaper('a4', 'landscape'); // Set the paper to A4 and landscape

            $pdfPath = 'pdfs/orders_' . now()->timestamp . '.pdf';
            $directory = storage_path('app/public/pdfs');

            // Manually create directory if it doesn't exist
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // Save the PDF to the public storage
            $pdf->save(storage_path('app/public/' . $pdfPath));


            // Generate a public URL
            $pdfLink = asset('storage/' . $pdfPath);
            $data['upload'] = $latestUpload;
            $data['link'] = $pdfLink;

            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
