<?php

namespace App\Http\Controllers;


use App\Console\Commands\Sync\SyncMessageBirdMessagesCommand;
use App\Models\AssetAccommodationInfo;
use App\Models\AssetCost;
use App\Models\AssetDiningInfo;
use App\Models\AssetEventInfo;
use App\Models\AssetMiscellaneousInfo;
use App\Models\AssetStatus;
use App\Models\Timezone;
use App\ModelsExtended\Asset;
use App\ModelsExtended\AssetCategory;
use App\ModelsExtended\AssetImage;
use App\ModelsExtended\ContactGroup;
use App\ModelsExtended\CurrencyType;
use App\ModelsExtended\Member;
use App\ModelsExtended\MemberGroup;
use App\ModelsExtended\Vendor;
use App\ModelsExtended\MemberStatus;
use App\Rules\EventDeadlineRule;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use App\ModelsExtended\AssetReceiver;

use App\Rules\PhoneNumberValidationRule;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['shareAssets']);
    }


    /**
     * Show the Assets Dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {

        $assets = Asset::query()
            ->with(
                "asset_category"
            )
            ->with(
                "asset_cost"
            )
            ->when(
                $request->input('search'), function (Builder $builder) use ($request) {
                $builder->where('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere(
                        'venue_name',
                        'like', '%' . $request->input('search') . '%'
                    );
            }
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

        return view('assets.index', ['assets' => $assets]);
    }

    /**
     * @param Asset $asset
     *
     * @return Renderable
     */
    public function showAsset(Asset $asset): Renderable
    {

        try {
            $asset->with('asset_category')
                ->with(
                    'asset_images'
                )
                ->with(
                    'asset_tags'
                )
                ->when(
                    $asset->asset_category_id === AssetCategory::Accommodation, function ($q) {
                    return $q->with('asset_accommodation_info');
                }
                )
                ->when(
                    $asset->asset_category_id === AssetCategory::Dining, function ($q) {
                    return $q->with('asset_dining_info');
                }
                )
                ->when(
                    $asset->asset_category_id === AssetCategory::Event, function ($q) {
                    return $q->with('asset_event_info');
                }
                )
                ->when(
                    $asset->asset_category_id === AssetCategory::Miscellaneous, function ($q) {
                    return $q->with('asset_miscellaneous_info');
                }
                );
            $assetReceiverList = AssetReceiver::getAssetReceiverList($asset->id);
            $totalMemberWithAssetShare = count($assetReceiverList->toArray());
            $membersWithOutShow = ($totalMemberWithAssetShare > 3) ? $totalMemberWithAssetShare - 3 : $totalMemberWithAssetShare;


            return view('assets.current', ['asset' => $asset,
                'assetReceiverList' => $assetReceiverList,
                'totalMemberWithAssetShare' => $totalMemberWithAssetShare,
                'membersWithOutShow' => $membersWithOutShow]);
        } catch (\Exception $exception) {
            throw $exception;
        }

    }

    /**
     * @param Asset $asset
     *
     * @return Renderable
     */
    public function showAssetPreview($category, $id): Renderable
    {
        $asset = Asset::find($id);

        if ($category == 'Accommodation') {
            return view('assets.previewAccommodation', ['asset' => $asset]);
        } elseif ($category == 'Dining') {
            return view('assets.previewDiningn', ['asset' => $asset]);
        } elseif ($category == 'Event') {
            return view('assets.previewEvent', ['asset' => $asset]);
        } elseif ($category == 'Miscellaneous') {
            return view('assets.previewMisc', ['asset' => $asset]);
        }

    }

    /**
     * Show the Assets Dashboard.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {

        return view('assets.create')
            ->with(
                "asset",
                new Asset
            )
            ->with(
                "category", AssetCategory::all()
            )
            ->with(
                "statuses", AssetStatus::all()
            )
            ->with(
                "timezones", Timezone::all()
            )
            ->with(
                "sellers", Member::all()
            )
            ->with(
                "currencyTypes", CurrencyType::query()->whereIn(
                "id",
                [
                    CurrencyType::USD, CurrencyType::EUR, CurrencyType::GBP
                ]
            )->get()
            )
            ->with(
                "venues", Vendor::all()
            );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function list(Request $request)
    {
        $assets = Asset::query()
            ->with(
                "asset_category"
            )
            ->where(
                'user_id', Auth::user()->id
            )
            ->get();

        return view('assets.list', ['assets' => $assets]);
    }

    public function delete($id)
    {
        Asset::where('id', $id)->delete();

        return redirect('/assets/index')->with("success", "Deleted successfully");
    }

    public function sendPaymentLink($id)
    {
        var_dump($id);

        return redirect('/assets/index')->with("success", "Payment link has been sent successfully");
    }

    public function edit($id)
    {
        $asset = Asset::find($id);
        if (!$asset) {
            return redirect()->back()->with('error', 'Invalid request, Please try again.');
        }

        return view('assets.create')
            ->with(
                "asset",
                $asset
            )
            ->with(
                "categories", AssetCategory::all()
            )
            ->with(
                "statuses", AssetStatus::all()
            )
            ->with(
                "timezones", Timezone::all()
            )
            ->with(
                "sellers", Member::all()
            )
            ->with(
                "currencyTypes", CurrencyType::query()->whereIn(
                "id",
                [
                    CurrencyType::USD, CurrencyType::EUR, CurrencyType::GBP
                ]
            )->get()
            )
            ->with(
                "venues", Vendor::all()
            );
    }


    public function insert(Request $request)
    {


        $asset_category_id = $request->input('category_id');

        $validator = Validator::make(
            $request->all(),
            [
                'category_id' => 'required|exists:asset_category,id',
                'name' => 'required|string|max:255',
                'venue' => (AssetCategory::Miscellaneous == $asset_category_id) ? 'nullable|string|max:255' : 'required|string|max:255',
                'address' => (AssetCategory::Miscellaneous == $asset_category_id) ? 'nullable|string|max:255' : 'required|string|max:255' ,
                'status' => 'required|integer',
                'seller' => 'required|integer',
                'cost_details' => 'required|string|max:255',
                'timezone' => 'required|integer',
                'description' => 'required|string',
                'deadline_date' => 'required|string',
                'deadline_time' => (AssetCategory::Miscellaneous == $asset_category_id) ? 'nullable|string' : 'required|string',
                'images.*' => 'mimes:jpeg,jpg,png,gif|max:20048',
                'tags' => 'nullable|string|max:255',
            ],
            [
                'name.required' => 'Please enter asset name.',
                'venue.required' => 'Please enter the venue name.',
                'address.required' => 'Please enter the venue address.',
                'seller.required' => 'Please select seller.',
                'status.required' => 'Please select status.',
                'currency_type_id.required' => 'Please select cost currency type.',
                'amount.required' => 'Please enter cost.',
                'cost_details.required' => 'Please enter cost details.',
                'deadline_date.required' => 'Please enter deadline date.',
                'deadline_time.required' => 'Please enter deadline time.',
                'description.required' => 'Please enter asset description.',
                'timezone.required' => 'Please select event timezone.',
                'images' => 'images should be jpeg,jpg,png,gif',
            ]
        );

        switch ($asset_category_id) {
            case AssetCategory::Accommodation:
                $this->validate(
                    $request,
                    [
                        'check_in_datetime' => ['required', new EventDeadlineRule($request->input('deadline_date'))],
                        'check_out_date' => ['required', new EventDeadlineRule($request->input('deadline_date'))],
                        'confirmation_number' => 'nullable|integer',
                        'guest_name' => 'nullable|max:255',
                        'number_of_guests' => 'nullable',
                        'venue_phone' => ['nullable', 'max:30', new PhoneNumberValidationRule],
                        'cancellation_cost' => 'nullable|integer',
                        'website' => 'nullable|url',
                        'cancellation_policy' => 'nullable|url|string|max:255',
                    ],
                    [
                        'check_in_datetime.required' => 'Please enter date of check in.',
                        'check_out_date.required' => 'Please enter date of check out.',
                    ]
                );
                break;
            case AssetCategory::Dining:
                $this->validate(
                    $request,
                    [
                        'reservation_date' => ['required', new EventDeadlineRule($request->input('deadline_date'))],
                        'reservation_time' => 'required',
                        'guest_name' => 'nullable|max:255',
                        'guest_email' => 'nullable|email|max:255',
                        'guest_phone' => ['nullable', 'max:30', new PhoneNumberValidationRule],
                        'venue_phone' => ['nullable', 'max:30', new PhoneNumberValidationRule],
                        'number_of_guests' => 'nullable',
                        'cancellation_policy' => 'nullable|url|string|max:255',
                        'menu_highlights' => 'nullable',
                    ],
                    [
                        'reservation_date.required' => 'Please enter reservation date.',
                        'reservation_time.required' => 'Please enter reservation time.',
                    ]
                );
                break;
            case AssetCategory::Event:
                $this->validate(
                    $request,
                    [
                        'event_date' => ['required', new EventDeadlineRule($request->input('deadline_date'))],
                        'event_time' => 'required',
                        'event_name' => 'nullable|string|max:255',
                        'event_type' => 'nullable|string|max:255',
                        'ticket_holder' => 'nullable|string|max:255',
                        'number_of_seats' => 'nullable|integer',
                        'seat_area' => 'nullable|string|max:255',
                        'venue_layout' => 'nullable|url|string|max:255',
                        'venue_amenities' => 'nullable|string',
                        'total_paid' => 'nullable|integer',
                        'cancellation_policy' => 'nullable|url|max:255',
                    ],
                    [
                        'event_date.required' => 'Please enter event date.',
                        'event_time.required' => 'Please enter event time.',
                    ]
                );
                break;
            case AssetCategory::Miscellaneous:
                $this->validate(
                    $request,
                    [
                        'display_date' => ['nullable', new EventDeadlineRule($request->input('deadline_date'))],
                        'event_name' => 'nullable|string|max:255',
                        'event_type' => 'nullable|string|max:255',
                        'ticket_holder' => 'nullable|string|max:255',
                        'number_of_seats' => 'nullable|integer',
                        'seat_area' => 'nullable|string|max:255',
                        'total_paid' => 'nullable|integer',
                        'cancellation_policy' => 'nullable|url|max:255',
                        'venue_layout' => 'nullable|url|max:255',
                        'multiple_locations' => 'nullable|string|max:255',
                    ]
                );
                break;
        }

        if ($validator->fails()) {
            return response()->json(['response' => "error", "validation_error" => $validator->errors()]);
        }


        DB::beginTransaction();

        try {

            if ($request->input('id') != null) {
                $asset = Asset::Find($request->input('id'));
                $assetAccommodationInfo = AssetAccommodationInfo::where('asset_id', $request->input('id'))->first();
                $assetDiningInfo = AssetDiningInfo::where('asset_id', $request->input('id'))->first();
                $assetEventInfo = AssetEventInfo::where('asset_id', $request->input('id'))->first();
                $assetMiscellaneousInfo = AssetMiscellaneousInfo::where('asset_id', $request->input('id'))->first();
                $assetCost = AssetCost::where('asset_id', $request->input('id'))->first();
            } else {
                $asset = new Asset;
                $assetAccommodationInfo = new AssetAccommodationInfo;
                $assetDiningInfo = new AssetDiningInfo;
                $assetEventInfo = new AssetEventInfo;
                $assetMiscellaneousInfo = new AssetMiscellaneousInfo;
                $assetCost = new AssetCost;
            }

            $asset->created_by_id = Auth::user()->id;
            $asset->asset_category_id = $asset_category_id;
            $asset->name = $request->input('name');
            $asset->venue_name = $request->input('venue');
            $asset->venue_address = $request->input('address');
            $asset->seller_id = $request->input('seller');
            $asset->asset_status_id = $request->input('status');
            if ($asset_category_id == AssetCategory::Accommodation) {
                $asset->check_in_datetime = $asset::format_date($request->input('check_in_datetime'));
                $asset->check_out_date = $asset::format_date($request->input('check_out_date'));
                $asset->deadline_datetime = $asset::format_date_time($request->input('deadline_date'), $request->input('deadline_time'));
            } elseif ($asset_category_id == AssetCategory::Dining) {
                $asset->check_in_datetime = $asset::format_date_time($request->input('reservation_date'), $request->input('reservation_time'));
                $asset->check_out_date = '1989-11-30';
                $asset->deadline_datetime = $asset::format_date_time($request->input('deadline_date'), $request->input('deadline_time'));
            } elseif ($asset_category_id == AssetCategory::Event) {
                $asset->check_in_datetime = $asset::format_date_time($request->input('event_date'), $request->input('event_time'));
                $asset->check_out_date = '1989-11-30';
                $asset->deadline_datetime = $asset::format_date_time($request->input('deadline_date'), $request->input('deadline_time'));
            } elseif ($asset_category_id == AssetCategory::Miscellaneous) {
                $asset->check_in_datetime = '1989-11-30';
                $asset->check_out_date = '1989-11-30';
                $asset->deadline_datetime = $asset::format_date_time($request->input('deadline_date'), $request->input('deadline_time'));
            }

            $asset->timezone_id = $request->input('timezone');
            $asset->description = $request->input('description');
            $asset->notes = $request->input('notes');
            $asset->save();


            // ************** Cost insert code ***************
            $assetCost->asset_id = $asset->id;
            $assetCost->currency_type_id = CurrencyType::USD;
            $assetCost->amount = 0; // remove from frontend
            $assetCost->usd_amount = 0; // remove from frontend
            $assetCost->cost_details = $request->input('cost_details');
            $assetCost->save();

            // ************** Tag insert code ***************
            if ($request->input('id') != null) {
                $assetTagArr = [];
                if (!is_null($request->input('tags'))) {
                    $tags = explode(",", $request->input('tags'));
                    for ($i = 0; $i < count($tags); $i++) {
                        $assetTagArr[] = [
                            'description' => $tags[$i]
                        ];
                    }

                    if (count($assetTagArr) > 0) {
                        $asset->asset_tags()->delete();
                        $asset->asset_tags()->createMany($assetTagArr);
                    }
                }
            } else {
                $assetTagArr = [];
                if (!is_null($request->input('tags'))) {
                    $tags = explode(",", $request->input('tags'));
                    for ($i = 0; $i < count($tags); $i++) {
                        $assetTagArr[] = [
                            'description' => $tags[$i]
                        ];
                    }
                    $asset->asset_tags()->createMany($assetTagArr);
                }
            }


            if ($asset_category_id == AssetCategory::Accommodation) {
                $assetAccommodationInfo->asset_id = $asset->id;
                $assetAccommodationInfo->guest_name = $request->input('guest_name');
                $assetAccommodationInfo->number_of_guest = $request->input('number_of_guest');
                $assetAccommodationInfo->number_of_night = $this->calculateNumberOfNight($request->input('check_in_datetime'), $request->input('check_out_date'));
                $assetAccommodationInfo->confirmation_number = $request->input('confirmation_number');
                $assetAccommodationInfo->venue_phone = $request->input('venue_phone');
                $assetAccommodationInfo->cancellation_cost = $request->input('cancellation_cost');
                $assetAccommodationInfo->website = $request->input('website');
                $assetAccommodationInfo->cancellation_policy = $request->input('cancellation_policy');
                $assetAccommodationInfo->save();

            } elseif ($asset_category_id == AssetCategory::Dining) {
                $assetDiningInfo->asset_id = $asset->id;
                $assetDiningInfo->guest_name = $request->input('guest_name');
                $assetDiningInfo->number_of_guest = $request->input('number_of_guest');
                $assetDiningInfo->guest_email = $request->input('guest_email');
                $assetDiningInfo->guest_phone = $request->input('guest_phone');
                $assetDiningInfo->menu_highlights = $request->input('menu_highlights');
                $assetDiningInfo->venue_phone = $request->input('venue_phone');
                $assetDiningInfo->cancellation_policy = $request->input('cancellation_policy');
                $assetDiningInfo->save();
            } elseif ($asset_category_id == AssetCategory::Event) {
                $assetEventInfo->asset_id = $asset->id;
                $assetEventInfo->event_name = $request->input('event_name');
                $assetEventInfo->event_type = $request->input('event_type');
                $assetEventInfo->ticket_holder = $request->input('ticket_holder');
                $assetEventInfo->number_of_seats = $request->input('number_of_seats');
                $assetEventInfo->seat_area = $request->input('seat_area');
                $assetEventInfo->venue_layout = $request->input('venue_layout');
                $assetEventInfo->cancellation_policy = $request->input('cancellation_policy');
                $assetEventInfo->total_paid = $request->input('total_paid');
                $assetEventInfo->venue_amenities = $request->input('venue_amenities');
                $assetEventInfo->save();
            } elseif ($asset_category_id == AssetCategory::Miscellaneous) {
                $assetMiscellaneousInfo->asset_id = $asset->id;
                $assetMiscellaneousInfo->display_date = $asset::format_date($request->input('display_date'));
                $assetMiscellaneousInfo->event_name = $request->input('event_name');
                $assetMiscellaneousInfo->event_type = $request->input('event_type');
                $assetMiscellaneousInfo->ticket_holder = $request->input('ticket_holder');
                $assetMiscellaneousInfo->number_of_seats = $request->input('number_of_seats');
                $assetMiscellaneousInfo->seat_area = $request->input('seat_area');
                $assetMiscellaneousInfo->multiple_locations = $request->input('multiple_locations');
                $assetMiscellaneousInfo->total_paid = $request->input('total_paid');
                $assetMiscellaneousInfo->venue_layout = $request->input('venue_layout');
                $assetMiscellaneousInfo->cancellation_policy = $request->input('cancellation_policy');
                $assetMiscellaneousInfo->save();
            }

            // upload images
            if ($request->hasfile('images')) {
                $this->fileUpload($request, $asset);
            }
            if ($request->input('id') != null) {
                if (!is_null($request->input('imagesRemove'))) {
                    $imagesRemove = explode(",", $request->input('imagesRemove'));
                    for ($i = 0; $i < count($imagesRemove); $i++) {
                        if ($imagesRemove[$i] > 0) {
                            AssetImage::where('id', $imagesRemove[$i])->delete();
                        }
                    }
                }
            }
            // upload images with url
            if ($request->vendor_images != null) {
                $urls = [];
                $imageTempUrls = explode(',', $request->vendor_images);
                foreach ($imageTempUrls as $url) {
                    $urls[] = Storage::cloud()->url($url);
                }
                $this->fileUploadWithUrl($urls, $asset);
            }

            DB::commit();

            return response()->json(['response' => "success", 'id' => $asset->id]);
        } catch (\Exception $e) {
            // return $e;
            DB::rollback();
            // something went wrong
            // return redirect()->back()->withInput();
            return $e->getMessage();
            return response()->json(['response' => "error", "errors" => $e]);
        } catch (\Throwable $e) {
            // return $e;
            DB::rollback();
            // something went wrong
            // return redirect()->back()->withInput();
            return $e->getMessage();
            return response()->json(['response' => "error", "errors" => $e]);
        }
    }


    public function fileUpload(Request $request, Asset $asset)
    {
        $images = $request->file('images');

        foreach ($images as $image) {
            $asset->asset_images()->create(
                [
                    'image_relative_url' => AssetImage::saveImageOnCloud($image, $asset),
                    'name' => $image->getClientOriginalName()
                ]
            );
        }
    }

    public function fileUploadWithUrl($urls, Asset $asset)
    {

        foreach ($urls as $url) {
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            $asset->asset_images()->create(
                [
                    'image_relative_url' => AssetImage::saveImageOnCloudWithUrl($name, $asset, $contents),
                    'name' => $name
                ]
            );
        }
    }

    public function createNewSeller(Request $request)
    {
        // Create new seller
        $member = new Member;
        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->email = null;
        $member->msisdn = Member::phoneToMsisdn(fake()->e164PhoneNumber . rand(1000, 800000));
        $member->member_status_id = MemberStatus::Active;
        if ($member->save()) {
            $name = $request->input('first_name') . ' ' . $request->input('last_name');

            return response()->json(['response' => "success", "member" => ['id' => $member->id, 'name' => $name]]);
        } else {
            return response()->json(['response' => "error"]);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function getReceivedAssetList($id)
    {
        $message = Asset::find($id)->getShareableMessageSample();
        $asset = Asset::with('assetCategory')->where('id', $id)->first();
        $asset->checkInDatetime = Asset::format_date_frontend($asset->checkInDatetime);
        $member_ids = Member::all()->pluck('id')->toArray();
        $memberWithoutAsset = AssetReceiver::getMembersWithIdNotSent($member_ids, $id);
        $assetReceiverList = AssetReceiver::getAssetReceiverList($id);
        $memberGroupList = ContactGroup::getGroupsWithNotShareAsset($id);
        return array('memberGroupList' => $memberGroupList, 'message' => $message, 'asset' => $asset, 'memberWithoutAsset' => $memberWithoutAsset, 'assetReceiverList' => $assetReceiverList);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function assetShare(Request $request)
    {
        try {

            $member_ids = $request->member_ids;

            if ($request->shareOption == 'groups') {
                $member_ids = [];
                foreach ($request->group_ids as $group) {
                    $member_ids = array_merge($member_ids, MemberGroup::where('contact_group_id', $group)->pluck('member_id')->toArray());
                }
            }
            AssetReceiver::sendAsset($request->asset_id, $request->share_asset_message, $member_ids);
            dispatch(function () {
                SyncMessageBirdMessagesCommand::loadToday();
            });
            return response()->json(['response' => "success", "message" => 'Asset share successfully.', 'asset_id' => $request->asset_id],);

        } catch (\Exception $e) {
            return response()->json(['response' => "error", "message" => $e->getMessage(), 'asset_id' => $request->asset_id]);
        }
    }

    public function shareAssets($uuid)
    {
        $assets = new Asset;
        $asset = $assets->getByUUID($uuid);
        $category = $asset->assetCategory->description;
        if ($asset) {
            if ($category == 'Accommodation') {
                return view('assets.previewAccommodation', ['asset' => $asset]);
            } elseif ($category == 'Dining') {
                return view('assets.previewDiningn', ['asset' => $asset]);
            } elseif ($category == 'Event') {
                return view('assets.previewEvent', ['asset' => $asset]);
            } elseif ($category == 'Miscellaneous') {
                return view('assets.previewMisc', ['asset' => $asset]);
            }
        }
        return redirect()->back();
    }

    public function calculateNumberOfNight($fromDate, $toDate)
    {
        $fromDate = Carbon::parse($fromDate);
        $toDate = Carbon::parse($toDate);
        // this calculates the diff between two dates, which is the number of nights
        return $toDate->diff($fromDate)->format("%a");

    }
}
