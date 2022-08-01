<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Quote_tag;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /*
     * Return quotes with relation 'tags'
     */
    public function getQuotes()
    {
        return Quote::with('tags')->orderBy('created_at', 'desc')->paginate(10);
    }

    /*
     * Add a new quote
     *
     */
    public function addQuote(Request $request): \Illuminate\Http\JsonResponse
    {
        $quote = new Quote();
        if (!empty($request)) {
            $quote->quote_text = $request->quote_text;
            $quote->quote_author = $request->quote_author;
            $quote->save();
            foreach ($request->tags as $tag) {
                $quote_tags = new Quote_tag();
                $quote_tags->quote_id = $quote->id;
                $quote_tags->tag_id = $tag;
                $quote_tags->save();
            }
        }

        return response()->json('ok', '200')->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', '*');

    }


}
