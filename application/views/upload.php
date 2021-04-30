<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> FILE MANAGEMENT
  
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                  <form action="<?= base_url()?>user/do_upload" method="POST" enctype="multipart/form-data">
                    <input type="file" name ="customeFile" class="form-control">
                    <input type="submit" name="submit" class="bt btb-primary">
                </form>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">File List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>uploadlisting" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Filename</th>
                        <th>filesize</th>
                        <th>date of upload</th>
                        <th>File Content</th> 
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($uploadRecords))
                    {
                        foreach($uploadRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->filename ?></td>
                        <td><?php echo $record->filesize ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->dateofupload)) ?></td>
                        <td><?php echo $record->content ?></td> 
                        <td class="text-center">
                             <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>editfile" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deletefile" href="#" data-userid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                 <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>

              </div><!-- /.box -->
            </div>
        </div>
    </section>
    <div class="box-tools">
                        <form action="<?php echo base_url() ?>searchWord" method="POST" id="searchWord">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" id = "inputSearch" style="width: 150px;" placeholder="SEARCH WORD"/>
                             
                              <div class="input-group-btn">
                                <button style ="    margin-right: 28pc;" class="btn btn-sm btn-default searchList">Search<i class=" "></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
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

<script>
    function searchWord()
    {
        jQuery('#btnSave').text('saving...'); //change button text
        jQuery('#btnSave').attr('disabled',true); //set button disable
        var url=""; 
        var DateSelected="";
        var oldRef = " ";
        //jQuery('[name="refref"]').val(jQuery('#refref').text());
//jQuery('#refref').text(data.ref);
          DateSelected =  jQuery('#refref').text();//jQuery("newRef").attr("newRef");//.getElementById("newRef").value;
           jQuery('#oldRef').val(DateSelected);
// //mAKE IF STAEMENT TO CHECK if value is empty
        // alert(value.length);
        alert(jQuery('#oldRef').text());
        alert(jQuery('#newRef').val());
        // if(DateSelected.length > 0)
        // {
             url = "<?php echo base_url()?>index.php/Dashboard/editReference";

        // ajax adding data to database
        jQuery.ajax({
            url : url,
            type: "POST",
            data: jQuery('#searchWord').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              alert('Record Successfully Edited');
              jQuery('#exampleModal3').modal('hide');
                 
                jQuery('#btnSave').text('Save'); //change button text
                jQuery('#btnSave').attr('disabled',false); //set button enable
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              alert("Failed changing the reference");
              console.log(jqXHR.responseText);
              console.log(textStatus);
              console.log(errorThrown);
                //alert('Error adding / update data'+errorThrown+' text status: '+textStatus+' jqXHR: '+jqXHR);
                //console.warn(jqXHR.responseText);
                jQuery('#btnSave').text('Save'); //change button text
                jQuery('#btnSave').attr('disabled',false); //set button enable

            }
        }); 
    }
    </script>
 
