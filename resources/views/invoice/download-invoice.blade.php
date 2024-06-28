<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Invoice</title>
  <style>
    body, .invoice-box {
      font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif;
      font-size: 16px;
      color: #333;
    }
    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
      background-color: #f7f7f7;
    }
    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
      border-collapse: collapse;
    }
    .invoice-box table td {
      padding: 10px;
      vertical-align: top;
    }
    .invoice-box table tr td:nth-child(2) {
      text-align: right;
    }
    .invoice-box .title {
      font-size: 45px;
      color: #333;
    }
    .invoice-box .information td {
      padding-bottom: 40px;
    }
    .invoice-box .heading td {
      background: #007BFF;
      color: white;
      border-bottom: 2px solid #ddd;
      font-weight: bold;
    }
    .invoice-box .item td {
      border-bottom: 1px solid #eee;
    }
    .invoice-box .item.last td {
      border-bottom: none;
    }
    .invoice-box .total td:nth-child(2) {
      border-top: 2px solid #eee;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="4">
          <table>
            <tr>
              <td class="title">
                <div>SRCodeX Shop</div>
              </td>
              <td style="text-align:right;">
                <div><strong>Invoice ID:</strong> {{ $order_info->order_id }}</div>
                <div><strong>Date:</strong> {{ $billing_info && $billing_info->first() ? $billing_info->first()->created_at->format('d-m-y') : 'N/A' }}</div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="information">
        <td colspan="4">
          <table>
            <tr>
              <td>
                <div><strong>SRCodeX Online Shop</strong></div>
                <div>Dhanmondi, Road: 15</div>
                <div>Dhaka 1200, Bangladesh</div>
              </td>
              <td style="text-align:right;">
                <div><strong>Bill To:</strong></div>
                <div>NAME: {{ $billing_info->first()->name }}</div>
                <div>EMAIL: {{ $billing_info->first()->email }}</div>
                <div>ADDRESS: {{ $billing_info->first()->address }}</div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="heading">
        <td>Item</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Total</td>
      </tr>
      @php $sub = 0; @endphp
      @foreach ($order_product as $product_info)
      <tr class="item {{ $loop->last ? 'last' : '' }}">
        <td>{{ $product_info->product->name }}</td>
        <td>{{ $product_info->price }}</td>
        <td>{{ $product_info->quantity }}</td>
        <td>{{ $product_info->price * $product_info->quantity }}</td>
      </tr>
      @php $sub += $product_info->price * $product_info->quantity; @endphp
      @endforeach
      <tr class="total">
        <td colspan="3"></td>
        <td>Sub Total: {{ $sub }}</td>
      </tr>
      <tr class="total">
        <td colspan="3"></td>
        <td>Discount: (-) {{ $order_info->discount }}</td>
      </tr>
      <tr class="total">
        <td colspan="3"></td>
        <td>Charge: (+) {{ $order_info->charge }}</td>
      </tr>
      <tr class="total">
        <td colspan="3"></td>
        <td>Grand Total: {{ $order_info->total }}</td>
      </tr>
    </table>
  </div>
</body>
</html>
