<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    public function  setUp(): void
    {
        parent::setUp();
    }

    public function test_fetch_all_todo_list()
    {
        $response = $this->getJson(route('todo-list.index'));
        $this->assertEquals(1, count($response->json()));
        $this->assertEquals($this->list->name, $response->json()[0]['name']);
    }

    public function test_fetch_single_todo_list()
    {
        $list = TodoList::factory()->create();

        $response = $this->getJson(route('todo-list.show', $list->id))
            ->assertOk()
            ->json();

        $this->assertEquals($response['name'], $list->name);
    }

    public function test_store_new_todo_list()
    {
        $list = TodoList::factory()->make();

        $response = $this->postJson(route('todo-list.store'), ['name' => $list->name])
            ->assertCreated();

        $this->assertEquals($list->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);
    }

    public function test_while_storing_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-list.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }

    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy', $this->list->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);
    }

    public function test_update_todo_list()
    {
        $this->patchJson(route('todo-list.update', $this->list->id), ['name' => 'updated name'])
            ->assertOk();

        $this->assertDatabaseHas(
            'todo_lists',
            [
                'id' => $this->list->id,
                'name' => 'updated name'
            ]
        );
    }
}
