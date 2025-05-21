<x-layouts.app :title="__('Edit Kategori')">
    <div class="mb-6">
        <flux:heading size="xl">Edit Kategori</flux:heading>
        <flux:subheading size="lg" class="mb-6">Perbarui informasi kategori</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <flux:input name="name" label="Nama Kategori" value="{{ old('name', $category->name) }}" required />
            <!-- Preview Gambar Lama -->
            @if($category->image)
                <div class="mb-4">
                    <h3 class="text-sm font-medium mb-2">Gambar Saat Ini</h3>
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Gambar Produk" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            <flux:input name="slug" label="Slug (Opsional)" value="{{ old('slug', $category->slug) }}" />
            <flux:input name="image" label="Gambar Baru" type="file" accept="image/*" />
            <flux:input name="description" label="Deskripsi" value="{{ old('description', $category->description) }}" />
        </div>

    <div class="mt-6 flex space-x-3">
        <flux:button type="submit" color="primary">
            Update
        </flux:button>

        <flux:button href="{{ route('categories.index') }}" color="secondary" variant="ghost">
            Cancel
        </flux:button>
    </div>
    </form>
</x-layouts.app>
