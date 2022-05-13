$(document).ready(function () {

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Admin&function=getcoupan_data",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#coupan_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].Coupan_ID}" class="coupan_id">
                     <td >${number} </td>
                     <td class="name_table">${obj[i].Coupan_ID} </td>
                     <td>${obj[i].Discount} </td>
                     <td>${obj[i].Created_At} </td>
                     <td>${obj[i].Expiry} </td>
                     <td><button type="button" class="btn btn-rounded btn-danger delete_coupan">Delete</button> </td>
                     </tr>
                     `)).draw();

                    }

                }

            }
        })
    }
    onload();
   

    $(document).on("click", ".delete_coupan", function () {
        var coupan_id = $(this).closest('tr').find(".coupan_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Admin&function=delete_coupan",
                data: { id: coupan_id },
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Admin&function=add_coupan";
                }
            })
        }

    })
    $(document).on('click', '.add_coupanbtn', function () {
        $(".coupan_data").hide();
        $(".add_coupan").css("display", "block");
        $(".page_name").text("Add Coupan");
    })

  
})
