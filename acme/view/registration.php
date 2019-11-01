 
 
      <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    

    <!-- site navigation use placeholder references -->
    <nav>
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>        
    </nav>
    <main>        
        <?php
if (isset($message)) {
 echo $message;
}
?>
        <form action="/acme/accounts/index.php" method="POST">
           <h2>Acme Registration</h2>
        <div class="fail-message"><p>All fields are required</p></div>
        <div>
                <label for="clientFirstname">First Name</label>
        </div>
        <div>
                <input name="clientFirstname" id="clientFirstname" type="text" <?php if (isset($clientFirstname)) {
                echo "value='$clientFirstname'";} ?> required>
        </div>
        <div>
                <label for="clientLastname">Last Name</label>
        </div>
        <div>
                <input name="clientLastname" id="clientLastname" type="text" <?php if (isset($clientLastname)) {
                echo "value='$clientLastname'";} ?> required>
        </div>
        <div>
                <label for="clientEmail">Email</label>
        </div>
        <div>
                <input type="email" name="clientEmail" id="clientEmail" <?php if (isset($clientEmail)) {
                echo "value='$clientEmail'";} ?> required >
        </div>
        <div>
                <label for="clientPassword">Password</label>
                <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</p>
        </div>
        <div>
          <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">     
        </div>
        <div>
            <label>&nbsp;</label>
            <input type="submit" name="submit" id="regbtn" value="Register" class="register">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="register">
        </div>
               
            </form>
        </main>
    
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
  
    
    
   
            
