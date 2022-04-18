$(document).ready(function () {
    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Address&function=getstate",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#state_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="state_id">
                     <input type=hidden value="${obj[i].Country_ID}" class="country_id">
                     <td>${number}</td>
                     <td class="name_table">${obj[i].Country} </td>
                     <td class="name_table2">${obj[i].State} </td>
                     <td>${obj[i].Created_At} </td>
                     <td>${obj[i].Modified_At}</td>
                     <td><button type="button" class="btn btn-rounded btn-primary edit_state">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_state">Delete</button> </td>
                 </tr>
                     `)).draw();

                    }

                }

            }
        })
    }
    function getcountry() {
        $.ajax({
            type: "GET",
            url: "?controller=Address&function=getcountry",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    for (var i = 0; i < len; i++) {
                        $(".Country").append(`             
                    <option value="${obj[i].ID}">${obj[i].Country}</option>
                    `);
                    }
                }
            }
        })
    }
    onload();
    getcountry();
    $(document).on('click', '.add_statebtn', function () {
        $(".state_data").hide();
        $(".add_state").css("display", "block");
        $(".page_name").text("Add State");
    })
    $(document).on('click', '.edit_state', function () {
        $(".state_data").hide();
        $(".update_state").css("display", "block");
        $(".page_name").text("Update State");

        var state_id = $(this).closest('tr').find(".state_id").val();
        var state = $(this).closest('tr').find(".name_table2").text().trim();
        var country_id = $(this).closest('tr').find(".country_id").val();

        $(".Country").val(country_id);
        $(".state-name").val(state);
        $(".state-id").val(state_id);

    })


    $(document).on("click", ".delete_state", function () {
        var state_id = $(this).closest('tr').find(".state_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=delete_state",
                data: { id: state_id },
                datatype: "json",

                success: function () {
                    window.location.href = "?controller=Address&function=add_state";
                }
            })
        }

    })
    $("#validate_form").validate({
        rules: {
            cid: {
                required: true,
            },
            state: {
                required: true,
                maxlength: 50
            }
        }
    });
    $("#validate_form1").validate({
        rules: {
            cid: {
                required: true,
            },
            state: {
                required: true,
                maxlength: 50
            }
        }
    });
})
