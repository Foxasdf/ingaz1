
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>العملات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            color: #343a40;
            font-weight: bold;
            animation: fadeInDown 1s ease-in-out;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
            animation: pulse 1s infinite;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }
        .table thead {
            background-color: #343a40;
            color: #ffffff;
        }
        .table thead th {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }
        .table tbody tr:active {
            background-color: #dee2e6;
        }
        .text-center i {
            color: #343a40;
        }
        .alert {
            border-radius: 10px;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-coins"></i> قائمة العملات</h1>
            <a href="{{ route('coins.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة عملة جديدة
            </a>
        </div>

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display error message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>العملة</th>
                        <th>سعر العملة</th>
                        <th>تاريخ الإنشاء</th>
                        <th>تاريخ التحديث</th>
                        <th class="text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coins as $coin)
                        <tr class="clickable-row" data-href="{{ route('coins.show', $coin->id) }}">
                            <td>{{ $coin->id }}</td>
                            <td>{{ $coin->coin }}</td>
                            <td>{{ $coin->coin_price }}</td>
                            <td>{{ $coin->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $coin->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('coins.edit', $coin->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                <form action="{{ route('coins.destroy', $coin->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه العملة؟')">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">لا توجد عملات.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rows = document.querySelectorAll('.clickable-row');
            rows.forEach(row => {
                row.addEventListener('click', function (event) {
                    if (event.target.tagName !== 'BUTTON' && event.target.tagName !== 'I' && event.target.tagName !== 'A') {
                        window.location.href = this.dataset.href;
                    }
                });
            });
        });
    </script>
</body>
</html>
