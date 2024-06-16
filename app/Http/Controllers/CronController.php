<?php

namespace App\Http\Controllers;

use App\Models\Pen;
use Illuminate\Http\Request;
use Illuminate\Support\Testing\Fakes\Fake;

class CronController extends Controller
{
    // wget -O /dev/null https://thulirfinance.in/testCron
    public function testCron()
    {
        Pen::create(['full_name'=> fake()->name(),'phone_number'=> fake()->phoneNumber(),'image'=> fake()->text(30)]);
        return 'success';
    }
}
