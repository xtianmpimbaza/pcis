<script>
    $(document).ready(function () {

        window.viewer_modal = function ($src = '') {
            start_loader()
            var t = $src.split('.')
            t = t[1]
            if (t == 'mp4') {
                var view = $("<video src='" + $src + "' controls autoplay></video>")
            } else {
                var view = $("<img src='" + $src + "' />")
            }
            $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
            $('#viewer_modal .modal-content').append(view)
            $('#viewer_modal').modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
                focus: true
            })
            end_loader()

        }

        window.uni_modal = function ($title = '', $url = '', $size = "") {
            start_loader()
            $.ajax({
                url: $url,
                error: err => {
                    console.log(err)
                    alert("An error occured")
                },
                success: function (resp) {
                    if (resp) {
                        $('#uni_modal .modal-title').html($title)
                        $('#uni_modal .modal-body').html(resp)

                        if ($size != '') {
                            $('#uni_modal .modal-dialog').addClass($size + '  modal-dialog-centered')
                        } else {
                            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
                        }

                        $('#uni_modal').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false,
                            focus: true,
                        })
                        end_loader()
                    }
                }
            })
        }

        window._conf = function ($msg = '', $func = '', $params = []) {
            $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
        }
    })
</script>
<footer class="main-footer text-sm">
    <strong>Copyright © <?php echo date('Y') ?>.
        <!-- <a href=""></a> -->
    </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <!--            Group work-->
    </div>
</footer>
</div>
<!-- ./wrapper -->
<div id="libraries">
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>

    <script src="<?php echo base_url ?>dist/js/adminlte.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url ?>plugins/dataTables/js/buttons.print.min.js"></script>


    <script>
        new DataTable('#example', {
            buttons: ['copy', 'excel', 'pdf', 'print'],
            layout: {
                topStart: 'buttons'
            }
        });

        new DataTable('#example2', {
            buttons: ['copy', 'excel', 'pdf', 'print'],
            layout: {
                topStart: 'buttons'
            }
        });
    </script>

    <!--    ------------- End -------->


</div>
<div class="daterangepicker ltr show-ranges opensright">
    <div class="ranges">
        <ul>
            <li data-range-key="Today">Today</li>
            <li data-range-key="Yesterday">Yesterday</li>
            <li data-range-key="Last 7 Days">Last 7 Days</li>
            <li data-range-key="Last 30 Days">Last 30 Days</li>
            <li data-range-key="This Month">This Month</li>
            <li data-range-key="Last Month">Last Month</li>
            <li data-range-key="Custom Range">Custom Range</li>
        </ul>
    </div>
    <div class="drp-calendar left">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
    </div>
    <div class="drp-calendar right">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
    </div>
    <div class="drp-buttons"><span class="drp-selected"></span>
        <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button>
        <button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button>
    </div>
</div>
<!--<div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>-->