<?php include("header.php"); ?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("left_sidebar.php"); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Topbar Start -->
                <?php include("topbar.php"); ?>
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">Report</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- start_date>i>d,end_date>i>d -->

                    <!-- Form Row Starts -->
                    <form method="post" action="" id="form_report_rad626eaf7b8d69a">
                        <div class="row">
                            <?php
                            $start_date = safe_post("report_start_date") ?: get_current_month_start_date();
                            $end_date = safe_post("report_end_date") ?: get_current_month_last_date();
                            ?>
                            <div class="form-group ic_report_start_date col-md-3 d-inline-block">
                                <label class="report_start_date" for="report_start_date">Start Date</label>
                                <input type="date" class="form-control report_start_date" placeholder="Start Date" name="report_start_date" value="<?php echo $start_date; ?>">
                            </div>
                            <div class="form-group ic_report_end_date col-md-3 d-inline-block">
                                <label class="report_end_date" for="report_end_date">End Date</label>
                                <input type="date" class="form-control report_end_date" placeholder="End Date" name="report_end_date" value="<?php echo $end_date; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-success btn-sm insert_report" value="Get Report" form_id="rad626eaf7b8d69a">
                            </div>
                    </form>
                </div>
                <!-- Form Row Ends -->

                <!-- end row -->
                <!-- Content here  -->

                <!-- Content here  -->

                <p><strong>Export Tools</strong></p>
                <a href="javascript:void" class="btn btn-secondary btn-sm export_to_csv_report"><i class="fa fa-download" aria-hidden="true"></i> CSV</a>
                <a href="javascript:void" class="btn btn-secondary btn-sm export_to_xls_report"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
                <a href="javascript:void" class="btn btn-secondary btn-sm print_table_report"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
            </div> <!-- container -->

        </div> <!-- content -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
    <?php include("core_scripts.php"); ?>
    <script>
      
//Export and print codes
// var records_table_id = "#list_table_report";
// $(".export_to_csv_report").click(function(){
// $(records_table_id).tableToCSV();
// });

// $(".export_to_xls_report").click(function(){
//   $(records_table_id).tableExport({
// filename: 'records.xls',
// escape:'false'
// });
// });

// function beforeprinttable(){
// //   $(records_table_id+" th:last-child,"+ records_table_id + " td:last-child").hide();
// };

// function afterprinttable(){
// setInterval(function(){
// //   $(records_table_id + " th:last-child,"+ records_table_id + " td:last-child").show();
// },1000);
// };

// $(".print_table_report").click(function(){
// $(records_table_id).printThis({  
// beforePrint:beforeprinttable(),
// afterPrint:afterprinttable()
// });
// });
    </script>

    <?php include("footer.php"); ?>