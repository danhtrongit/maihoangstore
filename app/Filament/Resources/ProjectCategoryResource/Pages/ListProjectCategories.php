<?php
namespace App\Filament\Resources\ProjectCategoryResource\Pages;
use App\Filament\Resources\ProjectCategoryResource;
use Filament\Resources\Pages\ListRecords;
class ListProjectCategories extends ListRecords { protected static string $resource = ProjectCategoryResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
