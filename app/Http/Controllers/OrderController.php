<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Órdenes",
 *     description="Operaciones relacionadas con órdenes de pedido"
 * )
 */
class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/orders",
     *     summary="Obtener todas las órdenes",
     *     tags={"Órdenes"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de órdenes"
     *     )
     * )
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Crear una nueva orden",
     *     tags={"Órdenes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id","total","status"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="total", type="number"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Orden creada exitosamente"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $order = Order::create($validated);

        return response()->json([
            'message' => 'Orden creada exitosamente.',
            'data' => $order
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}",
     *     summary="Actualizar una orden",
     *     tags={"Órdenes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="total", type="number"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Orden actualizada"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $order->update($validated);

        return response()->json([
            'message' => 'Orden actualizada correctamente.',
            'data' => $order
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/orders/{id}",
     *     summary="Eliminar una orden",
     *     tags={"Órdenes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Orden eliminada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'Orden eliminada correctamente.'
        ]);
    }
}
