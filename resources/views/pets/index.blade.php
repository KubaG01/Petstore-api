@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 20px;">
        📋 Lista Zwierząt - 
        @if(request('status') == 'pending') ⏳ Pending
        @elseif(request('status') == 'sold') ❌ Sold
        @else ✅ Available
        @endif
    </h1>

    <!-- Przyciski filtrowania -->
    <div style="display: flex; align-items: center; margin-bottom: 15px;">
        <div style="flex-grow: 1;">
            <a href="{{ route('pets.index', ['status' => 'available']) }}" style="padding: 10px; background: #4CAF50; color: white; text-decoration: none; margin-right: 10px;">✅ Available</a>
            <a href="{{ route('pets.index', ['status' => 'pending']) }}" style="padding: 10px; background: #FFA500; color: white; text-decoration: none; margin-right: 10px;">⏳ Pending</a>
            <a href="{{ route('pets.index', ['status' => 'sold']) }}" style="padding: 10px; background: #FF0000; color: white; text-decoration: none;">❌ Sold</a>

        </div>

        <!-- Przycisk "Dodaj nowego zwierzaka" -->
        <a href="{{ route('pets.create') }}" style="padding: 10px; background: #008CBA; color: white; text-decoration: none;">➕ Dodaj nowego zwierzaka</a>
    </div>
    <br>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 90%; margin: auto; text-align: left;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Status</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($pets) && count($pets) > 0)
                @foreach ($pets as $pet)
                    <tr>
                        <td>{{ $pet['id'] }}</td>
                        <td>{{ $pet['name'] ?? 'Brak nazwy' }}</td>
                        <td>{{ $pet['status'] ?? 'Nieznany status' }}</td>
                        <td style="text-align: center;">
                            <a class="edit-link" href="{{ route('pets.edit', $pet['id']) }}">✏️ Edytuj</a> 
                            <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline; margin:0; padding:0;" onsubmit="return confirmDelete('{{ $pet['id'] }}', '{{ $pet['name'] ?? 'Brak nazwy'}}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">🗑️ Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align: center;">Brak zwierząt do wyświetlenia.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <script>
        function confirmDelete(petId, petName) {
            if (!confirm(`Czy na pewno usunąć zwierzę: ${petName} (ID: ${petId})?`)) {
            return false; 
            }
            
            setTimeout(() => {
                location.reload();
            }, 500);
            
            return true;
        }
    </script>

    
    <style>
        .edit-link {
            text-decoration: none;
            padding: 5px 10px; 
            margin-bottom: 5px;
            margin-right: 4px;
            border: 1px solid #ccc;
            border-radius: 5px; 
            cursor: pointer; 
            color: #007bff; 
            width: 43%;
            display: inline-block;
        }
        
        .edit-link:hover {
            background-color: #f1f1f1;
            color: #0056b3; 
        }

        .delete-btn {
            text-decoration: none; 
            padding: 8px 10px; 
            margin-bottom: 5px;
            border: 1px solid red;
            border-radius: 5px;
            cursor: pointer; 
            color: white; 
            width: 48%;
            display: inline-block;
            background-color: red;
        }

        .delete-btn:hover {
            background-color: darkred;
            border-color: darkred; 
        }
</style>

@endsection
