$(document).ready(function () {

    if (window.File && window.FileList && window.FileReader) {
        $("#files_image").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    var file = e.target;
                    $(".imgGallery").append("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><button class=\"remove btn btn-danger\">Remove</button>" +
                        "</span>");
                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                    });
                });
                fileReader.readAsDataURL(f);
            }
            $(".upload-img").show();

        });
    } else {
        alert("Your browser doesn't support to File API")
    }

    $(".upload-img").hide();



    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Product&function=getproduct",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                console.log(obj);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#product_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                        <tr>
                        <input type="hidden" value="${obj[i][0].ID}" class="product_id">
                        <td>${number}</td>
                        <td>${obj[i][0].Product_Name}</td>
                        <td>
                            <div class="m-r-10"><img src="./assets/uploads/${obj[i][1].Image_Path}" alt="user" class="rounded" width="45"></div>
                        </td>
                        <td>${obj[i][0].Product_Quantity} </td>
                        <td>${obj[i][0].Product_Price} </td>
                        <td>${obj[i][0].Created_At} </td>
                        <td>${obj[i][0].Modified_At} </td>
                        <td><button type="button" class="btn btn-rounded btn-primary edit_product">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_product">Delete</button> </td>
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
                        $("#Category").append(` <option value="${obj[i].ID}">${obj[i].Category_Name}</option>`);
                    }
                }
            }
        })
    }

    function getsize() {
        $.ajax({
            type: "GET",
            url: "?controller=Product&function=getsize"
        })
    }
    function getcolor() {
        $.ajax({
            type: "GET",
            url: "?controller=Product&function=getcolor"
        })
    }
    onload();
    getcategory();
    getsize();
    getcolor();
    $(document).on('change', '.product_category', function () {
        var id = $(".product_category option:selected").val();

        if (id != '') {
            $.ajax({
                type: "POST",
                url: "?controller=Product&function=getsubcategory_id",
                data: { id: id },
                datatype: "json",
                success: function (data) {
                    obj = JSON.parse(data);
                    console.log(obj);
                    if (typeof obj === "object") {
                        var len = obj.length;
                        $(".product_subcategory").empty();
                        $(".product_subcategory").append(`<option value="" selected>Select</option>`);
                        for (var i = 0; i < len; i++) {
                            $(".product_subcategory").append(`<option value="${obj[i].ID}">${obj[i].Subcategory_Name}</option>`);
                        }
                    }
                }
            })
        } else {
            $(".product_subcategory").empty();
            $(".product_subcategory").append(`<option value="" selected>Select</option>`);
        }
    })
    $(document).on('click', '.edit_product', function () {
        $(".product_data").hide();
        $(".update_product").css("display", "block");
        $(".page_name").text("Update product");

        var productid = $(this).closest('tr').find(".product_id").val();
        $(".product-id").val(productid);

        $.ajax({
            type: "POST",
            url: "?controller=Product&function=getproductby_id",
            data: { id: productid },
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    for (var i = 0; i < len; i++) {
                        $(".product_name").val(obj[i][0].Product_Name);
                        $(".product_desc").val(obj[i][0].Product_Description);
                        $(".product_price").val(obj[i][0].Product_Price);
                        $(".product_quantity").val(obj[i][0].Product_Quantity);
                        $(".product_category").val(obj[i][0].Category_ID);
                        $(".product_color").val(obj[i][0].Product_Color_ID);
                        $(".product_size").val(obj[i][0].Product_Size);
                        getsubcategory_product(obj[i][0].Category_ID, obj[i][0].Subcategory_ID)
                        if (obj[i][0].IsTrending == 1) {
                            $("#switch16").attr('checked', true);
                        }
                    }
                }

            }
        })
        getimage(productid)

    })

    function getimage(productid) {
        var productid = productid;
        $.ajax({
            type: "POST",
            url: "?controller=Product&function=getimage_update",
            data: { id: productid },
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    $(".available_image").html('');
                    for (var i = 0; i < len; i++) {
                        $(".available_image").append(`<div><input type="hidden" value="${obj[i].ID}" class="image_id"><img src="./assets/uploads/${obj[i].Image_Path}" /><br><button type="button" class="remove_image btn btn-danger">Remove</button></div>`);
                    }
                }
            }
        })
    }

    $(document).on("click", ".remove_image", function () {
        var id = $(this).closest("div").find(".image_id").val();
        var product_id = $(".product-id").val();
        if (id != '') {
            $.ajax({
                type: "POST",
                url: "?controller=Product&function=delete_image",
                data: { id: id },
                datatype: "json",
                success: function (data) {
                    if (data == 1) {
                        alert("image deleted successfully");
                        getimage(product_id);
                    }
                    else {
                        alert("something went wrong");
                    }
                }
            })
        }
    })

    function getsubcategory_product(id, sid) {
        if (id != '') {
            $.ajax({
                type: "POST",
                url: "?controller=Product&function=getsubcategory_id",
                data: { id: id },
                datatype: "json",
                success: function (data) {
                    obj = JSON.parse(data);
                    console.log(obj);
                    if (typeof obj === "object") {
                        var len = obj.length;
                        $(".product_subcategory").empty();
                        $(".product_subcategory").append(`<option value="" selected>Select</option>`);
                        for (var i = 0; i < len; i++) {
                            $(".product_subcategory").append(`<option value="${obj[i].ID}">${obj[i].Subcategory_Name}</option>`);
                            $(".product_subcategory").val(sid);
                        }
                    }
                }
            })
        } else {
            $(".product_subcategory").empty();
            $(".product_subcategory").append(`<option value="" selected>Select</option>`);
        }
    }
    $(document).on("click", ".delete_product", function () {
        var product_id = $(this).closest('tr').find(".product_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Product&function=delete_product",
                data: { id: product_id },
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Product&function=all_product";
                }
            })
        }

    })
})
