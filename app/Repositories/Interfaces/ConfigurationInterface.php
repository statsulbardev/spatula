<?php

namespace App\Repositories\Interfaces;

/**
 * Interface used by different component, same crud process.
 * Concept Usage contextual-binding https://laravel.com/docs/9.x/container#contextual-binding
 * @package App\Repositories\Interfaces
 */
interface ConfigurationInterface
{
    public function save($data);

    public function update($data);
}
