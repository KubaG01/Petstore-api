@extends('layouts.app')

@section('content')
    <a href="{{ route('pets.index') }}" style="display: inline-block; margin: 15px; padding: 15px; background: #555; color: white; text-decoration: none; border-radius: 5px;">
        ⬅ Powrót do 📋 Listy Zwierząt
    </a>

    <h1 style="margin-bottom: 20px;">➕ Dodaj nowego zwierzaka</h1>

    <form action="{{ route('pets.store') }}" method="POST" style="max-width: 400px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 10px;">
        @csrf

        <label>ID (Opcjonalnie):</label>
        <input type="number" name="id" placeholder="Wpisz ID lub zostaw puste" class="input-field">

        <label>Nazwa:</label>
        <input type="text" name="name" required class="input-field">

        <label>Status:</label>
        <select name="status" class="input-field">
            <option value="available">✅ Available</option>
            <option value="pending">⏳ Pending</option>
            <option value="sold">❌ Sold</option>
        </select>

        <button type="submit" class="submit-btn">💾 Dodaj zwierzę</button>
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
