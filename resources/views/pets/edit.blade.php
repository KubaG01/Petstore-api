@extends('layouts.app')

@section('content')
    <a href="{{ route('pets.index') }}" style="display: inline-block; margin: 15px; padding: 15px; background: #555; color: white; text-decoration: none; border-radius: 5px;">
        ⬅ Powrót do 📋 Listy Zwierząt
    </a>

    <h1 style="margin-bottom: 20px;">✏️ Edytuj zwierzę</h1>

    <form style="max-width: 400px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 10px;" action="{{ route('pets.update', $pet['id']) }}" method="POST" >
        @csrf
        @method('PUT')

        <label>ID:</label>
        <input type="text" value="{{ $pet['id'] }}" disabled>
        <input type="hidden" name="id" value="{{ $pet['id'] }}">

        <label>Nazwa:</label>
        <input type="text" name="name" value="{{ $pet['name'] }}" required>

        <label>Status:</label>
        <select name="status">
            <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>✅ Available</option>
            <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
            <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>❌ Sold</option>
        </select>

        <button type="submit">💾 Zapisz zmiany</button>
    </form>

    <style>
        input, select {
            width: 95%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            width: 100%;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #005f75;
        }
    </style>
@endsection
