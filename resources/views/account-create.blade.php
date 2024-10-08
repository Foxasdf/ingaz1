<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Account</title>
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
        <h1 class="mb-4">Create New Account</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('account-store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="الاسم" class="form-label">Account Name (الاسم)</label>
                <input type="text" name="الاسم" id="الاسم" class="form-control" value="{{ old('الاسم') }}" required>
            </div>

            <div class="mb-3">
                <label for="رقم_الهاتف" class="form-label">Phone Number (رقم الهاتف)</label>
                <input type="text" name="رقم<em>الهاتف" id="رقم</em>الهاتف" class="form-control" value="{{ old('رقم_الهاتف') }}">
            </div>

            <div class="mb-3">
                <label for="العنوان" class="form-label">Address (العنوان)</label>
                <input type="text" name="العنوان" id="العنوان" class="form-control" value="{{ old('العنوان') }}">
            </div>

            <div class="mb-3">
                <label for="account_types_id" class="form-label">Account Type (النوع)</label>
                <select name="account_types_id" id="account_types_id" class="form-select" required>
                    <option value="">Select Account Type</option>
                    @foreach ($accountTypes as $type)
                        <option value="{{ $type->id }}" {{ old('account_types_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->النوع }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Create Account</button>
            <a href="{{ route('accounts') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
