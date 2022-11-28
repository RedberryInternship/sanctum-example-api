<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'giuna',
            'email' => 'giuna@redberry.ge',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'tornike',
            'email' => 'tornikek@redberry.ge',
            'password' => bcrypt('password'),
        ]);

        $images = collect(
            [
                [
                    'name' => 'Atreus',
                    'image' => 'atreus.webp',
                ],
                [
                    'name' => 'Baldur',
                    'image' => 'baldur.webp',
                ],
                [
                    'name' => 'Brok',
                    'image' => 'brok.jpg',
                ],
                [
                    'name' => 'Fenrir',
                    'image' => 'fenrir.jpg',
                ],
                [
                    'name' => 'Freya',
                    'image' => 'freya.webp',
                ],
                [
                    'name' => 'Jormungandr',
                    'image' => 'jormungandr.jpg', 
                ],
                [
                    'name' => 'Kratos',
                    'image' => 'kratos.jpg',
                ],
                [
                    'name' => 'Odin',
                    'image' => 'odin.webp',
                ],
                [
                    'name' => 'Sindri',
                    'image' => 'sindri.webp',
                ],
                [
                    'name' => 'Thor',
                    'image' => 'thor.webp',
                ],
                [
                    'name' => 'Tyr',
                    'image' => 'tyr.webp',
                ],
            ]
        )->map(function ($data) {
            $data['image'] = new File(storage_path('app/original-pictures/' . $data['image']));
            return $data;
        })->each(function($data) {
            Character::factory()->create([
                'name' => $data['name'],
                'image' => Storage::put('/characters', $data['image']),
                'likes' => 0,
            ]);
        });
    }
}
