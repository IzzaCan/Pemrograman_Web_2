<x-layouts.app :title="__('Edit Produk')">
    <div class="mb-6">
        <flux:heading size="xl">Edit Produk</flux:heading>
        <flux:subheading size="lg" class="mb-6">Perbarui detail produk</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <flux:input name="name" label="Nama Produk" value="{{ old('name', $product->name) }}" required />
            <flux:input name="slug" label="Slug (Opsional)" value="{{ old('slug', $product->slug) }}" />
            <flux:select label="Kategori" name="product_category_id" required>
                <option value="">- Pilih Kategori -</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($product->product_category_id == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </flux:select>
            <flux:input name="description" label="Deskripsi" type="textarea" value="{{ old('description', $product->description) }}" />
            
            @if($product->image_url)
                <div class="mb-4">
                    <h3 class="text-sm font-medium mb-2">Gambar Saat Ini</h3>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Gambar Produk" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            <flux:input name="image" label="Gambar Baru" type="file" accept="image/*" />
            <flux:input name="price" label="Harga (Rp)" type="number" value="{{ old('price', $product->price) }}" required />
            <flux:input name="sku" label="SKU" value="{{ old('sku', $product->sku) }}" required />
            <flux:input name="stock" label="Stok" type="number" value="{{ old('stock', $product->stock) }}" required />
            <flux:select label="Active Status" name="is_active" class="mb-3">
                <option value="1" {{ $product->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Non Active</option>
            </flux:select>
        </div>

        <div class="mt-6 flex space-x-3">
            <flux:button type="submit" color="primary">Simpan Perubahan</flux:button>
            <flux:button href="{{ route('products.index') }}" color="secondary" variant="ghost">Batal</flux:button>
        </div>
    </form>
</x-layouts.app>
