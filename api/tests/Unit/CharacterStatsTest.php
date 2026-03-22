<?php

namespace Tests\Unit;

use App\Models\Character;
use Tests\TestCase;

class CharacterStatsTest extends TestCase
{
    /**
     * Тест расчета модификатора
     */
    public function test_modifier_calculation(): void
    {
        $this->assertEquals(-1, Character::getModifier(8));
        $this->assertEquals(-1, Character::getModifier(9));
        $this->assertEquals(0, Character::getModifier(10));
        $this->assertEquals(0, Character::getModifier(11));
        $this->assertEquals(1, Character::getModifier(12));
        $this->assertEquals(4, Character::getModifier(18));
        $this->assertEquals(5, Character::getModifier(20));
    }

    /**
     * Тест акцессоров модификаторов в модели
     */
    public function test_character_modifier_accessors(): void
    {
        $character = new Character([
            'strength' => 18,
            'dexterity' => 14,
            'constitution' => 12,
            'intelligence' => 10,
            'wisdom' => 8,
            'charisma' => 6,
        ]);

        $this->assertEquals(4, $character->strength_modifier);
        $this->assertEquals(2, $character->dexterity_modifier);
        $this->assertEquals(1, $character->constitution_modifier);
        $this->assertEquals(0, $character->intelligence_modifier);
        $this->assertEquals(-1, $character->wisdom_modifier);
        $this->assertEquals(-2, $character->charisma_modifier);
    }
}
