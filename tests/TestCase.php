<?php

namespace Tests;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setup(): void
    {
        parent::setUp();
        $this->list = $this->createTodoList();
    }

    public function createTodoList($args = [])
    {
        return TodoList::factory()->create($args);
    }
}
