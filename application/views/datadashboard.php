<?php 
    
    // $tot_rows = counted rows for query
    // $pp = items per page
    // $curr_page = the current page number

    function get_paging_info($tot_rows,$pp,$curr_page)
    {
        $pages = ceil($tot_rows / $pp); // calc pages

        $data = array(); // start out array
        $data['si']        = ($curr_page * $pp) - $pp; // what row to start at
        $data['pages']     = $pages;                   // add the pages
        $data['curr_page'] = $curr_page;               // Whats the current page

        return $data; //return the paging data

    }
        // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div class="row">
            <?php if ($sekolah->num_rows > 0): ?>
                <?php foreach ($sekolah->result() as $r): ?>
                    <div class="col-md-4 portfolio-item">
                        <a href="#">
                            <img src="<?php echo base_url() ?><?php echo ($r->sekolah_foto) ? 'foto_sekolah/'.$r->sekolah_foto : 'assets/images/no_image.jpg'; ?>" width="256" height="256" alt="">
                        </a>
                        <h3>
                            <a href="<?php echo base_url() ?>detail/<?php echo $r->sekolah_id; ?>"><?php echo $r->sekolah_nama ?></a>
                        </h3>
                        <p><?php //echo $r->sekolah_desc; ?></p>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <!-- <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul> -->
                <?php if ($sekolah->num_rows > 0): ?>
                <center>
                    <ul class="pagination">
                    <?php $paging_info = get_paging_info($countsekolah,$numperpage,$curr_page); ?>
                        <!-- If the current page is more than 1, show the First and Previous links -->
                        <?php if($paging_info['curr_page'] > 1) : ?>
                            <li><a aria-label="Previous" data-hal="0"><span aria-hidden="true">«</span></a></li>
                            <li><a aria-label="Previous" data-hal="<?php echo ($paging_info['curr_page'] - 1); ?>"><span aria-hidden="true">Prev</span></a></li>
                        <?php endif; ?>



                        <?php
                            //setup starting point

                            //$max is equal to number of links shown
                            $max = 7;
                            if($paging_info['curr_page'] < $max)
                                $sp = 1;
                            elseif($paging_info['curr_page'] >= ($paging_info['pages'] - floor($max / 2)) )
                                $sp = $paging_info['pages'] - $max + 1;
                            elseif($paging_info['curr_page'] >= $max)
                                $sp = $paging_info['curr_page']  - floor($max/2);
                        ?>

                        <!-- If the current page >= $max then show link to 1st page -->
                        <?php if($paging_info['curr_page'] >= $max) : ?>
                            <li><a data-hal="1">1</a></li>
                            <li class="disabled"><a>...</a></li>
                        <?php endif; ?>

                        <!-- Loop though max number of pages shown and show links either side equal to $max / 2 -->
                        <?php for($i = $sp; $i <= ($sp + $max -1);$i++) : ?>

                            <?php
                                if($i > $paging_info['pages'])
                                    continue;
                            ?>

                            <?php if($paging_info['curr_page'] == $i) : ?>
                                <li class="active"><a data-hal="<?php echo $i ?>"><?php echo $i ?> <span class="sr-only">(current)</span></a></li>

                            <?php else : ?>
                                <li><a data-hal="<?php echo $i ?>"><?php echo $i ?></a></li>

                            <?php endif; ?>

                        <?php endfor; ?>


                        <!-- If the current page is less than say the last page minus $max pages divided by 2-->
                        <?php if($paging_info['curr_page'] < ($paging_info['pages'] - floor($max / 2))) : ?>

                            <li class="disabled"><a>...</a></li>
                            <li><a data-hal="<?php echo $paging_info['pages']; ?>"><?php echo $paging_info['pages']; ?></a></li>

                        <?php endif; ?>

                        <!-- Show last two pages if we're not near them -->
                        <?php if($paging_info['curr_page'] < $paging_info['pages']) : ?>
                            <li><a aria-label="Next" data-hal="<?php echo ($paging_info['curr_page'] + 1); ?>"><span aria-hidden="true">Next</span></a></li>
                            <li><a aria-label="Next" data-hal="<?php echo $paging_info['pages']; ?>"><span aria-hidden="true">»</span></a></li>
                            
                        <?php endif; ?>
                    </ul>
                </center>
            <?php endif ?>
            </div>
        </div>
<script type="text/javascript">
    $(".pagination li a").click(function(event) {
        event.preventDefault();
        var hal = $(this).data().hal;
        reloadpage(hal);
    });
</script>