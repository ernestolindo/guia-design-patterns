<?php

// Paso 1: Definir la interfaz del producto
interface Character
{
    public function getInfo(): string;
}

// Paso 2: Implementar productos concretos
class Skeleton implements Character
{
    private const ATTACK_SPEED = "slow";
    private const DAMAGE = "medium";

    public function getInfo(): string
    {
        return "Skeleton: Deals " . self::DAMAGE . " damage with a " . self::ATTACK_SPEED . " attack speed.";
    }
}

class Zombie implements Character
{
    private const ATTACK_SPEED = "high";
    private const DAMAGE = "high";

    public function getInfo(): string
    {
        return "Zombie: Deals " . self::DAMAGE . " damage with a " . self::ATTACK_SPEED . " attack speed.";
    }
}

// Paso 3: Definir la fábrica abstracta
abstract class CharacterFactory
{
    abstract public function create(): Character;

    public function getCharacterInfo(): string
    {
        return "Character info: " . $this->create()->getInfo() . PHP_EOL;
    }
}

// Paso 4: Implementar fábricas concretas
class SkeletonFactory extends CharacterFactory
{
    public function create(): Character
    {
        return new Skeleton();
    }
}

class ZombieFactory extends CharacterFactory
{
    public function create(): Character
    {
        return new Zombie();
    }
}

// Paso 5: Código del cliente
class GameDifficulty
{
    public const EASY = "easy";
    public const HARD = "hard";
}

function clientCode(string $gameDifficulty)
{
    switch ($gameDifficulty) {
        case GameDifficulty::EASY:
            $factory = new SkeletonFactory();
            break;
        case GameDifficulty::HARD:
            $factory = new ZombieFactory();
            break;
        default:
            throw new InvalidArgumentException("Invalid game difficulty: $gameDifficulty");
    }

    echo "Testing with difficulty: $gameDifficulty" . PHP_EOL;
    echo $factory->getCharacterInfo();
}

// Testing
clientCode(GameDifficulty::EASY);
clientCode(GameDifficulty::HARD);
