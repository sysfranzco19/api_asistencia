<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $modelName = 'App\Models\UsuarioModel';
    protected $format = 'json';

    public function login()
    {
        helper('jwt');

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $usuario = $this->model->where('email', $email)->first();

        if (!$usuario) {
            return $this->respond(['message' => 'Usuario no encontrado'], 404);
        }

        if (!password_verify($password, $usuario['password'])) {
            return $this->respond(['message' => 'Contraseña incorrecta'], 401);
        }

        $token = create_jwt([
            'id' => $usuario['id'],
            'email' => $usuario['email'],
            'nombre' => $usuario['nombre']
        ]);

        return $this->respond([
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'apellido' => $usuario['apellido'],
                'email' => $usuario['email'],
                'admin' => $usuario['admin']
            ]
        ], 200);
    }
}
