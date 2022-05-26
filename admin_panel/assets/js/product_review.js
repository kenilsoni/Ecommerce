$(document).ready(function () {
    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Admin&function=get_productrv",
            datatype: "json",
            success: function (data) {
                obj = JSON.parse(data);
                console.log(obj);
                if (typeof obj === "object") {
                    var len = obj.length;
                    // console.log(obj)
                    var mytable = $('#product_review').DataTable();
                    mytable.clear().draw();
                    for (var i = 0; i < len; i++) {
                        var number = i + 1;
                        mytable.row.add($(`
                        <tr>
                        <input type="hidden" value="${obj[i].ID}" class="review_id">
                        <td>${number}</td>
                        <td>${obj[i].FullName}</td>
                        <td>${obj[i].Product_Name} </td>
                        <td>${obj[i].Product_Rate} </td>
                        <td>${obj[i].Product_Review} </td>
                        <td>${obj[i].IsApprove==0 ? '<button type="button" class="btn btn-rounded btn-primary verify_rv">Verify</button>':'<button type="button" class="btn btn-rounded btn-success ">Verified</button>'} </td>
                        <td><button type="button" class="btn btn-rounded btn-danger delete_rv">Delete</button></td>
                    </tr>
                     `)).draw();
                    }
                }
            }
        })
    }
 
    onload();
    $(document).on("click", ".delete_rv", function () {
        var rv_id = $(this).closest('tr').find(".review_id").val();
        if (confirm("Are you really want to delete data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Admin&function=delete_rv",
                data: { id: rv_id},
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Admin&function=product_review";
                }
            })
        }

    })
    $(document).on("click", ".verify_rv", function () {
        var rv_id = $(this).closest('tr').find(".review_id").val();
        if (confirm("Are you really want to approve data")) {
            $.ajax({
                type: "POST",
                url: "?controller=Admin&function=verify_rv",
                data: { id: rv_id},
                datatype: "json",
                success: function () {
                    window.location.href = "?controller=Admin&function=product_review";
                }
            })
        }

    })
   
  
})
