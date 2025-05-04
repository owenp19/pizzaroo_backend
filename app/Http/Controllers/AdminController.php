<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Admins",
 *     description="Endpoints para gestionar administradores"
 * )
 */
class AdminController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/admins",
     *     summary="Obtener todos los administradores",
     *     tags={"Admins"},
     *     @OA\Response(response=200, description="Lista de administradores")
     * )
     */
    public function index()
    {
        return Admin::all();
    }

    /**
     * @OA\Post(
     *     path="/api/admins",
     *     summary="Crear un nuevo administrador",
     *     tags={"Admins"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Administrador creado")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::create($validated);

        return response()->json([
            'message' => 'Administrador creado exitosamente.',
            'data' => $admin
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/admins/{id}",
     *     summary="Actualizar un administrador",
     *     tags={"Admins"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Administrador actualizado")
     * )
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update($request->only(['name', 'email', 'password']));

        return response()->json([
            'message' => 'Administrador actualizado.',
            'data' => $admin
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/admins/{id}",
     *     summary="Eliminar un administrador",
     *     tags={"Admins"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Administrador eliminado")
     * )
     */
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();

        return response()->json(['message' => 'Administrador eliminado.']);
    }
}
