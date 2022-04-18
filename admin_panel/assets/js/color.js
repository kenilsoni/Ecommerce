$(document).ready(function () {
    $(document).on('click', '.add_colorbtn', function () {
        $(".color_detail").hide();
        $(".add_color").css("display", "block");
        $(".page_name").text("Add Color");
    })
    $(document).on('click', '.edit_color', function () {
        $(".color_detail").hide();
        $(".update_color").css("display", "block");
        $(".page_name").text("Update Color");

        var color_id = $(this).closest('tr').find(".color_id").val();
        var color = $(this).closest('tr').find(".name_table").text().trim();

        $(".color-id").val(color_id);
        $(".color-name").val(color);

        $.ajax({
            type: "POST",
            url: "?controller=Product&function=getcolor_id",
            datatype: "json",
            data: { id: color_id },
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    for (var i = 0; i < len; i++) {
                        $(".color-code").val(obj[i].Color_Code);
                    }

                }

            }
        })
    })

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Product&function=getcolor",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#color_detail').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="color_id">  
                     <td>${number}</td>              
                     <td class="name_table">${obj[i].Product_Color} </td>  
                     <td>${obj[i].Color_Code}<br><input type="color" value="${obj[i].Color_Code}" disabled></td>
                     <td>${obj[i].Created_At}</td>      
                     <td>${obj[i].Modified_At}</td>               
                     <td><button type="button" class="btn btn-rounded btn-primary edit_color">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_color">Delete</button> </td>
                 </tr>
                     `)).draw();

                    }

                }

            }
        })
    }
    onload();

    $(document).on("click", ".delete_color", function () {
        var color_id = $(this).closest('tr').find(".color_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Product&function=delete_color",
                data: { id: color_id },
                datatype: "json",

                success: function () {
                    window.location.href = "?controller=Product&function=add_color";
                }
            })
        }

    })
    $("#validate_form").validate({
        rules: {
            color_name: {
                required: true,
                maxlength: 50
            },
            color_code: {
                required: true,
            },
        }
    });
    $("#validate_form1").validate({
        rules: {
            color_name: {
                required: true,
                maxlength: 50
            },
            color_code: {
                required: true,
            },
        }
    });

})
