<x-app-layout>
    <div class="flex flex-col gap-y-5 w-1/5 mx-auto pt-12">
        <button onclick="location.href='{{ route('admin.categories.index') }}'"
            class="text-center items-center bg-indigo-400 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-200 rounded text-base mt-4 md:mt-0">カテゴリー一覧へ</button>
        <button onclick="location.href='{{ route('admin.todos') }}'"
            class="text-center items-center bg-indigo-400 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-200 rounded text-base mt-4 md:mt-0">TODO完了数一覧へ</button>
        <button onclick="location.href='{{ route('todos.index') }}'"
            class="text-center items-center bg-indigo-400 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-200 rounded text-base mt-4 md:mt-0">TODO一覧へ戻る</button>
    </div>
</x-app-layout>
