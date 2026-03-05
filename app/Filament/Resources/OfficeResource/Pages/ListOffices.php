<?php
namespace App\Filament\Resources\OfficeResource\Pages;
use App\Filament\Resources\OfficeResource;
use Filament\Resources\Pages\ListRecords;
class ListOffices extends ListRecords { protected static string $resource = OfficeResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
