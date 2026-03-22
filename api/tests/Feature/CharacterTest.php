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

        $data = [
            'name' => 'Test Character',
            'race' => 'Human',
            'class' => 'Warrior',
            'user_id' => $user->id,
            'strength' => 18,
            'dexterity' => 14,
            'constitution' => 16,
            'intelligence' => 10,
            'wisdom' => 12,
            'charisma' => 8,
        ];

        $response = $this->actingAs($user)->post('/api/characters', $data);

        $response->assertStatus(201);
        $response->assertJsonPath('data.user_id', $user->id); // Проверяем, что ID владельца совпадает
        $response->assertJsonPath('data.strength', 18);
        $response->assertJsonPath('data.dexterity', 14);
    }

    public function test_create_character_uses_authenticated_user_id(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $data = [
            'name' => 'Should be mine',
            'user_id' => $otherUser->id, // Пробуем подставить чужой ID
        ];

        $response = $this->actingAs($user)->post('/api/characters', $data);

        $response->assertStatus(201);
        $response->assertJsonPath('data.user_id', $user->id); // Должен подставиться ID текущего юзера
    }

    public function test_cannot_access_other_user_character(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $character = Character::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->get('/api/characters/' . $character->id);

        $response->assertStatus(403);
    }

    public function test_cannot_update_other_user_character(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $character = Character::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->put('/api/characters/' . $character->id, [
            'name' => 'Hacked Name'
        ]);

        $response->assertStatus(403);
    }

    public function test_cannot_delete_other_user_character(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $character = Character::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->delete('/api/characters/' . $character->id);

        $response->assertStatus(403);
    }

    public function test_cannot_get_other_user_characters_list(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user1)->get('/api/users/' . $user2->id . '/characters');

        $response->assertStatus(403);
    }

    public function test_get_characters_for_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/users/' . $user->id . '/characters');

        $response->assertStatus(200);
    }
}
