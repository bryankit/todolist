<?php

namespace App\Services;

use App\Models\Task;
use App\Library\Utility;

class TaskService
{


    /**
     * Display a listing of tasks based on filters and search criteria.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index($request)
    {
        $userId = auth()->user()->id;

        $perPage = $request->input('perPage', 10);
        $status = $request->input('status', '');
        $orderBy = $request->input('orderBy', 'title');
        $search = $request->input('search', '');

        $tasks = Task::where('user_id', $userId)->where('delete', false);

        if ($status) {
            $tasks->where('status', $status);
        }

        if ($search) {
            $tasks->where('title', 'like', '%' . $search . '%');
        }

        if ($orderBy === 'created_at') {
            $tasks->orderBy('created_at', 'desc');
        } else {
            $tasks->orderBy($orderBy);
        }

        $tasks->orderBy($orderBy);
        $tasks = $tasks->paginate($perPage);

        return [
            'tasks'   => $tasks,
            'perPage' => $perPage,
            'status'  => $status,
            'orderBy' => $orderBy,
            'search' => $search
        ];
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created task in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Request
     */
    public function store($request)
    {
        $filePath = Utility::setFilePath($request);
         Task::firstOrCreate(
            [
                'title' => $request->title
            ],
            [
                'user_id'   => auth()->user()->id,
                'content'   => $request->content,
                'status'    => $request->status,
                'file_path' => $filePath,
            ]
        );
        return $request->session()->flash('alert-success', 'Task Created');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function edit($request)
    {
        $userId = auth()->user()->id;
        $tasks = Task::where('user_id', $userId)->where('id', $request->id)->where('delete', false)->first();
        return [
            'tasks' => $tasks
        ];
    }

    /**
     * Update the specified task in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Request
     */
    public function update($request, $id)
    {
        $filePath = Utility::setFilePath($request);
        Task::where('id', $id)->update([
            'title'     => $request->title,
            'content'   => $request->content,
            'status'    => $request->status,
            'file_path' => $filePath,
        ]);
        return $request->session()->flash('alert-success', 'Task Updated');
    }

    /**
     * Update the status of the specified task in database.
     *
     * @param  \Illuminate\Http\Request  $statusRequest
     * @return \Illuminate\Http\Request
     */
    public function updateStatus($statusRequest)
    {
        Task::where('id', $statusRequest->id)
        ->where('user_id', auth()->user()->id)
        ->update([
            'status' => $statusRequest->status,
        ]);
        return $statusRequest->session()->flash('alert-success', 'Task Status Updated');
    }

    /**
     * Update the publish status of the specified task in database.
     *
     * @param  \Illuminate\Http\Request  $publishRequest
     * @return \Illuminate\Http\Request
     */
    public function updatePublish($publishRequest)
    {
        Task::where('id', $publishRequest->id)
        ->where('user_id', auth()->user()->id)
        ->update([
            'publish' => $publishRequest->publish,
        ]);
        return $publishRequest->session()->flash('alert-success', 'Publish Status Updated');
    }

    /**
     * Update the delete status of the specified task in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Request
     */
    public function updateDeleteStatus($request)
    {
        Task::where('id', $request->id)
        ->where('user_id', auth()->user()->id)
        ->update([
            'delete' => true,
        ]);
        return $request->session()->flash('alert-success', 'Task Deleted');
    }
}