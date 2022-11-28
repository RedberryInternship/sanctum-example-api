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
}
