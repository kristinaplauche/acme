<!--client update view --> 
<?php
if (!$_SESSION['loggedin']) {
   header('Location: /acme/?action=home');
}
?>
 
      <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    

    <!-- site navigation use placeholder references -->
    <nav>
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>        
    </nav>
    <main>  
        <form action="/acme/accounts/" method="POST">
           <h2>Account Update</h2>
            <?php
        if (isset($message)) {
            echo $message;
            }
            ?>
           <fieldset> 
        <div class="fail-message"><p>Use this form to update your account.</p></div>
        <div>
                <label for="clientFirstname">First Name</label>
        </div>
        <div>
                <input name="clientFirstname" id="clientFirstname" type="text" 
                    value = "<?php echo $_SESSION['clientData']['clientFirstname'];?>" required>
        </div>
        <div>
                <label for="clientLastname">Last Name</label>
        </div>
        <div>
                <input name="clientLastname" id="clientLastname" type="text" 
                       value = "<?php echo $_SESSION['clientData']['clientLastname'];?>" required>
        </div>
        <div>
                <label for="clientEmail">Email</label>
        </div>
        <div>
                <input type="email" name="clientEmail" id="clientEmail" 
                 value = "<?php echo $_SESSION['clientData']['clientEmail'];?>" required>
        </div>
        <div>
            <label>&nbsp;</label>
            <input type="submit" name="submit" id="regbtn" value="Update Account" class="register">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="updateAccount">
            <input type="hidden" name="clientId" value = "<?php echo $_SESSION['clientData']['clientId'];?>">
        </div>
                   </fieldset> 
                       </form> 
     
        <?php //print_r($_SESSION);?>
             <form action="/acme/accounts/" method="POST">
           <h2>Change Password</h2>
            <?php
        if (isset($message)) {
            echo $message;
            }
            ?>
            <fieldset>
        <div>
                <label for="clientPassword">Password</label>
                <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</p>
        </div>
        <div>
          <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">     
        </div>
        <div>
            <label>&nbsp;</label>
            <input type="submit" name="submit" id="regbtn2" value="Change Password" class="register">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value = "<?php echo $_SESSION['clientData']['clientId'];?>">
        </div>
            </fieldset> 
            </form>
        </main>
    
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
  
    
    
   
            
