<!DOCTYPE html>
<html>
<head>
<title>User Listing</title>
</head>

<body>

    <div> 
    <label for= "user_role" > <strong> Role </strong> </label>
            <select name="user_role" id="user_role">
            <option value="administrator">Administrator</option>
            <option value="subscriber">Subscriber</option>
            <option value="author">Author</option>
            <option value="contributor">Contributor</option>
            <option value="editor">Editor</option>
            

            </select>   
    </div>
    <div>
    <label for= "user_order" > <strong> order </strong> </label>
            <select name="user_order" id="user_order">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
            </select>   
        
    </div>  

    <div>
    <label for= "order_by" > <strong> select </strong> </label>
            <select name="order_by" id="order_by">
            <option value="user_login">Username</option>
            <option value="display_name">Displayname</option>
            </select>   
        
    </div>  
    

    <table id="gable">
       
        <tr>
            <th>UserName</th>
            <th >Disply Name</th>
            <th >Role</th>
            
    </table>
</body>

</html>