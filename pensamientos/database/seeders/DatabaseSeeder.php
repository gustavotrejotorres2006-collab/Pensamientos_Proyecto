<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        $admin = User::create([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@sistema.com',
            'password' => $password,
            'bio' => 'Administrador del sistema.',
            'is_active' => true,
        ]);

        $users = [
            ['Carlos Hernández', 'carlos', 'carlos@example.com', 'Me gusta escribir y compartir ideas.'],
            ['Ana Martínez', 'ana', 'ana@example.com', 'Pensamientos, experiencias y creatividad.'],
            ['Luis García', 'luis', 'luis@example.com', 'Tecnología, música y reflexiones.'],
            ['María López', 'maria', 'maria@example.com', 'Escribiendo un pensamiento a la vez.'],
            ['Sofía Ramírez', 'sofia', 'sofia@example.com', 'Me gusta compartir lo que aprendo.'],
            ['Diego Torres', 'diego', 'diego@example.com', 'Ideas y experiencias personales.'],
            ['Fernanda Cruz', 'fernanda', 'fernanda@example.com', 'Un espacio para escribir.'],
            ['Jorge Mendoza', 'jorge', 'jorge@example.com', 'Notas sobre mi día a día.'],
            ['Valeria Sánchez', 'valeria', 'valeria@example.com', 'Compartiendo pensamientos.'],
            ['Miguel Flores', 'miguel', 'miguel@example.com', 'Palabras, ideas y momentos.'],
        ];

        foreach ($users as [$name, $username, $email, $bio]) {
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'bio' => $bio,
                'is_active' => true,
            ]);

            Post::create([
                'user_id' => $user->id,
                'title' => 'Una reflexión personal',
                'content' => 'A veces detenerse un momento también es avanzar.',
            ]);

            Post::create([
                'user_id' => $user->id,
                'title' => 'Pensamiento del día',
                'content' => 'Cada experiencia puede enseñarnos algo nuevo.',
            ]);
        }

        Post::create([
            'user_id' => $admin->id,
            'title' => 'Bienvenido al sistema',
            'content' => 'Este es el espacio principal para compartir pensamientos, notas e ideas.',
        ]);
    }
}
