function ajaxLoadData() {
    $(".js-load").each(function() {
        if (isOnScreen($(this)) && $(this).hasClass('loaded') == false) {
            var holder = $(this).attr("data-holder");
            var type = $(this).attr('data-type');
            var url = $(this).attr("data-url");

            //begin ajax
            getDataHome(url, holder, true);

            //ajax stop
            $(document).ajaxStop(function() {
                runLazyLoad()
                if (type != undefined && type === 'slide'){
                    switch (holder) {
                        case '#service-online-slide':
                            var servicesSlide = new Swiper(".js--services-slide .mySwiper", {
                                // centeredSlides: true,
                                // centeredSlidesBounds: true,
                                autoplay: true,
                                loop: true,
                                breakpoints: {
                                    320: {
                                        spaceBetween: 10,
                                        slidesPerView: 1.25,
                                    },
                                    576: {
                                        spaceBetween: 15,
                                        slidesPerView: 2,
                                    },
                                    768: {
                                        spaceBetween: 10,
                                        slidesPerView: 3,
                                    },
                                    1680: {
                                        spaceBetween: 30,
                                        slidesPerView: 5,
                                    },
                                },
                                navigation: {
                                    nextEl: ".js--services-slide .swiper-button-next",
                                    prevEl: ".js--services-slide .swiper-button-prev",
                                },
                                pagination: {
                                    el: ".js--services-slide .swiper-pagination",
                                    clickable: true,
                                },
                            });
                            break;
                        case '#lawyer-slide':
                            var servicesSlide = new Swiper(".js--loyal-slide .mySwiper", {
                                // centeredSlides: true,
                                // centeredSlidesBounds: true,
                                // autoplay: true,
                                breakpoints: {
                                    320: {
                                        spaceBetween: 10,
                                        slidesPerView: 2,
                                    },
                                    576: {
                                        spaceBetween: 15,
                                        slidesPerView: 3,
                                    },
                                    992: {
                                        spaceBetween: 10,
                                        slidesPerView: 4,
                                    },
                                    1680: {
                                        spaceBetween: 30,
                                        slidesPerView: 6,
                                    },
                                },
                                navigation: {
                                    nextEl: ".js--loyal-slide .swiper-button-next",
                                    prevEl: ".js--loyal-slide .swiper-button-prev",
                                },
                            });
                            break;
                        case '#feedback-slide':
                            var swiperReview = new Swiper("#swiperReview", {
                                spaceBetween: 0,
                                slidesPerView: 1,
                                autoHeight: false,
                                pagination: {
                                    el: "#swiperReview .swiper-pagination",
                                    clickable: true,
                                }
                            });
                            break;
                    }
                }
                if (type != undefined && type === 'tab'){
                    switch (holder) {
                        case '#news-tab':
                            // clickTabActive('.js--nav-tab-item-index', 'cate', '.js--category-tab-index');
                            break;
                    }
                }
            });

            $(this).addClass('loaded');
        }
    });
}

function ajaxLoadMore(url, holder, holder_empty = true, holder_load, holder_load_empty = true){
    $.getJSON(url, function (result) {
        var data = "";
        var load_more = "";
        if (typeof result.load_more !== 'undefined') load_more = result.load_more;
        if (typeof result.data !== 'undefined') data = result.data;
        if (data == ''){
            return false;
        } else {
            if(holder_empty === true){
                $(holder).empty().html(data);
            }else{
                $(holder).append(data);
            }
        }

        if(holder_load_empty === true){
            $(holder_load).empty().html(load_more);
        }else{
            $(holder_load).append(load_more);
        }

    });
}

function isOnScreen(elem) {
    // if the element doesn't exist, abort
    if (elem.length == 0) {
        return;
    }
    var $window = jQuery(window)
    var viewport_top = $window.scrollTop()
    var viewport_height = $window.height()
    var viewport_bottom = viewport_top + viewport_height
    var $elem = jQuery(elem)
    var top = $elem.offset().top
    var height = $elem.height()
    var bottom = top + height

    return (top >= viewport_top && top < viewport_bottom) ||
        (bottom > viewport_top && bottom <= viewport_bottom) ||
        (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
}

function updateURLParameter(url, param, paramVal) {
    var TheAnchor = null;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";

    if (additionalURL) {
        var tmpAnchor = additionalURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];
        if (TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i = 0; i < tempArray.length; i++) {
            if (tempArray[i].split('=')[0] != param) {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    } else {
        var tmpAnchor = baseURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];

        if (TheParams)
            baseURL = TheParams;
    }

    if (TheAnchor)
        paramVal += "#" + TheAnchor;

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}

function getDataHome(url, holder, holder_empty = false, holder_clear = false, holder_other_empty) {
    $.getJSON(url, function (result) {
        var data = "";
        var cate = "";
        var ward_empty = "";
        if (typeof result.cate !== 'undefined') cate = result.cate;
        if (typeof result.ward_empty !== 'undefined') ward_empty = result.ward_empty;
        if (typeof result.data !== 'undefined') data = result.data;
        if (data == ''){
            if (holder_clear === true){
                // $(holder).empty().html('Không tìm thấy dữ liệu theo yêu cầu .... ')
            }
            return false;
        } else {
            if(holder_empty === true){
                $(holder).empty().html(data);
            }else{
                $(holder).append(data);
            }
        }
        $(holder_other_empty).empty().html(ward_empty)

    });
}

function showModalApply(url, holder, modalID, holder_empty = false) {
    $.getJSON(url, function (result) {
        var data = result;

        if (data == ''){
            return false;
        } else {
            if(holder_empty === true){
                $(holder).empty().html(data);
            }else{
                $(holder).append(data);
            }
            $(modalID).modal('show')
        }

    });
}

function getDataPaginate(url, dom = '', holder_empty = false, page = 1, param_page = 'page') {
    window.history.replaceState('', '', updateURLParameter(window.location.href, param_page, page));
    getDataHome(url, dom, '', holder_empty);
    $(document).ajaxStop(function() {
        runLazyLoad()
    })
}

function runLazyLoad() {
    var imgLazy = document.getElementsByTagName('img');
    for( i=0; i < imgLazy.length; i++)
    {
        imgLazy[i]=imgLazy[i].classList.add("lazy");
    }
    window.lazyLoadOptions = {
        elements_selector: '.lazy',
    };
    $("img.lazy").lazyload();
}

function addCart(ser_id, slug = '', quan, gocart = 0, route = '', route_redirect = '', order_item_id = 0)  {
    if(quan > 0) {
        $.ajax({
            type: 'POST',
            url: route,
            data: {
                _token:ENV.token,
                id:ser_id,
                slug: slug,
                quan:quan,
                order_item_id: order_item_id
            },
            dataType: 'json',
        }).done(function(json) {
            if (json.error == 1) {
                Swal.fire({
                    title: 'Thông báo',
                    text: json.msg,
                    type: 'warning',
                    confirmButtonText: 'Đồng ý',
                    confirmButtonColor: '#f37d26',
                });
            } else {
                if(gocart == 0) {
                    // $('.qty-rece').html(json.data.number)
                    // $('.qty-cart-show').html(json.data.number)
                    // $('.qty-cart-show').show()
                    // $('.qty-rece').html(json.data.number);
                    $('.cart-header .cart-link .cart-count').html(json.data.number);
                    // $('#icon-cart-pop').addClass('bounce-3');
                    // $('#icon-cart-pop').addClass('cart-buyed');
                    Swal.fire({
                        title: 'Thông báo',
                        text: 'Thêm vào giỏ hàng thành công',
                        type: 'success',
                        confirmButtonText: 'Đồng ý',
                        confirmButtonColor: '#006ac5',
                    }).then((result) => {
                        // shop.reload();
                    });
                }else {
                    window.location.href = route_redirect;
                }

            }
        });
    }else {
        Swal.fire({
            title: 'Thông báo',
            text: 'Hãy chọn số lượng',
            type: 'Warning',
            confirmButtonText: 'Đồng ý',
            confirmButtonColor: '#f37d26',
        }).then((result) => {
            // shop.reload();
        });
    }
}

function loadPopup(url, holder, type = 'modal', popup_holder= '', modal_holder = '') {
    $(popup_holder).empty();
    $.getJSON(url, function (result) {
        var data = "";
        if (typeof result.data !== 'undefined') data = result.data;
        $(holder).empty().html(data);
    });
    $(document).ajaxStop(function() {
        if (type != undefined){
            switch (type) {
                case "modal":
                    break;
                case "popup":
                    $(popup_holder).fadeIn();
                    $(popup_holder).find(".popup").addClass("opened");
                    break;
            }
        }
    });
}

function lawyerUpdateTimeline(url, holder, popup_holder ) {
    $(popup_holder).empty();
    $.getJSON(url, function (result) {
        var data = "";
        if (typeof result.data !== 'undefined') data = result.data;
        $(holder).empty().html(data);
    });
    $(document).ajaxStop(function() {
        $(popup_holder).fadeIn();
        $(popup_holder).find(".popup-content").addClass("active");
    });
}
function readURL(input, holder) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(holder).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function popupCancel() {
    $('.popup').fadeOut();
    $('.popup-content').removeClass('active');
}
function uploadAvatar(holder) {
    $(holder+":hidden").trigger("click");
}

function cancelService(url) {
    Swal.fire({
        title: 'Bạn có chắc muốn hủy dịch vụ này?',
        text: "Dịch vụ đã hủy không thể hoàn tác !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.value) {
            $.getJSON(url, function (result) {
                if(result.error == 0) {
                    Swal.fire({
                        type: 'success',
                        title: result.data.title,
                        text: result.data.mess,
                    }).then((result) => {
                        if (result.value) {
                            shop.reload();
                        }
                    })
                }else{
                    Swal.fire(
                        'Error !!!',
                        json.code.mess,
                        'error'
                    )
                }
            });
        }
    })
}

function searchData(url) {
    $.getJSON(url, function (result) {
        if(result.error == 0) {
            shop.redirect(result.data.url)
        }else{
            Swal.fire(
                'Error !!!',
                json.code.mess,
                'error'
            )
        }
    });
}

function closePopup() {

    $(".popup").fadeOut();
    $(".popup-content").removeClass("active");

    $(document).mouseup(function (e) {
        if (
            !$(".style--radius-border").is(e.target) &&
            $(".style--radius-border").has(e.target).length === 0
        ) {
            $(".popup").fadeOut();
            $(".popup-content").removeClass("active");
        }
    });

    $(".js-close-popup").click(function () {
        $(".popup").fadeOut();
        $(".popup-content").removeClass("active");
    });
}

function loginSocical(url) {
    $.getJSON(url, function (result) {
        if(result.error == 0) {
            shop.redirect(result.data.url)
        }else{
            Swal.fire(
                'Error !!!',
                json.code.mess,
                'error'
            )
        }
    });
}