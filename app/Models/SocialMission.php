<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class SocialMission extends Model
{
    use HasFactory, Translatable;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $translatable = [
        'main_title',
        'title_first',
        'text_first',
        'title_second',
        'text_second',
        'title_third',
        'text_third',
        'title_fourth',
        'text_fourth',
        'title_fifth',
        'text_fifth',
    ];
}
