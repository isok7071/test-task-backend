<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Quote_tag;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /*
     * Return quotes by filters  with relation 'tags'
     */
    public function getQuotes(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Quote::with('tags')->orderBy('created_at', 'desc');
        if ($request->filled('id')){
            $query->whereRaw('id = ?',[$request->id]);
        }
        if ($request->filled('quote_author')){
            $query->whereRaw('quote_author like ?', ['%'.$request->quote_author.'%']);
        }
        if ($request->filled('quote_text')){
            $query->whereRaw('quote_text like ?', ['%'.$request->quote_text.'%']);
        }
        return $query->paginate(10);
    }



    /*
     * Add a new quote
     */
    public function addQuote(Request $request): \Illuminate\Http\JsonResponse
    {
        $quote = new Quote();
        if (!empty($request)) {
            $quote->quote_text = htmlspecialchars($request->quote_text);
            $quote->quote_author = htmlspecialchars($request->quote_author);
            $quote->save();
            foreach ($request->tags as $tag) {
                $quote_tags = new Quote_tag();
                $quote_tags->quote_id = $quote->id;
                $quote_tags->tag_id = $tag;
                $quote_tags->save();
            }
        }

        return response()->json('ok', '200')->header('Access-Control-Allow-Headers', 'Authorization, Origin, X-Requested-With, Accept, X-PINGOTHER, Content-Type')->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', '*');

    }


}
