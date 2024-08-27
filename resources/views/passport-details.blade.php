@csrf
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تفاصيل الجواز</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 15px;
        }
        .card-header {
            border-radius: 15px 15px 0 0;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-update {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-update:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            padding: 0.75rem;
        }
        .mb-3 {
            margin-bottom: 1.5rem;
        }
        @media only screen and (max-width: 768px) {
            .card {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">تفاصيل الجواز</h1>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('passport-update', $passport->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="الحالة" class="form-label">الحالة</label>
                                <select class="form-select" id="الحالة" name="الحالة">
                                    <option value="جاري" {{ $passport['الحالة'] == 'جاري' ? 'selected' : '' }}>جاري</option>
                                    <option value="منتهي" {{ $passport['الحالة'] == 'منتهي' ? 'selected' : '' }}>منتهي</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="الاسم" class="form-label">الاسم</label>
                                <input type="text" class="form-control" id="الاسم" name="الاسم" value="{{ $passport['الاسم'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="رقم الجواز" class="form-label">رقم الجواز</label>
                                <input type="text" class="form-control" id="رقم الجواز" name="رقم الجواز" value="{{ $passport['رقم الجواز'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="الاسم الاجنبي" class="form-label">الاسم الاجنبي</label>
                                <input type="text" class="form-control" id="الاسم الاجنبي" name="الاسم الاجنبي" value="{{ $passport['الاسم الاجنبي'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="اسم الاب" class="form-label">اسم الاب</label>
                                <input type="text" class="form-control" id="اسم الاب" name="اسم الاب" value="{{ $passport['اسم الاب'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="الشهرة" class="form-label">الشهرة</label>
                                <input type="text" class="form-control" id="الشهرة" name="الشهرة" value="{{ $passport['الشهرة'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="اسم الاب اجنبي" class="form-label">اسم الاب اجنبي</label>
                                <input type="text" class="form-control" id="اسم الاب اجنبي" name="اسم الاب اجنبي" value="{{ $passport['اسم الاب اجنبي'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="الشهرة اجنبي" class="form-label">الشهرة اجنبي</label>
                                <input type="text" class="form-control" id="الشهرة اجنبي" name="الشهرة اجنبي" value="{{ $passport['الشهرة اجنبي'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="نوع الجواز" class="form-label">نوع الجواز</label>
                                <input type="text" class="form-control" id="نوع الجواز" name="نوع الجواز" value="{{ $passport['نوع الجواز'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="الجنسية" class="form-label">الجنسية</label>
                                <input type="text" class="form-control" id="الجنسية" name="الجنسية" value="{{ $passport['الجنسية'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="الجنس" class="form-label">الجنس</label>
                                <select class="form-select" id="الجنس" name="الجنس">
                                    <option value="ذكر" {{ $passport['الجنس'] == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                    <option value="أنثى" {{ $passport['الجنس'] == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="تاريخ الاستلام" class="form-label">تاريخ الاستلام</label>
                                <input type="date" class="form-control" id="تاريخ الاستلام" name="تاريخ الاستلام" value="{{ $passport['تاريخ الاستلام'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="تاريخ الارسال" class="form-label">تاريخ الارسال</label>
                                <input type="date" class="form-control" id="تاريخ الارسال" name="تاريخ الارسال" value="{{ $passport['تاريخ الارسال'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="تاريخ التسليم" class="form-label">تاريخ التسليم</label>
                                <input type="date" class="form-control" id="تاريخ التسليم" name="تاريخ التسليم" value="{{ $passport['تاريخ التسليم'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-update text-white">تحديث المعلومات</button>
                        <a href="{{ route('passports-index') }}" class="btn btn-secondary">العودة إلى قائمة الجوازات</a>
                        @if($passport['الحالة'] == 'منتهي')
                            <form action="{{ route('passport-delete', $passport->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا الجواز؟');">
                                    حذف الجواز
                                </button>
                            </form>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>