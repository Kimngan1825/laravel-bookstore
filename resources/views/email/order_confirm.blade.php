<div style="font-family: sans-serif; line-height: 1.6;">
    <h2 style="color: #20B2AA;">Cảm ơn bạn đã mua hàng!</h2>
    <p>Chào bạn, đơn hàng <strong>#{{ $order->order_id }}</strong> đã được đặt thành công.</p>
    <hr>
    <h4>Chi tiết đơn hàng:</h4>
    <ul>
        @foreach($items as $item)
            <li>{{ $item['title'] }} x {{ $item['quantity'] }} - {{ number_format($item['price'] * $item['quantity']) }}đ</li>
        @endforeach
    </ul>
    <p><strong>Tổng cộng: {{ number_format($order->total_amount) }}đ</strong></p>
    <p>Địa chỉ giao hàng: {{ $order->shipping_address }}</p>
    <hr>
    <p>Chúng tôi sẽ sớm liên hệ để giao hàng.</p>
</div>