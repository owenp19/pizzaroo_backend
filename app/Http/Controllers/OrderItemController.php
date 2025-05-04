<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Order Items",
 *     description="Endpoints para gestionar ítems de pedidos"
 * )
 */
class OrderItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/order-items",
     *     summary="Obtener todos los ítems de pedidos",
     *     tags={"Order Items"},
     *     @OA\Response(response=200, description="Lista de ítems")
     * )
     */
    public function index()
    {
        return response()->json(OrderItem::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/order-items",
     *     summary="Crear nuevo ítem",
     *     tags={"Order Items"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"order_id", "pizza_id", "quantity", "price_unit"},
     *             @OA\Property(property="order_id", type="integer"),
     *             @OA\Property(property="pizza_id", type="integer"),
     *             @OA\Property(property="quantity", type="integer"),
     *             @OA\Property(property="price_unit", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Ítem creado exitosamente")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'pizza_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'price_unit' => 'required|numeric|min:0',
        ]);

        $item = OrderItem::create($validated);

        return response()->json(['message' => 'Ítem creado exitosamente.', 'data' => $item], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/order-items/{id}",
     *     summary="Actualizar ítem de pedido",
     *     tags={"Order Items"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="order_id", type="integer"),
     *             @OA\Property(property="pizza_id", type="integer"),
     *             @OA\Property(property="quantity", type="integer"),
     *             @OA\Property(property="price_unit", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Ítem actualizado exitosamente")
     * )
     */
    public function update(Request $request, $id)
    {
        $item = OrderItem::findOrFail($id);
        $item->update($request->all());

        return response()->json(['message' => 'Ítem actualizado exitosamente.', 'data' => $item], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/order-items/{id}",
     *     summary="Eliminar ítem de pedido",
     *     tags={"Order Items"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Ítem eliminado")
     * )
     */
    public function destroy($id)
    {
        $item = OrderItem::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Ítem eliminado.'], 200);
    }
}
