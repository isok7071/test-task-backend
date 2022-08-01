<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TagController extends Controller
{
    /*
    * Return tags
    */
    public function getTags()
    {
        return Tag::query()->orderBy('created_at', 'desc')->get();
    }

    /*
    * Return tags with relation 'quotes'
    */
    public function getTagsRelation()
    {
        return Tag::with('quotes')->orderBy('created_at', 'desc')->paginate(10);
    }

}
