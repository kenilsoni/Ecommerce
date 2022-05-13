$(document).ready(function () {

    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Admin&function=get_contact",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#contact_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="contact_id">
                     <td >${number} </td>
                     <td class="name_table">${obj[i].Name} </td>
                     <td class="user_email">${obj[i].Email} </td>
                     <td>${obj[i].Subject} </td>
                     <td>${obj[i].Message} </td>
                     <td>${obj[i].Reply===''? '<button type="button" class="btn btn-rounded btn-primary edit_contact" data-toggle="modal" data-target="#replymodal">Reply</button>':obj[i].Reply}</td>
                     </tr>
                     `)).draw();
                    }
                }
            }
        })
    }
    onload();
    $(document).on('click', '.edit_contact', function () {
        var email = $(this).closest('tr').find(".user_email").text().trim();
        var contactid = $(this).closest('tr').find(".contact_id").val();
        $(".email_id").val(email);
        $(".id").val(contactid);
    })
})
