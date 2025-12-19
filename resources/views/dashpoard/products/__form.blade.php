@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group mb-3">
    <x-form.input label="Product Name" class="form-control-lg" role="input" name="name" type="text"
        :value="$product->name" />
</div>
<div class="form-group mb-3">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group mb-3">
    <label for="description">Description</label>
    <x-form.textarea name="description" id="description" rows="3" :value="$product->description" />
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <x-form.input label="Price" name="price" type="number" step="0.01" :value="$product->price" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <x-form.input label="Compare Price" name="compare_price" type="number" step="0.01"
                :value="$product->compare_price" />
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <x-form.input label="Tags" name="tags" type="text" :value="$product->tags->pluck('name')->implode(',')" />
</div>

<div class="form-group mb-3">
    <x-form.label for="image">Image{{-- $slot --}}</x-form.label>
    <x-form.input type="file" name="image" id="image" accept="image/*" />
    @if($product->image)
        <img src="{{asset('storage/' . $product->image)}}" alt="" width="50" height="50">
    @endif
</div>
<div class="form-group mb-3">
    <label for="status">Status</label>
    <x-form.radio name="status" :potions="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']"
        :checked="$product->status" />
</div>
<div class="form-group">
   
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Create' }}</button>
    

    <a href="{{ route('dashpoard.products.index') }}" class="btn btn-secondary ms-2-pinary">Cancel</a>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var input = document.querySelector('input[name=tags]');
        new Tagify(input)
    </script>
@endpush
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush