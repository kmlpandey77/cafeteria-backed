<?php

namespace App\Filament\System\Resources;

use App\Enums\AdminRole;
use App\Enums\RenewFor;
use App\Filament\System\Resources\OrganizationResource\Pages;
use App\Filament\System\Resources\OrganizationResource\RelationManagers\UsersRelationManager;
use App\Models\Admin;
use App\Models\Organization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('agent_id')
                        ->options(Admin::get()->pluck('name', 'id')->toArray())
                        ->required(),
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\Textarea::make('address'),
                    Forms\Components\TextInput::make('email')
                        ->email(),
                    Forms\Components\TextInput::make('phone')
                        ->tel(),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Organization::query()->when(auth()->user()->role != AdminRole::Admin, function ($query) {
                    $query->where('agent_id', auth()->id());
                });
            })
            ->columns([
                Tables\Columns\TextColumn::make('agent.name'),
                Tables\Columns\TextColumn::make('name')
                    ->description(fn($record) => $record->address)
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->description(fn($record) => $record->phone)
                    ->searchable(),
                Tables\Columns\TextColumn::make('license_key')
                    ->disabledClick(),
                Tables\Columns\TextColumn::make('expired_at')
                    ->label('Expire date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Register date')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
