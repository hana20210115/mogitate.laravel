<!DOCTYPE html>
<html lang="ja" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
        .logo-text { font-family: 'Pacifico', cursive; color: #EAB308; }
    </style>
</head>



<body class="bg-gray-50">
    <main class="max-w-3xl mx-auto p-8 bg-white shadow-md rounded-lg mt-8">
        <h2 class="text-2xl font-bold mb-8 text-gray-700">商品登録</h2>

        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-700 font-bold mb-1">商品名 <span class="bg-red-500 text-white text-xs px-1 rounded">必須</span></label>
                <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" class="w-full border p-2 rounded bg-gray-50">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-1">値段 <span class="bg-red-500 text-white text-xs px-1 rounded">必須</span></label>
                <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" class="w-full border p-2 rounded bg-gray-50">
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-1">商品画像 <span class="bg-red-500 text-white text-xs px-1 rounded">必須</span></label>
                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">季節 <span class="bg-red-500 text-white text-xs px-1 rounded">必須</span> <span class="text-red-400 text-xs ml-2">複数選択可</span></label>
                <div class="flex gap-6">
                    @foreach($seasons as $s)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="seasons[]" value="{{ $s->id }}" class="rounded text-yellow-500" {{ is_array(old('seasons')) && in_array($s->id, old('seasons')) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $s->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('seasons') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-1">商品説明 <span class="bg-red-500 text-white text-xs px-1 rounded">必須</span></label>
                <textarea name="description" placeholder="商品の説明を入力" class="w-full border p-4 rounded h-32 bg-gray-50">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('index') }}" class="bg-gray-300 px-12 py-2 rounded font-bold text-gray-700 hover:bg-gray-400 transition">戻る</a>
                <button type="submit" class="bg-yellow-500 text-white px-12 py-2 rounded font-bold hover:bg-yellow-600 transition shadow-md">登録</button>
            </div>
        </form>
    </main>
</body>