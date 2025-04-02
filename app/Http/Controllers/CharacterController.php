<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Character;

class CharacterController extends Controller
{
    public function fetchApiData()
    {
        $response = Http::get('https://rickandmortyapi.com/api/character');

        if ($response->successful()) {
            $characters = collect($response->json()['results'])->take(100);
            return view('characters.index', compact('characters'));
        }

        return redirect()->back()->with('error', 'Error al obtener datos de la API');
    }

    public function storeApiData()
    {
        $response = Http::get('https://rickandmortyapi.com/api/character');

        if ($response->successful()) {
            $characters = collect($response->json()['results'])->take(100);

            foreach ($characters as $character) {
                Character::updateOrCreate(
                    ['id' => $character['id']],
                    [
                        'name' => $character['name'],
                        'status' => $character['status'],
                        'species' => $character['species'],
                        'type' => $character['type'] ?? '',
                        'gender' => $character['gender'],
                        'origin_name' => $character['origin']['name'],
                        'origin_url' => $character['origin']['url'],
                        'image' => $character['image']
                    ]
                );
            }

            return redirect()->route('characters.local')->with('success', 'Datos almacenados correctamente');
        }

        return redirect()->back()->with('error', 'Error al almacenar datos');
    }

    public function indexLocal()
    {
        $characters = Character::paginate(10);
        // $characters = [
        //     ['id' => 1, 'name' => 'Rick Sanchez', 'status' => 'Alive', 'species' => 'Human'],
        //     ['id' => 2, 'name' => 'Morty Smith', 'status' => 'Alive', 'species' => 'Human'],
        //     ['id' => 3, 'name' => 'Birdperson', 'status' => 'Dead', 'species' => 'Alien'],
        // ];
        return view('characters.local', compact('characters'));
    }

    public function edit(Character $character)
    {
        return view('characters.edit', compact('character'));
    }

    public function update(Request $request, Character $character)
    {
        $character->update($request->all());
        return redirect()->route('characters.local')->with('success', 'Personaje actualizado');
    }
}
?>