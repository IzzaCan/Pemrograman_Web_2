<x-layouts.app :title="__('Add Product')">
    <div class="mb-6">
        <flux:heading size="xl">Add Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Tambah Detail Produk</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="space-y-4">
            <!-- Product Name -->
            <flux:input name="name" label="Product Name" value="{{ old('name') }}" required />

            <!-- Product Category -->
            <flux:select label="Category" name="product_category_id">
                <option value="">- Select Category -</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </flux:select>

            <!-- Product Description -->
            <flux:input name="description" label="Deskripsi" type="textarea" value="{{ old('description') }}" />

            <!-- Product Image -->
            <flux:input name="image" label="Gambar" type="file" accept="image/*" />

            <!-- Price, SKU, Stock, and Active -->
            <flux:input name="price" label="Price (Rp)" type="number" value="{{ old('price') }}" required />
            <flux:input name="sku" label="SKU" value="{{ old('sku') }}" required />
            <flux:input name="stock" label="Stock" type="number" value="{{ old('stock') }}" required />
            <flux:checkbox name="is_active" label="Active" :checked="old('is_active', true)" />
        </div>

        <div class="mt-6 flex space-x-3">
            <flux:button type="submit" color="primary">
                Save
            </flux:button>

            <flux:button href="{{ route('products.index') }}" color="secondary" variant="ghost">
                Cancel
            </flux:button>
        </div>
    </form>
</x-layouts.app>