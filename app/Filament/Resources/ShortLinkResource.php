<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShortLinkResource\Pages;
use App\Filament\Resources\ShortLinkResource\RelationManagers;
use App\Models\ShortLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortLinkResource extends Resource
{
    protected static ?string $model = ShortLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $modelLabel = 'ссылка';

    protected static ?string $pluralModelLabel = 'Ссылки';

    protected static ?string $navigationLabel = 'Ссылки';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('original_url')
                    ->label('Оригинальный URL')
                    ->url()
                    ->required()
                    ->maxLength(2048),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('original_url')
                    ->label('Оригинальный URL')
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\TextColumn::make('short_url')
                    ->label('Короткая ссылка')
                    ->copyable()
                    ->openUrlInNewTab()
                    ->url(fn (ShortLink $record): string => $record->short_url),
                Tables\Columns\TextColumn::make('clicks_count')
                    ->label('Клики')
                    ->counts('clicks')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Ссылок пока нет')
            ->emptyStateDescription('Создайте первую короткую ссылку.')
            ->emptyStateIcon('heroicon-o-link')
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Статистика'),
                Tables\Actions\EditAction::make()
                    ->label('Изменить'),
                Tables\Actions\DeleteAction::make()
                    ->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Удалить выбранные'),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('original_url')
                    ->label('Оригинальный URL'),
                Infolists\Components\TextEntry::make('short_url')
                    ->label('Короткая ссылка')
                    ->copyable()
                    ->url(fn (ShortLink $record): string => $record->short_url)
                    ->openUrlInNewTab(),
                Infolists\Components\TextEntry::make('clicks_count')
                    ->label('Всего кликов')
                    ->state(fn (ShortLink $record): int => $record->clicks()->count()),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function canEdit(Model $record): bool
    {
        return $record->user_id === auth()->id();
    }

    public static function canDelete(Model $record): bool
    {
        return $record->user_id === auth()->id();
    }

    public static function generateCode(): string
    {
        do {
            $code = Str::random(6);
        } while (ShortLink::query()->where('code', $code)->exists());

        return $code;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ClicksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShortLinks::route('/'),
            'create' => Pages\CreateShortLink::route('/create'),
            'view' => Pages\ViewShortLink::route('/{record}'),
            'edit' => Pages\EditShortLink::route('/{record}/edit'),
        ];
    }
}
