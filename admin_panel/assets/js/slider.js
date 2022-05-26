$(document).ready(function () {
    $('#slider_table').DataTable({
        "order": [[ 3, "desc" ]]
    });
    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Admin&function=slider_img",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#slider_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="slider_id">
                     <input type=hidden value="${obj[i].Image_Path}" class="image_path">
               
                     <td>${number}</td>
                     <td class="name_table">${obj[i].Description} </td>
                     <td class="name_table2">
                     <div ><img src="./assets/uploads/${obj[i].Image_Path}" alt="user" class="rounded" width="100%" ></div>
                     </td>
                     <td>${obj[i].Created_At} </td>
                    
                     <td><button type="button" class="btn btn-rounded btn-danger delete_slider">Delete</button> </td>
                 </tr>
                     `)).draw();

                    }

                }

            }
        })
    }
    
    onload();
 
  
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
    $(document).on('click', '.add_sliderbtn', function () {
        $(".slider_data").hide();
        $(".add_slider").css("display", "block");
        $(".page_name").text("Add slider");
    })
   
    $(document).on("click", ".delete_slider", function () {
        var slider_id = $(this).closest('tr').find(".slider_id").val();
        var image_path = $(this).closest('tr').find(".image_path").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Admin&function=delete_slider",
                data: { id: slider_id ,image_path:image_path},
                datatype: "json",

                success: function () {
                    window.location.href = "?controller=Admin&function=slider";
                }
            })
        }

    })
    
})
