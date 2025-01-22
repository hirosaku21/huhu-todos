<x-app-layout>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <form action="{{ route('todos.store') }}" method="post">
                    @csrf
                    <div class="relative mb-8">
                        <input type="text" id="content" name="content"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            placeholder="タスクを入力" value="{{ old('content') }}">
                        @error('content')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex gap-x-3 mb-3">
                        <div class="w-1/2">
                            <div class="relative">
                                <select name="category_id" id="category_id"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option disabled {{ old('category_id') ? '' : 'selected' }}>カテゴリーを選択</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-1/2">
                            <div class="relative">
                                <select name="sharing_range" id="sharing_range"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option disabled {{ old('sharing_range') ? '' : 'selected' }}>共有か個人か</option>
                                    <option value="share" {{ old('sharing_range') === 'share' ? 'selected' : '' }}>共有</option>
                                    <option value="personal" {{ old('sharing_range') === 'personal' ? 'selected' : '' }}>個人</option>
                                </select>
                                @error('sharing_range')
                                    <div class="text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
