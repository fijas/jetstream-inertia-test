<h3>Order Created!</h3>
<hr/>
<p>Your order has been created successfully! Your Order details can be found below:</p>
<p>Order: #{{$order->id}}<br/>
Created: {{$order->created_at}}</p>
<table style="min-width: 50%; border: 1px solid #ccc">
    <thead>
    <tr>
        <th style="border-bottom: 1px solid #ccc">Product</th>
        <th style="border-bottom: 1px solid #ccc">Quantity</th>
        <th style="border-bottom: 1px solid #ccc; text-align: right">Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($order->products as $product)
    <tr>
        <td style="border-bottom: 1px solid #ccc">{{$product->name}}</td>
        <td style="border-bottom: 1px solid #ccc">{{$product->pivot->count}}</td>
        <td style="border-bottom: 1px solid #ccc; text-align: right">${{$product->price * $product->pivot->count}}</td>
    </tr>
    @endforeach
    <tr>
        <td style="border-bottom: 1px solid #ccc" colspan="2">Sub Amount</td>
        <td style="border-bottom: 1px solid #ccc; text-align: right">${{$order->sub_amount}}</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #ccc" colspan="2">Tax</td>
        <td style="border-bottom: 1px solid #ccc; text-align: right">${{$order->tax_amount}}</td>
    </tr>
    <tr>
        <th colspan="2">Total</th>
        <td style="text-align: right">${{$order->total_amount}}</td>
    </tr>
    </tbody>
</table>
<p>
    - Life APP Team
</p>
