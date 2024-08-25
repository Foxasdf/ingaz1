<!-- resources/views/account_types/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create New Account Type</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Start -->
        <form action="{{ route('account-types.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="النوع" class="form-label">Account Type</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="النوع" 
                    name="النوع" 
                    value="{{ old('النوع') }}" 
                    required 
                    maxlength="255">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('account-types.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
        <!-- Form End -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>