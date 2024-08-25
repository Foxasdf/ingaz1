<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Calculation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="container mt-5">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1>Create Calculation</h1>
        <form action="{{ route('calculations.store') }}" method="POST">

        @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <!-- نوع الحساب دائن -->
        <div class="mb-3">
            <label for="accountTypeDain" class="form-label">نوع الحساب دائن</label>
            <select id="accountTypeDain" name="نوع_الحساب_دائن" class="form-control" required>
                <option value="">Select Account Type</option>
                @foreach($accountTypes as $accountType)
                    <option value="{{ $accountType->id }}">{{ $accountType->النوع }}</option>
                @endforeach
            </select>
        </div>

        <!-- دائن -->
        <div class="mb-3">
            <label for="accountDain" class="form-label">دائن</label>
            <select id="accountDain" name="دائن" class="form-control" required>
                <option value="">Select Account</option>
                <!-- Options will be dynamically populated by JavaScript -->
            </select>
        </div>

        <!-- نوع الحساب مدين -->
        <div class="mb-3">
            <label for="accountTypeMadin" class="form-label">نوع الحساب مدين</label>
            <select id="accountTypeMadin" name="نوع_الحساب_مدين" class="form-control" required>
                <option value="">Select Account Type</option>
                @foreach($accountTypes as $accountType)
                    <option value="{{ $accountType->id }}">{{ $accountType->النوع }}</option>
                @endforeach
            </select>
        </div>

        <!-- مدين -->
        <div class="mb-3">
            <label for="accountMadin" class="form-label">مدين</label>
            <select id="accountMadin" name="مدين" class="form-control" required>
                <option value="">Select Account</option>
                <!-- Options will be dynamically populated by JavaScript -->
            </select>
        </div>

        <!-- Coin and Amounts -->
        <div class="mb-3">
            <label for="coin" class="form-label">Coin</label>
            <select id="coin" name="coin_id" class="form-control" required>
                @foreach($coins as $coin)
                    <option value="{{ $coin->id }}" data-coin-price="{{ $coin->coin_price }}">{{ $coin->coin }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount_dain" class="form-label">Enter Amount for رصيد الدائن</label>
            <input type="number" id="amount_dain" name="amount_dain" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="رصيد_الدائن" class="form-label">رصيد الدائن</label>
            <input type="number" id="رصيد_الدائن" name="رصيد_الدائن" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="amount_madin" class="form-label">Enter Amount for رصيد المدين</label>
            <input type="number" id="amount_madin" name="amount_madin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="رصيد_المدين" class="form-label">رصيد المدين</label>
            <input type="number" id="رصيد_المدين" name="رصيد_المدين" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="البيان" class="form-label">البيان</label>
            <textarea id="البيان" name="البيان" class="form-control" required></textarea>
        </div>





        <!-- Passport dropdown with both 'الاسم' and 'رقم الجواز' -->
        <div class="mb-3">
            <label for="passport" class="form-label">Passport</label>
            <select id="passport" name="passport_id" class="form-control">
                @foreach($passports as $passport)
                    <option value="{{ $passport->id }}">{{ $passport['الاسم'] }} - {{ $passport['رقم الجواز'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="created_at">تاريخ السجل</label>
            <input type="date" name="created_at" id="created_at" class="form-control" value="{{ old('created_at', now()->format('Y-m-d')) }}">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const accountTypeDainSelect = document.getElementById('accountTypeDain');
        const accountDainSelect = document.getElementById('accountDain');
        const accountTypeMadinSelect = document.getElementById('accountTypeMadin');
        const accountMadinSelect = document.getElementById('accountMadin');
        const amountDainInput = document.getElementById('amount_dain');
        const amountMadinInput = document.getElementById('amount_madin');
        const coinSelect = document.getElementById('coin');
        const رصيد_الدائنInput = document.getElementById('رصيد_الدائن');
        const رصيد_المدينInput = document.getElementById('رصيد_المدين');

        // Function to update account dropdowns
        function updateAccountDropdown(accountTypeSelect, accountSelect) {
            const accountTypeId = accountTypeSelect.value;

            // Clear the account dropdown
            accountSelect.innerHTML = '<option value="">Select Account</option>';

            if (accountTypeId) {
                fetch(`/calculations/accounts/by-type/${accountTypeId}`)
                    .then(response => response.json())
                    .then(accounts => {
                        accounts.forEach(account => {
                            const option = document.createElement('option');
                            option.value = account.id;
                            option.textContent = account['الاسم'];
                            accountSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching accounts:', error));
            }
        }

        // Event listeners for account type dropdowns
        accountTypeDainSelect.addEventListener('change', () => {
            updateAccountDropdown(accountTypeDainSelect, accountDainSelect);
        });

        accountTypeMadinSelect.addEventListener('change', () => {
            updateAccountDropdown(accountTypeMadinSelect, accountMadinSelect);
        });

        // Function to update the balances dynamically
        function updateBalances() {
            const amountDain = parseFloat(amountDainInput.value) || 0;
            const amountMadin = parseFloat(amountMadinInput.value) || 0;
            const selectedCoin = coinSelect.options[coinSelect.selectedIndex];
            const coinPrice = parseFloat(selectedCoin.getAttribute('data-coin-price')) || 1;

            const balanceDain = amountDain * coinPrice;
            const balanceMadin = amountMadin * coinPrice;

            رصيد_الدائنInput.value = balanceDain;
            رصيد_المدينInput.value = balanceMadin;
        }

        // Event listeners to update balances when user inputs amount or changes the coin
        amountDainInput.addEventListener('input', updateBalances);
        amountMadinInput.addEventListener('input', updateBalances);
        coinSelect.addEventListener('change', updateBalances);
    });
</script>
</body>
</html>