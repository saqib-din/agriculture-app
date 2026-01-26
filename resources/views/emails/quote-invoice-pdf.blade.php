<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Invoice {{ $quote_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
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
            display: table;
            width: 100%;
            border-bottom: 3px solid #006169;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-info {
            display: table-cell;
            width: 50%;
            vertical-align: top;
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
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: top;
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
            background: #cfe2ff;
            color: #006169;
        }

        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .info-box {
            display: table-cell;
            width: 48%;
            vertical-align: top;
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
            display: table;
            width: 100%;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .total-row span {
            display: table-cell;
        }

        .total-row span:last-child {
            text-align: right;
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

        .notes-section {
            clear: both;
            margin-top: 40px;
        }

        .notes-section h3 {
            color: #006169;
            margin-bottom: 10px;
        }

        .notes-section p {
            background: #f8f9fa;
            padding: 15px;
            border-left: 3px solid #006169;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h1>{{ config('app.name') }}</h1>
                <p>Company Name: {{ $variables['company_address'] ?? 'N/A' }}</p>
                {{-- <p>City, State ZIP</p> --}}
                <p>Phone: {{ $variables['company_phone'] ?? 'N/A' }}</p>
                <p>Email: {{ config('mail.from.address') }}</p>
            </div>
            <div class="invoice-details">
                <h2>QUOTE</h2>
                <p><strong>Quote #:</strong> {{ $quote_number }}</p>
                <p><strong>Date:</strong> {{ $quote->created_at->format('d M, Y') }}</p>
                {{-- <p><strong>Status:</strong> <span class="status-badge">Quote Request</span></p> --}}
            </div>
        </div>

        <!-- Customer and Quote Info -->
        <div class="info-section">
            <div class="info-box">
                <h3>Customer Information:</h3>
                <p><strong>{{ $quote->customer_name }}</strong></p>
                <p>{{ $quote->customer_email }}</p>
                @if ($quote->customer_phone)
                    <p>{{ $quote->customer_phone }}</p>
                @endif
            </div>
            <div class="info-box">
                <h3>Quote Information:</h3>
                <p><strong>Quote Number:</strong> {{ $quote_number }}</p>
                <p><strong>Quote Date:</strong> {{ $quote->created_at->format('d M, Y h:i A') }}</p>
                <p><strong>Valid Until:</strong> {{ $quote->created_at->addDays(30)->format('d M, Y') }}</p>
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
                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $product['name'] }}</strong><br>
                            <small>{{ $product['sku'] }} | Brand: {{ $product['brand'] }} | Model:
                                {{ $product['model'] }}</small>
                        </td>
                        <td class="text-center">{{ $product['quantity'] }}</td>
                        <td class="text-right">PKR {{ number_format($product['price'], 2) }}</td>
                        <td class="text-right">PKR {{ number_format($product['subtotal'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="total-section">
            {{-- <div class="total-row">
                <span>Subtotal:</span>
                <span>PKR {{ number_format($subtotal, 2) }}</span>
            </div> --}}
            @if ($tax_amount > 0)
                <div class="total-row">
                    <span>Tax ({{ $tax_rate }}%):</span>
                    <span>PKR {{ number_format($tax_amount, 2) }}</span>
                </div>
            @endif
            <div class="total-row grand-total">
                <span>Total Amount:</span>
                <span>PKR {{ number_format($total, 2) }}</span>
            </div>
        </div>

        <!-- Customer Message -->
        @if ($quote->customer_message)
            <div class="notes-section">
                <h3>Customer Message:</h3>
                <p>{{ $quote->customer_message }}</p>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for your interest!</strong></p>
            <p>For any queries, please contact us at {{ config('mail.from.address') }} or call {{ $quote->customer_phone }}</p>
            <p style="margin-top: 10px; font-size: 11px;">This is a computer-generated quote. No signature required.</p>
            <p style="margin-top: 5px; font-size: 11px;">Quote valid for 30 days from issue date.</p>
        </div>
    </div>
</body>

</html>
