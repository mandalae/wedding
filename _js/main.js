var overlayTimeout = null;
$(function () {

    $(".js-brandsButton").bind('mouseenter', function (e) {
        clearTimeout(overlayTimeout);
        $(".overlay").hide();
        $(this).find(".overlay").slideDown('fast');
    });

    $(".js-brandsButton").bind('mouseleave', function (e) {
        overlayTimeout = setTimeout(function () {
            $("#brand-overlay").hide();
        }, 500)
    });

    $(".js-categoryButton").bind('mouseenter', function (e) {
        clearTimeout(overlayTimeout);
        $(".overlay").hide();
        $(this).find(".overlay").slideDown('fast');
    });

    $(".js-categoryButton").bind('mouseleave', function (e) {
        overlayTimeout = setTimeout(function () {
            $("#category-overlay").hide();
        }, 500)
    });

    $(".js-aquatronButton").bind('mouseenter', function (e) {
        clearTimeout(overlayTimeout);
        $(".overlay").hide();
        $(this).find(".overlay").slideDown('fast');
    });

    $(".js-aquatronButton").bind('mouseleave', function (e) {
        overlayTimeout = setTimeout(function () {
            $("#aquatron-overlay").hide();
        }, 500)
    });

    $(".js-courseButton").bind('mouseenter', function (e) {
        clearTimeout(overlayTimeout);
        $(".overlay").hide();
        $(this).find(".overlay").slideDown('fast');
    });

    $(".js-courseButton").bind('mouseleave', function (e) {
        overlayTimeout = setTimeout(function () {
            $("#course-overlay").hide();
        }, 500)
    });

    setInterval(function () {
        var current = $("#teaser ul li:visible");
        var next = current.next();

        if (next.length == 0) {
            next = $("#teaser ul li:first");
        }

        current.fadeOut('fast');
        next.fadeIn('fast');
    }, 10000);

    $("#priceRange").slider({
        range: true,
        min: 0,
        max: 1000,
        values: [0, 1000],
        slide: function (event, ui) {
            $("#amount").val("\u00A3" + ui.values[0] + " - $" + ui.values[1]);
        }
    });

    $("#amount").val("\u00A3" + $("#priceRange").slider("values", 0) +
        " - \u00A3" + $("#priceRange").slider("values", 1));

    $("#update-products").bind('click', function (e) {
        $.post('/_feeds/product-list.php', {
            brandId: $("#product-brands").val(),
            categoryId: $("#product-categories").val(),
            lowerPrice: $("#priceRange").slider("values", 0),
            upperPrice: $("#priceRange").slider("values", 1),
            query: $('#query').val()
        }, function (html) {
            $("#product-list").html(html);
        });
    });

});