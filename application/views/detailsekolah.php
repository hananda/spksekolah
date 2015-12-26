<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detail Sekolah</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/typeahead/typeahead.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .spinner {
      background:url('<?php echo base_url();?>assets/images/spinner.gif') no-repeat right center !important;
      background-size : 16px 16px !important;
    }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>" style="text-decoration:none;">SPK Sekolah</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!-- <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo @$sekolah->sekolah_nama ?></h1>
                <hr>
                <!-- Post Content -->
                <?php echo @$sekolah->sekolah_desc; ?>
               <!--  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>
 -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Compare Dengan sekolah lain</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                              <div class="form-group">
                                <input type="text" class="form-control" id="nmsekolah" placeholder="Cari nama sekolah">
                              </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <div class="well" id="listcompare">
                    <h4>List Compare Sekolah</h4><hr style="border-color:black;">
                    
                    <!-- /.row -->
                </div>
                <button type="button" class="btn btn-success" id="btncompare">Hitung SPK</button>
            </div>
        </div>
        <hr>
        <!-- Large modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button> -->

        <div class="modal fade bs-example-modal-lg" id="modalspk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="mySmallModalLabel">Hasil Perhitungan SPK Sekolah Swasta</h4>
                </div>
                <div class="modal-body" id="modalcontent">
                  
                </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; SPK Sekolah Swasta 2015</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/handlebars.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bloodhound.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/typeahead.bundle.js"></script>
    <script type="text/javascript">
        var idsekolahselected = 0;
        var idsekolah = '<?php echo $id; ?>';
        var states = new Bloodhound({ 
        //datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'), 
            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // `states` is an array of state names defined in "The Basics" 
            //local: $.map(states, function(state) { return { value: state }; }) 
            remote: {
                url: '<?php echo site_url(); ?>dashboard/sekolah_typeahead?',
                beforeSend: function(xhr){
                  $('.tt-hint').addClass('spinner');
                },
                replace: function(url, uriEncodedQuery) {
                  query = $('#nmsekolah.tt-input').val();
                  // if (!val) return url;
                  return url + 'query='+query+'&idsekolah='+idsekolah;
                },
                filter: function (sekolah) {
                  $('.tt-hint').removeClass('spinner');
                    return $.map(sekolah.result, function (sekolah) {
                        return {
                            nama: sekolah.sekolah_nama,
                            foto: sekolah.sekolah_foto,
                            alamat: sekolah.sekolah_alamat,
                            idsekolah:sekolah.sekolah_id
                        };
                    });
                }
            }
          }); 

      // kicks off the loading/processing of `local` and `prefetch` 
        states.initialize();

        $('#nmsekolah').typeahead(null, {
            name: 'states',
            displayKey: 'value',
            source: states.ttAdapter(),
            templates: {
              empty: [
              '<div class="empty-message">',
              'tidak dapat menemukan data sekolah',
              '</div>'
              ].join('\n'),
              suggestion: Handlebars.compile('\
                <div class="row">\
                        <div class="col-lg-4">\
                            <img src="<?php echo base_url() ?>foto_sekolah/{{foto}}" width="64" height="64" />\
                        </div>\
                        <div class="col-lg-8">\
                            <p>{{nama}}<br>\
                            {{alamat}}</p>\
                        </div>\
                    </div>')}
        }).on('typeahead:selected', function (obj, datum) {
            // console.log(obj);
            // console.log(datum);
            if ($("#sekolah"+datum.idsekolah).length == 0) {
                var foto = '';
                if (datum.foto) {
                    foto = '<?php echo base_url() ?>foto_sekolah/'+foto;
                }else{
                    foto = '<?php echo base_url(); ?>assets/images/no_image.jpg';
                }
                $("#listcompare").append('\
                    <div class="row rowcompare" id="sekolah'+datum.idsekolah+'"  data-id="'+datum.idsekolah+'">\
                        <div class="col-lg-4">\
                            <img src="<?php echo base_url() ?>foto_sekolah/'+datum.foto+'" width="64" height="64" />\
                        </div>\
                        <div class="col-lg-8">\
                            <p>'+datum.nama+'<br>\
                            '+((datum.alamat) ? datum.alamat : '')+'</p>\
                            <button type="button" data-id="'+datum.idsekolah+'" class="btn btn-danger btnhapuscompare">Hapus</button>\
                        </div>\
                        <div class="col-lg-12">\
                    <hr style="border-color:black;">\
                    </div>\
                    </div>');
            }
            // idsekolahselected = datum.idsekolah;
        });

      $('.tt-query').css('background-color','#fff');

      $("#btncompare").click(function(event) {
          event.preventDefault();
          var arrsekolah = [];
          arrsekolah.push(<?php echo $id; ?>);
          if ($(".rowcompare").length == 0) {
            alert('anda belum memilih sekolah lain untuk dicompare !');
            return false;
          }

          $(".rowcompare").each(function(index, el) {
              arrsekolah.push($(this).data().id);
          });

          console.info(arrsekolah);

          $.ajax({
              url: '<?php echo base_url(); ?>dashboard/compare',
              type: 'POST',
              dataType: 'html',
              data: {arr: arrsekolah},
          })
          .done(function(resp) {
              $("#modalcontent").html(resp);
              $("#modalspk").modal("show");
          })
          .fail(function() {
              console.log("error");
          })
          .always(function() {
              console.log("complete");
          });
          
      });

      $(document).on('click', '.btnhapuscompare', function(event) {
          event.preventDefault();
          var id = $(this).data().id;
          $("#sekolah"+id).remove();
      });
    </script>
</body>

</html>
