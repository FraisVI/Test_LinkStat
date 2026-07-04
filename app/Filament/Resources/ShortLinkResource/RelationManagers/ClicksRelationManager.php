<?php

namespace App\Filament\Resources\ShortLinkResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClicksRelationManager extends RelationManager
{
    protected static string $relationship = 'clicks';

    protected static ?string $title = 'Переходы';

    public function form(Form $form): Form
    {
        return $form;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ip_address')
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP-адрес'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата и время')
                    ->dateTime('d.m.Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('ip_address')
                    ->label('IP-адрес')
                    ->form([
                        TextInput::make('ip_address')
                            ->label('IP-адрес'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['ip_address'] ?? null,
                            fn (Builder $query, string $ipAddress): Builder => $query->where('ip_address', 'like', "%{$ipAddress}%"),
                        );
                    }),
                Tables\Filters\Filter::make('created_at')
                    ->label('Дата перехода')
                    ->form([
                        DatePicker::make('created_at')
                            ->label('Дата перехода'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['created_at'] ?? null,
                            fn (Builder $query, string $date): Builder => $query->whereDate('created_at', $date),
                        );
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading(fn (): string => $this->hasActiveClickFilters() ? 'По заданным фильтрам ничего не найдено' : 'Переходов пока нет')
            ->emptyStateDescription(fn (): string => $this->hasActiveClickFilters() ? 'Измените параметры фильтрации или сбросьте фильтры.' : 'После первого перехода по короткой ссылке здесь появится запись.')
            ->emptyStateIcon('heroicon-o-chart-bar');
    }

    private function hasActiveClickFilters(): bool
    {
        return filled($this->tableFilters['ip_address']['ip_address'] ?? null)
            || filled($this->tableFilters['created_at']['created_at'] ?? null);
    }
}
