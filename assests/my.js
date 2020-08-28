jQuery(document).ready(function($) {
    $("#user_role, #user_order,#order_by").change(function() {
        $.ajax({
            type: 'POST',
            url: my_vars.my_ajax_url,
            data: {
                action: "register_user_front_end",
                user_role: $('#user_role option:selected').val(),
                user_order: $('#user_order option:selected').val(),
                order_by: $('#order_by option:selected').val(),
               
            },
            success: function(results) {
                var results = $.parseJSON(results);
                $("#gable tr:gt(0)").remove();
                
               
                var table = document.getElementById('gable');
                results.forEach(function(object) {
                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td>' + object.user_login + '</td>' +
                        '<td>' + object.display_name + '</td>' +
                        '<td>' + object.meta_value + '</td>' ;
            
                    table.appendChild(tr);
                });

            }
        });
    });
});