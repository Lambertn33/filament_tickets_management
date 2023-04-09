<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Filament\Resources\TicketResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\TicketResource\RelationManagers\LabelsRelationManager;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->unique(ignoreRecord: true),
                Textarea::make('description'),
                Select::make('priority')
                    ->required()
                    ->placeholder('Select priority')
                    ->options(self::$model::PRIORITY),
                Textarea::make('Comment'),
                Checkbox::make('is_resolved')
                    ->required(),
                Select::make('assigned_to')
                    ->options(User::whereHas('roles', function( Builder $query ) {
                        $query->where('name', Role::AGENTROLE);
                    })
                        ->get()
                        ->pluck('name', 'id')
                        ->toArray()
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->description(fn (Ticket $record): string => $record->description ? $record->description : '')
                    ->searchable(),
                BadgeColumn::make('priority')
                    ->colors([
                        'warning' => static fn ($state): bool => $state === self::$model::MEDIUMPRIORITY,
                        'success' => static fn ($state): bool => $state === self::$model::HIGHPRIORITY,
                        'danger' => static fn ($state): bool => $state === self::$model::LOWPRIORITY,
                    ]),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => static fn ($state): bool => $state === self::$model::ARCHIVEDSTATUS,
                        'success' => static fn ($state): bool => $state === self::$model::OPENSTATUS,
                        'danger' => static fn ($state): bool => $state === self::$model::CLOSEDSTATUS,
                    ]),
                TextColumn::make('assignedBy.name'),
                TextColumn::make('assignedTo.name'),
                TextInputColumn::make('comment')
                    ->disabled(!auth()->user()->hasPermission('ticket_edit')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class,
            LabelsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
