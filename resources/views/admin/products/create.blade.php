@extends('layouts.admin')

@section('content')
<h1>Добавить товар</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="margin-bottom: 15px;">
        <input type="text" name="name" placeholder="Название" value="{{ old('name') }}" required style="width: 100%; padding: 8px;">
        @error('name') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <select name="category_id" id="category_id" required style="width: 100%; padding: 8px;">
            <option value="">Выберите категорию</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <select name="subcategory_id" id="subcategory_id" style="width: 100%; padding: 8px;">
            <option value="">Выберите подкатегорию (опционально)</option>
        </select>
        @error('subcategory_id') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <textarea name="description" placeholder="Описание" style="width: 100%; padding: 8px;">{{ old('description') }}</textarea>
        @error('description') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <input type="number" name="price" placeholder="Цена" value="{{ old('price') }}" required style="width: 100%; padding: 8px;">
        @error('price') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <input type="number" name="stock" placeholder="Количество" value="{{ old('stock') }}" required style="width: 100%; padding: 8px;">
        @error('stock') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <input type="file" name="image" accept="image/*">
        @error('image') <span style="color: red;">{{ $message }}</span> @enderror
    </div>

    <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none;">Добавить</button>
</form>

<script>
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategorySelect = document.getElementById('subcategory_id');
        console.log('Выбрана категория:', categoryId);

        if (categoryId) {
            console.log('Отправка запроса на:', `/admin/get-subcategories/${categoryId}`);
            fetch(`/admin/get-subcategories/${categoryId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    console.log('Ответ сервера:', response);
                    if (!response.ok) {
                        throw new Error(`Ошибка HTTP: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Полученные данные:', data);
                    subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию (опционально)</option>';
                    if (data.length > 0) {
                        data.forEach(sub => {
                            subcategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                        });
                    } else {
                        subcategorySelect.innerHTML += '<option value="">Подкатегорий нет</option>';
                    }
                })
                .catch(error => {
                    console.error('Ошибка при загрузке подкатегорий:', error);
                    subcategorySelect.innerHTML = '<option value="">Ошибка загрузки подкатегорий</option>';
                });
        } else {
            subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию (опционально)</option>';
        }
    });
</script>
@endsection