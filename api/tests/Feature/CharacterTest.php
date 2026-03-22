<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Character;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class CharacterTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_create_character(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/characters', [
            'name' => 'Test Character',
            'race' => 'Human',
            'class' => 'Warrior',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_get_characters_for_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/users/' . $user->id . '/characters');

        $response->assertStatus(200);
    }
}
