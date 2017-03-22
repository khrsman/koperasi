<!-- <div class="container" style="margin-top:80px;"> -->
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>



  <!-- PAGE START -->
  <div class="row multi-columns-row">

    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <a href="<?php echo site_url('store/koperasi'); ?>" class="btn btn-primary btn-lg btn-block">Produk Koperasi</a>
        </div>

        <div class="col-md-6">
          <a href="<?php echo site_url('store/product/member'); ?>" class="btn btn-default btn-lg btn-block">Produk Anggota</a>
        </div>
      </div>
      <hr>
    </div>


    <div class="col-md-12">

      <form class="form-horizontal" action="<?php echo $form_action; ?>" method="GET" >
        <div class="box box-info">

            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-search" style="margin-right:7px"></i> Cari Koperasi</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="rows">
                  
                  <?php if(!empty(validation_errors())): ?>
                  <div class="alert alert-danger alert-dismissable">
                     <?php echo validation_errors(); ?>
                  </div> 
                  <?php endif; ?>

                  <div class="form-group">
                      <label for="filter_kabupaten" class="col-sm-4 control-label">Kota / Kabupaten</label>
                      <div class="col-sm-6">

                        <select id="filter_kabupaten" class="selectpicker_kabupaten with-ajax search-select form-control" name="filter_kabupaten" data-live-search="true" required=""></select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="filter_kodepos" class="col-sm-4 control-label">Kode Pos</label>
                      <div class="col-sm-6">
                        <input type="number" name="filter_kodepos" class="form-control" id="filter_kodepos" />
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="filter_kodepos" class="col-sm-4 control-label"></label>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search" style="margin-right:7px"></i> Cari Koperasi</button>
                        &nbsp;atau&nbsp;
                        <a href="<?php echo site_url('store/product').'?filter_koperasi='.$this->session->userdata('koperasi'); ?>" class="btn btn-default"><i class="fa fa-shopping-bag" style="margin-right:7px"></i> Koperasi Saya</a>
                      </div>
                  </div>

              </div>
            </div>

        </div>
      </form>

    </div>
  </div>
  <!-- PAGE END -->




<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ajax-bootstrap-select.js"></script>
<script type="text/javascript">
  

$('.selectpicker').selectpicker('val', ['Mustard','Relish']);
</script>


<script type="text/javascript">
    var options = {
        ajax          : {
            url     : '<?php echo base_url()."store/koperasi/search_kabupaten"; ?>',
            type    : 'POST',
            dataType: 'json',
            data    : {
                keyword: '{{{q}}}'
            }
        },
        locale        : {
            currentlySelected : 'Saat ini dipilih',
            emptyTitle        : 'Ketikan nama kota / kabupaten',
            errorText         : 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder : 'Ketikan nama kabupaten...',
            statusInitialized : 'Lakukan pencarian kabupaten',
            statusNoResults   : 'Pencarian tidak ditemukan',
            statusSearching   : 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].id,
                    }));
                }
            }

            return array;
        }
    };

    $('.selectpicker_kabupaten').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);


</script>