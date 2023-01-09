<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use App\ModelsExtended\Timezone;
use App\ModelsExtended\Vendor;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\VendorRequest;
use App\Models\VendorImage;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Show the Library Dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('library.index')
            ->withVendors(
                Vendor::with('logo')->with('images')->orderBy('id', 'DESC')->get()
            );
    }

    /**
     * Show the Assets Library form.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('library.create', ["categories" => AssetCategory::all(), "maxPhotoUpload" => 6,'timezones' => Timezone::all()->toArray()]);
    }

    /**
     * Save the vendor.
     *
     * @return String
     */
    public function store(VendorRequest $request)
    {

        $vendor = Vendor::updateOrCreate(
            [
                'id' => $request->input("vendor_id")
            ],
            [
                "asset_category_id" => $request->input("asset_category_id"),
                "name" => $request->input("name"),
                "alias" => $request->input("alias"),
                "address" => $request->input("address"),
                "phone" => $request->input("phone"),
                "email" => $request->input("email"),
                "timezone_id" => $request->input("timezone"),
                "tags" => $request->input("tags"),
                "description" => $request->input("description"),
            ]
        );

        $vendorImages = [];

        if ($request->hasFile("logo")) {
            $path = Storage::cloud()->put(auth()->user()->id . "/vendor/logo", $request->file("logo"));
            $vendorImages[] = [
                "vendor_id" => $vendor->id,
                "image_relative_url" => $path,
                "type" => "Logo"
            ];
        }

        if ($request->hasFile("photos")) {
            foreach ($request->file("photos") as $photo) {
                $path = Storage::cloud()->put(auth()->user()->id . "/vendor/photos", $photo);
                $vendorImages[] = [
                    "vendor_id" => $vendor->id,
                    "image_relative_url" => $path,
                    "type" => "Photo"
                ];
            }
        }

        if (count($vendorImages) > 0) {
            VendorImage::insert($vendorImages);
        }

        return response()->json(["success" => true, "message" => "Vendor has been added."]);
    }
    public function edit($id)
    {

        $vendor = Vendor::find($id);
        if (!$vendor) {
            return redirect()->back()->with('error', 'Invalid request, Please try again.');
        }
        return view('library.create') ->with(
            "vendor",
            $vendor
        )->with(
            "categories",
            AssetCategory::all()
        )->with("maxPhotoUpload", 6)
        ->withTimezones(Timezone::all());
    }

    public function libraryShow($id)
    {
        return view('library.current', ['vendor' => Vendor::find($id)]);
    }
    public function deleteImage($id)
    {
        if($id != null)
        {
            VendorImage::find($id)->delete();
        }
        return response()->json(["success" => true, "message" => "Vendor image has been deleted."]);
    }
}
