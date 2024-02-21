<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class IndexView extends RowAction
{
    public $name = 'view Index';
    public function href()
    {
        return $this->getResource() . "/" . $this->getKey() . "/view";
    }
}
