
<style>
    .text-white{
        color: white !important;
    }
    .bg-theme-primary{
        background: #4d5997 !important;
    }

    .supplierList ul .text-white a:hover{
        background-color:transparent !important;
    }
</style>

<div id="current_vendor" >
    <div class="d-flex align-items-center justify-content-end">
        <a href="{{ route('library_edit',($vendor->id) ? $vendor->id : '') }}"
           class="btn btn-link  px-4 py-2 me-3 rounded-10px text-decoration-none editSupplierBtn">
            Edit Supplier
        </a>
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--             stroke-linejoin="round" class="feather feather-more-vertical">--}}
{{--            <circle cx="12" cy="12" r="1"></circle>--}}
{{--            <circle cx="12" cy="5" r="1"></circle>--}}
{{--            <circle cx="12" cy="19" r="1"></circle>--}}
{{--        </svg>--}}
    </div>
    <div class="d-flex flex-column w-100 mt-4">
        <div class="rowSupplierProfile pt-2">
            <div class="column">
                <div class="photo-column">
                    <img class="img-fluid rounded-circle"
                         src="{{$vendor->logo->image_url ?? asset('assets/images/image-8.png')}}" alt="Image description">
                </div>
            </div>
            <div class='double-column'>
                <div class='details-column'>
                    <h4 class="text-natural-gray-7 mb-2">{{ @$vendor->name }}</h4>
                    <span class="vendor_alias ">({{ $vendor->alias }})</span>
                    <span class="text-natural-gray-7 opacity-50">{{ @$vendor->type }}</span>
                    <p class="mt-1">{{ @$vendor->description }}</p>
                </div>
            </div>
        </div>
        <div class="row general-info mt-5">
            <h3 class="title text-natural-gray-7 opacity-50 fw-700 mb-3">GENERAL INFO
            </h3>
            <div class="col-sm-6">
                <div>
                    <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Email</p>
                    <p class="email fw-700">{{ @$vendor->email }}</p>
                </div>
                <div class="mt-3">
                    <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Address</p>
                    <p class="text-natural-gray-7 opacity-50 fw-400">{{ @$vendor->address }}</p>
                </div>
                <div class="mt-3">
                    <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Timezone</p>
                    <p class="text-natural-gray-7 opacity-50 fw-400">{{ @$vendor->timezone->description }}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Website</p>
                    <p class="text-natural-gray-7 opacity-50 fw-400">{{ @$vendor->website }}</p>
                </div>
                <div class="mt-3">
                    <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Added on</p>
                    <p class="text-natural-gray-7 opacity-50 fw-400">
                        {{ ($vendor) ? $vendor->created_at->toDayDateTimeString() : '' }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex flex-column w-100">
        <p class="text-tags text-natural-gray-7 fw-700 opacity-50">TAGS</p>
        <div class="pt-2">
            <?php
            $tags = explode(',', @$vendor->tags)
            ?>
            @foreach($tags as $tag)
                <span class="badge badge-purple mb-2">{{ $tag }}</span>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="d-flex flex-column w-100 mt-4 supplierPhoto">
        <p class="text-photos text-natural-gray-7 fw-700 opacity-50">PHOTOS</p>
        <div class="row pt-2 text-center">
            @if( ($vendor->first()) ? $vendor->images->count() : '')
                @foreach($vendor->images as $image)
                    <div class="col-sm-3">
                        <img class="img-fluid" src="{{$image->image_url ?? asset('assets/images/image-8.png')}}"
                             alt="Image description">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
