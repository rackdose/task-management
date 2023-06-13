<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="lg:px-8 mx-auto py-8 py-6 bg-white">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Edit Task') }}
                    </h2>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    @if(Session::has('success'))
                        <div class="mt-4 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p>{{Session::get('success')}}</p>
                        </div>
                    @endif

                    <form class="flex flex-col space-y-4" method="POST" action="{{ route('update', $task->id) }}">
                        @csrf

                        <!-- Title -->
                        <x-input type="text" name="title" value="{{ $task->title }}" placeholder="Task Title" class="py-3 px-4 bg-gray-100 rounded-lg" required autofocus />
                        
                        <!-- Description -->
                        <textarea name="description" placeholder="Description" class="py-3 px-4 bg-gray-100 rounded-lg" required>{{ $task->description }}</textarea>

                        <div class="flex space-x-4">

                            <!-- Assignee -->
                            <select name="assigned_user" class="w-1/2 py-3 px-4 bg-gray-100 rounded-lg" required>
                                <option value="">Assignee</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if($task->assigned_user == $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>

                            <!-- Due Date -->
                            <div class="relative w-1/3">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker datepicker-format="dd-mm-yyyy" type="text" value="{{ $task->dateString() }}" class="bg-gray-50 py-3 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white0" placeholder="Due Date" name="due_date" required>
                            </div>

                            <!-- Status -->
                            <select name="status" class="w-1/3 py-3 px-4 bg-gray-100 rounded-lg">
                                <option value="">Status</option>
                                <option value="1" @if($task->status == 1) selected @endif>Completed</option>
                                <option value="2"  @if($task->status == 2) selected @endif>Not Completed</option>
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="flex space-x-4">
                            <button class="w-28 py-4 px-8 text-white bg-green-500 rounded-lg">Update</button>
                            <a href="{{ route('tasks') }}" class="w-28 py-4 px-8 text-white bg-blue-500 rounded-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>