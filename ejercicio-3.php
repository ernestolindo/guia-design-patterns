<?php

// Component interface
interface Fighter
{
    public function listWeapons(): string;
}

// Concrete components

class Human implements Fighter
{
    public function listWeapons(): string
    {
        return "Fists";
    }
}

class Witch implements Fighter
{
    public function listWeapons(): string
    {
        return "Magic";
    }
}

// Decorator class

abstract class FighterDecorator implements Fighter
{
    protected Fighter $fighter;

    public function __construct(Fighter $fighter)
    {
        $this->fighter = $fighter;
    }

    public function listWeapons(): string
    {
        return $this->fighter->listWeapons();
    }
}

// Concrete decorators

class SwordDecorator extends FighterDecorator
{
    public function listWeapons(): string
    {
        return $this->fighter->listWeapons() . ", Sword";
    }
}

class BowDecorator extends FighterDecorator
{
    public function listWeapons(): string
    {
        return $this->fighter->listWeapons() . ", Bow";
    }
}

// Client code: Testing the decorator pattern

function describeFighter(Fighter $fighter, string $fighterName): void
{
    echo "Weapons of $fighterName: " . $fighter->listWeapons() . PHP_EOL;
}

// Example usage

$human = new Human();
$humanWithSword = new SwordDecorator($human);
$humanWithSwordAndBow = new BowDecorator($humanWithSword);
describeFighter($humanWithSwordAndBow, "Human 1");

$witch = new Witch();
$witchWithSword = new SwordDecorator($witch);
$witchWithSwordAndBow = new BowDecorator($witchWithSword);
describeFighter($witchWithSwordAndBow, "Witch 1");
