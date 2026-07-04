<?php

namespace App\Filament\Resources\ShortLinkResource\Pages;

use App\Filament\Resources\ShortLinkResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewShortLink extends ViewRecord
{
    protected static string $resource = ShortLinkResource::class;

    public function getTitle(): string
    {
        return 'Статистика ссылки';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('resetStats')
                ->label('Сбросить статистику')
                ->color('danger')
                ->icon('heroicon-o-arrow-path')
                ->requiresConfirmation()
                ->modalHeading('Сбросить статистику ссылки')
                ->modalDescription('Все переходы по этой ссылке будут удалены. Сама ссылка останется доступной.')
                ->modalSubmitActionLabel('Сбросить')
                ->action(function (): void {
                    $this->record->clicks()->delete();

                    Notification::make()
                        ->title('Статистика сброшена')
                        ->success()
                        ->send();

                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),
            Actions\EditAction::make()
                ->label('Изменить'),
            Actions\DeleteAction::make()
                ->label('Удалить')
                ->modalHeading('Удалить ссылку'),
        ];
    }
}
