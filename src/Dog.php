<?php

declare(strict_types=1);

namespace Osteel\ClosedByDefault;

final readonly class Dog
{
    private const string SOUND = 'Woof';

    public function __construct(public string $name, private(set) ?int $microchipId) {}

    private function bark(): void
    {
        echo self::SOUND;
    }

    public function fetch(Ball $item): Ball
    {
        $this->bark();
        return $item;
    }
}
