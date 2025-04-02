<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Character;

class CharacterController extends Controller
{
    public function fetchApiData()
    {
        $url = 'https://rickandmortyapi.com/api/character';
        $characters = collect(); 
        $pagesToFetch = 5; 
        $currentPage = 0; 
    
        while ($url && $currentPage < $pagesToFetch) {
            $response = Http::get($url);
    
            if ($response->successful()) {
                $data = $response->json();
                $characters = $characters->merge(collect($data['results'])); 
                $url = $data['info']['next']; 
                $currentPage++; 
            } else {
                return redirect()->back()->with('error', 'Error al obtener datos de la API');
            }
        }
        return view('characters.index', compact('characters'));
    }
    public function storeApiData()
    {
        $url = 'https://rickandmortyapi.com/api/character';
        $pagesToFetch = 5; // Puedes ajustar este valor según el número de páginas que quieras procesar
        $currentPage = 0;
    
        while ($url && $currentPage < $pagesToFetch) {
            $response = Http::get($url);
    
            if ($response->successful()) {
                $data = $response->json();
                $characters = collect($data['results']);
    
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
    
                $url = $data['info']['next']; // Actualiza la URL para la siguiente página
                $currentPage++;
            } else {
                session()->flash('error', 'Error al obtener datos de la API');
                return redirect()->back();
            }
        }
    
        session()->flash('success', 'Todos los datos se han almacenado correctamente');
        return redirect()->route('characters.local');
    }

    public function indexLocal()
    {
        $characters = Character::paginate(10);
        if ($characters->isEmpty()) {
            return redirect()->route('characters.api')->with('error', 'No hay personajes almacenados. Por favor, obtén datos de la API primero.');
        }
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