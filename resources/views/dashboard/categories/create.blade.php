<x-layouts.app :title="__('Tambah Kategori')">
    <div class="mb-6">
        <flux:heading size="xl">Tambah Kategori</flux:heading>
        <flux:subheading size="lg" class="mb-6">Isi data kategori</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="space-y-4">
            <flux:input name="name" label="Nama Kategori" value="{{ old('name') }}" required />
            <flux:input name="slug" label="Slug (Opsional)" value="{{ old('slug') }}" />
            <flux:input name="description" label="Deskripsi" value="{{ old('description') }}" />
            <flux:input name="image" label="Gambar (URL)" value="{{ old('image') }}" />
        </div>

    <div class="mt-6 flex space-x-3">
        <flux:button type="submit" color="primary">
            Simpan
        </flux:button>

        <flux:button href="{{ route('categories.index') }}" color="secondary" variant="ghost">
            Batal
        </flux:button>
    </div>

    </form>
</x-layouts.app>
