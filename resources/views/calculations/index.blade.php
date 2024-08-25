<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الحسابات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1 {
            color: #343a40;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
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
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-book"></i> سجلات المحاسبة الغير مثبتة</h1>
            <a href="{{ route('calculations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> أضافة سجل جديد
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
                        <th>Is Second Entry</th>
                        <th>دائن</th>
                        <th>مدين</th>
                        <th>رصيد الدائن</th>
                        <th>رصيد المدين</th>
                        <th>البيان</th>
                        <th>رقم السجل الاساسي</th>
                        <th>نوع الحساب دائن</th>
                        <th>نوع الحساب مدين</th>
                        <th>Passport</th>
                        <th>Coin</th>
                        <th>تاريخ السجل</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($calculations as $calculation)
                        <tr class="clickable-row" data-href="{{ route('calculations.show', $calculation->id) }}">
                            <td>{{ $calculation->id }}</td>
                            <td>{{ $calculation->is_second_entry ? 'Yes' : 'No' }}</td>
                            <td>{{ $calculation->accountDain['الاسم'] ?? 'N/A' }}</td>
                            <td>{{ $calculation->accountMadin['الاسم'] ?? 'N/A' }}</td>
                            <td>{{ $calculation['رصيد_الدائن'] }}</td>
                            <td>{{ $calculation['رصيد_المدين'] }}</td>
                            <td>{{ $calculation->البيان }}</td>
                            <td>{{ $calculation['main_record_id'] }}</td>
                            <td>{{ $calculation->accountTypeDain->النوع ?? 'N/A' }}</td>
                            <td>{{ $calculation->accountTypeMadin->النوع ?? 'N/A' }}</td>
                            <td>{{ $calculation->passport['الاسم'] ?? 'N/A' }}</td>
                            <td>{{ $calculation->coin->coin ?? 'N/A' }}</td>
                            <td>{{ $calculation->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('calculations.edit', $calculation->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Only show the delete button if it's not a counterpart -->
                                @if(!$calculation->is_second_entry)
                                    <form action="{{ route('calculations.destroy', $calculation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center">No calculations found.</td>
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
                row.addEventListener('click', function () {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
</body>
</html>