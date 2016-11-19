<?php

/*
 * This file is part of Echowine Laravel ORM.
 *
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Alias Field
    |--------------------------------------------------------------------------
    |
    | Here you may write all alias for fields
    | These will be called in schema method of Model
    | You can also change default aliases
    */

    'fields' => [
        'string' => \EchoWine\Laravel\ORM\Field\String\Field::class,
    ]

];
