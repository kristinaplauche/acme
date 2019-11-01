
        
        
      <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    

    <!-- site navigation use placeholder references -->
  
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>        
        
       
    <main>
        <?php //if (isset($message)) { echo $message;}
        if (isset($_SESSION['message'])) {
 echo $_SESSION['message'];
}?>
        <form method="post" action="/acme/accounts/" >
            <input type="hidden" name="action" value="login_user">
            <h2>Acme Login</h2>
           
            <div>
                 <label>Email</label>
            </div>
            <div>
                <input name="clientEmail" id="email"  type="email" <?php if (isset($clientEmail)) {
                echo "value='$clientEmail'";} ?> required>
            </div>
        
        <div>
            <label>
                Password
            </label>
             <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</p>
        </div>
        <div>
          <input name="clientPassword" id="password"  type="password" required>     
        </div>
        <div>
     
            <label>&nbsp;</label>
            <input type="submit" name="submit" id="regbtn" value="Login" class="login">
            
        </div>
        </form>
        <h2>Not a Member?</h2>
        
        
            
            <p> <a href='/acme/accounts/?action=registration'>Register</a></p>

        
        
        </main>
 
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
  
    
    

            
