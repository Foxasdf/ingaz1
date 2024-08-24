<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Account</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('account-update', $account->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="الاسم" class="form-label">Account Name (الاسم)</label>
                <input type="text" name="الاسم" id="الاسم" class="form-control" value="{{ old('الاسم', $account->الاسم) }}" required>
            </div>

            <div class="mb-3">
                <label for="رقم_الهاتف" class="form-label">Phone Number (رقم الهاتف)</label>
                <input type="text" name="رقم_الهاتف" id="رقم_الهاتف" class="form-control" value="{{ old('رقم_الهاتف', $account['رقم الهاتف']) }}">
            </div>

            <div class="mb-3">
                <label for="العنوان" class="form-label">Address (العنوان)</label>
                <input type="text" name="العنوان" id="العنوان" class="form-control" value="{{ old('العنوان', $account->العنوان) }}">
            </div>

            <div class="mb-3">
                <label for="account_types_id" class="form-label">Account Type (النوع)</label>
                <select name="account_types_id" id="account_types_id" class="form-select" required>
                    @foreach ($accountTypes as $type)
                        <option value="{{ $type->id }}" {{ old('account_types_id', $account->account_types_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->النوع }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <button type="submit" class="btn btn-success">Update Account</button>
            <a href="{{ route('account-profile', $account->id) }}" class="btn btn-secondary">Cancel</a>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>