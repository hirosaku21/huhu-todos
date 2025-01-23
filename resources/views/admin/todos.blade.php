<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">共有TODO完了数</h1>
            </div>
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                @if (count($completedTodos) === 0)
                    <p>完了したTODOがありません</p>
                @else
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    ID</th>
                                <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    担当</th>
                                <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    完了数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($completedTodos as $todos)
                                <tr>
                                    <td class="px-4 py-3">{{ $todos[0]['completed_by']['id'] }}</td>
                                    <td class="px-4 py-3">{{ $todos[0]['completed_by']['name'] }}</td>
                                    <td class="px-4 py-3">{{ count($todos) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </section>

</x-app-layout>
