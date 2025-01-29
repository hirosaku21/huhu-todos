<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap justify-between p-5 flex-col md:flex-row items-center">
        <button onclick="location.href='{{ route('todos.create') }}'"
            class="inline-flex items-center bg-indigo-400 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-200 rounded text-base mt-4 md:mt-0">新規登録
        </button>
        <div class="flex items-center">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit"
                    class="inline-flex items-center border-0 py-1 px-3 focus:outline-none rounded text-base mt-4 md:mt-0">ログアウト
                </button>
            </form>
            @if ($user->role === 'admin')
                <footer class="text-gray-600 body-font">
                    <div class="container mx-auto flex flex-wrap justify-between p-5 flex-col md:flex-row items-center">
                        <button onclick="location.href='{{ route('admin.index') }}'"
                            class="inline-flex items-center bg-indigo-400 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-200 rounded text-base mt-4 md:mt-0">管理画面へ
                        </button>
                    </div>
                </footer>
            @endif
        </div>
    </div>
</header>
