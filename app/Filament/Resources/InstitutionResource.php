<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstitutionResource\Pages;
use App\Models\Institution;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;

class InstitutionResource extends Resource
{
    protected static ?string $model = Institution::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Institutions';
    protected static ?string $navigationGroup = 'Annuaire';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('type'),
                TextInput::make('address'),
                TextInput::make('phone'),
                TextInput::make('email'),
                TextInput::make('website'),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(4),
                Textarea::make('schedules')
                    ->label('Horaires')
                    ->rows(3)
                    ->extraAttributes(['class' => 'no-resize-none']),
                FileUpload::make('logo')
                    ->directory('institutions')
                    ->image()
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('type')->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('email'),
                ImageColumn::make('logo')
                    ->disk('public'),
               TextColumn::make('description')
                    ->label('Description')
                    ->limit(100),

            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'Ministère' => 'Ministère',
                        'Direction' => 'Direction',
                        'Administration publique' => 'Administration publique',
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstitutions::route('/'),
            'create' => Pages\CreateInstitution::route('/create'),
            'edit' => Pages\EditInstitution::route('/{record}/edit'),
        ];
    }
}
