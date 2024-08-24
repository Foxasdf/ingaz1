<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Account Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">View Account Type</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <label for="النوع" class="form-label">Account Type Name (النوع)</label>
            <input type="text" class="form-control" id="النوع" value="{{ $accountType->النوع }}" readonly>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('account-types.edit', $accountType->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            @if ($accountType->isDeletable())
                <form action="{{ route('account-types.destroy', $accountType->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            @endif
            <a href="{{ route('account-types.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>