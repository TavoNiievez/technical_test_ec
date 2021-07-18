<?php

namespace App\Tests\Integration\Shared\Domain;

interface FixtureLoader
{
    public function loadFixtures();
    public function purge();
}