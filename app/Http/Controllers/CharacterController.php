<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    public function index()
    {
        return Character::all('id', 'name', 'image', 'likes')->map(function ($character) {
            return [
                'id' => $character->id,
                'name' => $character->name,
                'image' => Storage::url($character->image),
                'likes' => $character->likes,
            ];
        });
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'image' => 'required|image',
        ]);

        Character::create([
            'name' => $data['name'],
            'image' => request()->file('image')->store('characters'),
        ]);

        return response('', 201);
    }
}
