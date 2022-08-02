<?php

namespace App\Http\Controllers;

use App\Models\Quote_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;
use Ramsey\Collection\Map\AssociativeArrayMap;

class Quote_tagController extends Controller
{
    /*
    * Return tags by filters
    */
    public function getQuoteTags(Request $request)
    {
        $query = Quote_tag::query()->orderBy('created_at', 'desc');

        if ($request->filled('id')){
            $query->whereRaw('id = ?',[$request->id]);
        }
        if ($request->filled('tag_id')){
            $query->whereRaw('tag_id like ?', ['%'.$request->tag_id.'%']);
        }
        if ($request->filled('quote_id')){
            $query->whereRaw('quote_id like ?', ['%'.$request->quote_id.'%']);
        }
        return $query->paginate(10);
    }
}
