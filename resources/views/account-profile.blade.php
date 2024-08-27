<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="mb-4">Account Profile</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $account->الاسم }}</h5>
                <p class="card-text"><strong>ID:</strong> {{ $account->id }}</p>
                <p class="card-text"><strong>النوع:</strong> {{ $account->accountTypes["النوع"] ?? 'N/A' }}</p>
                <p class="card-text"><strong>رقم الهاتف:</strong> {{ $account['رقم الهاتف'] }}</p>
                <p class="card-text"><strong>العنوان:</strong> {{ $account->العنوان }}</p>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('account-edit', $account->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            @if ($account->isDeletable())
                <form action="{{ route('account-delete', $account->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            @endif
            <a href="{{ route('accounts') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to All Accounts
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
