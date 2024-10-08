
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Calculation</title>
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
        <h1>Edit Calculation</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('calculations.update', $calculation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- نوع الحساب دائن -->
            <div class="mb-3">
                <label for="accountTypeDain" class="form-label">نوع الحساب دائن</label>
                <select id="accountTypeDain" name="نوع_الحساب_دائن" class="form-control" required>
                    <option value="">Select Account Type</option>
                    @foreach($accountTypes as $accountType)
                        <option value="{{ $accountType->id }}" {{ $calculation->نوع_الحساب_دائن == $accountType->id ? 'selected' : '' }}>
                            {{ $accountType->النوع }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- دائن -->
            <div class="mb-3">
                <label for="accountDain" class="form-label">دائن</label>
                <select id="accountDain" name="دائن" class="form-control" required>
                    <option value="">Select Account</option>
                    @foreach($accountsDain as $account)
                        <option value="{{ $account->id }}" {{ $calculation->دائن == $account->id ? 'selected' : '' }}>
                            {{ $account->الاسم }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- نوع الحساب مدين -->
            <div class="mb-3">
                <label for="accountTypeMadin" class="form-label">نوع الحساب مدين</label>
                <select id="accountTypeMadin" name="نوع_الحساب_مدين" class="form-control" required>
                    <option value="">Select Account Type</option>
                    @foreach($accountTypes as $accountType)
                        <option value="{{ $accountType->id }}" {{ $calculation->نوع_الحساب_مدين == $accountType->id ? 'selected' : '' }}>
                            {{ $accountType->النوع }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- مدين -->
            <div class="mb-3">
                <label for="accountMadin" class="form-label">مدين</label>
                <select id="accountMadin" name="مدين" class="form-control" required>
                    <option value="">Select Account</option>
                    @foreach($accountsMadin as $account)
                        <option value="{{ $account->id }}" {{ $calculation->مدين == $account->id ? 'selected' : '' }}>
                            {{ $account->الاسم }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Coin -->
            <div class="mb-3">
                <label for="coin" class="form-label">Coin</label>
                <select id="coin" name="coin_id" class="form-control" required>
                    @foreach($coins as $coin)
                        <option value="{{ $coin->id }}" {{ $calculation->coin_id == $coin->id ? 'selected' : '' }}>
                            {{ $coin->coin }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- رصيد الدائن -->
            <div class="mb-3">
                <label for="رصيد_الدائن" class="form-label">رصيد الدائن</label>
                <input type="number" id="رصيد_الدائن" name="رصيد_الدائن" class="form-control" value="{{ $calculation->رصيد_الدائن }}" required>
            </div>

            <!-- رصيد المدين -->
            <div class="mb-3">
                <label for="رصيد_المدين" class="form-label">رصيد المدين</label>
                <input type="number" id="رصيد_المدين" name="رصيد_المدين" class="form-control" value="{{ $calculation->رصيد_المدين }}" required>
            </div>

            <!-- البيان -->
            <div class="mb-3">
                <label for="البيان" class="form-label">البيان</label>
                <textarea id="البيان" name="البيان" class="form-control" required>{{ $calculation->البيان }}</textarea>
            </div>

            <!-- Passport -->
            <div class="mb-3">
                <label for="passport" class="form-label">Passport</label>
                <select id="passport" name="passport_id" class="form-control">
                    <option value="">Select Passport</option>
                    @foreach($passports as $passport)
                        <option value="{{ $passport->id }}" {{ $calculation->passport_id == $passport->id ? 'selected' : '' }}>
                            {{ $passport->الاسم }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Calculation</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>