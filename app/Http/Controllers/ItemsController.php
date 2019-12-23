<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*Items::chunk(100, function($items){
            foreach($items as $item){
                echo $item;
            }
        });*/
        //dd($request['search']);
        if ($request['search']) {
            $rawItems = DB::select("SELECT * from items WHERE name LIKE ?", array('%' . $request['search'] . '%'));
            //dd($items);
            $total = count($rawItems);
            $perPage = 21;
            $currentPage = 1;
            $items = new \Illuminate\Pagination\LengthAwarePaginator($rawItems, $total, $perPage, $currentPage);
            return view('welcome', ['items' => $items, 'user' => $request->user(), 'searchVal' => $request['search']]);
        } else {
            $items = Items::OrderBy('updated_at', 'desc')->paginate(21);
            return view('welcome', ['items' => $items, 'user' => $request->user(), 'searchVal' => '']);
            //dd($items);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['file'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric']
        ]);
        $item = new Items;
        $item['image'] = $request->file('image')->store('public/images');
        $item['name'] = $request['name'];
        $item['description'] = $request['description'];
        $item['image'] = Storage::url($item['image']);
        $item['price'] = $request['price'];
        $item['stock'] = $request['stock'];

        //dd($item);
        $item->save();
        return redirect("/dashboard/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items, $item_id)
    {
        dd($items::find($item_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items, $item_id)
    {
        //dd($items::find($item_id));
        $item = $items::find($item_id);
        //dd($item);
        return view('items.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items, $item_id)
    {

        /*function validator(array $request)
            {
            return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'number'],
            'stock' => ['requered', 'number']
            ]);
            }*/
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric']
        ]);
        // to-do image change like in new item...
        $data = $items::find($item_id);
        $data['name'] = $request['name'];
        $data['description'] = $request['description'];
        $data['price'] = $request['price'];
        $data['stock'] = $request['stock'];

        //dd($data);
        $data->save();
        return redirect()->back()->with('success', 'Item saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $items)
    {
        //
    }
}
