<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = DB::table('quotes')->get();
        return view('onglets.quotes',compact('quotes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function searchQuote(Request $request)
    {
        $from = request('startDate');
        $to = request('endDate');
        $id_quote = request('id_quote');
        $status_quote = request('status_quote');
        $quotes = DB::table('quotes')
            ->where('id',$id_quote)
            ->orWhere('status_quote',$status_quote)
            ->orWhereBetween('date_quote', [$from, $to])
            ->get();
        //dd($quotes);
        return view('onglets.quotes', ['quotes' => $quotes]);
    }
    /**
     * 
     */
    public function show($id) {
        //dd("here");
        $quote = Quote::find($id);
        //dd($quote);


        $file_path = $quote->quote_path;
        $path = public_path(). $file_path;
        $file_name = $quote->quote_name;

        $headers = array(
            'Content-Type: application/pdf',
          );

        return Response::download($path, $file_name, $headers);
    }
}
