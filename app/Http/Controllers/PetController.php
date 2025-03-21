<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'available'); 
        $response = Http::get("https://petstore.swagger.io/v2/pet/findByStatus", ['status' => $status]);
        $pets = $response->json();

        return view('pets.index', compact('pets'));
    }

    public function filterByStatus($status)
    {
        $response = Http::get("https://petstore.swagger.io/v2/pet/findByStatus", [
            'status' => $status
        ]);

        $pets = $response->json();
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        Http::post('https://petstore.swagger.io/v2/pet', [
            "id" => $request->id | rand(1000, 9999),
            "name" => $request->name,
            "status" => $request->status,
            "photoUrls" => ["string"],
            "category" => ["id" => 1, "name" => "General"],
            "tags" => [["id" => 1, "name" => "Tag"]]
        ]);

        return redirect()->route('pets.index')->with('success', 'Zwierzę dodane!');
    }

    public function edit($id)
    {
        $maxAttempts = 3;
        $attempt = 0;
        $pet = null;

        do {
            $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");

            if ($response->successful()) {
                $pet = $response->json();
                return view('pets.edit', compact('pet'));
            }
            $attempt++;
            sleep(1);
        } while ($attempt < $maxAttempts);

        return redirect()->route('pets.index')->with('error', 'Nie można załadować danych zwierzaka. Spróbuj ponownie!');
    }

    public function update(Request $request, $id)
    {
        Http::put("https://petstore.swagger.io/v2/pet", [
            "id" => $id,
            "name" => $request->name,
            "status" => $request->status,
            "photoUrls" => ["string"],
            "category" => ["id" => 1, "name" => "General"],
            "tags" => [["id" => 1, "name" => "Tag"]]
        ]);

        return redirect()->route('pets.index')->with('success', 'Zwierzę zaktualizowane!');
    }

    public function destroy($id)
    {
        $response=Http::delete("https://petstore.swagger.io/v2/pet/{$id}");
        if ($response->successful()) {
            return redirect()->route('pets.index')->with('success', 'Zwierzę usunięte!');
        } else {
            return redirect()->route('pets.index')->with('error', 'Błąd podczas usuwania zwierzaka!');
        }
    }
}
