@csrf
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Account Profile</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $account->الاسم }}</h5>
                <p class="card-text"><strong>ID:</strong> {{ $account->id }}</p>
                <p class="card-text"><strong>النوع:</strong> {{ $account->accountTypes["النوع"]?? 'N/A'}}</p>
                <p class="card-text"><strong>رقم الهاتف:</strong> {{ $account['رقم الهاتف']}}</p>
                <p class="card-text"><strong>العنوان:</strong> {{ $account->العنوان }}</p>
            </div>
        </div>

        <a href="{{ route('accounts') }}" class="btn btn-primary mt-3">Back to All Accounts</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>