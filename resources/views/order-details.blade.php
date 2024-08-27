<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            animation: fadeIn 1s ease-in-out;
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            animation: fadeInUp 1s ease-in-out;
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Order Details</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Order Information</h5>
                <p><strong>ID:</strong> {{ $order->id }}</p>
                <p><strong>اسم الحساب:</strong> {{ $order->account->الاسم ?? 'N/A' }}</p>
                <p><strong>اسم الزبون:</strong> {{ $order['اسم الزبون'] }}</p>
                <p><strong>وجهة السفر:</strong> {{ $order['وجهة السفر'] }}</p>
                <p><strong>نوع التأشير:</strong> {{ $order['نوع التأشير'] }}</p>
                <p><strong>عدد مرات الدخول:</strong> {{ $order['عدد مرات الدخول'] }}</p>
                <p><strong>الحالة:</strong> {{ $order['الحالة'] }}</p>
            </div>
        </div>

        <h2 class="mb-3">Associated Passports</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>الحالة</th>
                        <th>الاسم</th>
                        <th>رقم الجواز</th>
                        <th>نوع الجواز</th>
                        <th>الجنسية</th>
                        <th>تاريخ الاستلام</th>
                        <th>تاريخ الارسال</th>
                        <th>تاريخ التسليم</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->passports as $passport)
                    <tr>
                        <td>{{ $passport->id }}</td>
                        <td>{{ $passport['الحالة'] }}</td>
                        <td>{{ $passport['الاسم'] }}</td>
                        <td>{{ $passport['رقم الجواز'] }}</td>
                        <td>{{ $passport['نوع الجواز'] }}</td>
                        <td>{{ $passport['الجنسية'] }}</td>
                        <td>{{ $passport['تاريخ الاستلام'] }}</td>
                        <td>{{ $passport['تاريخ الارسال'] }}</td>
                        <td>{{ $passport['تاريخ التسليم'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No passports found for this order.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('orders') }}" class="btn btn-primary mt-3">Back to All Orders</a>
        <a href="{{ route('orders-edit', $order->id) }}" class="btn btn-warning mt-3">Edit Order</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>