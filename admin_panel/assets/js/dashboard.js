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
        url: "?controller=Admin&function=pending_count",
        datatype: "json",
        success: function (data) {
            obj = JSON.parse(data);
            var len = obj.length;
            if (obj !== 'empty') {
                for (var i = 0; i < len; i++) {
                    $("#pending_count").text(obj[i].pending_count);
                }
            }
            else {
                $("#pending_count").text(0);
            }

        }
    })
    $.ajax({
        type: "GET",
        url: "?controller=Admin&function=complete_count",
        datatype: "json",
        success: function (data) {
            obj = JSON.parse(data);
            var len = obj.length;
            if (obj !== 'empty') {
                for (var i = 0; i < len; i++) {
                    $("#complete_count").text(obj[i].complete_count);
                }
            }
            else {
                $("#complete_count").text(0);
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