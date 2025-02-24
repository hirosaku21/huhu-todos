<x-app-layout>
    <x-header :user="$user" />
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-2/3 w-full mx-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <tbody>
                        @if (count($todos) === 0)
                            <p class="leading-relaxed mb-8">タスクを登録してください</p>
                        @else
                            <div class="flex mb-4 w-1/4">
                                <h2
                                    class="flex-grow text-center text-indigo-500 border-b-2 border-indigo-500 py-2 text-lg px-1">
                                    共有</h2>
                                <button onclick="location.href='{{ route('todos.personal') }}'"
                                    class="flex-grow text-center border-b-2 border-gray-300 py-2 text-lg px-1">個人</button>
                            </div>
                            @foreach ($todos as $todo)
                                <tr>
                                    <td class="w-10 text-center">
                                        <form action="{{ route('todos.complete', ['todoId' => $todo->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="checkbox" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="px-4 py-3 text-lg text-gray-900">
                                        <form action="{{ route('todos.update', ['todoId' => $todo->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="content" value="{{ $todo->content }}"
                                                onblur="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="px-4 py-3 text-lg text-gray-900">
                                        <form action="{{ route('todos.destroy', ['todoId' => $todo->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center bg-indigo-400 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-200 rounded text-base mt-4 md:mt-0">削除
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @vite(['resources/js/todo/index.js'])

</x-app-layout>

