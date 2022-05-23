$(document).ready(function () {

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Admin&function=get_newsletter",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#newsletter_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type="hidden" class="newsletter_id" value="${obj[i].ID}">
                     <td >${number} </td>
                     <td class="name_table">${obj[i].Title} </td>
                     <td>${obj[i].Description} </td>
                     <td>${obj[i].Created_At} </td>
                     <td><button type="button" class="btn btn-rounded btn-danger delete_nl">Delete</button></td>
                     </tr>
                     `)).draw();
                    }
                }
            }
        })
    }
    function onload2() {
        $.ajax({
            type: "GET",
            url: "?controller=Admin&function=get_newsletteruser",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#usernewsletter_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <td >${number} </td>
                     <td class="name_table">${obj[i].Email} </td>
                     <td>${obj[i].Created_At} </td>
                     </tr>
                     `)).draw();
                    }
                }
            }
        })
    }
    onload();
    onload2();
   
    $(document).on("click", ".delete_nl", function () {
        var neesletter_id = $(this).closest('tr').find(".newsletter_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Admin&function=delete_newsletter",
                data: { id: neesletter_id },
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Admin&function=all_newsletter";
                }
            })
        }

    })
    $(document).on('click', '.add_newsletterbtn', function () {
        $(".newsletter_data").hide();
        $(".add_newsletter").css("display", "block");
        $(".page_name").text("Add NewsLetter");
    })

  
})
