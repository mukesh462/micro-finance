<?php

namespace App\Admin\Actions\Post;

use App\Models\IndexMember;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class IndexDelete extends RowAction
{
    public $name = 'Delete';

    public function dialog()
    {
        return  $this->confirm('Are you sure to delete this Index?');
    }

    public function handle(Model $model)
    {

        IndexMember::where('index_id', $model->id)->delete();

        $model->delete();

        return $this->response()->success('Index deleted Successfully')->refresh();
    }
}
