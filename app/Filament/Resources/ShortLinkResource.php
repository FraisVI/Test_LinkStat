<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShortLinkResource\Pages;
use App\Models\ShortLink;
use Filament\Forms;
use Filament\Forms\Form;
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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShortLinks::route('/'),
            'create' => Pages\CreateShortLink::route('/create'),
            'edit' => Pages\EditShortLink::route('/{record}/edit'),
        ];
    }
}
