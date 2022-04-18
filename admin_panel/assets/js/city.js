$(document).ready(function () {
    $(document).on('click', '.add_citybtn', function () {
        $(".city_data").hide();
        $(".add_city").css("display", "block");
        $(".page_name").text("Add City");
    })

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Address&function=getcity",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#city_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="city_id">
                     <input type=hidden value="${obj[i].Country_ID}" class="country_id">
                     <input type=hidden value="${obj[i].State_ID}" class="state_id">
                     <td>${number} </td>
                     <td class="name_table">${obj[i].Country} </td>
                     <td class="name_table2">${obj[i].State} </td>
                     <td class="name_table3">${obj[i].City} </td>
                     <td>${obj[i].Created_At} </td>
                     <td>${obj[i].Modified_At}</td>
                     <td><button type="button" class="btn btn-rounded btn-primary edit_city">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_city">Delete</button> </td>
                 </tr>
                     `)).draw();

                    }

                }

            }
        })
    }
    function getcountry() {
        $.ajax({
            type: "GET",
            url: "?controller=Address&function=getcountry",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    for (var i = 0; i < len; i++) {
                        $(".Country").append(`<option value="${obj[i].ID}">${obj[i].Country}</option>`);
                    }
                }
            }
        })
    }
   
    $(document).on('change', '.Country', function () {
        var cid = $(this).val();
        if (cid != '') {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=getstatebyid",
                datatype: "json",
                data: { id: cid },
                success: function (data) {
                    obj = JSON.parse(data);
                    if (obj !== 'empty') {
                        var len = obj.length;
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                        for (var i = 0; i < len; i++) {
                            $(".State").append(`<option value="${obj[i].ID}">${obj[i].State}</option>`);
                        }
                    }
                    else {
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                    }
                }
            })
        }
        else {
            $(".State").empty();
            $(".State").append(`<option value="" selected>Select</option>`);
            console.log("ss");
        }

    })

    onload();
    getcountry();

    $(document).on('click', '.edit_city', function () {
        $(".city_data").hide();
        $(".update_city").css("display", "block");
        $(".page_name").text("Update City");

        var sid = $(this).closest('tr').find(".state_id").val();
        var city = $(this).closest('tr').find(".name_table3").text().trim();
        var cid = $(this).closest('tr').find(".country_id").val();
        var city_id = $(this).closest('tr').find(".city_id").val();

        $(".Country").val(cid);
        $(".city-name").val(city);
        $(".city-id").val(city_id);

        if (cid != '') {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=getstatebyid",
                datatype: "json",
                data: { id: cid },
                success: function (data) {
                    obj = JSON.parse(data);

                    if (obj !== 'empty') {

                        var len = obj.length;
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                        for (var i = 0; i < len; i++) {
                            $(".State").append(`<option value="${obj[i].ID}">${obj[i].State}</option>`);
                        }
                        if (sid != '') {
                            $(".State").val(sid);
                        }
                    }
                    else {
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                    }
                }
            })
        }
        else {
            $(".State").empty();
            $(".State").append(`<option value="" selected>Select</option>`);
        }
    })

    $(document).on("click", ".delete_city", function () {
        var city_id = $(this).closest('tr').find(".city_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=delete_city",
                data: { id: city_id },
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Address&function=add_city";
                }
            })
        }
    })
    $("#validate_form").validate({
        rules: {
            cid: {
                required: true,
            },
            sid: {
                required: true,
            },
            city: {
                required: true,
                maxlength: 50
            }
        }
    });
    $("#validate_form1").validate({
        rules: {
            cid: {
                required: true,
            },
            sid: {
                required: true,
            },
            city: {
                required: true,
                maxlength: 50
            }
        }
    });
})
