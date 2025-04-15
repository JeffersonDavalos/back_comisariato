<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Routing\Controller; 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    /**
     *
     * @param Request 
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $resultado = $this->usuarioService->obtenerContraseñaPorUsuarioYCedula($request);
            if (isset($resultado['error'])) {
                return response()->json(['error' => $resultado['error']], 500);
            }
            return response()->json($resultado, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener usuarios: ' . $e->getMessage());
            return response()->json([
                'message' => 'Ha ocurrido un error inesperado: ' . $e->getMessage()
            ], 500);
        }
    }

    public function registrarUsuario(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $resultado = $this->usuarioService->registrarUsuario($data);
            return $resultado;
        } catch (Exception $e) {
            Log::error('Error en el controlador al registrar usuario: ' . $e->getMessage());
            return response()->json([
                'message' => 'Ha ocurrido un error inesperado: ' . $e->getMessage()
            ], 500);
        }
    }

    public function actualizarUsuario(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $resultado = $this->usuarioService->actualizarUsuario($data);
            return $resultado;
        } catch (Exception $e) {
            Log::error('Error en el controlador al registrar usuario: ' . $e->getMessage());
            return response()->json([
                'message' => 'Ha ocurrido un error inesperado: ' . $e->getMessage()
            ], 500);
        }
    }
}
