$(document).ready(function () {

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=SubCategory&function=getsubcategory",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                console.log(obj);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#subcategory_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="subcategory_id">
                     <input type=hidden value="${obj[i].Category_ID}" class="category_id">
                     <td >${number} </td>
                     <td >${obj[i].Category_Name} </td>
                     <td class="name_table">${obj[i].Subcategory_Name} </td>
                     <td >${obj[i].Created_At} </td>
                     <td >${obj[i].Modified_At} </td>
                     <td><button type="button" class="btn btn-rounded btn-primary edit_subcategory">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_subcategory">Delete</button> </td>
                     </tr>
                     `)).draw();

                    }
                }
            }
        })
    }
    function getcategory() {
        $.ajax({
            type: "GET",
            url: "?controller=Category&function=getcategory",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    for (var i = 0; i < len; i++) {
                        $("#Category").append(`<option value="${obj[i].ID}">${obj[i].Category_Name}</option>`);
                    }
                }
            }
        })
    }
    onload();
    getcategory()

    $(document).on("click", ".delete_subcategory", function () {
        var subcategory_id = $(this).closest('tr').find(".subcategory_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=SubCategory&function=deletesubcategory",
                data: { id: subcategory_id },
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=SubCategory&function=all_subcategory";
                }
            })
        }

    })
    $(document).on('click', '.edit_subcategory', function () {
        $(".subcategory_data").hide();
        $(".update_subcategory").css("display", "block");
        $(".page_name").text("Update SubCategory");
        var subcategory_name = $(this).closest('tr').find(".name_table").text().trim();
        var category_id = $(this).closest('tr').find(".category_id").val();
        var subcategory_id = $(this).closest('tr').find(".subcategory_id").val();
        $(".subcategory_input").val(subcategory_name);
        $(".update_id").val(subcategory_id);
        $("#Category").val(category_id);

        $.ajax({
            type: "POST",
            url: "?controller=SubCategory&function=getdesc",
            data: { id: subcategory_id },
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                var len = obj.length;
                if (typeof obj === "object") {
                    for (var i = 0; i < len; i++) {
                        $("#subcategory_desc").val(obj[i].Subcategory_desc);
                    }
                }
            }
        })

    })

    $("#validate_form").validate({
        rules: {
            category_name: {
                required: true,

            },
            Category: {
                required: true,
            },
            subcategory_name: {
                required: true,
                maxlength: 50
            },
            desc_subcategory: {
                required: true,
                maxlength: 255
            }
        }
    });


})
