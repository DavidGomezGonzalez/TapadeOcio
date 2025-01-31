<form action="{{ $action }}" method="post">
    @csrf
    @if ($method ?? false)
        @method($method)
    @endif
    <div class="mb-5">
        <label for="name" class="block font-bold mb-2">Name</label>
        <input type="text" name="name" id="name" class="border p-2 w-full"
            value="{{ old('name', $subcategory->name ?? '') }}">
        @if ($errors->has('name'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
        @endif
        <label for="category_id" class="block font-bold mb-2">Category</label>
        <select class="form-control w-full" id="category_id" name="category_id">
            <option value="">{{ __('Choose a Value') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @if ((isset($subcategory->category_id) && $subcategory->category_id == old('category_id', $subcategory->category_id )) || (isset($category_id) && $category_id == $category->id))
                        selected
                    @endif
                >{{ $category->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('category_id') }}</p>
        @endif
        <label for="description" class="block font-bold mb-2">{{ __('Description') }}</label>
        <textarea type="text" name="description" id="description" class="border p-2 w-full h-48 ">{{ old('description', $subcategory->description ?? '') }}</textarea>
        @if ($errors->has('description'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
        @endif
    </div>
    <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">{{ $buttonText }}</button>
</form>
