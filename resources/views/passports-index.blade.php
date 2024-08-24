@csrf
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Passports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">All Passports</h1>
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
                                <th>الحالة</th>
                                <th>الاسم</th>
                                <th>رقم الجواز</th>
                                <th>نوع الجواز</th>
                                <th>الجنسية</th>
                                <th>الجنس</th>
                                <th>تاريخ الاستلام</th>
                                <th>تاريخ الارسال</th>
                                <th>تاريخ التسليم</th>
                                <th>اسم الزبون</th>
                                <th>وجهة السفر</th>
                                <th>نوع التأشير</th>
                                <th>اسم الحساب</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($passports as $passport)
                            <tr class="clickable-row" data-href="{{ route('passport-details', $passport->id) }}">
                                <td>{{ $passport->id }}</td>
                                <td><span class="badge bg-{{ $passport['الحالة'] == 'منتهي' ? 'success' : 'warning' }}">{{ $passport['الحالة'] }}</span></td>
                                <td>{{ $passport['الاسم'] }}</td>
                                <td>{{ $passport['رقم الجواز'] }}</td>
                                <td>{{ $passport['نوع الجواز'] }}</td>
                                <td>{{ $passport['الجنسية'] }}</td>
                                <td>{{ $passport['الجنس'] }}</td>
                                <td>{{ $passport['تاريخ الاستلام'] }}</td>
                                <td>{{ $passport['تاريخ الارسال'] }}</td>
                                <td>{{ $passport['تاريخ التسليم'] }}</td>
                                <td>{{ $passport->order['اسم الزبون'] ?? 'N/A' }}</td>
                                <td>{{ $passport->order['وجهة السفر'] ?? 'N/A' }}</td>
                                <td>{{ $passport->order['نوع التأشير'] ?? 'N/A' }}</td>
                                <td>{{ $passport->order->account['الاسم'] ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="15" class="text-center">No passports found.</td>
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