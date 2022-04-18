$(document).ready(function () {

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Address&function=getcountry",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#country_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="country_id">
                     <td >${number} </td>
                     <td class="name_table">${obj[i].Country} </td>
                     <td>${obj[i].Created_At} </td>
                     <td>${obj[i].Modified_At} </td>
                     <td><button type="button" class="btn btn-rounded btn-primary edit_country">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_country">Delete</button> </td>
                     </tr>
                     `)).draw();

                    }

                }

            }
        })
    }
    onload();
    $(document).on('click', '.edit_country', function () {
        $(".country_data").hide();
        $(".update_country").css("display", "block");
        $(".page_name").text("Update Country");
        var countryname = $(this).closest('tr').find(".name_table").text().trim();
        var countryid = $(this).closest('tr').find(".country_id").val();
        $(".countryinput").val(countryname);
        $(".update_id").val(countryid);
    })

    $(document).on("click", ".delete_country", function () {
        var country_id = $(this).closest('tr').find(".country_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=delete_country",
                data: { id: country_id },
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Address&function=add_country";
                }
            })
        }

    })
    $(document).on('click', '.add_countrybtn', function () {
        $(".country_data").hide();
        $(".add_country").css("display", "block");
        $(".page_name").text("Add Country");
    })

    $("#validate_form").validate({
        rules: {
            country: {
                required: true,
                maxlength: 50
            },
        }
    });
    $("#validate_form1").validate({
        rules: {
            country: {
                required: true,
                maxlength: 50
            },
        }
    });

})
