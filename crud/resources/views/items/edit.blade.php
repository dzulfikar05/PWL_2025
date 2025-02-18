<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
</head>
<body>
    <h1>Edit Item</h1>
    <!-- Form untuk mengedit item yang sudah ada, mengarah ke route items.update -->
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf
        @method('PUT') <!-- Metode PUT untuk memperbarui data -->

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $item->name }}" required> <!-- Menggunakan nilai item yang sudah ada -->
        <br>

        <label for="description">Description:</label>
        <textarea name="description" required>{{ $item->description }}</textarea> <!-- Menggunakan nilai item yang sudah ada -->
        <br>

        <!-- Tombol untuk memperbarui item -->
        <button type="submit">Update Item</button>
    </form>

    <!-- Link untuk kembali ke halaman daftar item -->
    <a href="{{ route('items.index') }}">Back to List</a>
</body>
</html>
