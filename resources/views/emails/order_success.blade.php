<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.5;">
    <h2 style="margin-bottom: 8px;">Order placed successfully</h2>
    <p style="margin-top: 0;">Your order <strong>#{{ $orderId }}</strong> has been received.</p>

    <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; border-color: #e5e7eb; margin-top: 12px;">
        <thead style="background: #f9fafb;">
            <tr>
                <th align="left">Book</th>
                <th align="right">Qty</th>
                <th align="right">Price</th>
                <th align="right">Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                @php
                    $price = (float)($item['gia_ban'] ?? 0);
                    $qty = (int)($item['so_luong'] ?? 0);
                    $lineTotal = $price * $qty;
                @endphp
                <tr>
                    <td>{{ $item['ten_sach'] ?? 'N/A' }}</td>
                    <td align="right">{{ $qty }}</td>
                    <td align="right">{{ number_format($price, 0, ',', '.') }} đ</td>
                    <td align="right">{{ number_format($lineTotal, 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 12px;">
        <strong>Subtotal:</strong> {{ number_format($subtotal, 0, ',', '.') }} đ
    </p>

    <p>Thank you for shopping with us.</p>
</body>
</html>