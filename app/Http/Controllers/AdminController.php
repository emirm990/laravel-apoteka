<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.dashboard');
    }

    public function index(Request $request)
    {
        if ($request['search']) {
            $rawItems = DB::select("SELECT * from items WHERE name LIKE ?", array('%' . $request['search'] . '%'));
            //dd($items);
            $total = count($rawItems);
            $perPage = 21;
            $currentPage = 1;
            $items = new \Illuminate\Pagination\LengthAwarePaginator($rawItems, $total, $perPage, $currentPage);
            return view('admin.edit', ['items' => $items, 'user' => $request->user(), 'searchVal' => $request['search']]);
        } else {
            $items = Items::OrderBy('updated_at', 'desc')->paginate(24);
            return view('admin.edit', ['items' => $items, 'user' => $request->user(), 'searchVal' => '']);
            //dd($items);
        }
    }
    public function destroy(Items $items, $item_id)
    {
        $items::destroy($item_id);
        return back();
    }
}
