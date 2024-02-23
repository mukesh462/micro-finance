<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class TestRow extends RowAction
{
    public $name = 'Edit';

    public function href()
    {

        return $this->getResource() . "/" . $this->getKey() . "/edits";
    }

    public function render()
    {
        // Retrieve the URL for the edit action
        $url = $this->href();

        // Add JavaScript code to navigate to the URL and refresh the page
        return <<<HTML
            <a href="javascript:void(0);" onclick="navigateAndRefresh('$url')">{$this->name()}</a>
            <script>
                function navigateAndRefresh(url) {
                    // Navigate to the URL
                    window.location.href = url;
                    // Reload the page after a short delay (adjust as needed)
                    setTimeout(function() {
                        location.reload();
                    }, 1000); // 1000 milliseconds = 1 second
                }
            </script>
        HTML;
    }
}
