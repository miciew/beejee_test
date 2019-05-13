


function toogleTaskStatus()
{
    $('input[type="checkbox"]').on('change', function (e)
    {
        let data = {
            "id": $(this).data('task-id')
        };

        $.post('/tasks/toogle-status', data);
    })
}
