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
                $("#paginate tr:gt(0)").remove();
               
                var table = document.getElementById('paginate');
                results.forEach(function(object) {
                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td>' + object.user_login + '</td>' +
                        '<td>' + object.display_name + '</td>' +
                        '<td>' + object.meta_value + '</td>' ;
            
                    table.appendChild(tr);
                });
               
                makePager = function(page){
                    var show_per_page = 10;
                     var number_of_items = $('#paginate tr').size();
                     var number_of_pages = Math.ceil(number_of_items / show_per_page);
                    var number_of_pages_todisplay = 6;
                    var navigation_html = '';
                    var current_page = page;
                    var current_link = (number_of_pages_todisplay >= current_page ? 1 : number_of_pages_todisplay + 1);
                    if (current_page > 1)
                    current_link = current_page;
                    if (current_link != 1) navigation_html += "<a class='nextbutton' href=\"javascript:first();\">« Start&nbsp;</a>&nbsp;<a class='nextbutton' href=\"javascript:previous();\">« Prev&nbsp;</a>&nbsp;";
                    if (current_link == number_of_pages - 1) current_link = current_link - 3;
                    else if (current_link == number_of_pages) current_link = current_link - 4;
                    else if (current_link > 2) current_link = current_link - 2;
                    else current_link = 1;
                    var pages = number_of_pages_todisplay;
                    while (pages != 0) {
                    if (number_of_pages < current_link) { break; }
                    if (current_link >= 1)
                    navigation_html += "<a class='" + ((current_link == current_page) ? "currentPageButton" : "numericButton") + "' href=\"javascript:showPage(" + current_link + ")\" longdesc='" + current_link + "'>" + (current_link) + "</a>&nbsp;";
                    current_link++;
                    pages--;
                     }
                    if (number_of_pages > current_page){
                     navigation_html += "<a class='nextbutton' href=\"javascript:next()\">Next »</a>&nbsp;<a class='nextbutton' href=\"javascript:last(" + number_of_pages + ");\">Last »</a>";
                     }
                     $('#page_navigation').html(navigation_html);
                          }
                          var pageSize = 11;
                          showPage = function (page) {
                                $("#paginate tr").hide();
                                $('#current_page').val(page);
                                $("#paginate tr").each(function (n) {
                                    if (n >= pageSize * (page - 1) && n < pageSize * page)
                                        $(this).show();
                                });
                            makePager(page);
                           }
                            showPage(1);
                           next = function () {
                                new_page = parseInt($('#current_page').val()) + 1;
                                showPage(new_page);
                            }
                            last = function (number_of_pages) {
                                new_page = number_of_pages;
                                $('#current_page').val(new_page);
                                showPage(new_page);
                            }
                            first = function () {
                                var new_page = "1";
                                $('#current_page').val(new_page);
                                showPage(new_page);    
                          }
                            previous = function () {
                                new_page = parseInt($('#current_page').val()) - 1;
                                $('#current_page').val(new_page);
                                showPage(new_page);
                          }
               
                
            }
        });
    });

    
});