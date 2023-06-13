<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Task;
use App\Http\Resources\Task as TaskResource;
   
class TaskController extends BaseController
{
    public function index()
    {
        $tasks = Task::all();

        if ($tasks->isEmpty()) {
            return $this->sendError('Opsss, theres no task available to fetch.');
        }

        return $this->sendResponse(TaskResource::collection($tasks), 'All task fetched.');
    }
   
    public function show($id)
    {
        $task = Task::find($id);

        if (is_null($task)) {
            return $this->sendError('Task does not exist.');
        }

        return $this->sendResponse(new TaskResource($task), 'Task fetched.');
    }

    public function getByUser($id)
    {
        $task = Task::assigneduser($id)->get();

        if ($task->isEmpty()) {
            return $this->sendError('User does not have any tasks assigned.');
        }

        return $this->sendResponse(new TaskResource($task), 'Task fetched.');
    }
}