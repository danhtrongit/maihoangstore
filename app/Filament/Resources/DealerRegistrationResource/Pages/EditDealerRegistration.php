<?php
namespace App\Filament\Resources\DealerRegistrationResource\Pages;
use App\Filament\Resources\DealerRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditDealerRegistration extends EditRecord { protected static string $resource = DealerRegistrationResource::class; protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; } }
