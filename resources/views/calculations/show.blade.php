<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>عرض الحساب</title>
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
        .card {
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }
        .card-header {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
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
            <h1><i class="fas fa-book"></i> تفاصيل الحساب</h1>
            <a href="{{ route('calculations.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> العودة إلى القائمة
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

        <div class="card">
            <div class="card-header">
                تفاصيل الحساب #{{ $calculation->id }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Is Second Entry:</strong> {{ $calculation->is_second_entry ? 'Yes' : 'No' }}</p>
                        <p><strong>دائن:</strong> {{ $calculation->accountDain['الاسم'] ?? 'N/A' }}</p>
                        <p><strong>مدين:</strong> {{ $calculation->accountMadin['الاسم'] ?? 'N/A' }}</p>
                        <p><strong>رصيد الدائن:</strong> {{ $calculation['رصيد_الدائن'] }}</p>
                        <p><strong>رصيد المدين:</strong> {{ $calculation['رصيد_المدين'] }}</p>
                        <p><strong>البيان:</strong> {{ $calculation->البيان }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>رقم السجل الاساسي:</strong> {{ $calculation['main_record_id'] }}</p>
                        <p><strong>نوع الحساب دائن:</strong> {{ $calculation->accountTypeDain->النوع ?? 'N/A' }}</p>
                        <p><strong>نوع الحساب مدين:</strong> {{ $calculation->accountTypeMadin->النوع ?? 'N/A' }}</p>
                        <p><strong>Passport:</strong> {{ $calculation->passport['الاسم'] ?? 'N/A' }}</p>
                        <p><strong>Coin:</strong> {{ $calculation->coin->coin ?? 'N/A' }}</p>
                        <p><strong>تاريخ السجل:</strong> {{ $calculation->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('calculations.edit', $calculation->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> تعديل
                </a>
                @if(!$calculation->is_second_entry)
                    <form action="{{ route('calculations.destroy', $calculation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this calculation?')">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>