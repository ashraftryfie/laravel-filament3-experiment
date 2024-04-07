<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum PostStatus: string implements HasLabel
{
    case PENDING = 'pending';
    case PUBLISHED = 'published';
    case BLOCKED = 'blocked';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
