   
        

    
      <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    
    <!-- site navigation use placeholder references -->
    
    
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>  
    
    <main>
        <section ><h1>Welcome to Acme!</h1>
            <!--This is to show featured product -->
              <?php if ($productFeatured2 !=null){ echo $productFeatured; 
              }else { ?>
            
            <div class="slider-wrap">
            <img src="/acme/images/products/rocket.png" class="slider" alt="coyote on rocket">
            <div class="overlay">
                <h2>Acme Rocket</h2>
                <p>Quick lighting fuse</p>
                <p>NHTSA approved seat belts</p>
                <p>Mobile launch stand included</p>
                <div class="call">
                   <img src="/acme/images/site/iwantit.gif"  alt="I want it button"></div></div></div> 
                    
            <?php  } ?>
        </section>
        <div class="content-wrapper">
    <section class="recipe-wrap"><h3>Featured Recipes</h3>
        <div class="recipes">
        <figure><img src="/acme/images/recipes/bbqsand.jpg" alt="bbq sandwich">
            <figcaption><a title ="BBQ" href="#">Pulled Roadrunner BBQ</a>
            </figcaption>
            </figure>
        <figure><img src="/acme/images/recipes/potpie.jpg" alt="pot pie">
            <figcaption><a title ="Pot Pie" href="#">Roadrunner Pot Pie</a>
            </figcaption>
            </figure>
        <figure><img src="/acme/images/recipes/soup.jpg" alt="bowl of soup">
            <figcaption><a title ="Soup" href="#">Roadrunner Soup</a>
            </figcaption>
            </figure>
        <figure><img src="/acme/images/recipes/taco.jpg" alt="soft shell taco">
            <figcaption><a title ="Tacos" href="#">Roadrunner Tacos</a>
            </figcaption>
            </figure>
            </div>
    </section>

            </div>
       <?php 
$ages = array("Steve" => 32, 25 => "Mary");      
print_r ($ages);
     ?> 
        </main>
    
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
    
    
    
    