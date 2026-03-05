<?php
namespace App\Filament\Resources\DealerRegistrationResource\Pages;
use App\Filament\Resources\DealerRegistrationResource;
use Filament\Resources\Pages\ListRecords;
class ListDealerRegistrations extends ListRecords { protected static string $resource = DealerRegistrationResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
