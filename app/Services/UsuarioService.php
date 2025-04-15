<?php

namespace App\Services;

use App\Models\estadoTarea;
use App\Models\materias;
use App\Models\tareas;
use App\Models\usuario;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\DB; 

class UsuarioService
{
    /**
     *
     * @param string $usuario
     * @param string $cedula
     * @return array
     */
    public function obtenerContraseñaPorUsuarioYCedula($request)
    {
        try {
            $usuarioData = usuario::where('usuario', $request->usuario)
            ->where('estado', 'A')
            ->first();
            if ($usuarioData) {
                return  $usuarioData;
            } else {
                return ['error' => 'Usuario no encontrado'];
            }

        } catch (QueryException $e) {
            return ['error' => 'Error al consultar los usuarios: ' . $e->getMessage()];
        }
    }
    public function registrarUsuario($data): JsonResponse
    {
        try {
            $usuario = usuario::where('usuario', $data['usuario'])->first();

            if ($usuario) {
                return response()->json(['error' => 'El usuario ya está registrado.'], 409);
            }
            $nuevoUsuario = usuario::create([
                'usuario' => $data['usuario'], 
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'cedula' => $data['cedula'],
                'contraseña' => $data['contraseña'],  
                'correo' => $data['correo'],
                'estado' => 'A',
                'fecha_creacion' => now(),
            ]);
            return response()->json(['message' => 'Usuario registrado con éxito'], 200);
        } catch (Exception $e) {
            Log::error('Error al registrar usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Ha ocurrido un error inesperado: ' . $e->getMessage()], 500);
        }
    }
    public function actualizarUsuario($data): JsonResponse
    {
        try {
            $usuario = usuario::where('id_usuario', $data['id_usuario'])->first();
            if (!$usuario) {
                return response()->json(['error' => 'Usuario no encontrado.'], 404);
            }
    
            $datosAActualizar = [];
            if (!empty($data['usuario'])) {
                $datosAActualizar['usuario'] = $data['usuario'];
            }
    
            if (!empty($data['nombre'])) {
                $datosAActualizar['nombre'] = $data['nombre'];
            }
    
            if (!empty($data['apellido'])) {
                $datosAActualizar['apellido'] = $data['apellido'];
            }
    
            if (!empty($data['cedula'])) {
                $datosAActualizar['cedula'] = $data['cedula'];
            }
    
            if (!empty($data['contraseña'])) {
                $datosAActualizar['contraseña'] =$data['contraseña'];
            }
    
            if (!empty($data['correo'])) {
                $datosAActualizar['correo'] = $data['correo'];
            }
    
            if (!empty($data['estado'])) {
                $datosAActualizar['estado'] = $data['estado'];
            }
            $datosAActualizar['fecha_actualizacion'] = now();
            if (!empty($datosAActualizar)) {
                usuario::where('id_usuario', $data['id_usuario'])->update($datosAActualizar);
                return response()->json(['message' => 'Usuario actualizado con éxito'], 200);
            } else {
                return response()->json(['message' => 'No hay datos para actualizar.'], 400);
            }
        } catch (Exception $e) {
            Log::error('Error al actualizar usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Ha ocurrido un error inesperado: ' . $e->getMessage()], 500);
        }
    }
}
