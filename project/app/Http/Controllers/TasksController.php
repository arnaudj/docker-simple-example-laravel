<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Http\Resources\Task as TaskResource;

/**
 * 
+-----------+------------------+---------------+----------------------------------------------+--------------+
| Method    | URI              | Name          | Action                                       | Middleware   |
+-----------+------------------+---------------+----------------------------------------------+--------------+
| GET|HEAD  | /                |               | Closure                                      | web          |
| GET|HEAD  | api/tasks        | tasks.index   | App\Http\Controllers\TasksController@index   | api          |
| POST      | api/tasks        | tasks.store   | App\Http\Controllers\TasksController@store   | api          |
| GET|HEAD  | api/tasks/{task} | tasks.show    | App\Http\Controllers\TasksController@show    | api          |
| PUT|PATCH | api/tasks/{task} | tasks.update  | App\Http\Controllers\TasksController@update  | api          |
| DELETE    | api/tasks/{task} | tasks.destroy | App\Http\Controllers\TasksController@destroy | api          |
 */
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET tasks/
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(Task::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     * POST tasks/
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new TaskResource(Task::create($request->all()));
    }

    /**
     * Display the specified resource.
     * GET tasks/id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * PUT /tasks/id + json body
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /tasks/id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return 204;
    }
}
