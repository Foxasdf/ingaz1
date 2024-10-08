<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            animation: fadeIn 1s ease-in-out;
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            animation: fadeInUp 1s ease-in-out;
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Order</h1>

        <form action="{{ route('orders-update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Order Information</h5>
                    <div class="mb-3">
                        <label for="اسم_الزبون" class="form-label">اسم الزبون</label>
                        <input type="text" class="form-control" id="اسم_الزبون" name="اسم الزبون" value="{{ $order['اسم_الزبون'] }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="وجهة_السفر" class="form-label">وجهة السفر</label>
                        <input type="text" class="form-control" id="وجهة_السفر" name="وجهة السفر" value="{{ $order['وجهة_السفر'] }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="نوع_التأشير" class="form-label">نوع التأشير</label>
                        <input type="text" class="form-control" id="نوع_التأشير" name="نوع التأشير" value="{{ $order['نوع_التأشير'] }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="عدد<em>مرات</em>الدخول" class="form-label">عدد مرات الدخول</label>
                        <select class="form-select" id="عدد<em>مرات</em>الدخول" name="عدد مرات الدخول" required>
                            <option value="مرة" {{ $order['عدد_مرات_الدخول'] == 'مرة' ? 'selected' : '' }}>مرة</option>
                            <option value="عدة مرات" {{ $order['عدد_مرات_الدخول'] == 'عدة مرات' ? 'selected' : '' }}>عدة مرات</option>
                            <option value="ذهاب وأياب" {{ $order['عدد_مرات_الدخول'] == 'ذهاب وأياب' ? 'selected' : '' }}>ذهاب وأياب</option>
                        </select>
                        <div class="mb-3">
                            <label for="الحالة" class="form-label">الحالة</label>
                            <select class="form-select" id="الحالة" name="الحالة" required>
                                <option value="جديد" {{ $order['الحالة'] == 'جديد' ? 'selected' : '' }}>جديد</option>
                                <option value="تحت التنفيذ" {{ $order['الحالة'] == 'تحت التنفيذ' ? 'selected' : '' }}>تحت التنفيذ</option>
                                <option value="منتهي" {{ $order['الحالة'] == 'منتهي' ? 'selected' : '' }}>منتهي</option>
                            </select>
                        </div>
                </div>
            </div>

            <h2 class="mb-3">Associated Passports</h2>
            @foreach($order->passports as $index => $passport)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Passport #{{ $index + 1 }}</h5>
                        <input type="hidden" name="passports[{{ $index }}][id]" value="{{ $passport->id }}">
                        <div class="mb-3">
                            <label for="passport_{{ $index }}_الحالة" class="form-label">الحالة</label>
                            <input type="text" class="form-control" id="passport_{{ $index }}_الحالة" name="passports[{{ $index }}][الحالة]" value="{{ $passport['الحالة'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="passport_{{ $index }}_الاسم" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="passport_{{ $index }}_الاسم" name="passports[{{ $index }}][الاسم]" value="{{ $passport['الاسم'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="passport_{{ $index }}<em>رقم</em>الجواز" class="form-label">رقم الجواز</label>
                            <input type="text" class="form-control" id="passport_{{ $index }}<em>رقم</em>الجواز" name="passports[{{ $index }}][رقم الجواز]" value="{{ $passport['رقم الجواز'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="passport_{{ $index }}<em>نوع</em>الجواز" class="form-label">نوع الجواز</label>
                            <input type="text" class="form-control" id="passport_{{ $index }}<em>نوع</em>الجواز" name="passports[{{ $index }}][نوع الجواز]" value="{{ $passport['نوع الجواز'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="passport_{{ $index }}_الجنسية" class="form-label">الجنسية</label>
                            <input type="text" class="form-control" id="passport_{{ $index }}_الجنسية" name="passports[{{ $index }}][الجنسية]" value="{{ $passport['الجنسية'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="passport_{{ $index }}<em>تاريخ</em>الاستلام" class="form-label">تاريخ الاستلام</label>
                            <input type="date" class="form-control" id="passport_{{ $index }}<em>تاريخ</em>الاستلام" name="passports[{{ $index }}][تاريخ الاستلام]" value="{{ $passport['تاريخ الاستلام'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="passport_{{ $index }}<em>تاريخ</em>الارسال" class="form-label">تاريخ الارسال</label>
                            <input type="date" class="form-control" id="passport_{{ $index }}<em>تاريخ</em>الارسال" name="passports[{{ $index }}][تاريخ الارسال]" value="{{ $passport['تاريخ الارسال'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="passport_{{ $index }}<em>تاريخ</em>التسليم" class="form-label">تاريخ التسليم</label>
                            <input type="date" class="form-control" id="passport_{{ $index }}<em>تاريخ</em>التسليم" name="passports[{{ $index }}][تاريخ التسليم]" value="{{ $passport['تاريخ التسليم']}}">
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Order</button>
                <a href="{{ route('orders', $order->id) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
