<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Reservas",
 *     description="Endpoints para gestionar reservas"
 * )
 */
class ReservationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/reservas",
     *     summary="Obtener todas las reservas",
     *     tags={"Reservas"},
     *     @OA\Response(response=200, description="Lista de reservas")
     * )
     */
    public function index()
    {
        return Reservation::all();
    }

    /**
     * @OA\Post(
     *     path="/api/reservas",
     *     summary="Crear una nueva reserva",
     *     tags={"Reservas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","number_of_people","reservation_date","reservation_time"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="number_of_people", type="integer"),
     *             @OA\Property(property="reservation_date", type="string", format="date"),
     *             @OA\Property(property="reservation_time", type="string", format="time"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Reserva creada exitosamente")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'number_of_people' => 'required|integer|min:1',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i:s',
            'message' => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);

        return response()->json([
            'message' => 'Reserva guardada exitosamente.',
            'data' => $reservation
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/reservas/{id}",
     *     summary="Actualizar una reserva",
     *     tags={"Reservas"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="number_of_people", type="integer"),
     *             @OA\Property(property="reservation_date", type="string", format="date"),
     *             @OA\Property(property="reservation_time", type="string", format="time"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Reserva actualizada correctamente")
     * )
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return response()->json([
            'message' => 'Reserva actualizada correctamente',
            'data' => $reservation
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/reservas/{id}",
     *     summary="Eliminar una reserva",
     *     tags={"Reservas"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Reserva eliminada correctamente")
     * )
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Reserva eliminada correctamente.']);
    }
}
