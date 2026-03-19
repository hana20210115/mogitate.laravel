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
<body class="bg-gray-50 min-h-screen">

    <header class="bg-white shadow-sm py-4 px-8 mb-8">
        <h1 class="logo-text text-3xl">mogitate</h1>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">
                @if(request('search'))
                    “{{ request('search') }}”の商品一覧
                @else
                    商品一覧
                @endif
            </h2>
            
            <a href="{{ route('create') }}" class="bg-yellow-500 text-white px-6 py-2 rounded font-bold hover:bg-yellow-600 transition shadow-md">
    + 商品を追加
</a>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            <aside class="w-full md:w-64 flex-shrink-0">
                <form action="{{ route('index') }}" method="GET">
                    <div class="mb-8">
                        <h3 class="font-bold mb-3 text-gray-700 border-b-2 border-yellow-500 inline-block">商品名で検索</h3>
                        <div class="flex flex-col gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="商品名を入力" class="w-full border-gray-300 rounded-md shadow-sm p-2 border bg-white focus:ring-yellow-500">
                            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md font-bold hover:bg-yellow-600">検索</button>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold mb-3 text-gray-700 border-b-2 border-yellow-500 inline-block">価格順で表示</h3>
                        <select name="sort" onchange="this.form.submit()" class="w-full border-gray-300 rounded-md shadow-sm p-2 border bg-white focus:ring-yellow-500">
                            <option value="">価格で並べ替え</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順</option>
                        </select>
                        @if(request('sort'))
                            <div class="mt-4"> 
                                <span class="inline-flex items-center px-4 py-1 rounded-full border border-yellow-400 text-gray-600 bg-white shadow-sm text-sm">
                                    {{ request('sort') == 'desc' ? '高い順に表示' : '低い順に表示' }}
                                    <a href="{{ route('index', ['search' => request('search')]) }}" class="ml-2 text-yellow-500 font-bold hover:text-yellow-700">
                                        ⓧ
                                    </a>
                                </span>
                            </div>
                        @endif
                    </div>
                </form>
            </aside>

            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition flex flex-col">
                            <a href="{{ route('show', ['id' => $product->id]) }}" class="h-48 overflow-hidden bg-gray-200 block">
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </a>
                            <div class="p-4 flex flex-col flex-1">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-lg text-gray-700 font-medium">
                                        <a href="{{ route('show', ['id' => $product->id]) }}" class="hover:text-yellow-600">{{ $product->name }}</a>
                                    </h3>
                                    <p class="text-lg font-bold text-gray-900">¥{{ number_format($product->price) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{$products->links()}}
                </div>
            </div> </div> </main>

    <footer class="h-20"></footer>
</body>
</html>