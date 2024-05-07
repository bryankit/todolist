<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Requests\UpdatePublishRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService
    ){}

    /**
     * Display a listing of tasks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) : View
    {
        $data = $this->taskService->index($request);
        return view('todos.index', $data);
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create() : View
    {
        return view('todos.create');
    }

    /**
     * Store a newly created task in database.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request) : RedirectResponse
    {
        $this->taskService->store($request);
        return to_route('task');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request) : View
    {
        $data = $this->taskService->edit($request);
        return view('todos.edit', $data);
    }

    /**
     * Update the specified task in database.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskRequest $request, $id) : RedirectResponse
    {
        $this->taskService->update($request, $id);
        return to_route('task');
    }

    /**
     * Update the status of the specified task in database.
     *
     * @param  \App\Http\Requests\UpdateStatusRequest  $statusRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(UpdateStatusRequest $statusRequest) : RedirectResponse
    {
        $this->taskService->updateStatus($statusRequest);
        return to_route('task');
    }

    /**
     * Update the publish status of the specified task in database.
     *
     * @param  \App\Http\Requests\UpdatePublishRequest  $publishRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePublish(UpdatePublishRequest $publishRequest) : RedirectResponse
    {
        $this->taskService->updatePublish($publishRequest);
        return to_route('task');
    }

   /**
     * Update the delete status of the specified task in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDeleteStatus(Request $request) : RedirectResponse
    {
        $this->taskService->updateDeleteStatus($request);
        return to_route('task');
    }
}
