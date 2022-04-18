$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "?controller=Admin&function=gettotal_user",
        datatype: "json",
        success: function (data) {
            obj = JSON.parse(data);
            var len = obj.length;
            if (obj !== 'empty') {
                for (var i = 0; i < len; i++) {
                    $("#total_user").text(obj[i].TOTAL_USER);
                }
            }
            else {
                $("#total_user").text(0);
            }

        }
    })
    $.ajax({
        type: "GET",
        url: "?controller=Admin&function=gettotal_product",
        datatype: "json",
        success: function (data) {
            obj = JSON.parse(data);
            var len = obj.length;
            if (obj !== 'empty') {
                for (var i = 0; i < len; i++) {
                    $("#total_product").text(obj[i].TOTAL_PRODUCT);
                }
            }
            else {
                $("#total_product").text(0);
            }

        }
    })
})