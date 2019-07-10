<div class="card mt-4 ">
    <div class="card-header text-dark rev-head text-left">
        <h5>        
            <?php echo $rat->restaurantName;?>

            <small>
                <span class="ml-3 stars-top">
                    <?php
                        for($i = 0 ; $i < $rat->rate ; $i++ )
                            echo '<span class="fa fa-star checked"></span>';
                        for($i = $rat->rate; $i < 5 ; $i++ )
                            echo '<span class="fa fa-star"></span>';  
                    ?>              
                </span>
            </small>            
        </h5>
        <div class="arrow-down">
        </div>
    </div>
    <div class="card-body rev-bod">    

        <form id="<?php echo $rat->restaurantID?>" action="../../modules/edit-rate.php" method="post" enctype="multipart/form-data">
            <input id = "userLogin" name="userLogin" type="hidden" value="<?php echo $_SESSION['login']; ?>">
            <input id = "restaurantId" name="restaurantId" type="hidden" value="<?php echo $rat->restaurantID; ?>">
            <input id = "rate" name="rate" type="hidden" value="<?php echo $rat->rate; ?>">
            <div class="row">
                <div class="col-sm-2 text-center" style="font-size:1.5em;">
                    <p class="text-body mb-2">Twoja ocena</p>								
                    <div class="rating-stars-<?php echo $rat->restaurantID ?>">

                        <?php
                        for($i = 0 ; $i < $rat->rate ; $i++ )
                            echo '<span class="star-'.($i+1).' pointer fa fa-star checked"></span>';
                        for($i = $rat->rate; $i < 5 ; $i++ )
                            echo '<span class="star-'.($i+1).' pointer fa fa-star"></span>';  
                        ?> 
                        
                    </div>								
                </div>
                
                <div class="col-sm-8 comment-textarea">                    
                    <textarea id="inputDescription" name="description" class="form-control" rows="3" maxlength="255" pattern="^[\x20a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+$" ><?php echo $rat->description; ?></textarea>
                </div>

                <div class="col-sm-2 comment-button">
                    <button class="btn btn-warning btn-block" type="submit" name="edit" value="1">Zapisz</button>                     
                    <button class="btn btn-danger btn-block" type="submit" name="delete" value="1">Usuń</button>
                </div>									
            </div>
        </form>     

    </div>
</div>

