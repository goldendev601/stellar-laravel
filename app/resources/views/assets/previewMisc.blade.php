@extends('layouts.authentication.master')
@section('title', 'Assets Preview')

@section('css')
<style>

.seatChartImg {
    width: 307px;
}

@media only screen and (max-width: 600px) {
    .seatChartImg {
        width: 320px;
        margin-bottom: 40px
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="accoumodaton">
        <div class="row">
            <div class="col-12 mb-3 logoTopDiv">
                <img class="logoTop" src="{{ asset('/assets/images/preview/brandLogo.png') }}">
            </div>
        </div>

        <div class="container px-2 mt-md-5 px-md-5">
            <div class="row">
                <div class="col-12 col-md-6 order-2 order-md-1 pe-md-5">
                    <div class="row">
                        <div class="col-12">
                            <p class="categoryTitle">Miscellaneous</p>
                            <h4 class="asstesName">{{$asset->name}}</h4>
                            <p class="asstesAddress my-4">{{$asset->venue_address}}</p>

                            <div class="asstesDescription">
                                <p>{!! $asset->description !!}</p>
                            </div>
                        </div>
                    </div>
                    @if($asset->asset_status_id == App\ModelsExtended\AssetStatus::Available)
                    <div class="row">
                        <div class="col-12">
                            <hr class="d-md-none mt-3">
                            <p class="dateTitle">Date</p>
                            <p class="date">
                                {{$asset->asset_miscellaneous_info['display_date']}}
                            </p>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-3 titleNumberOfNight">NUMBER OF SEATS</p>
                                    <div class="d-flex">
                                        <p class="titleNumberOfNightDetaisIcon"><i class="fa fa-user me-2"
                                                aria-hidden="true"></i>
                                        </p>
                                        <p class="titleNumberOfNightDetais">{{$asset->asset_miscellaneous_info['number_of_seats'] ? $asset->asset_miscellaneous_info['number_of_seats']:0}}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class="mb-3 titlePrice">COST DETAILS</p>
                                    <div class="d-flex priceInfoWrapper">
                                        <p class="priceDetailsUnit">{{ $asset->asset_cost->cost_details }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex btnInquiryDiv align-items-center justify-content-center my-3">
                                <button class="btnInquiry" id="makeInquiryBtnMisc" onclick="openInquireModal();">MAKE INQUIRE </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($asset->asset_status_id == App\ModelsExtended\AssetStatus::Sold || $asset->asset_status_id == App\ModelsExtended\AssetStatus::Expired)
                    <div class="row">
                        <div class="col-12">
                            <hr class="d-md-none mt-3">
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <p class="blankNotification">
                                        Well, that’s disappointing. This asset is no longer available.
                                    </p>
                                </div>

                            </div>
                            <div class="d-flex align-items-center justify-content-center my-5">
                                <button class="btnInquiry">FIND MORE ASSETS </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-12 col-md-6 ps-md-5 order-1 order-md-2 mb-4 mb-sm-0"
                    style=" display: flex; flex-direction: column; align-items: center; ">
                    @if(count($asset->asset_images)>0)
                    <img class="coverPhoto" src="{{$asset->asset_images[0]->image_url}}" alt="PHOTO">
                    @else
                    <img class="coverPhoto" src="{{asset('/assets/images/preview/misc-blank.png')}}">
                    @endif


                    <div class="container imgSlider px-0 mt-2">
                        <div class="nav-scroller-wrapper">
                            <nav class="nav-scroller">
                                <div class="nav-scroller-content">
                                    @if(count($asset->asset_images)>1)
                                    @foreach($asset->asset_images as $image)
                                    <a href="javascript:void(0)" class="nav-scroller-item"
                                        onclick="openModal();currentSlide(3)"><img src="{{$image->image_url}}"
                                            alt="Image description"></a>
                                    @endforeach
                                    @endif
                                </div>
                            </nav>
                            <a href="javascript:void(0)" class="nav-scroller-btn nav-scroller-btn--left"><i
                                    data-feather="chevron-left"></i></a>
                            <a class=" nav-scroller-btn nav-scroller-btn--right"><i
                                    data-feather="chevron-right"></i></a>
                        </div>
                    </div>
                </div>

                @if($asset->asset_status_id == App\ModelsExtended\AssetStatus::Available)
                    @if($asset->asset_miscellaneous_info->venue_layout != '')
                        <div class="col-12 col-md-6 pe-md-5 moreInformation mt-5 order-3 order-md-3">
                            <h5>SEATING CHART</h5>
                            <img class="mt-3 seatChartImg" src="{{ $asset->asset_miscellaneous_info->venue_layout  }}">
                        </div>
                    @endif
                   @if($asset->notes != '')
                    <div class="col-12 col-md-6 ps-md-5 moreInformation mt-2 mt-md-5 order-4 order-md-4">
                        <hr class="d-md-none mt-3">
                        <h5>IMPORTANT EVENT INFORMATION</h5>
                        <p>{{$asset->notes}}</p>
                    </div>
                    @endif

                    @if($asset->asset_miscellaneous_info->multiple_locations != '')
                        <div class="col-12 col-md-6 ps-md-5 moreInformation mt-2 mt-md-5 order-4 order-md-4">
                            <hr class="d-md-none mt-3">
                            <h5>MULTIPLE LOCATIONS</h5>
                            <p>{{$asset->asset_miscellaneous_info->multiple_locations}}</p>
                        </div>
                    @endif
                    @if($asset->asset_miscellaneous_info->cancellation_policy != '')
                        <div class="col-12 col-md-6 ps-md-5 moreInformation mt-2 mt-md-5 order-4 order-md-4">
                            <hr class="d-md-none mt-3">
                            <h5><a class="cancellation_policy_link" href="{{$asset->asset_miscellaneous_info->cancellation_policy}}">CANCELLATION POLICY</a></h5>

                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="row d-flex align-items-end previewfooter">
            <div class="col-6">
                <img class="logoTop" src="{{ asset('/assets/images/preview/brandLogo.png') }}">
            </div>
            <div class="col-6 d-flex justify-content-end">
                <p class="m-0">Stellar 2022. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background:#000;">
            <div class="row">
                @foreach($asset->asset_images as $key=>$image)
                <div class="mySlides" data-id="{{$key+1}}">
                    <div class="row mb-2">
                        <div class="col-6 col-sm-6">
                            <div class="numbertext">{{$key+1}} /
                                {{count($asset->asset_images)}}</div>
                        </div>
                        <div class="col-6 col-sm-6" style="text-align: right;">
                            <span class="close cursor" onclick="closeModal()">&times;</span>
                        </div>
                    </div>
                    <img src="{{$image->image_url}}" alt="Image description">
                </div>
                @endforeach
                <a class="prev" onclick="plusSlides(-1)"><i data-feather="arrow-left"></i></a>
                <a class="next" onclick="plusSlides(1)"><i data-feather="arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
<div id="make-inquire-popup" class="modal make-inquire-popup">
    <div class="vue-container">
        <make-inquire :asset_id="{{ json_encode($asset->id)}}"></make-inquire>
    </div>
</div>
@endsection



@section('script')

<script>
    function openInquireModal() {
        document.getElementById("make-inquire-popup").style.display = "block";
    }
    function closeInquireModal() {
        document.getElementById("make-inquire-popup").style.display = "none";
    }
    $('.message-btn-rect').click(function () {
        $('.default-question-list').hide();
        $('.message-input-wrapper').show();
    });
    $('.question-item-btn-wrapper').click(function () {
        $('.default-question-list').hide();
        $('.message-input-wrapper').show();
    });
    $('.question-btn-1').click(function () {
        $('.question-msg-1').show();
    });
    $('.question-btn-2').click(function () {
        $('.question-msg-2').show();
    });
    $('.question-btn-3').click(function () {
        $('.question-msg-3').show();
    });
</script>

<script>
var slideIndex = 1;


function openModal() {
    slideIndex = 1;
    document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    slideIndex = 1;
    document.getElementById("myModal").style.display = "none";
}


showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);

}

function showSlides(n) {
    var i;

    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slides[slideIndex - 1].style.display = "block";

}
</script>


<script>
/**
  Horizontal scrolling menu.

  @param {Object} object - Container for all options.
  @param {string || DOM node} wrapperSelector - Container element selector.
  @param {string} selector - Scroller element selector.
  @param {string} contentSelector - Scroller content element selector.
  @param {string} buttonLeftSelector - Left button selector.
  @param {string} buttonRightSelector - Right button selector.
  @param {integer} scrollStep - Amount to scroll on button click.
*/


const navScroller = function({
    wrapperSelector: wrapperSelector = '.nav-scroller-wrapper',
    selector: selector = '.nav-scroller',
    contentSelector: contentSelector = '.nav-scroller-content',
    buttonLeftSelector: buttonLeftSelector = '.nav-scroller-btn--left',
    buttonRightSelector: buttonRightSelector = '.nav-scroller-btn--right',
    scrollStep: scrollStep = 75
} = {}) {

    let scrolling = false;
    let scrollingDirection = '';
    let scrollOverflow = '';
    let timeout;

    let navScrollerWrapper;

    if (wrapperSelector.nodeType === 1) {
        navScrollerWrapper = wrapperSelector;
    } else {
        navScrollerWrapper = document.querySelector(wrapperSelector);
    }
    if (navScrollerWrapper === undefined || navScrollerWrapper === null) return;

    let navScroller = navScrollerWrapper.querySelector(selector);
    let navScrollerContent = navScrollerWrapper.querySelector(contentSelector);
    let navScrollerLeft = navScrollerWrapper.querySelector(buttonLeftSelector);
    let navScrollerRight = navScrollerWrapper.querySelector(buttonRightSelector);


    // Sets overflow
    const setOverflow = function() {
        scrollOverflow = getOverflow(navScrollerContent, navScroller);
        toggleButtons(scrollOverflow);
    }


    // Debounce setting the overflow with requestAnimationFrame
    const requestSetOverflow = function() {
        if (timeout) {
            window.cancelAnimationFrame(timeout);
        }

        timeout = window.requestAnimationFrame(() => {
            setOverflow();
        });
    }


    // Get overflow value on scroller
    const getOverflow = function(content, container) {
        let containerMetrics = container.getBoundingClientRect();
        let containerWidth = containerMetrics.width;
        let containerMetricsLeft = Math.floor(containerMetrics.left);

        let contentMetrics = content.getBoundingClientRect();
        let contentMetricsRight = Math.floor(contentMetrics.right);
        let contentMetricsLeft = Math.floor(contentMetrics.left);

        // Offset the values by the left value of the container
        let offset = containerMetricsLeft;
        containerMetricsLeft -= offset;
        contentMetricsRight -= offset + 1; // Due to an off by one bug in iOS
        contentMetricsLeft -= offset;

        // console.log (containerMetricsLeft, contentMetricsLeft, containerWidth, contentMetricsRight);

        if (containerMetricsLeft > contentMetricsLeft && containerWidth < contentMetricsRight) {
            return 'both';
        } else if (contentMetricsLeft < containerMetricsLeft) {
            return 'left';
        } else if (contentMetricsRight > containerWidth) {
            return 'right';
        } else {
            return 'none';
        }
    }


    // Move the scroller with a transform
    const moveScroller = function(direction) {
        if (scrolling === true) return;

        setOverflow();

        let scrollDistance = scrollStep;
        let scrollAvailable;


        if (scrollOverflow === direction || scrollOverflow === 'both') {

            if (direction === 'left') {
                scrollAvailable = navScroller.scrollLeft;
            }

            if (direction === 'right') {
                let navScrollerRightEdge = navScroller.getBoundingClientRect().right;
                let navScrollerContentRightEdge = navScrollerContent.getBoundingClientRect().right;

                scrollAvailable = Math.floor(navScrollerContentRightEdge - navScrollerRightEdge);
            }

            // If there is less that 1.5 steps available then scroll the full way
            if (scrollAvailable < (scrollStep * 1.5)) {
                scrollDistance = scrollAvailable;
            }

            if (direction === 'right') {
                scrollDistance *= -1;
            }

            navScrollerContent.classList.remove('no-transition');
            navScrollerContent.style.transform = 'translateX(' + scrollDistance + 'px)';

            scrollingDirection = direction;
            scrolling = true;
        }

    }


    // Set the scroller position and removes transform, called after moveScroller()
    const setScrollerPosition = function() {
        var style = window.getComputedStyle(navScrollerContent, null);
        var transform = style.getPropertyValue('transform');
        var transformValue = Math.abs(parseInt(transform.split(',')[4]) || 0);

        if (scrollingDirection === 'left') {
            transformValue *= -1;
        }

        navScrollerContent.classList.add('no-transition');
        navScrollerContent.style.transform = '';
        navScroller.scrollLeft = navScroller.scrollLeft + transformValue;
        navScrollerContent.classList.remove('no-transition');

        scrolling = false;
    }


    // Toggle buttons depending on overflow
    const toggleButtons = function(overflow) {
        navScrollerLeft.classList.remove('active');
        navScrollerRight.classList.remove('active');

        if (overflow === 'both' || overflow === 'left') {
            navScrollerLeft.classList.add('active');
        }

        if (overflow === 'both' || overflow === 'right') {
            navScrollerRight.classList.add('active');
        }
    }


    const init = function() {

        // Determine scroll overflow
        setOverflow();

        // Scroll listener
        navScroller.addEventListener('scroll', () => {
            requestSetOverflow();
        });

        // Resize listener
        window.addEventListener('resize', () => {
            requestSetOverflow();
        });

        // Button listeners
        navScrollerLeft.addEventListener('click', () => {
            moveScroller('left');
        });

        navScrollerRight.addEventListener('click', () => {
            moveScroller('right');
        });

        // Set scroller position
        navScrollerContent.addEventListener('transitionend', () => {
            setScrollerPosition();
        });

    };

    // Init is called by default
    init();


    // Reveal API
    return {
        init
    };
};

const navScrollerTest = navScroller();

var totalImg = "{{count($asset->asset_images)}}";
if (totalImg > 1) {
    setInterval(function() {

        var src = $('.nav-scroller-content > a:first')
            .next().attr('data-src');
        $(".coverPhoto").attr("src", src);
        if (totalImg > 4) {
            $('.nav-scroller-btn').addClass('active')
        } else {
            $('.nav-scroller-btn').removeClass('active')
        }


        $('.nav-scroller-content > a:first')
            .next()
            .fadeIn(1000)
            .end()
            .appendTo('.nav-scroller-content');
    }, 3000);
}
</script>
@endsection
