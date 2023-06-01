<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);

        $addressData = $request->only([
            'name',
            'phone',
            'address',
            'city',
            'province',
            'postal_code',
        ]);

        $addressData['user_id'] = auth()->id();

        $address = Address::create($addressData);

        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = Address::findOrFail($id);
        return view('addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);

        $addressData = $request->only([
            'name',
            'phone',
            'address',
            'city',
            'province',
            'postal_code',
        ]);

        $address = Address::findOrFail($id);
        $address->update($addressData);

        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
    }

    public function setDefault($id)
    {
        $address = Address::findOrFail($id);

        Address::where('user_id', $address->user_id)->update(['is_default' => false]);

        $address->update(['is_default' => true]);

        return redirect()->back()->with('success', 'Address set as default.');
    }
}
