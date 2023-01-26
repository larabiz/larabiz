<x-app>
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item link="{{ route('posts.index') }}">Blog</x-breadcrumb-item>
        <x-breadcrumb-item link="{{ route('posts.show', $post) }}" class="truncate">{{ $post->title }}</x-breadcrumb-item>
        <x-breadcrumb-item style="overflow: unset; text-overflow: unset">Modifier l'article</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section>
        <x-slot:title>
            Modifier l'article
        </x-slot:title>

        @if ($post->preview)
            <img src="{{ $post->preview_url }}" />
        @endif

        <x-form method="PUT" action="{{ route('posts.update', $post) }}" class="grid gap-4 mt-4">
            <div>
                <x-label for="title">Titre</x-label>
                <x-input id="title" name="title" value="{{ old('title') ?? $post->title }}" required />
            </div>

            <div>
                <x-label for="slug">Slug</x-label>
                <x-input id="slug" name="slug" value="{{ old('slug') ?? $post->slug }}" required />
            </div>

            <div>
                <x-label for="excerpt">Extrait</x-label>
                <x-textarea id="excerpt" name="excerpt" value="{{ old('excerpt') ?? $post->excerpt }}" required>{{ old('excerpt') ?? $post->excerpt }}</x-textarea>
            </div>

            <div>
                <x-label for="content">Contenu</x-label>

                <div class="bg-white/75 mt-1 rounded shadow shadow-indigo-100 transition-colors" :class="{ 'bg-white': focused }">
                    <x-markdown
                        name="content"
                        id="content"
                        required
                    >{{ old('content') ?? $post->content }}</x-markdown>
                </div>
            </div>

            <div>
                <x-label for="status">Statut</x-label>

                <select name="status" id="status" class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full">
                    <option value="draft" @selected('published' === $post->status)>Published</option>
                    <option value="draft" @selected('draft' === $post->status)>Brouillon</option>
                </select>
            </div>

            <x-action-btn type="submit" class="mt-4 shadow-md">
                Modifier
            </x-action-btn>
        </x-form>
    </x-section>
</x-app>
