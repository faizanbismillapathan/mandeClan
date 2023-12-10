$(document).ready(function() {
    $(".dropdown-toggle").click(function() {
        $(".drop-menu").toggle("slow, 200")
    }), $(".drop-menu .dropdown-item").click(function() {
        $(".drop-menu").hide("slow, 200")
    });
    var e = 0;
    $("#minus").click(function() {
            e--, $("#theCount").text(e), e < 1 && ($(".counter-div").hide(), $(".addtocard").show())
        })/*, $("#myinput2").on("input", function() {
            var e = $("#myinput2").val();
            /^[7-9][0-9]{9}$/.test(e) ? ($(".name").show(), $(".validation").hide(), $(".login-signup-popup .login-signup-div").css("padding", "40px")) : ($(".validation").show(), $(".name").hide())
        })*/, $("#myinput3").on("input", function() {
            $(this).val() ? $(".next1").removeAttr("disabled") : $(".next1").attr("disabled", "disabled")
        }), $(".shipping-address .guest-user-tab, .shipping-address .guest-user-tab-link").click(function() {
            $(".shipping-address .address-book").hide(), $(".shipping-address .guest-User").show()
        }), $(".shipping-address .address-book-tab").click(function() {
            $(".shipping-address .address-book").show(), $(".shipping-address .guest-User").hide()
        }), $(".checkout-page .delivery-method .home-delivery").click(function() {
            $(".checkout-page .shipping-address-div").show(), $(".checkout-page .self-pickup-btn").hide()
        }), $(".checkout-page .delivery-method .selfpickup").click(function() {
            $(".checkout-page .shipping-address-div").hide(), $(".checkout-page .self-pickup-btn").show()
        }), $("#scrollToTop").hide(), $(window).scroll(function() {
            $(this).scrollTop() > 100 ? $("#scrollToTop").show().fadeIn() : $("#scrollToTop").fadeOut().hide()
        }), $("#scrollToTop").click(function() {
            return $("html, body").animate({
                scrollTop: 0
            }, 360), !1
        }), $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(e) {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var o = $(this.hash);
                (o = o.length ? o : $("[name=" + this.hash.slice(1) + "]")).length && (e.preventDefault(), $("html, body").animate({
                    scrollTop: o.offset().top
                }, 1e3, function() {
                    var e = $(o);
                    if (e.focus(), e.is(":focus")) return !1;
                    e.attr("tabindex", "-1"), e.focus()
                }))
            }
        }),
        $(".mobile-menu .menu-bar").click(function() {
            $(".mobile-header").animate({
                width: "show"
            }, 500), $(".mobile-header-overlay").show(), $("body").css("overflow", "hidden")
        }), $(".mobile-header .close-btn").click(function() {
            $(".mobile-header").animate({
                width: "hide"
            }, 200), $(".mobile-header-overlay").hide(), $("body").css("overflow", "scroll")
        }),
        $(".mobile-filter-fab, .performance-bar .fas").click(function() {
            $(".mobile-filter").show("slow"),
                $(".filter-overlay, .scrolldiv_close").show("slow"),
                $("body").css("overflow", "hidden")
        }),
        $(".mobile-filter .close-btn, .scrolldiv_close").click(function() {
            $(".mobile-filter").hide("slow"),
                $(".filter-overlay, .scrolldiv_close").hide("slow"),
                $("body").css("overflow", "scroll")
        })
});
$(document).ready(function() {
    $(".dropdown-toggle").click(function() {
        $(".drop-menu").toggle("slow, 200")
    }), $(".drop-menu .dropdown-item").click(function() {
        $(".drop-menu").hide("slow, 200")
    });
    var e = 0;
    $("#minus").click(function() {
            e--, $("#theCount").text(e), e < 1 && ($(".counter-div").hide(), $(".addtocard").show())
        })/*, $("#myinput2").on("input", function() {
            var e = $("#myinput2").val();
            /^[7-9][0-9]{9}$/.test(e) ? ($(".name").show(), $(".validation").hide(), $(".login-signup-popup .login-signup-div").css("padding", "40px")) : ($(".validation").show(), $(".name").hide())
        })*/, $("#myinput3").on("input", function() {
            $(this).val() ? $(".next1").removeAttr("disabled") : $(".next1").attr("disabled", "disabled")
        }), $(".shipping-address .guest-user-tab, .shipping-address .guest-user-tab-link").click(function() {
            $(".shipping-address .address-book").hide(), $(".shipping-address .guest-User").show()
        }), $(".shipping-address .address-book-tab").click(function() {
            $(".shipping-address .address-book").show(), $(".shipping-address .guest-User").hide()
        }), $(".checkout-page .delivery-method .home-delivery").click(function() {
            $(".checkout-page .shipping-address-div").show(), $(".checkout-page .self-pickup-btn").hide()
        }), $(".checkout-page .delivery-method .selfpickup").click(function() {
            $(".checkout-page .shipping-address-div").hide(), $(".checkout-page .self-pickup-btn").show()
        }), $("#scrollToTop").hide(), $(window).scroll(function() {
            $(this).scrollTop() > 100 ? $("#scrollToTop").show().fadeIn() : $("#scrollToTop").fadeOut().hide()
        }), $("#scrollToTop").click(function() {
            return $("html, body").animate({
                scrollTop: 0
            }, 360), !1
        }), $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(e) {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var o = $(this.hash);
                (o = o.length ? o : $("[name=" + this.hash.slice(1) + "]")).length && (e.preventDefault(), $("html, body").animate({
                    scrollTop: o.offset().top
                }, 1e3, function() {
                    var e = $(o);
                    if (e.focus(), e.is(":focus")) return !1;
                    e.attr("tabindex", "-1"), e.focus()
                }))
            }
        }), $(".mobile-menu .menu-bar").click(function() {
            $(".mobile-header").animate({
                width: "show"
            }, 500), $(".mobile-header-overlay").show(), $("body").css("overflow", "hidden")
        }), $(".mobile-header .close-btn").click(function() {
            $(".mobile-header").animate({
                width: "hide"
            }, 200), $(".mobile-header-overlay").hide(), $("body").css("overflow", "scroll")
        }),
        $(".mobile-filter-fab, .performance-bar .fas").click(function() {
            $(".mobile-filter").show("slow"),
                $(".filter-overlay, .scrolldiv_close").show("slow"),
                $("body").css("overflow", "hidden")
        }),
        $(".mobile-filter .close-btn, .scrolldiv_close, .close-btn").click(function() {
            $(".mobile-filter").hide("slow"),
                $(".filter-overlay, .scrolldiv_close").hide("slow"),
                $("body").css("overflow", "scroll")
        })
});