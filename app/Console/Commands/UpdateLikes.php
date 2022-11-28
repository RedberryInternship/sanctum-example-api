<?php

namespace App\Console\Commands;

use App\Models\Character;
use Illuminate\Console\Command;

class UpdateLikes extends Command
{
    protected $signature = 'god-of-war:update-likes';

    protected $description = 'Randomly update likes for characters';

    public function handle()
    {
        $character = Character::inRandomOrder()->first();
        $character->likes++;
        $character->save();

        $this->info("{$character->name} has {$character->likes} likes");
    }
}
