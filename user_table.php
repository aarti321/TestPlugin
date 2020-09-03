<!DOCTYPE html>
<html>
<head>
<title>User Listing</title>


<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"></script>


<body>

    <div> 
    
    <div>
    <label for= "user_order" > <strong><?php esc_html_e('Order', 'testPlugin');?> </strong> </label>
            <select name="user_order" id="user_order">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
            </select>   
        
    </div>  

    <div>
    <label for= "order_by" > <strong><?php esc_html_e('Select From', 'testPlugin');?>  </strong> </label>
            <select name="order_by" id="order_by">
            <option value="user_login">Username</option>
            <option value="display_name">Displayname</option>
            </select>   
        
    </div>  
    <label for= "user_role" class ="My_role" > <strong><?php esc_html_e('Role', 'testPlugin');?>  </strong> </label>
            <select name="user_role" id="user_role">
            <option value="administrator">Administrator</option>
            <option value="subscriber">Subscriber</option>
            <option value="author">Author</option>
            <option value="contributor">Contributor</option>
            <option value="editor">Editor</option>
            

            </select>   
    </div>
    
  
    <table class="paginated" id="paginate" Border="1">
       
        <tr>
            <th>UserName</th>
            <th >Display Name</th>
            <th >Role</th>
        </tr>    
         
            
    </table>
    
    </div>

    <div class ="centre">
    <input type='hidden' id='current_page' />
        <input type='hidden' id='show_per_page' />
        <div id='page_navigation'>
        </div>
</div>   
    
    
</body>

</html>