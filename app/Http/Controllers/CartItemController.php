<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Cart Items",
 *     description="Operaciones sobre los ítems del carrito"
 * )
 */
class CartItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cart-items",
     *     summary="Obtener todos los ítems del carrito",
     *     tags={"Cart Items"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de ítems"
     *     )
     * )
     */
    public function index()
    {
        return CartItem::all();
    }

    /**
     * @OA\Post(
     *     path="/api/cart-items",
     *     summary="Agregar ítem al carrito",
     *     tags={"Cart Items"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id","pizza_id","quantity"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="pizza_id", type="integer"),
     *             @OA\Property(property="quantity", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ítem agregado"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'pizza_id' => 'required|integer|exists:pizzas,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::create($validated);

        return response()->json([
            'message' => 'Item agregado al carrito correctamente.',
            'data' => $item
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/cart-items/{id}",
     *     summary="Actualizar ítem del carrito",
     *     tags={"Cart Items"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id","pizza_id","quantity"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="pizza_id", type="integer"),
     *             @OA\Property(property="quantity", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ítem actualizado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'pizza_id' => 'required|integer|exists:pizzas,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item->update($validated);

        return response()->json([
            'message' => 'Item actualizado correctamente.',
            'data' => $item
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/cart-items/{id}",
     *     summary="Eliminar ítem del carrito",
     *     tags={"Cart Items"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ítem eliminado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return response()->json([
            'message' => 'Item eliminado del carrito.'
        ]);
    }
}
