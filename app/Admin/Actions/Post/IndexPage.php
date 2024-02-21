<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class IndexPage extends RowAction
{
    public $name = 'Edit';

    // public function handle(Model $model)
    // {
    //     // $model ...

    //     return $this->response()->success('Success message.')->refresh();
    // }
    public function href()
    {
        return $this->getResource() . "/" . $this->getKey() . "/edits";
    }
}
