<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function get_all_relic_info(Request $r)
    {
        //$test = DB::table('items_price')->where('cod_item', '<', 11)->get();
        $test = DB::table('relic_drop')->join('relics', 'relic_drop.relic', '=', 'relics.cod_relic')->join('relic_profit', 'relic_drop.relic', '=', 'relic_profit.cod_relic')->join('relic_price', 'relic_drop.relic', '=', 'relic_price.cod_relic')->select('relics.relic_name', 'relic_drop.*', 'relic_price.price', 'relic_profit.intact', 'relic_profit.exceptional', 'relic_profit.flawless', 'relic_profit.radiant')->get();
        return response()->json($test, 200);
    }

    public function relic_drops(Request $r)
    {
        //$test = DB::table('items_price')->where('cod_item', '<', 11)->get();
        $test = DB::table('relic_drop')->join('relics', 'relic_drop.relic', '=', 'relics.cod_relic')->select('relics.relic_name', 'relic_drop.*')->get();
        return response()->json($test, 200);
    }


    public function items(Request $r)
    {
        //$test = DB::table('items_price')->where('cod_item', '<', 11)->get();
        $test = DB::table('items_price')->join('items', 'items_price.cod_item', '=', 'items.item_cod')->select('items_price.price', 'items.item_name', 'items.item_cod')->get();
        return response()->json($test, 200);
    }

}
