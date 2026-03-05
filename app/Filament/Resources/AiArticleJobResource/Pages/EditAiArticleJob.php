<?php

namespace App\Filament\Resources\AiArticleJobResource\Pages;

use App\Filament\Resources\AiArticleJobResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAiArticleJob extends EditRecord
{
    protected static string $resource = AiArticleJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
