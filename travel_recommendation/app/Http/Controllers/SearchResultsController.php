<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/8/2018
 * Time: 12:06 AM
 */

namespace App\Http\Controllers;


class SearchResultsController extends Controller
{
    public function pageLoad()
    {
        return view( "SearchResults" );
    }
}