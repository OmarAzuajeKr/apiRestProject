<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function getCategoria()
    {
        return response()->json(Categoria::all(), 200);
    }

    public function getCategoriaById($id)
    {
        $categoria = Categoria::find($id);
        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoria Not Found'], 404);
        }
        return response()->json($categoria, 200);
    }

    public function insertCategoria(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'cat_nom' => 'required|string|max:255',
            'cat_obs' => 'nullable|string|max:255',
        ]);

        // Crear una nueva categoría
        $categoria = Categoria::create($validatedData);

        // Devolver la respuesta con el código de estado 201
        return response($categoria, 201);
    }
    public function updateCategoria(Request $request, $id){
      $categoria = Categoria::find($id);
      if (is_null($categoria)) {
          return response()->json(['message' => 'Categoria Not Found'], 404);
      }
      $categoria->update($request->all());
      return response($categoria, 200);
    }
}
