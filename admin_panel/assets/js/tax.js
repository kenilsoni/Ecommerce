$(document).ready(function () {
    $('#tax_table').DataTable({
        "order": [[ 4, "desc" ]]
    });
    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Address&function=get_tax",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    var mytable = $('#tax_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                     <tr>
                     <input type=hidden value="${obj[i].ID}" class="tax_id">
                     <input type=hidden value="${obj[i].Country_ID}" class="country_id">
                     <input type=hidden value="${obj[i].State_ID}" class="state_id">
                     <td>${number}</td>
                     <td class="name_table">${obj[i].Country} </td>
                     <td class="name_table2">${obj[i].State} </td>
                     <td class="name_table3">${obj[i].tax_percent} </td>
                     <td>${obj[i].Created_At} </td>
                     <td>${obj[i].Modified_At}</td>
                     <td><button type="button" class="btn btn-rounded btn-primary edit_tax">Edit</button>&nbsp;<button type="button" class="btn btn-rounded btn-danger delete_tax">Delete</button> </td>
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
    $(document).on('change', '.Country', function () {
        var cid = $(this).val();
        if (cid != '') {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=getstatebyid",
                datatype: "json",
                data: { id: cid },
                success: function (data) {
                    obj = JSON.parse(data);
                    if (obj !== 'empty') {
                        var len = obj.length;
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                        for (var i = 0; i < len; i++) {
                            $(".State").append(`<option value="${obj[i].ID}">${obj[i].State}</option>`);
                        }
                    }
                    else {
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                    }
                }
            })
        }
        else {
            $(".State").empty();
            $(".State").append(`<option value="" selected>Select</option>`);
            console.log("ss");
        }

    })
    $(document).on('click', '.add_taxbtn', function () {
        $(".state_data").hide();
        $(".add_state").css("display", "block");
        $(".page_name").text("Add tax");
    })
    $(document).on('click', '.edit_tax', function () {
        $(".state_data").hide();
        $(".update_state").css("display", "block");
        $(".page_name").text("Update tax");

        var tax_id = $(this).closest('tr').find(".tax_id").val();
        var tax = $(this).closest('tr').find(".name_table3").text().trim();
        var country_id = $(this).closest('tr').find(".country_id").val();
        var state_id = $(this).closest('tr').find(".state_id").val();

        $(".Country").val(country_id);
        $(".add-tax").val(tax);
       
        $(".tax_id").val(tax_id);

        if (country_id != '') {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=getstatebyid",
                datatype: "json",
                data: { id: country_id },
                success: function (data) {
                    obj = JSON.parse(data);

                    if (obj !== 'empty') {

                        var len = obj.length;
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                        for (var i = 0; i < len; i++) {
                            $(".State").append(`<option value="${obj[i].ID}">${obj[i].State}</option>`);
                        }
                        if (state_id != '') {
                            $(".State").val(state_id);
                        }
                    }
                    else {
                        $(".State").empty();
                        $(".State").append(`<option value="" selected>Select</option>`);
                    }
                }
            })
        }
        else {
            $(".State").empty();
            $(".State").append(`<option value="" selected>Select</option>`);
        }

    })


    $(document).on("click", ".delete_tax", function () {
        var tax_id = $(this).closest('tr').find(".tax_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Address&function=delete_tax",
                data: { id: tax_id },
                datatype: "json",

                success: function () {
                    window.location.href = "?controller=Admin&function=service_tax";
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
               
            },
            tax:{
                required:true
            },
            ccode:{
                required:true
            },
            scode:{
                required:true
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
                
            },
            tax:{
                required:true
            },
            ccode:{
                required:true
            },
            scode:{
                required:true
            }
        }
    });
})
