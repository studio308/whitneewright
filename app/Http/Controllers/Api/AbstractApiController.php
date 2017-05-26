<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace App\Http\Controllers\Api;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\ResponseTrait;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class AbstractApiController
 * @package Kabooodle\Http\Controllers\Api
 */
abstract class AbstractApiController extends Controller
{
    use DispatchesJobs, Helpers, ResponseTrait, ValidatesRequests;
}