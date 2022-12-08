<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    public function index(): mixed
    {
        $todo = TodoList::all();

        return response($todo);
    }

    public function show(TodoList $list)
    {
        return response($list);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $list = TodoList::create($request->all());

        return response($list, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $list)
    {
        $list->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(Request $request, TodoList $list)
    {
        $list->update($request->all());

        return $list;
    }
}
