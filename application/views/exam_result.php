<style type="text/css">
  
  #whatis
  {
    <?php
    echo "hai";
      ?>
  }



</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Exam Results
        <small>....</small>
      </h1>
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
                    <h3 class="box-title">Exam Subject Results</h3>
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
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody>  
         <tr>  
            <td>user_id</td>  
            <td>sub_id</td>  
             <td>score</td>
             <td>name</td>
             <td>Subject Name</td>
         </tr>  
         <?php  
         foreach ($h->result() as $row)  
         {  
            ?><tr>  
            <td><?php echo $row->user_id;?></td>
            <td><?php echo $row->sub_id;?></td>
            <td><?php echo $row->score;?></td>
            <td><?php echo $row->name;?></td>
            <td><?php 
            if ($row->sub_id == 1) 
            {
              echo "C PROGRAMMING";
            }
            elseif ($row->sub_id == 2) 
            {
              echo "C++ PROGRAMMING";
            }
            elseif ($row->sub_id == 3) 
            {
              echo "JAVA";
            }
            elseif ($row->sub_id == 4) 
            {
              echo "PYTHON";
            }
            elseif ($row->sub_id == 5) 
            {
              echo "RUBY";
            }
            elseif ($row->sub_id == 6) 
            {
              echo "PHP";
            }


            ?></td>         
              <!--  <td><a href="#">START</a></td>  -->
            </tr>

         <?php }  
         ?>  
      </tbody>  
                    <?php
                        
                    
                    ?>
                  </table>
                  <!-- <div> -->
                    <!-- <table border=1>
                      <tr>
                        <th>SUB ID</th>
                        <th>SUBJECT NAME</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>C PROGRAMMING</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>CPP PROGRAMMING</td>
                      </tr>
                    </table> -->
                  




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
