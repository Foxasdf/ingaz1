<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Account Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Account Type</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('account-types.update', $accountType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="النوع" class="form-label">Account Type Name (النوع)</label>
                <input type="text" name="النوع" id="النوع" class="form-control" value="{{ old('النوع', $accountType->النوع) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update Type</button>
            <a href="{{ route('account-types.show', $accountType->id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>