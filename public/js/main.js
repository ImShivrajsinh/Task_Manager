$(document).ready(function () {
    $('#registrationForm').submit(function (e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function (response) {
               
                window.location.href = response.redirect;
            },
            error: function (xhr, status, error) {
                var errors = JSON.parse(xhr.responseText);
                displayValidationErrors(errors.errors);
            }
        });
    });

   





















$(document).on('click', '.edit-task-btn', function () {
    var taskId = $(this).val();
    //alert(taskId);
     $('#editTaskModal').modal('show');   
    
     $.ajax({
         url: '/edit-task/' + taskId,
         type: "GET",
         success: function (response){
             $('#taskId').val(taskId);
             $('#taskname').val(response.task.taskname);
             $('#taskdescription').val(response.task.taskdescription);
            $('#duedate').val(response.task.duedate);
         }
    });


});

function displayValidationErrors(errors) {
    $('.validation-error').remove();

    $.each(errors, function (key, value) {
        var field = $('#registerModal').find('[name="' + key + '"]');
        field.addClass('is-invalid');
        field.after('<span class="text-danger validation-error">' + value[0] + '</span>');
    });
}
});
