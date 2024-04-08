<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\PostStatus;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create a New Post')
                    ->description('create a new post using this form')
                    //->collapsed()
                    ->schema([
                        TextInput::make('title')
                            ->rules([
                                'min:3',
                                'max:25',
                            ])
                            ->required(),

                        TextInput::make('slug')
                            ->minLength(3)
                            ->maxLength(30)
                            ->unique(ignoreRecord: true)
                            ->required(),

                        Select::make('status')
                            ->options(PostStatus::class)
                            ->required(),


                        MarkdownEditor::make('content')
                            ->columnSpanFull()
                            ->required(),
                    ])->columnSpan(2)->columns(3),

                Group::make()->schema([
                    Section::make('Choose an Image')
                        ->collapsible()
                        ->schema([
                            FileUpload::make('thumbnail')
                                ->disk('public')
                                ->directory('thumbnails'),
                        ])->columnSpan(1),

                    ColorPicker::make('color')->required(),

                    TagsInput::make('tags')->required(),
                ]),

            ])->columns([
                'default' => 1,
                'md' => 2,
                'lg' => 3,
                'xlg' => 4,
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
