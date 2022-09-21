<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function handleRecordCreation(array $data) : Post
    {
        $data['user_id'] = auth()->id();

        $status = $data['status'];

        unset($data['status']);

        /** @var Post */
        $post = parent::handleRecordCreation($data);

        $post->setStatus($status);

        return $post;
    }
}
