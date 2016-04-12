<?php

namespace Profio\Auth\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as IlluminateController;

abstract class BaseController extends IlluminateController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
