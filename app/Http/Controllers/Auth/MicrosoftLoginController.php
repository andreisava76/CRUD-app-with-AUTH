<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Http\Request;

class MicrosoftLoginController extends Controller
{
    public function connect()
    {
        return MsGraph::connect();
    }

}
