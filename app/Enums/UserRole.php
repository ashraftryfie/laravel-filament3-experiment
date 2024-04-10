<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case Editor = 'editor';
    case USER = 'user';
}
