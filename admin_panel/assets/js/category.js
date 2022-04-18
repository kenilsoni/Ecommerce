$(document).ready(function () {

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Category&function=getcategory",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#category_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="category_id">
                     <td>${number}</td>
                     <td class="name_table" >${obj[i].Category_Name} </td>
                     <td >${obj[i].Created_At} </td>
                     <td >${obj[i].Modified_At} </td>
                     <td><button type="button" class="btn btn-rounded btn-primary edit_category">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_category">Delete</button> </td>
                     </tr>
                     `)).draw();

                    }

                }

            }
        })

    }
    onload();

    $(document).on("click", ".delete_category", function () {
        var category_id = $(this).closest('tr').find(".category_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Category&function=deletecategory",
                data: { id: category_id },
                datatype: "json",

                success: function () {
                    window.location.href = "?controller=Category&function=all_category";
                }
            })
        }

    })
    $(document).on('click', '.edit_category', function () {
        $(".category_data").hide();
        $(".update_category").css("display", "block");
        $(".page_name").text("Update Category");
        var category_name = $(this).closest('tr').find(".name_table").text().trim();
        var category_id = $(this).closest('tr').find(".category_id").val();
        $(".category_input").val(category_name);
        $(".update_id").val(category_id);

        $.ajax({
            type: "POST",
            url: "?controller=Category&function=getdesc",
            data: { id: category_id },
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                var len = obj.length;
                if (typeof obj === "object") {
                    for (var i = 0; i < len; i++) {
                        $("#category_desc").val(obj[i].Category_desc);
                    }
                }
            }
        })

    })



    $("#validate_form").validate({
        rules: {
            category_name: {
                required: true,
                maxlength: 50
            },
            desc_category: {
                required: true,
                maxlength: 255
            }
        }
    });
})