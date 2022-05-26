$(document).ready(function () {
    $('#pending_order_table').DataTable({
        "order": [[ 1, "desc" ]]
    });
    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Product&function=get_pendingorder",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    var len = obj.length;
                    // console.log(obj)
                    var mytable = $('#pending_order_table').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        mytable.row.add($(`
                        <tr>
                        <input type="hidden" value="${obj[i][2].ID}" class="main_id">
                        <input type="hidden" value="${obj[i][2].Order_ID}" class="order_id">
                        <td>${obj[i][2].Order_ID}</td>
                       
                        <td>${obj[i][2].Created_At} </td>
                        <td>${obj[i][1].Fullname} </td>
                        <td>${obj[i][0].Street} ${obj[i][0].City} ${obj[i][0].State}  ${obj[i][0].Country} </td>
                        <td>${obj[i][2].Total} </td>
                        <td><button type="button" class="btn btn-rounded btn-danger view_detail">View Details</button> </td>
                        <td><button type="button" class="btn btn-rounded btn-primary mark_complete">Mark as Complete</button></td>
                    </tr>
                     `)).draw();
                    }
                }
            }
        })
    }
 
    onload();
   
   
    $(document).on('click', '.mark_complete', function () {
        
        var order_id = $(this).closest('tr').find(".main_id").val();
        if(confirm('is order complete??')){
        $.ajax({
            type: "POST",
            url: "?controller=Product&function=update_status",
            data: { order_id: order_id },
            datatype: "json",
            success: function (data) {
                    alert("status change successfully")
                    window.location.reload()
            }
        })}
    })


    $(document).on('click', '.view_detail', function () {
        $(".table_data").hide();
        $(".view_data").css("display", "block");
        $(".page_name").text("view details");

        var order_id = $(this).closest('tr').find(".order_id").val();

        $.ajax({
            type: "POST",
            url: "?controller=Product&function=getproductby_id_placed",
            data: { order_id: order_id },
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                console.log(obj);
                if (typeof obj === "object") {
                    var len = obj.clr.length;
                    console.log(obj['clr'][0][0].Product_Color)
                    var mytable = $('#details_product').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        
                        mytable.row.add($(`
                        <tr>
                        <td>${obj['name'][i][0].Product_Name}</td>
                        <td>${obj['qty'][i]} </td>
                        <td>${obj['clr'][i][0].Product_Color} </td>
                        <td>${obj['size'][i][0].Product_Size} </td>
                        <td>${obj['name'][i][0].Product_Price} </td>
                    </tr>
                     `)).draw();
                    }
                }
            }
        })

    })
})
