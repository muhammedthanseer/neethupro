
<style type="text/css">
    /*.galary
    {
        width: 10px;
        height: 10px;
    }
    .images123
    {
        width: 100px;
        height: 100px;
    }*/
    /*#wwwww
    {
        width: 100;
        height: 100;
    }
    #imagescoll
    {
        width: 100;
        height: 100;
    }*/
   div.imagescoll img
    {
       /* width: 600px;
        height: 400px;
        opacity: 1;
        display: block;
        border-radius: 8px;
        padding: 10px 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
        width: 400;
        height: 400;
        /*border: 1px solid black;*/
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 8px;


    }
    

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <!-- div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>#"><i class="fa fa-plus"></i> Add New</a>
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
<!--                     <h3 class="box-title">Exam Subject List</h3>
 -->                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group">                        
                              <!-- <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div> -->
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                 

                 <!-- //images of collage -->
                 <!-- start -->
                 <!-- <div calss=galary>
                     <img src="https://www.ajce.in/home/images/centre-complex.jpg" class="images123">
                 </div> -->

            
<?php 
$this->load->helper('directory'); //load directory helper
$dir = "assets/images/collage"; // Your Path to folder
$map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */

foreach ($map as $k)
{?>
    <div class="imagescoll" align="center">
     <img src="<?php echo base_url($dir)."/".$k;?>" alt="">
   </div>
<?php }
          
?>


                <!-- END -->


<iframe src="https://www.ajce.in/home/index.html#" width="100%" height="700">
    
</iframe> 


                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<!-- <script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
