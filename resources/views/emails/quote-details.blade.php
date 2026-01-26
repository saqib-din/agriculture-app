<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #006169;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .content {
            padding: 30px;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #006169;
            padding: 15px;
            margin: 20px 0;
        }

        .info-box h3 {
            margin: 0 0 10px 0;
            color: #006169;
            font-size: 16px;
        }

        .info-box p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            font-weight: bold;
            background: #f8f9fa;
            margin-top: 10px;
            border-radius: 4px;
        }

        .grand-total {
            background: #006169;
            color: white;
            font-size: 18px;
            padding: 15px;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #006169;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .a {
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Quote Request</h1>
            <p style="margin: 5px 0;">{{ $quote_number }}</p>
        </div>

        <div class="content">
            <p>Dear {{ $quote->customer_name }},</p>
            <p>Thank you for your quote request. Please find the details below:</p>

            <div class="info-box">
                <h3>Customer Information</h3>
                <p><strong>Name:</strong> {{ $quote->customer_name }}</p>
                <p><strong>Email:</strong> <a href="#"
                        style="text-decoration:none; color:text-white;">{{ $quote->customer_email }}</a></p>
                @if ($quote->customer_phone)
                    <p><strong>Phone:</strong> {{ $quote->customer_phone }}</p>
                @endif
                <p><strong>Quote Date:</strong> {{ $quote->created_at->format('d M, Y h:i A') }}</p>
            </div>

            <h3 style="color: #006169; margin-top: 30px;">Products Requested</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Price</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <strong>{{ $product['name'] }}</strong><br>
                                <small style="color: #666;">{{ $product['sku'] }} | Brand:
                                    {{ $product['brand'] }}</small>
                            </td>
                            <td style="text-align: center;">{{ $product['quantity'] }}</td>
                            <td style="text-align: right;">PKR {{ number_format($product['price'], 2) }}</td>
                            <td style="text-align: right;">PKR {{ number_format($product['subtotal'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- 
            <div class="total-row">
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

            @if ($quote->customer_message)
                <div class="info-box" style="margin-top: 30px;">
                    <h3>Your Message</h3>
                    <p>{{ $quote->customer_message }}</p>
                </div>
            @endif

            <p style="margin-top: 30px;">
                We have attached a detailed invoice PDF for your reference. If you have any questions or would like to
                proceed with this quote, please don't hesitate to contact us.
            </p>

            <center>
                <a href="mailto:{{ config('mail.from.address') }}" class="btn" style="color:text-white;">Contact
                    Us</a>
            </center>
        </div>

        <div class="footer">
            <p><strong>Thank you for choosing us!</strong></p>
            <p>{{ config('app.name') }}</p>
            <p>Email: <a href="#"
                    style="text-decoration:none; color:text-white;">{{ config('mail.from.address') }}</a> | Phone:
                {{ $quote->customer_phone }}</p>
        </div>
    </div>
</body>

</html>
