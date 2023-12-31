<?php

namespace App\Http\Controllers\Api;

use App\Models\Farm;
use App\Models\User;
use App\Models\Product;
use App\Models\CropRecord;
use Illuminate\Http\Request;
use App\Models\SupportedBarangay;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CropRecordResource;
use App\Http\Resources\SupportedProductResource;
use App\Http\Resources\SupportedBarangayResource;
use App\Http\Requests\SuperAdmin\StoreBarangayRequest;
use App\Http\Requests\SuperAdmin\UpdateBarangayRequest;

class SuperAdminController extends Controller
{

    public function supportedBarangay()
    {
        $supportedBarangay = SupportedBarangay::query()->orderBy('supported_barangay', 'asc')->paginate(8);
        return SupportedBarangayResource::collection($supportedBarangay);
    }

    public function getCropRecords(Request $request)
    {
        $capitanJuanSold = 0;
        $bugcaonSold = 0;
        $kulasihanSold = 0;
        $bantuanonSold = 0;
        $poblacionSold = 0;
        $balilaSold = 0;
        $baclayonSold = 0;
        $kaatuanSold = 0;
        $alanibSold = 0;
        $songcoSold = 0;
        $cawayanSold = 0;
        $victorySold = 0;
        $kibangaySold = 0;
        $basacSold = 0;

        //YIELD
        $capitanjuanYield = 0;
        $bugcaonYield = 0;
        $kulasihanYield = 0;
        $bantuanonYield = 0;
        $poblacionYield = 0;
        $balilaYield = 0;
        $baclayonYield = 0;
        $kaatuanYield = 0;
        $alanibYield = 0;
        $songcoYield = 0;
        $cawayanYield = 0;
        $victoryYield = 0;
        $kibangayYield = 0;
        $basacYield = 0;

        // $records = Product::where('harvested_date', $request->start_date)
        //     ->where('product_type', '=', $request->commodity)
        //     ->get();
        $records = Product::
        // whereBetween('harvested_date', [$request->start_date, $request->end_date])
            where('product_type', $request->commodity)
            ->get();


        if(!$records){
            return response()->json('none');
        }else{
            // return response()->json('There is');
            foreach ($records as $record) {
                if ($record->product_location == 'CAPITAN JUAN') {
                    $capitanJuanSold = $capitanJuanSold + $record->actual_sold_kg;
                    $capitanjuanYield = $capitanjuanYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'BUGCAON') {
                    $bugcaonSold = $bugcaonSold + $record->actual_sold_kg;
                    $bugcaonYield = $bugcaonYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'KULASIHAN') {
                    $kulasihanSold = $kulasihanSold + $record->actual_sold_kg;
                    $kulasihanYield = $kulasihanYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'BANTUANON') {
                    $bantuanonSold = $bantuanonSold + $record->actual_sold_kg;
                    $bantuanonYield = $bantuanonYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'POBLACION') {
                    $poblacionSold = $poblacionSold + $record->actual_sold_kg;
                    $poblacionYield = $poblacionYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'BALILA') {
                    $balilaSold = $balilaSold + $record->actual_sold_kg;
                    $balilaYield = $balilaYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'BACLAYON') {
                    $baclayonSold = $baclayonSold + $record->actual_sold_kg;
                    $baclayonYield = $baclayonYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'KAATUAN') {
                    $kaatuanSold = $kaatuanSold + $record->actual_sold_kg;
                    $kaatuanYield = $kaatuanYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'ALANIB') {
                    $alanibSold = $alanibSold + $record->actual_sold_kg;
                    $alanibYield = $alanibYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'SONGCO') {
                    $songcoSold = $songcoSold + $record->actual_sold_kg;
                    $songcoYield = $songcoYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'CAWAYAN') {
                    $cawayanSold = $cawayanSold + $record->actual_sold_kg;
                    $cawayanYield = $cawayanYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'VICTORY') {
                    $victorySold = $victorySold + $record->actual_sold_kg;
                    $victoryYield = $victoryYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'KIBANGAY') {
                    $kibangaySold = $kibangaySold + $record->actual_sold_kg;
                    $kibangayYield = $kibangayYield + $record->prospect_harvest_in_kg;
                } else if ($record->product_location == 'BASAC') {
                    $basacSold = $basacSold + $record->actual_sold_kg;
                    $basacYield = $basacYield + $record->prospect_harvest_in_kg;
                }
            }
        }


        // return response([
        //     'capitanJuanSold' => $capitanJuanSold,
        //     'CapitanJuanYield' => $capitanjuanYield,

        //     'bugcaonSold' => $bugcaonSold,
        //     'BugcaonYield' => $bugcaonYield,

        //     'kulasihanSold' => $kulasihanSold,
        //     'KulasihanYield' => $kulasihanYield,

        //     'bantuanonSold' => $bantuanonSold,
        //     'BantuanonYield' => $bantuanonYield,

        //     'poblacionSold' => $poblacionSold,
        //     'PoblacionYield' => $poblacionYield,

        //     'balilaSold' => $balilaSold,
        //     'BalilaYield' => $balilaYield,

        //     'baclayonSold' => $baclayonSold,
        //     'BaclayonYield' => $baclayonYield,

        //     'kaatuanSold' => $kaatuanSold,
        //     'KaatuanYield' => $kaatuanYield,

        //     'alanibSold' => $alanibSold,
        //     'AlanibYield' => $alanibYield,

        //     'songcoSold' => $songcoSold,
        //     'SongcoYield' => $songcoYield,

        //     'cawayanSold' => $cawayanSold,
        //     'CawayanYield' => $cawayanYield,

        //     'victorySold' => $victorySold,a
        //     'VictoryYield' => $victoryYield,

        //     'songcoSold' => $songcoSold,
        //     'SongcoYield' => $songcoYield,

        //     'basacSold' => $basacSold,
        //     'BasacYield' => $basacYield,

        //     'StartDate' => $$request->start_date,
        //     'EndDate' => $request->end_date,
        //     'Commodity' => $commodity,
        // ], 200);
        // return CropRecordResource::collection($cropRecords);
    }

    public function pendingProducts()
    {
        $pendingProducts =  Product::where('is_approved', 0)->orderBy('prospect_harvest_date', 'desc')
            ->with('farm')
            ->get();
        return response()->json($pendingProducts);
    }

    public function pendingProduct($product)
    {
        $productWithFarmOwner = Product::where('id', $product)
            ->with('farm')->first();
        return response()->json($productWithFarmOwner);
    }


    public function getFarmers()
    {
        $farmers = Farm::with('user')->get();

        return response()->json($farmers);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addBarangay(StoreBarangayRequest $request)
    {
        $data = $request->validated();
        $supportedBarangay = SupportedBarangay::create($data);
        return response(new SupportedBarangayResource($supportedBarangay), 201);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showBarangay(SupportedBarangay $barangay)
    {
        return new SupportedBarangayResource($barangay);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBarangay(UpdateBarangayRequest $request, SupportedBarangay $barangay)
    {
        $data = $request->validated();
        $barangay->update($data);

        // $supportedBarangays = SupportedBarangay::query()->orderBy('supported_barangay', 'asc')->paginate(8);
        // return new SupportedBarangay($supportedBarangays);
        return response(new SupportedBarangayResource($barangay), 201);
    }

    // ####################################
    // Products
    public function pendingProductUpdate(Request $request, Product $product)
    {

        $product->where('id', $product->id)
            ->update([
                'is_approved' => 1,
                'price' => $request->input('price'),
            ]);

        return response()->json(['success' => "Product Updated Successfully"]);
    }

    public function approvedProducts()
    {
        $product = Product::where('is_approved', 1)
            ->with('farm')
            ->get();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
