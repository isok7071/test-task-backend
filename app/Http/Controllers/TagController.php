<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TagController extends Controller
{
    /*
    * Return tags by filters
    */
    public function getTags(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Tag::query()->orderBy('created_at', 'desc');

        if ($request->filled('id')){
            $query->whereRaw('id = ?',[$request->id]);
        }
        if ($request->filled('tag_name')){
            $query->whereRaw('tag_name like ?', ['%'.$request->tag_name.'%']);
        }
        return $query->paginate(10);
    }

    /*
    * Return tags by filters with relation 'quotes'
    */
    public function getTagsRelation(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Tag::with('quotes')->orderBy('created_at', 'desc');
        if ($request->filled('id')){
            $query->whereRaw('id = ?',[$request->id]);
        }

        if ($request->filled('tag_name')){
            $query->whereRaw('tag_name like ?', ['%'.$request->tag_name.'%']);
        }
        return $query->paginate(10);
    }


}
