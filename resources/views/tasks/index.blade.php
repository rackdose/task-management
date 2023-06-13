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
                        {{ __('Create Task') }}
                    </h2>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                        @if (session()->has('success'))
                        <div class="mt-4 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" id="msg" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p>{{ session()->get('success') }}</p>
                        </div>
                        @endif
                    </div>

                    <form class="flex flex-col space-y-4" method="POST" action="{{ route('store') }}">
                        @csrf

                        <!-- Title -->
                        <x-input type="text" name="title" :value="old('title')" placeholder="Task Title" class="py-3 px-4 bg-gray-100 rounded-lg" required autofocus />
                        
                        <!-- Description -->
                        <textarea name="description" :value="old('description')" placeholder="Description" class="py-3 px-4 bg-gray-100 rounded-lg" required></textarea>

                        <div class="flex space-x-4">

                            <!-- Assignee -->
                            <select name="assigned_user" class="w-1/2 py-3 px-4 bg-gray-100 rounded-lg" required>
                                <option value="" selected>Assignee</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                            <!-- Due Date -->
                            <div class="relative w-1/2">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400 dtp" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><style>.dtp{fill:#616060}</style><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker datepicker-format="dd-mm-yyyy" type="text" :value="old('due_date')" class="bg-gray-50 py-3 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Due Date" name="due_date" required>
                            </div>
                        </div>
                        <button class="w-28 py-4 px-8 text-white bg-green-500 rounded-lg">Add</button>
                    </form>
                </div>
                
                <div class="lg:px-8 mx-auto py-8 py-6 bg-white">
                    @foreach ($tasks as $task)
                        <div class="py-4 flex item-center px-3 border-b border-gray-300 rounded-lg">

                            <!-- task list -->
                            <div class="flex-1 pr-2">
                                <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                                <h3 class="text-sm font-semibold">{{ $task->user->name }}</h3>
                                <label class="text-sm text-red-500">{{ $task->due_date }}</label>
                                <p class="text-gray-500">{{ $task->description }}</p>
                            </div>
                            <div class="flex space-x-3">

                                <!-- edit -->
                                <form method="GET" action="{{ route('edit', $task->id) }}">
                                    <button class="py-2 px-2 flex justify-center items-center w-12 h-12 bg-green-500 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                    </button>
                                </form>

                                <!-- delete -->
                                <form method="POST" action="{{ route('destroy', $task->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="py-2 px-2 flex justify-center items-center w-12 h-12 bg-red-500 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>