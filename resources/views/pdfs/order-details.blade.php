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

            <td valign="top"><img src="{{ public_path('images/pdf-logo.png') }}" alt="" width="150" /></td>
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
            @foreach ($upload->orders as $order)
                <tr>
                    <th scope="row">{{ $order->ref_no }}</th>
                    <td colspan="5"></td>
                </tr>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td></td>
                        <td>{{ $item->customer->name }}</td>
                        <td>{{ $item->customer->email }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->date }}</td>
                        <td align="right">{{ $item->qty }}</td>
                        <td align="right">{{ $item->item_price }}</td>
                    </tr>
                @endforeach
            @endforeach

        </tbody>

        {{-- <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal $</td>
            <td align="right">1635.00</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Tax $</td>
            <td align="right">294.3</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">$ 1929.3</td>
        </tr>
    </tfoot> --}}
    </table>

</body>

</html>
