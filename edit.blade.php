<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Candidate</title>
</head>
<body>

    <h1>Edit Candidate</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('candidates.update', $candidate->id) }}">
        @csrf
        @method('PUT')

        <label>First Name:</label><br>
        <input type="text" name="first_name"
               value="{{ old('first_name', $candidate->first_name) }}" required><br><br>

        <label>Middle Name:</label><br>
        <input type="text" name="middle_name"
               value="{{ old('middle_name', $candidate->middle_name) }}"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name"
               value="{{ old('last_name', $candidate->last_name) }}" required><br><br>

        <label>Gender:</label><br>
        <input type="text" name="gender"
               value="{{ old('gender', $candidate->gender) }}" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address"
               value="{{ old('address', $candidate->address) }}" required><br><br>

        <label>Position:</label><br>
        <input type="text" name="position"
               value="{{ old('position', $candidate->position) }}" required><br><br>

        <label>Party:</label><br>
        <input type="text" name="party"
               value="{{ old('party', $candidate->party) }}"><br><br>

        <button type="submit">Update</button>
        <a href="{{ route('candidates.index') }}">Cancel</a>
    </form>

</body>
</html>