<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class ManageDocument extends RowAction
{
    public $name = 'Manage Document ';

    public function handle(Model $model)
    {
        // $model ...

      
    }
    public function href()
    {
        return $this->getResource() ."/" . $this->getKey() ."/documents";
    } 

}