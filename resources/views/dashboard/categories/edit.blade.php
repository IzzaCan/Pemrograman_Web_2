<x-layouts.app :title="__('Edit Kategori')">
    <div class="mb-6">
        <flux:heading size="xl">Edit Kategori</flux:heading>
        <flux:subheading size="lg" class="mb-6">Perbarui informasi kategori</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <flux:input name="name" label="Nama Kategori" value="{{ old('name', $category->name) }}" required />
            <flux:input name="slug" label="Slug (Opsional)" value="{{ old('slug', $category->slug) }}" />
            <flux:input name="description" label="Deskripsi" value="{{ old('description', $category->description) }}" />
            <flux:input name="image" label="Gambar (URL)" value="{{ old('image', $category->image) }}" />
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
