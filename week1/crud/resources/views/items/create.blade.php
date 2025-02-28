<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
</head>
<body>
    <h1>Add Item</h1>
    <!-- form jika di submit akan mengarahkan ke route items.store -->
    <form action="{{ route('items.store') }}" method="POST">
        @csrf <!-- Laravel CSRF token untuk mencegah serangan Cross-Site Request Forgery -->

        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <br>
        {{-- submit untuk mengirimkan form --}}
        <button type="submit">Add Item</button>
    </form>

    <!-- Link untuk kembali ke halaman daftar item -->
    <a href="{{ route('items.index') }}">Back to List</a
