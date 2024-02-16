<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class DeleteVoucher extends RowAction
{
    public $name = 'Delete ';

      public function dialog()
    {
       return  $this->confirm('Are you sure to copy this row?');
    }

    public function handle(Model $model)
    {
        // $model ...

      return  $this->confirm('Are you sure to copy this row?');
      
    }
    // public function href()
    // {
    //     return $this->getResource() ."/" . $this->getKey() ."/documents";
    // } 
  

}