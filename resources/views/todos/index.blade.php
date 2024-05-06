<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @if (Session::has('alert-success'))
                    <div id="alert-3"
                        class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:text-green-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-sm font-medium ms-3">
                            {{ Session::get('alert-success') }}
                        </div>
                        <button type="button" onclick="closeAlert()"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif


                <div class="p-6">

                    <button type="button" onclick="window.location='{{ route('task.create') }}'"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create
                        Task </button>
                    <div class="flex flex-wrap gap-4">
                        <form method="GET" action="{{ route('task') }}" class="flex items-center mb-4">
                            <label for="perPage" class="mr-2">Display</label>
                            <select name="perPage" id="perPage" onchange="this.form.submit()"
                                class="w-20 px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                            </select>
                            <label for="status" class="ml-4 mr-2">Filter by Status:</label>
                            <select name="status" id="status" onchange="this.form.submit()"
                                class="w-32 py-1 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">All</option>
                                <option value="to_do" {{ $status == 'to_do' ? 'selected' : '' }}>To Do</option>
                                <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>In Progress
                                </option>
                                <option value="done" {{ $status == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                            <label for="orderBy" class="ml-4 mr-2">Order by:</label>
                            <select name="orderBy" id="orderBy" onchange="this.form.submit()"
                                class="w-32 px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="title" {{ $orderBy == 'title' ? 'selected' : '' }}>Title</option>
                                <option value="created_at" {{ $orderBy == 'created_at' ? 'selected' : '' }}>Date
                                    Created</option>
                            </select>
                        </form>

                        <form method="GET" action="{{ route('task') }}" class="flex items-center mb-4">
                            <label for="search" class="mr-2">Search by Title:</label>
                            <input type="text" name="search" id="search" value="{{ $search }}"
                                class="px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <button type="submit"
                                class="px-4 py-1 ml-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">Search</button>
                        </form>
                    </div>

                    @if (count($tasks) > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Content
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Image
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Publish
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Action
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Date Created
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $task->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $task->content }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($task->file_path)
                                                <img src="{{ url($task->file_path) }}" alt="Task Image"
                                                    class="w-10 h-10 rounded-full">
                                            @else
                                                <img src="https://via.placeholder.com/150" alt="Placeholder Image"
                                                    class="w-10 h-10 rounded-full">
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form id="statusForm" method="POST"
                                                action="{{ route('task.updateStatus', $task->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="relative">
                                                    <select name="status" onchange="this.form.submit()"
                                                        class="block w-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-gray-100 border border-gray-300 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option value="to_do"
                                                            {{ $task->status == 'to_do' ? 'selected' : '' }}>To Do
                                                        </option>
                                                        <option value="in_progress"
                                                            {{ $task->status == 'in_progress' ? 'selected' : '' }}>In
                                                            Progress</option>
                                                        <option value="done"
                                                            {{ $task->status == 'done' ? 'selected' : '' }}>Done
                                                        </option>
                                                    </select>
                                                    <div
                                                        class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                                        <svg class="w-4 h-4 fill-current"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M9 5l3 3m0 0l3-3m-3 3v10"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form id="publishForm" method="POST"
                                                action="{{ route('task.updatePublish', $task->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="relative">
                                                    <select name="publish" onchange="this.form.submit()"
                                                        class="block w-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-gray-100 border border-gray-300 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option value="save_as_draft"
                                                            {{ $task->publish == 'save_as_draft' ? 'selected' : '' }}>
                                                            Save
                                                            as Draft
                                                        </option>
                                                        <option value="published"
                                                            {{ $task->publish == 'published' ? 'selected' : '' }}>
                                                            Published
                                                        </option>
                                                    </select>
                                                    <div
                                                        class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                                        <svg class="w-4 h-4 fill-current"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M9 5l3 3m0 0l3-3m-3 3v10"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('task.edit', $task->id) }}"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                        clip-rule="evenodd" />
                                                    <path fill-rule="evenodd"
                                                        d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('task.updateDeleteStatus', $task->id) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $task->created_at }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Task</h3>
                    @endif
                    {{ $tasks->appends([
                            'perPage' => $perPage,
                            'status' => $status,
                            'orderBy' => $orderBy
                        ])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function closeAlert() {
        var alertElement = document.getElementById("alert-3");
        if (alertElement) {
            alertElement.style.display = "none";
        }
    }
</script>
