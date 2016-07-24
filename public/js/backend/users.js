$(document).ready(function(){

    var url = "/admin/edit-user";

    //display modal form for task editing
    $('.user_row').dblclick(function(){
        var id = $(this).attr('user_id');

        $('#myModal .modal-body').load(url + '/' + id);
       /* $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#user_id').val(data.id);
            $('#name').val(data.task);
            $('#email').val(data.description);
            $('#btn-save').val("update");

            $('#myModal').modal('show');
        })*/
        $('#myModal').modal('show');

    });

    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete task and remove it from list
    $('.delete-task').click(function(){
        var task_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + task_id,
            success: function (data) {
                console.log(data);

                $("#task" + task_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new task / update existing task
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = $('#frmTasks').serialize();

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var my_url =  "/admin/update-user";

       /* if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + task_id;
        }*/

       // console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#myModal').modal('hide');
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});