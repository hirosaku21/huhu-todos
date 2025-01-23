<x-app-layout>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <form action="{{ route('admin.categories.store') }}" method="post">
                    @csrf
                    <div class="relative mb-8">
                        <input type="text" id="name" name="name"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            placeholder="カテゴリー名を入力" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="p-2 w-full">
                        <button type="submit"
                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
