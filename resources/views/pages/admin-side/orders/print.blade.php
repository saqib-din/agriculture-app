<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order {{ $order->order_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Arial", sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #006169;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-info h1 {
            color: #006169;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .company-info p {
            margin: 3px 0;
            color: #666;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .invoice-details p {
            margin: 3px 0;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-in_progress {
            background: #cfe2ff;
            color: #084298;
        }

        .status-delivered {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-installed {
            background: #d4edda;
            color: #155724;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .info-box {
            width: 48%;
        }

        .info-box h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #006169;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 5px;
        }

        .info-box p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table thead {
            background: #f8f9fa;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        table tbody tr:hover {
            background: #f8f9fa;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-section {
            margin-top: 20px;
            float: right;
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .total-row.grand-total {
            background: #f8f9fa;
            padding: 12px;
            margin-top: 10px;
            border: 2px solid #006169;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            clear: both;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #666;
            font-size: 12px;
        }

        @media print {
            body {
                padding: 0;
            }

            .no-print {
                display: none;
            }

            .invoice-container {
                box-shadow: none;
            }
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #006169;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button:hover {
            background: #006169;
        }
    </style>
</head>

<body>
    @if (!isset($isPdf))
        <button onclick="window.print()" class="print-button no-print">
            Print Invoice
        </button>
    @endif

    @php
        $variables = \App\Models\Variable::pluck('value', 'key');
    @endphp
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h1>{{ $variables['company_name'] ?? 'Scrumad' }}</h1>
                <p>Address: {{ $variables['company_address'] ?? 'N/A' }}</p>
                <p>Phone: {{ $variables['company_phone'] ?? 'N/A' }}</p>
                <p>Email: {{ $variables['company_email'] ?? 'N/A' }}</p>
            </div>
            <div class="invoice-details">
                <h2>INVOICE</h2>
                <p><strong>Order #:</strong> {{ $order->order_number }}</p>
                <p>
                    <strong>Date:</strong>
                    {{ $order->created_at->format('d, M, Y') }}
                </p>
                <p>
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Client and Order Info -->
        <div class="info-section">
            <div class="info-box">
                <h3>Bill To:</h3>
                <p><strong>{{ $order->client->name }}</strong></p>
                <p>{{ $order->client->email }}</p>
                @if ($order->client->phone)
                    <p>{{ $order->client->phone }}</p>
                    @endif @if ($order->client->company)
                        <p>{{ $order->client->company }}</p>
                        @endif @if ($order->client->address)
                            <p>{{ $order->client->address }}</p>
                            @if ($order->client->city || $order->client->state)
                                <p>
                                    {{ $order->client->city }}{{ $order->client->state
                                        ? ',
                                                                                                                                                                                                                                                ' .
                                            $order->client->state
                                        : '' }}
                                </p>
                            @endif
                        @endif
            </div>
            <div class="info-box">
                <h3>Order Information:</h3>
                <p>
                    <strong>Order Number:</strong> {{ $order->order_number }}
                </p>
                <p>
                    <strong>Order Date:</strong> {{ $order->created_at->format('d M, Y h:i A') }}
                </p>
                <p><strong>Payment Status:</strong> Due on Receipt</p>
                @if ($order->quote_request_id)
                    <p>
                        <strong>Quote Reference:</strong> #{{ $order->quote_request_id }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Products Table -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $product->name }}</strong>
                            <br />
                            <small>{{ $product->sku }} | Brand: {{ $product->brand }}</small>
                        </td>
                        <td class="text-center">
                            {{ $product->pivot->quantity }}
                        </td>
                        <td class="text-right">
                            PKR {{ number_format($product->pivot->price, 2) }}
                        </td>
                        <td class="text-right">
                            PKR {{ number_format($product->pivot->subtotal, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="total-section">
            {{-- <div class="total-row">
                <span>Subtotal:</span>
                <span>PKR {{ number_format($order->subtotal, 2) }}</span>
            </div> --}}
            <div class="total-row">
                <span>Tax ({{ $order->tax_rate }}%):</span>
                <span>PKR {{ number_format($order->tax_amount, 2) }}</span>
            </div>
            @if ($order->discount > 0)
                <div class="total-row">
                    <span>Discount:</span>
                    <span>- PKR {{ number_format($order->discount, 2) }}</span>
                </div>
            @endif
            <div class="total-row grand-total">
                <span>Total Amount:</span>
                <span>PKR {{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <!-- Notes -->
        @if ($order->notes)
            <div style="clear: both; margin-top: 40px">
                <h3 style="color: #4680ff; margin-bottom: 10px">Notes:</h3>
                <p
                    style="
                        background: #f8f9fa;
                        padding: 15px;
                        border-left: 3px solid #4680ff;
                    ">
                    {{ $order->notes }}
                </p>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for your business!</strong></p>
            <p>
                For any queries, please contact us at {{ $variables['company_email'] ?? 'N/A' }} or
                call {{ $variables['company_phone'] ?? 'N/A' }}
            </p>
            <p style="margin-top: 10px; font-size: 11px">
                This is a computer-generated document. No signature
                required.
            </p>
        </div>
    </div>

    <script>
        // Auto-print on load (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>

</html>
