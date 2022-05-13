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

    if (window.File && window.FileList && window.FileReader) {
        $("#files_image2").on("change", function (e) {
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
            url: "?controller=Admin&function=get_testimonial",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                console.log(obj);
                if (typeof obj === "object") {
                    var len = obj.length;
                    console.log(obj)
                    var mytable = $('#testimonial_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                        <tr>
                        <input type="hidden" value="${obj[i].ID}" class="testimonial_id">
                        <input type="hidden" value="${obj[i].Image_Path}" class="image_path">
                        <td>${number}</td>
                        <td>
                            <div class="m-r-10"><img src="./assets/uploads/${obj[i].Image_Path}" alt="user" class="rounded" width="45"></div>
                        </td>
                        <td class="name_get">${obj[i].Name}</td>                       
                        <td class="designation_get">${obj[i].Designation} </td>
                        <td class="desc_get">${obj[i].Description} </td>
                        <td>${obj[i].Created_At} </td>
                        <td><button type="button" class="btn btn-rounded btn-primary edit_testimonial">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_testimonial">Delete</button> </td>
                    </tr>
                     `)).draw();
                    }
                }
            }
        })
    }
    $(document).on('click', '.add_testimonialbtn', function () {
        $(".testimonial_data").hide();
        $(".add_testimonial").css("display", "block");
        $(".page_name").text("Add Testimonial");
    })

    

    onload();
    
    
    $(document).on('click', '.edit_testimonial', function () {
        $(".testimonial_data").hide();
        $(".update_testimonial").css("display", "block");
        $(".page_name").text("Update testimonial");

        var testimonialid = $(this).closest('tr').find(".testimonial_id").val();
        var name = $(this).closest('tr').find(".name_get").text().trim();
        var desc = $(this).closest('tr').find(".desc_get").text().trim();
        var designation = $(this).closest('tr').find(".designation_get").text().trim();
        // console.log(name)
        $(".testimonial_id").val(testimonialid);
        $(".name").val(name);
        $(".desc").val(desc);
        $(".designation").val(designation);

    })


    $(document).on("click", ".delete_testimonial", function () {
        var testimonial_id = $(this).closest('tr').find(".testimonial_id").val();
        var image_path = $(this).closest('tr').find(".image_path").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Admin&function=delete_testimonial",
                data: { id: testimonial_id,image_path:image_path},
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Admin&function=add_testimonial";
                }
            })
        }

    })
})
