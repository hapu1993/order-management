<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>

            <td valign="top"><img src="<?php echo e(public_path('images/pdf-logo.png')); ?>" alt="" width="150" /></td>
            <td align="right">
                <h3>Azbow Order Management System</h3>
                <pre>
                Manager
                Azbow Order Management System
                Colombo 05
            </pre>
            </td>
        </tr>

    </table>

    <br />
    
    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Description</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Unit Price</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $upload->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($order->ref_no); ?></th>
                    <td colspan="5"></td>
                </tr>
                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td></td>
                        <td><?php echo e($item->customer->name); ?></td>
                        <td><?php echo e($item->customer->email); ?></td>
                        <td><?php echo e($item->product->name); ?></td>
                        <td><?php echo e($item->date); ?></td>
                        <td align="right"><?php echo e($item->qty); ?></td>
                        <td align="right"><?php echo e($item->item_price); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>

        
    </table>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\order-management\resources\views/pdfs/order-details.blade.php ENDPATH**/ ?>