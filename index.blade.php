<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Candidate Management System</title>
</head>
<body>

    <h1>Add Candidate</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('candidates.store') }}">
        @csrf
        <label>First Name:</label><br>
        <input type="text" name="first_name" required><br><br>

        <label>Middle Name:</label><br>
        <input type="text" name="middle_name"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" required><br><br>

        <label>Gender:</label><br>
        <input type="text" name="gender" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address" required><br><br>

        <label>Position:</label><br>
        <input type="text" name="position" required><br><br>

        <label>Party:</label><br>
        <input type="text" name="party"><br><br>

        <button type="submit">Save</button>
    </form>

    <hr>

    <h1>Candidate List</h1>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('candidates.index') }}">
        <input type="text" name="search" placeholder="Search by name, position, or party..."
               value="{{ request('search') }}">
        <button type="submit">Search</button>
        @if(request('search'))
            <a href="{{ route('candidates.index') }}">Clear</a>
        @endif
    </form>

    <br>

    <table border="1" cellpadding="10">
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Position</th>
            <th>Party</th>
            <th>Actions</th>
        </tr>

        @forelse($candidates as $candidate)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $candidate->first_name }}</td>
            <td>{{ $candidate->middle_name ?? '-' }}</td>
            <td>{{ $candidate->last_name }}</td>
            <td>{{ $candidate->gender }}</td>
            <td>{{ $candidate->address }}</td>
            <td>{{ $candidate->position }}</td>
            <td>{{ $candidate->party ?? '-' }}</td>
            <td>
                {{-- Edit Button: redirects to edit.blade.php --}}
                <a href="{{ route('candidates.edit', $candidate->id) }}">
                    <button type="button">Edit</button>
                </a>

                {{-- Delete Button --}}
                <form method="POST" action="{{ route('candidates.destroy', $candidate->id) }}"
                      style="display:inline;"
                      onsubmit="return confirm('Delete {{ $candidate->first_name }} {{ $candidate->last_name }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">
                @if(request('search'))
                    No candidates found for "{{ request('search') }}".
                @else
                    No candidates found.
                @endif
            </td>
        </tr>
        @endforelse
    </table>

</body>
</html>