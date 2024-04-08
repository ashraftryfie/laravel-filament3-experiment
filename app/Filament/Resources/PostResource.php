<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use App\PostStatus;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

    protected static ?string $modelLabel = 'Post CRUD';

    public static function form(Form $form): Form
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

                        Select::make('category_id')
                            ->required()
                            ->label('Category')
                            //->options(Category::all()->pluck('name', 'id'))
                            ->relationship(
                                'category',
                                'name'
                            )
                            ->searchable(),

                        MarkdownEditor::make('content')
                            ->columnSpanFull()
                            ->required(),
                    ])->columnSpan(2)->columns(2),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('thumbnail'),
                ColorColumn::make('color')->toggleable(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('content')->toggleable()->wrap(15)->searchable(),
                TextColumn::make('tags')->toggleable(),
                TextColumn::make('status')->toggleable()->sortable(),
                TextColumn::make('category.name')->toggleable()->sortable()->searchable(),
                TextColumn::make('slug')->toggleable()->sortable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->date('Y M D')
                    ->toggleable()
                    ->label('Published on'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
