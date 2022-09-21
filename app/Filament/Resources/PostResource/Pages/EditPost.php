<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getActions() : array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data) : Model
    {
        $status = $data['status'];

        unset($data['status']);

        /** @var Post */
        $record = parent::handleRecordUpdate($record, $data)->fresh();

        if ($record->status !== $status) {
            $record->setStatus($status);
        }

        return $record;
    }
}
