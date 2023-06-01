<?php

namespace App\Http\Controllers;

use App\Models\Address;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
        $this->apiKey = '50fccf12764162cd152d016aae5460e1';
        $this->baseUrl = 'https://api.rajaongkir.com/starter/';
    }

    public function getCities()
    {
        $response = $this->client->request('GET', $this->baseUrl . 'city', [
            'headers' => [
                'key' => $this->apiKey,
            ],
        ]);

        $cities = json_decode($response->getBody(), true)['rajaongkir']['results'];

        return response()->json($cities);
    }

    public function getCitiesByProvince($provinceId)
    {
        $rajaOngkir = new Client();
        $apiKey = '50fccf12764162cd152d016aae5460e1';
        $baseUrl = 'https://api.rajaongkir.com/starter/';

        $response = $rajaOngkir->request('GET', $baseUrl . 'city?province=' . $provinceId, [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);

        $cities = json_decode($response->getBody(), true)['rajaongkir']['results'];

        return response()->json($cities);
    }

    public function getProvinces()
    {
        $response = $this->client->request('GET', $this->baseUrl . 'province', [
            'headers' => [
                'key' => $this->apiKey,
            ],
        ]);

        $provinces = json_decode($response->getBody(), true)['rajaongkir']['results'];

        return response()->json($provinces);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rajaOngkir = new Client();
        $apiKey = '50fccf12764162cd152d016aae5460e1';
        $baseUrl = 'https://api.rajaongkir.com/starter/';
        $addresses = auth()->user()->addresses;

        foreach ($addresses as $address) {
            $response = $rajaOngkir->request('GET', $baseUrl . 'province?id=' . $address->province, [
                'headers' => [
                    'key' => $apiKey,
                ],
            ]);

            $provinceName = json_decode($response->getBody(), true)['rajaongkir']['results']['province'];

            $response = $rajaOngkir->request('GET', $baseUrl . 'city?id=' . $address->city, [
                'headers' => [
                    'key' => $apiKey,
                ],
            ]);

            $cityName = json_decode($response->getBody(), true)['rajaongkir']['results']['city_name'];

            $address->province = $provinceName;
            $address->city = $cityName;
        }
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rajaOngkir = new Client();
        $apiKey = '50fccf12764162cd152d016aae5460e1';
        $baseUrl = 'https://api.rajaongkir.com/starter/';

        $response = $rajaOngkir->request('GET', $baseUrl . 'province', [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);

        $provinces = json_decode($response->getBody(), true)['rajaongkir']['results'];

        return view('addresses.create', compact('provinces'));
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

        if (auth()->user()->addresses->isEmpty()) {
            $addressData['is_default'] = true;
        }

        $address = Address::create($addressData);

        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rajaOngkir = new Client();
        $apiKey = '50fccf12764162cd152d016aae5460e1';
        $baseUrl = 'https://api.rajaongkir.com/starter/';

        $response = $rajaOngkir->request('GET', $baseUrl . 'province', [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);
        $provinces = json_decode($response->getBody(), true)['rajaongkir']['results'];

        $response = $rajaOngkir->request('GET', $baseUrl . 'city', [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);
        $cities = json_decode($response->getBody(), true)['rajaongkir']['results'];
        $address = Address::findOrFail($id);
        return view('addresses.edit', compact('address', 'provinces', 'cities'));
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
