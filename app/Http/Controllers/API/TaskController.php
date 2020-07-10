<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('priority')->get();

        $code = 200;
        $response['success'] = true;
        $response['data'] = $tasks;
        $response['message'] = 'Tarefas recuperadas com sucesso';

        return response()->json($response, $code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required|max:255',
            'priority' => 'required',
        ]);

        if($validator->fails()) {
            
            $code = 404;
            $response['success'] = false;
            $response['data'] = $validator->errors();
            $response['message'] = 'Error ao cadastrar tarefa';

            return response()->json($response, $code);
        }

        $task = Task::create($data);

        $code = 201;
        $response['success'] = true;
        $response['data'] = $task;
        $response['message'] = 'Tarefa cadastrada com sucesso';

        return response()->json($response, $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required|max:255',
            'priority' => 'required',
        ]);

        if($validator->fails()) {
            
            $code = 404;
            $response['success'] = false;
            $response['data'] = $validator->errors();
            $response['message'] = 'Error ao atualizar tarefa';

            return response()->json($response, $code);
        }

        $task->update($data);

        $code = 204;
        $response = null;

        return response()->json($response, $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        
        $code = 204;
        $response = null;

        return response()->json($response, $code);
    }
}
