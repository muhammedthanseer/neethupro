<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Exam Subjects
        <small></small>
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
                    <h3 class="box-title">Exam Subject List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group">                        
                            
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <?php foreach($result->result() as $r) 
                    { ?>
			    <table class="table table-hover">
                    <th>Student Name</th>
                    <th>Score</th>
				    <tr>
				    <td width="200px"><?=$r->name;?></td>
				    <td><?=$r->score;?></td>
				    </tr>
			    </table>
		<?php
		    }
                                  
                    ?>
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
