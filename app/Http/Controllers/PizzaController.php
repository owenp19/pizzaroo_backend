<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Pizzas",
 *     description="Gestión de pizzas"
 * )
 */
class PizzaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pizzas",
     *     summary="Listar todas las pizzas",
     *     tags={"Pizzas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pizzas"
     *     )
     * )
     */
    public function index()
    {
        return Pizza::all();
    }

    /**
     * @OA\Post(
     *     path="/api/pizzas",
     *     summary="Crear una nueva pizza",
     *     tags={"Pizzas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "price", "image_url"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number", format="float"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pizza creada exitosamente"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'required|string',
        ]);

        $pizza = Pizza::create($validated);

        return response()->json([
            'message' => 'Pizza creada correctamente',
            'data' => $pizza
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/pizzas/{id}",
     *     summary="Actualizar una pizza existente",
     *     tags={"Pizzas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number", format="float"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pizza actualizada correctamente"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $pizza = Pizza::findOrFail($id);

        $pizza->update($request->only([
            'name', 'description', 'price', 'image_url'
        ]));

        return response()->json([
            'message' => 'Pizza actualizada correctamente',
            'data' => $pizza
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/pizzas/{id}",
     *     summary="Eliminar una pizza",
     *     tags={"Pizzas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pizza eliminada correctamente"
     *     )
     * )
     */
    public function destroy($id)
    {
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();

        return response()->json([
            'message' => 'Pizza eliminada correctamente'
        ]);
    }
}
