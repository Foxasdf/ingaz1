@csrf
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h1 class="mb-0">Add New Order</h1>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('orders-store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="اسم_الزبون" class="form-label">اسم الزبون</label>
                        <input type="text" name="اسم الزبون" class="form-control" id="اسم_الزبون" value="{{ old('اسم الزبون') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="وجهة_السفر" class="form-label">وجهة السفر</label>
                        <input type="text" name="وجهة السفر" class="form-control" id="وجهة_السفر" value="{{ old('وجهة السفر') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="نوع_التأشير" class="form-label">نوع التأشير</label>
                        <input type="text" name="نوع التأشير" class="form-control" id="نوع_التأشير" value="{{ old('نوع التأشير') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="عدد_مرات_الدخول" class="form-label">عدد مرات الدخول</label>
                        <input type="text" name="عدد مرات الدخول" class="form-control" id="عدد_مرات_الدخول" value="{{ old('عدد مرات الدخول') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="الحالة" class="form-label">الحالة</label>
                        <select class="form-select" id="الحالة" name="الحالة" required>
                            <option value="جديد" {{ old('الحالة') == 'جديد' ? 'selected' : '' }}>جديد</option>
                            <option value="تحت التنفيذ" {{ old('الحالة') == 'تحت التنفيذ' ? 'selected' : '' }}>تحت التنفيذ</option>
                            <option value="منتهي" {{ old('الحالة') == 'منتهي' ? 'selected' : '' }}>منتهي</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="account_id" class="form-label">الحساب</label>
                        <select class="form-select" id="account_id" name="account_id" required>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                    {{ $account->الاسم }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Create Order</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>