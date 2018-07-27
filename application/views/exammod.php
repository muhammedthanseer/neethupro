<style type="text/css">
#subone2
{
  background-color: #6073ED;
    border: none;
    color: white;
    padding: 10px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
/*#time
{
  color: red;
}*/

</style>
<script>
function myFunction() {
    alert("Exam is taken Successfully");
}
</script>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Questions<br>
        <h3>Instructions</h3>
        <h5>1.Read the Question carefully</h5>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <!-- <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>#"><i class="fa fa-plus"></i> Add New</a>
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Exam Subject List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group">                        
                              <!-- <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div> -->
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
               <!--  <div id="timer">2:00</div> -->
                <!-- <div align="right" id="time">Exam closes in <span id="time">05:00</span> minutes!</div> -->
                          <div class="box-body table-responsive no-padding">
              

                  <form method="post" action="">
                    <?php
                    foreach ($h->result() as $row) {
                      # code...
                    ?>
                  <div class="form-group">
            <div class="radio">
              <label><b>Question&nbsp:-&nbsp</b></label></label><b><?php echo $row->question;?><br>
              <label><input type="radio" value='1' name="question<?=$row->que_id?>"><?php echo $row->ans1;?></label>
            </div>
            <div class="radio">
                <label><input type="radio" value='2' name="question<?=$row->que_id?>"><?php echo $row->ans2;?></label>
            </div>
            <div class="radio">
                <label><input type="radio" value='3' name="question<?=$row->que_id?>"><?php echo $row->ans3;?></label>
            </div>
            <div class="radio">
              <label><input type="radio" value='4' name="question<?=$row->que_id?>"><?php echo $row->ans4;?></label>
            </div>
        </div>
         <?php }  
         ?>  <input type="submit" name="submit" value="submit" id="subone2">
                </form>
              
              
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
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


