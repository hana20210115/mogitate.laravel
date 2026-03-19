<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <main class="max-w-5xl mx-auto p-8 bg-white shadow-md rounded-lg mt-8">
        <nav class="text-blue-500 mb-6">
            <a href="{{ route('index') }}">商品一覧</a> &gt; {{ $product->name }}
        </nav>

        <form action="{{ route('update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col md:flex-row gap-12">
                <div class="flex-1">
                    <img src="{{ asset('storage/products/' . $product->image) }}" class="w-full rounded-lg shadow-sm mb-4">
                    <div class="mt-4 p-2 bg-gray-100 rounded text-sm text-gray-500">
                        <label class="block mb-1 font-bold">画像を変更する</label>
                        <input type="file" name="image" class="w-full">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1 space-y-6">
                    <div>
                        <label class="block text-gray-600 mb-1">商品名</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2 rounded">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">値段</label>
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" class="w-full border p-2 rounded">
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-2">季節</label>
                        <div class="flex gap-4">
                            @foreach($seasons as $s)
    <label class="inline-flex items-center">
        <input type="checkbox" name="seasons[]" value="{{ $s->id }}" 
            {{ $product->seasons->contains('id', $s->id) ? 'checked' : '' }}>
        <span class="ml-2">{{ $s->name }}</span>
    </label>
@endforeach
                        </div>
                        @error('seasons')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <label class="block text-gray-600 mb-1">商品説明</label>
                <textarea name="description" class="w-full border p-4 rounded h-32">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex items-center justify-between">
                <div class="flex gap-4">
                    <a href="{{ route('index') }}" class="bg-gray-200 px-8 py-2 rounded font-bold text-gray-700">戻る</a>
                    <button type="submit" class="bg-yellow-500 text-white px-8 py-2 rounded font-bold hover:bg-yellow-600 transition">
                        変更を保存
                    </button>
                </div>
                
                </div>
        </form> <div class="flex justify-end -mt-10"> 
            <form action="{{ route('destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                @csrf
                @method('DELETE') 
                
                <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        </div>
    </main>
</body>
</html>