<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Calculation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            animation: fadeIn 1s ease-in-out;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-in-out;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeInDown 1s ease-in-out;
        }
        .mb-3 {
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-in-out;
        }
        label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            animation: pulse 1s infinite;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .passport-details {
            margin-top: 20px;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
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
        @keyframes slideIn {
            0% { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
            <!--- passport details card -->


           @keyframes popIn {
               0% {
            opacity: 0;
                 transform: scale(0.8);
                 }
                100% {
                    opacity: 1;
                    transform: scale(1);
        }
    }

    .passport-details {
        animation: popIn 0.3s ease-out;
    }

        }
    </style>
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
                <option value="">Select Passport</option>
                @foreach($passports as $passport)
                    <option value="{{ $passport->id }}">{{ $passport['الاسم'] }} - {{ $passport['رقم الجواز'] }}</option>
                @endforeach
            </select>
        </div>

        <!-- Passport Details Card -->
        <div id="passportDetails" class="passport-details d-none">
            <h5>Passport Details</h5>
            <div id="passportInfo"></div>
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
        const passportSelect = document.getElementById('passport');
        const passportDetails = document.getElementById('passportDetails');
        const passportInfo = document.getElementById('passportInfo');

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

// Function to display passport details
function displayPassportDetails() {
    const passportId = passportSelect.value;

    if (passportId) {
        fetch(`/calculations/passports/${passportId}`)
            .then(response => response.json())
            .then(passport => {
                passportDetails.classList.remove('d-none');
                
                // Remove the animation class if it exists
                passportDetails.classList.remove('passport-details');
                
                // Force a reflow to restart the animation
                void passportDetails.offsetWidth;
                
                // Add the animation class
                passportDetails.classList.add('passport-details');
                
                passportInfo.innerHTML = `
                    <p><strong>الحالة:</strong> ${passport['الحالة']}</p>
                    <p><strong>الاسم:</strong> ${passport['الاسم']}</p>
                    <p><strong>رقم الجواز:</strong> ${passport['رقم الجواز']}</p>
                    <p><strong>الاسم الاجنبي:</strong> ${passport['الاسم الاجنبي']}</p>
                    <p><strong>اسم الاب:</strong> ${passport['اسم الاب']}</p>
                    <p><strong>الشهرة:</strong> ${passport['الشهرة']}</p>
                    <p><strong>اسم الاب اجنبي:</strong> ${passport['اسم الاب اجنبي']}</p>
                    <p><strong>الشهرة اجنبي:</strong> ${passport['الشهرة اجنبي']}</p>
                    <p><strong>نوع الجواز:</strong> ${passport['نوع الجواز']}</p>
                    <p><strong>الجنسية:</strong> ${passport['الجنسية']}</p>
                    <p><strong>الجنس:</strong> ${passport['الجنس']}</p>
                    <p><strong>تاريخ الاستلام:</strong> ${passport['تاريخ الاستلام']}</p>
                    <p><strong>تاريخ الارسال:</strong> ${passport['تاريخ الارسال']}</p>
                    <p><strong>تاريخ التسليم:</strong> ${passport['تاريخ التسليم']}</p>
                `;
            })
            .catch(error => console.error('Error fetching passport details:', error));
    } else {
        passportDetails.classList.add('d-none');
        passportInfo.innerHTML = '';
    }
}

// Event listener to display passport details when the user selects a passport
passportSelect.addEventListener('change', displayPassportDetails);
});
</script>
</body>
</html>