<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Spatie\Tags\Tag;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\SpatieTagsColumn;
use App\Filament\Resources\PostResource\Pages;
use Filament\Forms\Components\SpatieTagsInput;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->default(1)
                    ->relationship('user', 'username')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255),
                SpatieTagsInput::make('tags')
                    ->type('category')
                    ->label('Categories'),
                Forms\Components\Textarea::make('excerpt')
                    ->label('Excerpt')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\MarkdownEditor::make('content')
                    ->label('Content')
                    ->required()
                    ->maxLength(65535),
            ])
            ->columns(1);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Author'),
                SpatieTagsColumn::make('tags')
                    ->type('category')
                    ->label('Categories'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('views')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Updated At'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tags')
                    ->relationship('tags', 'name')
                    ->label('Category'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('updateCategories')
                    ->action(function (Collection $records, array $data) {
                        $records->each->attachTags($data['tags'], 'category');
                    })
                    ->form([
                        Forms\Components\TagsInput::make('tags')
                            ->suggestions(function () {
                                return Tag::getWithType('category')->pluck('name', 'id');
                            })
                            ->label('Categories'),
                    ])
                    ->label('Categories'),
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getRelations() : array
    {
        return [
            StatusResource\RelationManagers\StatusesRelationManager::class,
        ];
    }

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery() : Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes()->latest();
    }
}
