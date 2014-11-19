<?php require_once('resources/nfsite_config.php');

include('header.php');

if(isset($_GET['search']))
{
  $search_Item = $_GET['search'];  
}
?>
<div class="container">
  <div class="row">
    <div class="col-md-12 jumbotron">
      
    <div class="row"> 
      <div class= "col-md-8">
        <?php $searched = $postcon-> searchPost($search_Item);
        
              foreach($searched as $item){ 
                if (isset($item['title']) || isset($item['description']) ) {?>
                  <div>
                    <h4><a href="postDetail.php?post_id=<?php echo $item['postId'];?>"><?php echo $item['title']; ?></a></h4>
                    <p><?php echo $nfsite->truncate($item['description'], "postDetail.php", "post_id", $item['postId']); ?></p>
                  </div>
                <?php }
                elseif (isset($item['fullname'])) {?>
                  <span>Posted By: <?php echo ucfirst($item['fullname']);?> </span>
                <?php }

                ?>                   
            <hr>  
            <?php } ?>                
      </div>
      <?php include('sidebar.php'); ?>
    </div>
    
    </div>
  </div>
</div>



  foreach($searched as $item){
    echo "Name:<a href='#'>".$item['title']."</a>";
  }

<?php include('footer.php'); ?>