@extends('layouts.admin')

@section('content')
<h1>Редактировать товар</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <input type="text" name="name" value="{{ old('name', $product->name) }}" required style="width: 100%; padding: 8px;">
        @error('name') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <select name="category_id" id="category_id" required style="width: 100%; padding: 8px;">
            <option value="">Выберите категорию</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <select name="subcategory_id" id="subcategory_id" style="width: 100%; padding: 8px;">
            <option value="">Выберите подкатегорию (опционально)</option>
            @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                    {{ $subcategory->name }}
                </option>
            @endforeach
        </select>
        @error('subcategory_id') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <textarea name="description" style="width: 100%; padding: 8px;">{{ old('description', $product->description) }}</textarea>
        @error('description') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <input type="number" name="price" value="{{ old('price', $product->price) }}" required style="width: 100%; padding: 8px;">
        @error('price') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required style="width: 100%; padding: 8px;">
        @error('stock') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <input type="file" name="image" accept="image/*">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="Текущее изображение" style="margin-top: 10px;">
        @endif
        @error('image') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none;">Сохранить</button>
</form>

<script>
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategorySelect = document.getElementById('subcategory_id');

        if (categoryId) {
            fetch(`/admin/subcategories/${categoryId}`)
                .then(response => response.json())
                .then(subcategories => {
                    subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию (опционально)</option>';
                    subcategories.forEach(sub => {
                        subcategorySelect.innerHTML += `<option value="${sub.id}" ${sub.id == '{{ $product->subcategory_id }}' ? 'selected' : ''}>${sub.name}</option>`;
                    });
                });
        } else {
            subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию (опционально)</option>';
        }
    });

    // Инициализация подкатегорий при загрузке страницы
    document.getElementById('category_id').dispatchEvent(new Event('change'));
</script>
@endsection