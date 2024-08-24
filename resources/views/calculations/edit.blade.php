<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Calculation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

<!-- رقم السجل الاساسي -->
<div class="mb-3">
    <label for="رقم_السجل_الاساسي" class="form-label">رقم السجل الاساسي</label>
    <input type="number" id="رقم_السجل_الاساسي" name="رقم_السجل_الاساسي" class="form-control" value="{{ $calculation->رقم_السجل_الاساسي }}">
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