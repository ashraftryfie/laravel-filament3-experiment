<?php

namespace App;

enum PostStatus: string
{
    case PENDING = 'pending';
    case PUBLISHED = 'published';
    case BLOCKED = 'blocked';
}
