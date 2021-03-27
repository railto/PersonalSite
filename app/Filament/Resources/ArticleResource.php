<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components\DateTimePicker;
use Filament\Resources\Forms\Components\MarkdownEditor;
use Filament\Resources\Forms\Components\TextInput;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns\Text;
use Filament\Resources\Tables\Table;

class ArticleResource extends Resource
{
    public static $icon = 'heroicon-o-rss';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                TextInput::make('title')->autofocus()->required(),
                DateTimePicker::make('published_at'),
                MarkdownEditor::make('content')->required(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Text::make('title')->sortable()->searchable(),
                Text::make('published_at')->dateTime()->sortable()->default('Unpublished'),
            ])
            ->filters([
                //
            ])->defaultSort('id', 'desc');
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListArticles::routeTo('/', 'index'),
            Pages\CreateArticle::routeTo('/create', 'create'),
            Pages\EditArticle::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
