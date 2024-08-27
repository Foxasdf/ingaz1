<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        .table th {
            font-weight: 600;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-delete {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .clickable-row {
            cursor: pointer;
        }
        .clickable-row:hover {
            background-color: #f1f3f5;
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
        <div class="d-flex justify-content-between mb-3">
            <h1 class="mb-0">All Orders</h1>
            <a href="{{ route('orders-create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Order
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Orders List</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>اسم الحساب</th>
                                <th>اسم الزبون</th>
                                <th>وجهة السفر</th>
                                <th>نوع التأشير</th>
                                <th>عدد مرات الدخول</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr class="clickable-row" data-href="{{ route('order-details', $order->id) }}">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->account->الاسم ?? 'N/A' }}</td>
                                <td>{{ $order['اسم_الزبون'] }}</td>
                                <td>{{ $order['وجهة_السفر'] }}</td>
                                <td>{{ $order['نوع_التأشير'] }}</td>
                                <td>{{ $order['عدد_مرات_الدخول'] }}</td>
                                <td><span class="badge bg-{{ $order['الحالة'] == 'منتهي' ? 'success' : 'warning' }}">{{ $order['الحالة'] }}</span></td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td onclick="event.stopPropagation();">
                                    <a href="{{ route('orders-edit', $order->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @if($order['الحالة'] == 'منتهي')
                                        <form action="{{ route('order-delete', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Are you sure you want to delete this order?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.clickable-row');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
</body>
</html>
