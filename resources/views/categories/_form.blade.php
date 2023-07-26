<form action="{{ $action }}" method="post">
    @csrf
    @if ($method ?? false)
        @method($method)
    @endif
    <div class="mb-5">
        <label for="name" class="block font-bold mb-2">{{ __('Name') }}</label>
        <input type="text" name="name" id="name" class="border p-2 w-full"
            value="{{ old('name', $category->name ?? '') }}">
        @if ($errors->has('name'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
        @endif
        <label for="description" class="block font-bold mb-2"> {{ __('Description') }}</label>
        <textarea type="text" name="description" id="description" class="border p-2 w-full h-48 ">{{ old('description', $category->description ?? '') }}</textarea>
        @if ($errors->has('description'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
        @endif


        <!-- Is Main -->
        <div class="form-group">
            <label for="is_main">{{ __('Principal') }}:</label>
            <input type="checkbox" name="is_main" id="is_main" value="{{ old('is_main', $category->is_main) }}">
        </div>
        
        <!-- Order -->
        <div class="form-group">
            <label for="order">{{ __('Orden') }}:</label>
            <input type="number" name="order" id="order" value="{{ old('order', $category->order) }}">
        </div>
        

        <label for="icon_id" class="block font-bold mb-2">{{ __('Icon') }}</label>

        <div class="flex gap-4">
        <select name="icon_id" id="icon_id">
            <option value="">{{ __('Choose a Value') }}</option>
            @foreach ($icons as $icon)
                <option value="{{ $icon->id }}">{{ $icon->name }}</option>
            @endforeach
        </select>
        @if ($category->icon)
            <x-icon name="{{ pathinfo($category->icon->filename, PATHINFO_FILENAME) }}" class="w-8 h-8" />
        @endif
        </div>


        <script type="text/javascript">
            $('#icon_id').val({{ old('icon_id', $category->icon_id ?? '') }});
            $('#icon_id').select2();
        </script>

    </div>
    <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">{{ $buttonText }}</button>
</form>
