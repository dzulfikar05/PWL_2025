<!DOCTYPE html>
<html>

<head>
    <title>Item List</title>
</head>

<body>
    <h1>Items</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('items.create') }}">Add Item</a> <!-- memangil route items.create untuk beralih ke halaman create -->

    <ul>
        <!-- Looping melalui daftar item yang diberikan -->
        @foreach ($items as $item)
            <li>
                <!-- Menampilkan nama item -->
                {{ $item->name }} -

                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- memangil route items.edit untuk beralih ke halaman edit -->

                <!-- Form untuk menghapus item, menggunakan metode DELETE -->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display: inline;">
                    @csrf <!-- Token CSRF untuk keamanan -->
                    @method('DELETE') <!-- Menggunakan metode DELETE untuk menghapus item -->
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>

</html>
