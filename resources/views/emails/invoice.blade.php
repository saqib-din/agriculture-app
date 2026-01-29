<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $order->order_number }}</title>
</head>

<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
    
    @php
        $variables = \App\Models\Variable::pluck('value', 'key');
    @endphp

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:20px 0;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-collapse:collapse;">

                    <!-- Header -->
                    <tr>
                        <td style="background:#006169;color:#ffffff;padding:25px;text-align:center;">
                            <h1 style="margin:0;font-size:26px;">INVOICE</h1>
                            <p style="margin:5px 0 0 0;">{{ $order->order_number }}</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:25px;color:#333;">

                            <p>Dear <strong>{{ $order->client->name }}</strong>,</p>
                            <p>Thank you for your order. Below are your invoice details.</p>

                            <!-- One Row Info Section -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-top:20px;border-collapse:collapse;">
                                <tr>
                                    <!-- Company Info -->
                                    <td valign="top" width="33%"
                                        style="padding:10px;background:#f8f9fa;border-left:4px solid #006169;">
                                        <strong>{{ $variables['company_name'] ?? 'Scrumad' }}</strong><br>
                                        Address: {{ $variables['company_address'] ?? 'N/A' }}<br>
                                        Phone: {{ $variables['company_phone'] ?? 'N/A' }}<br>
                                        Email: {{ $variables['company_email'] ?? 'N/A' }}
                                    </td>

                                    <!-- Bill To -->
                                    <td valign="top" width="33%"
                                        style="padding:10px;background:#f8f9fa;border-left:4px solid #006169;">
                                        <strong>Bill To</strong><br>
                                        {{ $order->client->name }}<br>
                                        {{ $order->client->email }}<br>
                                        {{ $order->client->phone ?? '' }}<br>
                                        {{ $order->client->company ?? '' }}<br>
                                        {{ $order->client->address ?? '' }}
                                    </td>

                                    <!-- Order Info -->
                                    <td valign="top" width="34%"
                                        style="padding:10px;background:#f8f9fa;border-left:4px solid #006169;">
                                        <strong>Order Info</strong><br>
                                        Order #: {{ $order->order_number }}<br>
                                        Date: {{ $order->created_at->format('d M, Y') }}<br>
                                        Status: {{ ucfirst(str_replace('_', ' ', $order->status)) }}<br>
                                        @if ($order->quote_request_id)
                                            Quote Ref: #{{ $order->quote_request_id }}<br>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <!-- Products Table -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-top:20px;border-collapse:collapse;">
                                <tr style="background:#f1f1f1;">
                                    <th align="left" style="padding:10px;border:1px solid #ddd;">Product</th>
                                    <th align="center" style="padding:10px;border:1px solid #ddd;">Qty</th>
                                    <th align="right" style="padding:10px;border:1px solid #ddd;">Price</th>
                                    <th align="right" style="padding:10px;border:1px solid #ddd;">Total</th>
                                </tr>

                                @foreach ($order->products as $product)
                                    <tr>
                                        <td style="padding:10px;border:1px solid #ddd;">
                                            <strong>{{ $product->name }}</strong><br>
                                            <small>{{ $product->sku }}</small>
                                        </td>
                                        <td align="center" style="padding:10px;border:1px solid #ddd;">
                                            {{ $product->pivot->quantity }}</td>
                                        <td align="right" style="padding:10px;border:1px solid #ddd;">PKR
                                            {{ number_format($product->pivot->price, 2) }}</td>
                                        <td align="right" style="padding:10px;border:1px solid #ddd;">PKR
                                            {{ number_format($product->pivot->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <!-- Totals -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:15px;">
                                @if ($order->tax_amount > 0)
                                    <tr>
                                        <td align="right">
                                            <strong>Tax ({{ $order->tax_rate }}%):</strong> PKR
                                            {{ number_format($order->tax_amount, 2) }}
                                        </td>
                                    </tr>
                                @endif

                                @if ($order->discount > 0)
                                    <tr>
                                        <td align="right">
                                            <strong>Discount:</strong> - PKR {{ number_format($order->discount, 2) }}
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td align="right" style="padding-top:10px;">
                                        <strong>Total:</strong> PKR {{ number_format($order->total, 2) }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Notes -->
                            @if ($order->notes)
                                <div
                                    style="margin-top:20px;background:#f8f9fa;padding:10px;border-left:4px solid #006169;">
                                    <strong>Notes:</strong><br>
                                    {{ $order->notes }}
                                </div>
                            @endif

                            <p style="margin-top:20px;">If you have any questions, feel free to contact us.</p>

                            <p style="text-align:center;margin-top:20px;">
                                <a href="mailto:{{ $variables['company_email'] ?? config('mail.from.address') }}"
                                    style="background:#006169;color:#ffffff;padding:12px 25px;text-decoration:none;">
                                    Contact Us
                                </a>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f8f9fa;padding:15px;text-align:center;font-size:12px;color:#666;">
                            Thank you for your business<br>
                            {{ $variables['company_name'] ?? config('app.name') }}
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
