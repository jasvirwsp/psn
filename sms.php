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

                <h4 class="page-title">Send SMS to <?php echo beautify_meta_name(title_case("plumber")); ?>s
                </h4>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <!-- RAD Featured Table-->

          <?php

          //Configurations
          $record_type = "plumber";
          $show_date_column = true;
          $enable_export_tools = true;
          $enable_footer_stats = false;
          //Search
          $search_by_columns = array('record_id', 'plumber_name', 'plumber_mobile_no', 'plumber_whatsapp_no', 'plumber_address', 'plumber_city', 'plumber_state', 'plumber_district', 'plumber_verified', 'plumber_date_of_birth', 'plumber_date_of_marriage'); //you can also put "all" or array.
          $enable_date_filter = true;
          //Columns
          $columns_to_list = array('record_id', 'plumber_name', 'plumber_mobile_no', 'plumber_whatsapp_no', 'plumber_address', 'plumber_city', 'plumber_state', 'plumber_verified');  // You can set it to "all", array("meta_name","another_meta_name"), blank
          if (safe_get("show_all_fields") == "yes") {
            $columns_to_list = "all";
          }
          $columns_to_exclude = array("");
          //Action Buttons
          $edit_button_url = "edit_plumber.php?plumber_id=";
          $view_button_url = "view_plumber.php?plumber_id=";
          $delete_button_class = "delete_plumber";
          //Records
          $per_page = 20;
          //Offset settings
          if (isset($_GET["override_limit"])) {
            $per_page = safe_get("override_limit");
          }
          $offset = 0;
          $page = 1;
          if (isset($_GET["page"])) {
            $page = safe_get("page");
            if ($page > 0) {
              $offset = ($page - 1) * $per_page;
            }
          }

          //Get record meta keys
          $meta_keys_array_name = "meta_keys_of_" . $record_type;
          $meta_keys_array =  $$meta_keys_array_name;


          //Initial records query 
          $where_array = array("plumber_name != ?" => ""); // You can change it as per required
          $options_array = array("orderBy" => "record_id DESC", "limit" => $per_page, "offset" => $offset);

          //End Configurations


          //Search By Columns
          if ($search_by_columns == "all") {
            $search_by_columns = $meta_keys_array;
          }
          ?>

          <!-- by>s>this,keyword>i -->
          <div class="row">
             <div class="col-lg-12">
<div id="accordiontwo" class="">
<div class="card mb-0">
<div class="card-header bg-dark text-white" id="headingTwo">
<h5 class="m-0">
    <a class="text-white" data-toggle="collapse" href="#collapseTwo" aria-expanded="true">
        <i class="mdi mdi-comment mr-1 text-primary"></i> 
        SMS Body
    </a>
</h5>
</div>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordiontwo">
<div class="card-body">
<div class="form-group ic_sms_body col-md-12 d-inline-block">
<label class="sms_body" for="sms_body">Your Message</label>
<textarea rows="5" type="text" class="form-control sms_body" placeholder="Your Message Here" name="sms_body"></textarea>

</div>

<div class="form-group ic_sms_body col-md-5 d-inline-block">
<button type="button" class="btn btn-primary select_all_mobile">Select All</button>
<button type="button" class="btn btn-primary sms_to_selected">Send</button>
<button type="button" class="btn btn-success reset_process">Reset</button>
</div>
<div class="form-group ic_sms_body col-md-5 d-inline-block">
<h5>
    <span class="text-dark" data-toggle="collapse" aria-expanded="true">
        <i class="mdi mdi-account-multiple mr-1 text-primary"></i> 
        Selected Contacts - 
        <span class="text-primary mobile_count"><b></b></span>
    </span>
    <!-- output sms -->
    <span class="text-dark" data-toggle="collapse" aria-expanded="true">
        <span class="text-success output_message"><b></b></span>
    </span>
</h5>
</div>
</div>
</div>
</div>
</div> <!-- end #accordions-->
</div> <!-- end col -->
</div>
<br><br>
          <div id="accordion" class="w-100 mb-3">
            <div class="card mb-0">
              <div class="card-header" id="headingOne">
                <h4 class="m-0">
                  <a class="text-dark" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                    <i class="mdi mdi-table-search mr-1 text-primary"></i>
                    Search Records
                  </a>
                </h4>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">


                  <!-- Row Starts -->
                  <div class="row">
                    <!-- Col 1 -->
                    <div class="col-sm-3">
                      <form method="get" action="" id="form_search_rad5c40c114c0d28">
                        <div class="form-group d-inline-block">
                          <label for="search_by">Search By</label>
                          <select required class="form-control db_auto_chose reset_me" name="search_by" db_auto_chose_value="<?php echo safe_get('search_by'); ?>">
                            <option value="">Select Search By</option>
                            <?php foreach ($search_by_columns as $single_column) {
                            ?>
                              <option value="<?php echo $single_column; ?>"><?php echo beautify_meta_name($single_column); ?></option>
                            <?php
                            } ?>

                          </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group d-inline-block">
                        <label for="search_keyword">Search Keyword</label>
                        <input type="text" class="form-control reset_me" placeholder="Keyword" name="search_keyword" value="<?php echo safe_get('search_keyword'); ?>">
                      </div>
                    </div>
                    <!-- Date Filter    -->
                    <?php if ($enable_date_filter) { ?>
                      <div class="col-sm-3">
                        <div class="form-group d-inline-block">
                          <label for="search_start_date">Start Date</label>
                          <input type="date" class="form-control reset_me" placeholder="Start Date" name="search_start_date" value="<?php echo safe_get('search_start_date'); ?>">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group d-inline-block">
                          <label for="search_end_date">End Date</label>
                          <input type="date" class="form-control reset_me" placeholder="End Date" name="search_end_date" value="<?php echo safe_get('search_end_date'); ?>">
                        </div>
                      </div>
                    <?php } ?>
                    <!-- Date Filter    -->
                    <div class="form-group col-sm-12">
                      <input type="submit" class="btn btn-secondary btn-sm insert_search" value="SEARCH" form_id="rad5c40c114c0d28">

                      <input type="button" class="btn btn-secondary btn-sm reset_form" value="RESET FILTERS" form_id="rad5c40c114c0d28">
                    </div>
                    </form>


                  </div>
                  <!-- Col 1 ends-->
                </div>
                <!-- Row Ends -->
              </div>
            </div>
          </div>




        </div>

        <table class="table table-striped <?php if (safe_get('show_all_fields') == 'yes') {
                                            echo 'table-responsive';
                                          } ?>" id="list_table_plumber">
          <?php


          //set columns
          $selected_columns = array($meta_keys_array[0], $meta_keys_array[1]); // if columns_to_list is blank select first two automatically
          if ($columns_to_list == "all") {
            $selected_columns = $meta_keys_array;
          }
          if (is_array($columns_to_list)) {
            $selected_columns = $columns_to_list;
          }

          ?>
          <thead class="bg-dark">
            <tr>
              <th>
                  <a href="javascript:void(0)" class="btn btn-info btn-sm select_all_to_delete mt-1" status="unchecked"><i class="fe-check-circle"></i></a> <?php if ($user_role == "admin") { ?><a href="javascript:void(0)" class="btn btn-danger btn-sm delete_selected mt-1"><i class="fe-trash"></i></a> <?php } ?></th>
              <?php
              //Pass thru Function for titles
              function pass_thru_title($single_column)
              {

                $response_array = array("plumber_verified" => "Visiting Card Verified");

                if (isset($response_array[$single_column])) {

                  $return_value = $response_array[$single_column];

                  return $return_value;
                }
              }
              //Pass thru Function for titles
              ?>
              <?php
              foreach ($selected_columns as $single_column) {
                if (in_array($single_column, $columns_to_exclude)) {
                  continue;
                }
              ?>
                <th><?php echo pass_thru_title($single_column) ?: beautify_meta_name($single_column); ?></th>
              <?php
              }
              ?>
              <?php if ($show_date_column) { ?>
                <th>Date Created</th>
              <?php } ?>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            //Check if search query is reqeusted
            if (isset($_GET["search_by"])) {
              $search_by = safe_get("search_by");
              $search_keyword = safe_get("search_keyword");
              $where_array = array($search_by . " LIKE ?" => "%" . $search_keyword . "%");
              $options_array = array("orderBy" => "record_id DESC");

              if ($search_by == "record_id") {
                $where_array = array("record_id" => $search_keyword);
                $options_array = array("limit" => 1);
              }

              if (isset($_GET["search_start_date"]) && ($_GET["search_start_date"] != "")) {
                $start_date = safe_get("search_start_date");
                $end_date = safe_get("search_end_date");
                $options_array = array("between" => "date(date_created)," . $start_date . "," . $end_date);
              }
            }

            $total_records = $records_fetch_controller->fetch_count_by_record_type_and_where_array([$record_type, $where_array]);
            $list_records = $records_fetch_controller->fetch_record_with_where([$record_type, $where_array, $options_array]);
            $count_list_records = count($list_records);
            if ($count_list_records == 0) {
              $zero_records = "<h4 class='text-center'>No Data Found</h4>";
            }


            //Pass thru custom functions
            //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
            //   return "test ".$dynamic_value;
            // }

            function plumber_verified($single_column, $dynamic_value, $record_id, $data_array)
            {
              if ($dynamic_value == "" || $dynamic_value == "no") {
                return "<span class='p-1 bg-danger d-block text-white text-center rounded'>No</span>";
              }
              if ($dynamic_value == "yes") {
                return "<span class='p-1 bg-success d-block text-white text-center rounded'>Yes</span>";
              }
            }


            //Pass thru custom functions
            //Pass thru Function
            function pass_thru($single_column, $dynamic_value, $record_id, $data_array)
            {
              // Ex $allowed_columns = array("dummy_column");
              $allowed_columns = array("plumber_verified");

              if (in_array($single_column, $allowed_columns)) {

                $return_value = $single_column($single_column, $dynamic_value, $record_id, $data_array);

                return $return_value;
              }
            }
            //Pass thru Function

            //Loop list records
            $do_total_array = array(); //add columns here
            $totals_array = array();
            foreach ($list_records as $single_record) {
              $record_id = $single_record["record_id"];

            ?>
              <tr>
                <td><div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input mobile_number" id="checkmeout_<?php echo $record_id; ?>" record_id="<?php echo $record_id; ?>">
                      <label class="custom-control-label" for="checkmeout_<?php echo $record_id; ?>"></label>
                    </div></td>
                <?php
                foreach ($selected_columns as $single_column) {
                  //Do total
                  if (in_array($single_column, $do_total_array)) {
                    $exclude_from_pass_thru = array();
                    if (in_array($single_column, $exclude_from_pass_thru)) {
                      $totals_array[$single_column] = $totals_array[$single_column] + $single_record[$single_column];
                    } else {
                      $totals_array[$single_column] = $totals_array[$single_column] + (pass_thru($single_column, $single_record[$single_column], $record_id, $single_record) ?: $single_record[$single_column]);
                    }
                  };
                  //Do total
                  if (in_array($single_column, $columns_to_exclude)) {
                    continue;
                  }
                  if ($single_column == "record_id") {
                ?>
                    <td class="<?php echo $single_column; ?> <?php echo $single_column . "_" . $record_id; ?>"><?php echo pass_thru($single_column, $record_id, $record_id, $single_record) ?: $record_id; ?></td>
                  <?php
                    continue;
                  }
                  ?>
                  <td class="<?php echo $single_column; ?> <?php echo $single_column . "_" . create_slug($single_record[$single_column]); ?>"><?php echo pass_thru($single_column, $single_record[$single_column], $record_id, $single_record) ?: title_case($single_record[$single_column]); ?></td>
                <?php  }

                if ($show_date_column) {
                ?>
                  <td><?php echo humanize_date($single_record["date_created"]); ?></td>
                <?php
                }
                ?>
                <td>
                  <!--Dyanamic buttons -->
                  <?php
                  //Dynamic Buttons Array
                  //Title,Href,CSS Classes,Icon,Tooltip,Target
                  $dynamic_buttons = array(
                    ["View", "view_plumber.php?plumber_id=$record_id", "btn btn-sm w-100 mb-1 btn-warning", "fe-activity", "", "_self"]
                  );
                  //Dynamic Buttons Array

                  //Loop Buttons
                  foreach ($dynamic_buttons as $single_button) {
                  ?>
                    <a target="<?php echo $single_button[5]; ?>" class="<?php echo $single_button[2] ?: "btn btn-sm w-100 mb-1 btn-info"; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $single_button[4] ?: $single_button[0]; ?>" href="<?php echo $single_button[1] ?>"><i class="<?php echo $single_button[3] ?>"></i> <?php echo $single_button[0] ?></a>
                  <?php
                  }
                  // loop  buttons ends
                  ?>
                  <!--Dyanamic buttons -->
                  <a class="btn btn-info btn-sm w-100 mb-1" data-toggle="tooltip" data-placement="top" title="View/Edit" href="<?php echo $edit_button_url . $record_id; ?>"><i class="fe-edit-1"></i> Edit</a>
                  <?php if ($user_role == "admin") { ?>
                    <a class="btn btn-danger btn-sm  w-100 mb-1 <?php echo $delete_button_class; ?>" data-toggle="tooltip" data-placement="top" title="Delete" href=javascript:void(0)" record_id="<?php echo $record_id; ?>"><i class="fe-trash-2"></i></a>
                  <?php } ?>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <?php
        if ($zero_records) {
          echo $zero_records;
        }
        ?>

        <?php
        //Only show pagination if search is not queried
        if (!isset($_GET["search_by"])) {
          if (!isset($_GET["override_limit"])) {
        ?>
            <!-- Row Starts -->
            <div class="row">
              <!-- Col 1 -->
              <div class="col-sm-6">
                <?php if ($page > 1) {
                  $prev_page = $page - 1;
                ?>
                  <a href="?page=<?php echo $prev_page; ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
                <?php } ?>
                <?php
                //Total Records for pagination        
                $this_page_records = $page * $per_page;

                if ($total_records > $this_page_records) {
                  $next_page = $page + 1;
                ?>
                  <a href="?page=<?php echo $next_page; ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-right" aria-hidden="true"></i> Next</a>
                <?php
                }
                ?>

              </div>
              <!-- Col 1 ends-->

              <!-- Col 2 -->
              <div class="col-sm-6">
                Total Records : <strong><?php echo $total_records; ?></strong> . Limit : <strong><?php echo $per_page; ?> Per Page </strong>
                <?php if ($total_records > $this_page_records) { ?>
                  <a href="?override_limit=0" class="btn btn-info btn-sm"><i class="fa fa-list" aria-hidden="true"></i> View All</a> <a href="?override_limit=0&show_all_fields=yes" class="btn btn-info btn-sm"><i class="fa fa-list" aria-hidden="true"></i> View All with All Fields</a> <?php } ?>
              </div>
              <!-- Col 2 ends -->
            <?php } ?>
            </div>
            <!-- Row Ends -->
            <?php if ($enable_export_tools) { ?>
              <div class="row">
                <!-- Col 1 -->
                <div class="col-sm-12">
                  <p><strong>Export Tools</strong></p>
                  <a href="javascript:void" class="btn btn-secondary btn-sm export_to_csv_plumber"><i class="fa fa-download" aria-hidden="true"></i> CSV</a>
                  <a href="javascript:void" class="btn btn-secondary btn-sm export_to_xls_plumber"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
                  <a href="javascript:void" class="btn btn-secondary btn-sm print_table_plumber"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                  <?php if (!isset($_GET["show_all_fields"])) { ?>
                    <a href="plumber.php?show_all_fields=yes" class="btn btn-secondary btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Show All Fields</a>
                  <?php } ?>
                </div>
                <!-- Col 1 ends -->
              </div>
              <!-- Row Ends -->
            <?php } ?>

          <?php  }
          ?>
          <!-- RAD Featured Table-->

          <?php if ($enable_footer_stats) { ?>
            <!-- Horizontal Card 3 Column -->
            <div class="card text-white bg-dark mb-3 mt-3">
              <div class="card-header bg-dark">Stats</div>
              <div class="card-body">
                <!-- Row Starts -->
                <div class="row">
                  <!-- Col 1 -->
                  <div class="col-sm-4">
                    <h5 class="card-title">Stat : </h5>
                    <p class="card-text">0</p>
                  </div>
                  <!-- Col 1 ends-->

                  <!-- Col 2 -->
                  <div class="col-sm-4">
                    <h5 class="card-title">Stat : </h5>
                    <p class="card-text">0</p>
                  </div>
                  <!-- Col 2 ends -->

                  <!-- Col 3 -->
                  <div class="col-sm-4">
                    <h5 class="card-title">Stat : </h5>
                    <p class="card-text">0</p>
                  </div>
                  <!-- Col 3 ends -->
                </div>
                <!-- Row Ends -->
              </div>
            </div>
            <!-- Horizontal Card 3 Column -->
          <?php } ?>
          <!-- end row -->

      </div> <!-- container -->

    </div> <!-- content -->
    <!-- Add plumber Start-->
    <div class="modal fade" id="add_plumber" tabindex="-1" role="dialog" aria-labelledby="add_plumber_LongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo beautify_meta_name(title_case("plumber")); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- name>i,mobile_no>i>n,whatsapp_no>i>n,email>i>e,address>t,city>s>kotkapura,photo>i,identity_proof>i,date_of_birth>i>d,date_of_marriage>i>d,experience>i>n,remarks>t --&gt<!-- Form Row Starts -->
            <div class="row">
              <form method="post" action="" id="form_plumber_rad5df4b1f44c914" class="w-100">
                <div class="form-group ic_plumber_name col-md-5 d-inline-block">
                  <label class="label_plumber_name" for="plumber_name">Name</label>
                  <input type="text" class="form-control plumber_name" placeholder="Name" name="plumber_name">
                </div>
                <div class="form-group ic_plumber_mobile_no col-md-5 d-inline-block">
                  <label class="label_plumber_mobile_no" for="plumber_mobile_no">Mobile No</label>
                  <input type="number" class="form-control plumber_mobile_no" placeholder="Mobile No" name="plumber_mobile_no">
                </div>
                <div class="form-group ic_plumber_whatsapp_no col-md-5 d-inline-block">
                  <label class="label_plumber_whatsapp_no" for="plumber_whatsapp_no">Whatsapp No</label>
                  <input type="number" class="form-control plumber_whatsapp_no" placeholder="Whatsapp No" name="plumber_whatsapp_no">
                </div>
                <div class="form-group ic_plumber_email col-md-5 d-inline-block">
                  <label class="label_plumber_email" for="plumber_email">Email</label>
                  <input type="email" class="form-control plumber_email" placeholder="Email" name="plumber_email">
                </div>
                <div class="form-group ic_plumber_address col-sm-12">
                  <label class="label_plumber_address" for="plumber_address">Address</label>
                  <textarea class="form-control plumber_address" placeholder="Address" name="plumber_address"></textarea>
                </div>
                <div class="form-group ic_plumber_city col-md-5 d-inline-block">
                  <label class="plumber_city" for="plumber_city">City</label>
                  <input type="text" class="form-control plumber_city auto_suggestions_plumber_city" autocomplete="off" placeholder="City" name="plumber_city">
                </div>
                <div class="form-group ic_plumber_district col-md-5 d-inline-block">
                  <label class="plumber_district" for="plumber_district">District</label>
                  <input type="text" class="form-control plumber_district auto_suggestions_plumber_district" autocomplete="off" placeholder="District" name="plumber_district">
                </div>
                <div class="form-group ic_plumber_state col-md-5 d-inline-block">
                  <label class="plumber_state" for="plumber_state">State</label>
                  <input type="text" class="form-control plumber_state auto_suggestions_plumber_state" autocomplete="off" placeholder="State" name="plumber_state">
                </div>
                <div class="form-group col-sm-12">
                  <label for="plumber_photo">Plumber Photo</label>
                  <input type="hidden" class="form-control" name="plumber_photo">
                  <div class="upload_files_plumber_photo upload_files_container">

                  </div>
                  <div class="uploaded_files_plumber_photo">
                    <ul class="uploaded_file_ids_plumber_photo uploaded_files_list_container" style="list-style-type:none;">
                    </ul>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="plumber_identity_proof">Plumber Identity Proof</label>
                  <input type="hidden" class="form-control" name="plumber_identity_proof">
                  <div class="upload_files_plumber_identity_proof upload_files_container">

                  </div>
                  <div class="uploaded_files_plumber_identity_proof">
                    <ul class="uploaded_file_ids_plumber_identity_proof uploaded_files_list_container" style="list-style-type:none;">
                    </ul>
                  </div>
                </div>

                <div class="form-group ic_plumber_date_of_birth col-md-5 d-inline-block">
                  <label class="label_plumber_date_of_birth" for="plumber_date_of_birth">Date Of Birth</label>
                  <input type="date" class="form-control plumber_date_of_birth" placeholder="Date Of Birth" name="plumber_date_of_birth">
                </div>
                <div class="form-group ic_plumber_date_of_marriage col-md-5 d-inline-block">
                  <label class="label_plumber_date_of_marriage" for="plumber_date_of_marriage">Date Of Marriage</label>
                  <input type="date" class="form-control plumber_date_of_marriage" placeholder="Date Of Marriage" name="plumber_date_of_marriage">
                </div>
                <div class="form-group ic_plumber_experience col-md-5 d-inline-block">
                  <label class="label_plumber_experience" for="plumber_experience">Experience(Years)</label>
                  <input type="number" class="form-control plumber_experience" placeholder="Experience" name="plumber_experience">
                </div>
                <div class="form-group ic_plumber_current_brand col-md-5 d-inline-block">
                  <label class="plumber_current_brand" for="plumber_current_brand">Current Brand</label>
                  <input type="text" class="form-control plumber_current_brand" placeholder="Current Brand" name="plumber_current_brand">
                </div>
                <!-- Multi Item Table for Plumber Dealer  -->
                <!-- plumber_id>h,name>i,address>t,city>i,contact>i>n -->
                <h4 class="text-center">Dealer Sittings(You can add Multiple)</h4>
                <hr>
                <!-- Multi RAD Items Table -->
                <div class="col-sm-12">
                  <input type="hidden" name="plumber_dealer_[]" class="multi_item_plumber_dealer_1">
                  <table class="table multi_items_table_plumber_dealer">

                    <thead class="bg-dark">
                      <!-- Head Row -->
                      <tr class="item_header text-white">
                        <th class="text-center multi_item_label_plumber_dealer_name">Name</th>
                        <th class="text-center multi_item_label_plumber_dealer_address">Address</th>
                        <th class="text-center multi_item_label_plumber_dealer_city">City</th>
                        <th class="text-center multi_item_label_plumber_dealer_contact">Contact</th>
                        <th class="text-center multi_item_label_plumber_dealer_actions">Actions</th>
                      </tr>
                      <!-- Head Row -->
                    </thead>
                    <tbody>
                      <!-- Row -->
                      <tr class="multi_item_row_plumber_dealer">
                        <input type="hidden" class="form-control multi_item_input_plumber_dealer multi_item_input_plumber_dealer_series multi_item_input_plumber_dealer_plumber_id">

                        <td>
                          <input type="text" class="form-control multi_item_input_plumber_dealer multi_item_input_plumber_dealer_series multi_item_input_plumber_dealer_name">
                        </td>

                        <td>
                          <textarea class="form-control multi_item_input_plumber_dealer multi_item_input_plumber_dealer_series multi_item_input_plumber_dealer_address"></textarea>
                        </td>

                        <td>
                          <input type="text" class="form-control multi_item_input_plumber_dealer multi_item_input_plumber_dealer_series multi_item_input_plumber_dealer_city auto_suggestions_plumber_city" autocomplete="off">
                        </td>

                        <td>
                          <input type="number" class="form-control multi_item_input_plumber_dealer multi_item_input_plumber_dealer_series multi_item_input_plumber_dealer_contact">
                        </td>

                        <td>
                          <a href="javascript:void(0)" class="btn btn-danger multi_item_plumber_dealer_remove_item mb-1 mr-1" item_no="1"><i class="fe-trash"></i></a> </td>
                      </tr>
                      <!-- Row -->
                    </tbody>
                  </table>
                  <!-- Add item button -->
                  <a href="javascript:void(0)" class="btn btn-warning item multi_item_add_plumber_dealer mb-3">(+)</a>
                  <!-- Add item button -->
                </div>
                <!-- Multi RAD Items Table for plumber_dealer -->


                <div class="form-group ic_plumber_remarks col-sm-12">
                  <label class="label_plumber_remarks" for="plumber_remarks">Remarks</label>
                  <textarea class="form-control plumber_remarks" placeholder="Remarks" name="plumber_remarks"></textarea>
                </div>

                <div class="form-group col-md-12">
                  <input type="submit" class="btn btn-success btn-sm insert_plumber" value="Add Plumber" form_id="rad5df4b1f44c914">
                </div>
              </form>
            </div>
            <!-- Form Row Ends -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Add plumber Ends-->

    <!-- Quick Edit Modal for plumber Start-->
    <div class="modal fade" id="quick_edit_modal_plumber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo beautify_meta_name(title_case("plumber")); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body ic_age_modal">
            <form method="post" action="" id="form_update_plumber_quick_edit" class="w-100">
              <input type="hidden" name="record_id" value="" class="quick_edit_plumber_record_id">
              <div class="modal_input_loader_plumber">

              </div>
              <div class="form-group col-md-12">

                <input type="submit" class="btn btn-success btn-sm update_plumber" value="Update <?php echo beautify_meta_name(title_case("plumber")); ?>" form_id="quick_edit">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Quick Edit Modal plumber Ends-->


  </div>

  <!-- ============================================================== -->
  <!-- End Page content -->
  <!-- ============================================================== -->


  </div>
  <!-- END wrapper -->
  <?php include("core_scripts.php"); ?>
  <script src="wsp_rad/assets/js/upload_core.js"></script>
  <script src="wsp_rad/assets/js/upload_main.js"></script>

  <script>
    <?php
    //Search Filters Conditional changes
    $search_filters_array = array(
      array(
        "filter_name" => "plumber_city",
        "type" => "text",
        "class" => "auto_suggestions_plumber_city",
        "default_value" => "",
        "attributes" => array(
          "autocomplete" => "off"
        )
      ),
      array(
        "filter_name" => "plumber_district",
        "type" => "text",
        "class" => "auto_suggestions_plumber_district",
        "default_value" => "",
        "attributes" => array(
          "autocomplete" => "off"
        )
      ),
      array(
        "filter_name" => "plumber_state",
        "type" => "text",
        "class" => "auto_suggestions_plumber_state",
        "default_value" => "",
        "attributes" => array(
          "autocomplete" => "off"
        )
      ),
      array(
        "filter_name" => "plumber_date_of_birth,plumber_date_of_marriage",
        "type" => "date",
        "class" => "",
        "default_value" => get_today_date(),
        "attributes" => array()
      )
    );

    ?>
    $("select[name=search_by]").change(function() {
      var search_by_value = $(this).val();
      var initial_search_keyword_classes = "form-control reset_me ";
      var allowed_filters_array = new Array();
      <?php
      foreach ($search_filters_array as $single_search_condition) {
        $explode_search_filter_names = explode(",", $single_search_condition["filter_name"]);
        $search_filters_names_string = "";
        foreach ($explode_search_filter_names as $single_filter_name) {
      ?>
          //Push to array
          allowed_filters_array.push("<?php echo $single_filter_name; ?>");
        <?php
          $search_filters_names_string = $search_filters_names_string . 'search_by_value == "' . $single_filter_name . '" || ';
        }
        $search_filters_names_string = rtrim($search_filters_names_string, "|| ");
        ?>

        if (<?php echo $search_filters_names_string; ?>) {

          //Set Type
          $("input[name=search_keyword]").attr("type", "<?php echo $single_search_condition["type"]; ?>");
          //Set Class
          $("input[name=search_keyword]").attr("class", initial_search_keyword_classes + "<?php echo $single_search_condition["class"]; ?>");
          //Set Value
          $("input[name=search_keyword]").val("<?php echo $single_search_condition["default_value"]; ?>");
          //Set Attributes
          <?php foreach ($single_search_condition["attributes"] as $single_search_attr_name => $single_search_attr_value) { ?>
            $("input[name=search_keyword]").attr("<?php echo $single_search_attr_name; ?>", "<?php echo $single_search_attr_value; ?>");
          <?php } ?>
        }

      <?php } ?>
      //If not available in filters, then keep defaults
      if (allowed_filters_array.indexOf(search_by_value) == "-1") {
        //Set Type
        $("input[name=search_keyword]").attr("type", "text");
        //Set Class
        $("input[name=search_keyword]").attr("class", initial_search_keyword_classes);
        //Set Value
        $("input[name=search_keyword]").val("");
      }
      //If not available in filters, then keep defaults

      //Focus on search keyword
      $("input[name=search_keyword]").focus();
    });

    //Search Filters Conditional changes

    //Insert variables
    var insert_button_class_plumber = ".insert_plumber"; // .classname
    var form_id_plumber = "#form_plumber"; // #entry_form
    var insert_api_url_plumber = "api/plumber/insert_plumber.php"; // /api/insert.php
    var form_id_parameter_name = "form_id";

    //Insert Operation
    $(document).on("click", insert_button_class_plumber, function(e) {
      e.preventDefault();
      //Processing
      swal("Processing", "Please Wait", "warning");
      //Processing
      var form_to_process_plumber = form_id_plumber + "_" + $(this).attr(form_id_parameter_name);

      $.post(insert_api_url_plumber, $(form_to_process_plumber).serializeArray(), function(data) {

        var response_json_plumber = data;

        if (response_json_plumber["status"] == "failure") {
          var get_errors_plumber = response_json_plumber["errors"];
          var errors_returned_plumber = "";
          $(get_errors_plumber).each(function(index, value) {
            errors_returned_plumber = errors_returned_plumber + " => " + value;

          });
          swal("Error", errors_returned_plumber, {
            icon: "error"
          });

        } else {


          //Reset Form
          // $(form_to_process_plumber)[0].reset();

          //Focus to first input
          $(form_to_process_plumber + " input[type=text]").first().focus();

          //To show updated values on same page
          // $(updated_data_container_class).load(updated_data_file_url);


          // Other functions to execure on success


          //Customized buttons
          var entry_id_plumber = response_json_plumber["record_id"];
          var customized_content_plumber = document.createElement("div");
          customized_content_plumber.innerHTML = "<a href='edit_plumber.php?plumber_id=" + entry_id_plumber + "' class='btn btn-sm btn-warning mt-1'>Edit Plumber</a> <a href='#' onclick='location.reload()' class='btn btn-sm btn-warning mt-1'>Add New Plumber</a> <!--<a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a> --><br><br><a href='#' onclick='var loc = location.href.replace(location.hash,\"\");window.location = loc;' class='btn btn-sm btn-danger'>Close & Refresh</a> <a href='#' onclick='swal.close()' class='btn btn-sm btn-danger'>X</a>";
          swal({
            title: "Success",
            text: "Choose next action",
            content: customized_content_plumber,
            buttons: false,
            icon: 'success',
          });
          //Customized buttons

        }



      }); // .post function ends

    }); //Insert function ends

    //Featured Tabel Javascript
    //Reset Form
    $(".reset_form").click(function() {
      var form_id = $(this).attr("form_id");
      $("#form_search_" + form_id + " .reset_me").val("");
    });
    //DB Auto Chose
    $(".db_auto_chose").each(function() {
      var db_auto_chose_name = $(this).attr("name");
      var db_auto_chose_value = $(this).attr("db_auto_chose_value");
      $(this).val(db_auto_chose_value);
    });

    //Export and print codes
    var records_table_id = "#list_table_plumber";
    $(".export_to_csv_plumber").click(function() {
      $(records_table_id).tableToCSV();
    });

    $(".export_to_xls_plumber").click(function() {
      $(records_table_id).tableExport({
        filename: 'records.xls',
        escape: 'false'
      });
    });

    function beforeprinttable() {
      $(records_table_id + " th:last-child," + records_table_id + " td:last-child").hide();
    };

    function afterprinttable() {
      setInterval(function() {
        $(records_table_id + " th:last-child," + records_table_id + " td:last-child").show();
      }, 1000);
    };

    $(".print_table_plumber").click(function() {
      $(records_table_id).printThis({
        beforePrint: beforeprinttable(),
        afterPrint: afterprinttable()
      });
    });

    // Delete Operation

    var delete_record_button_class_plumber = ".delete_plumber"; // .classname
    var primary_record_key_attribute_name_plumber = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
    var delete_api_url_plumber = "api/plumber/delete_plumber.php"; // /api/delete.php

    $(document).on("click", delete_record_button_class_plumber, function(e) {
      e.preventDefault();


      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var record_id_plumber = $(this).attr(primary_record_key_attribute_name_plumber);

            $.post(delete_api_url_plumber, {
              "record_id": record_id_plumber
            });


            swal("Processing", {
              icon: "success",
              timer: 1000
            }).then(function() {
              location.reload();
            });

          }
        });
    });
    //Featured Tabel Ends

    //Multi select
    // Select/unselect all items
    $(".select_all_to_delete").click(function() {
      var availble_items_length = $(".multi_delete").length;

      if (availble_items_length > 0) {

        var status = $(this).attr("status");
        if (status == "unchecked") {
          $(".multi_delete").prop("checked", true);
          $(this).attr("status", "checked");
        } else {
          $(".multi_delete").prop("checked", false);
          $(this).attr("status", "unchecked");
        }
      } else {
        swal("Oops", "No Item to select", "info")
      }
    });
    //ends

    //Delete selected items
    $(".delete_selected").click(function(e) {
      e.preventDefault();
      var selected_items_length = $(".multi_delete:checked").length;
      if (selected_items_length > 0) {

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

              var selected_to_delete_array = $(".multi_delete:checked").map(function() {
                return $(this).attr("record_id");
              }).get();
              var api_url = "api/plumber/delete_plumber.php"; //Replace with correct API url

              swal("Deleting Selected Entries", {
                icon: "warning",
              });

              $.post(api_url, {
                "record_id": selected_to_delete_array
              }, function() {

                swal("Deletion Success", {
                  icon: "success",
                });
                setTimeout(function() {
                  location.reload();
                }, 1000)

              });

            }
          });

      } else {
        swal("Oops", "No Item Selected", "info");

      }

    });
    //Delete selected items ends
    //Multi select ends

    
    //Apply Datatables to mobile only
    $(document).ready(function() {
      $(document).ready(function() {
        var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

        if (isMobile) {
          $('#list_table_plumber').DataTable({
            paging: false,
            info: false,
            responsive: {
              details: true
            },
            "language": {
              "search": "Search Table"
            }

          });
        }else{
          //Datatable

    $('#list_table_plumber').DataTable({
      paging: false,
      info: false,
      "language": {
        "search": "Search Table"
      }

    });

        }
      });

    });
    //Apply Datatables to mobile only



    //Quick Edit Code for plumber starts
    $(".quick_edit_plumber").click(function() {
      var quick_edit_plumber_record_type = 'plumber';
      var quick_edit_plumber_record_id = $(this).attr("record_id");
      $(".quick_edit_plumber_record_id").val(quick_edit_plumber_record_id);
      var quick_edit_plumber_input_name = $(this).attr("quick_edit_input_name");
      $("#quick_edit_modal_plumber").modal("show");
      $(".modal_input_loader_plumber").load("edit_" + quick_edit_plumber_record_type + ".php?" + quick_edit_plumber_record_type + "_id=" + quick_edit_plumber_record_id + " .ic_" + quick_edit_plumber_input_name);
    });


    //Update Variables for plumber
    var qe_update_button_class_plumber = ".update_plumber"; // .classname
    var qe_form_id_plumber = "#form_update_plumber";
    var qe_update_api_url_plumber = "api/plumber/update_plumber.php"; // /api/update.php
    var qe_form_id_parameter_name_plumber = "form_id";
    //Update Operation
    $(document).on("click", qe_update_button_class_plumber, function(e) {
      e.preventDefault();
      var qe_form_to_process_plumber = qe_form_id_plumber + "_" + $(this).attr(qe_form_id_parameter_name_plumber);

      $.post(qe_update_api_url_plumber, $(qe_form_to_process_plumber).serializeArray(), function(data) {
        var qe_response_json_plumber = data;

        if (qe_response_json_plumber["status"] == "failure") {
          var qe_get_errors_plumber = qe_response_json_plumber["errors"];

          var errors_returned_plumber = "";
          $(qe_get_errors_plumber).each(function(index, value) {
            errors_returned_plumber = errors_returned_plumber + " => " + value;
          });

          swal("Error", errors_returned_plumber, {
            icon: "error"
          });
        } else {

          //Reset Form
          //$(qe_form_to_process_plumber)[0].reset();



          // Other functions to execute on success
          //Customized buttons
          var qe_customized_content_plumber = document.createElement("div");
          qe_customized_content_plumber.innerHTML = "<a href='javascript:void(0)' onClick='location.reload()' class='btn btn-sm btn-warning mt-1'>Refresh Changes</a> <br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
          swal({
            title: "Updated",
            text: "Choose next action",
            content: qe_customized_content_plumber,
            buttons: false,
            icon: 'success',
          });
          //Customized buttons


        }
      });

    });
    //Quick Edit Code for plumber ends 


    //RAD Multi Items tables Functions
    //$(".multi_items_table_plumber_dealer").stickyTableHeaders();

    var form_id_plumber_dealer = "#form_plumber_rad5df4b1f44c914";
    if (form_id_plumber_dealer == "#") {
      swal("Form Id is invalid for Multi Table of plumber_dealer");
    }
    //Append new row
    $(document).on("click", ".multi_item_add_plumber_dealer", function() {
      var items_length_plumber_dealer = $(".multi_item_plumber_dealer_remove_item:last").attr("item_no");
      var new_length_plumber_dealer = parseInt(items_length_plumber_dealer) + parseInt(1);
      var item_string_plumber_dealer = $(".multi_item_row_plumber_dealer")[0].outerHTML;
      $(".multi_items_table_plumber_dealer tbody").append(item_string_plumber_dealer);
      $(form_id_plumber_dealer).append('<input type="hidden" name="plumber_dealer_[]" class="multi_item_plumber_dealer_' + new_length_plumber_dealer + '" item_no="' + new_length_plumber_dealer + '">');

      //Change Item No on Trash
      $(".multi_item_plumber_dealer_remove_item:last").attr("item_no", new_length_plumber_dealer);

      //Focus first input of last tr
      $(".multi_item_row_plumber_dealer:last").children().find(".multi_item_input_plumber_dealer").first().focus();
      update_stats_plumber_dealer();

      //Scroll to bottom if required on adding new element
      //$('html, body').animate({scrollTop:$(document).height()}, 'slow');
    });

    //Append new row ends

    //On change of any input
    $(document).on("keyup", ".multi_item_input_plumber_dealer", function() {
      var led_separator_plumber_dealer = "~|~";
      var item_no_plumber_dealer = $(this).parents("tr:first").find(".multi_item_plumber_dealer_remove_item:first").attr("item_no");
      var item_string_plumber_dealer = "";
      $(this).parents("tr:first").find(".multi_item_input_plumber_dealer").each(function() {
        item_string_plumber_dealer = item_string_plumber_dealer + led_separator_plumber_dealer + $(this).val();
      });

      $(".multi_item_plumber_dealer_" + item_no_plumber_dealer).val(item_string_plumber_dealer.substring(led_separator_plumber_dealer.length));
      update_stats_plumber_dealer();
    });
    //On change of any input

    //Remove item
    $(document).on("click", ".multi_item_plumber_dealer_remove_item", function() {
      var items_length_plumber_dealer = $(".multi_items_table_plumber_dealer tbody tr").length;
      if (items_length_plumber_dealer == 1) {
        swal("Atleast one item is required");
      } else {
        var item_no_plumber_dealer = $(this).attr("item_no");
        $(this).parents("tr:first").remove();
        var item_plus_plumber_dealer = parseInt(item_no_plumber_dealer);
        $(".multi_item_plumber_dealer_" + item_plus_plumber_dealer).remove();

        update_stats_plumber_dealer();
      }
    });
    //Remove item

    //Stats code
    function update_stats_plumber_dealer() {

    }
    //Stats code ends

    //Custom functions on inputs
    // $(document).on("keyup",".multi_item_input_plumber_dealer_class",function(){    

    // });

    //Apply responsiveness for mobile
    $(document).ready(function() {
      var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

      if (isMobile) {
        $(".multi_items_table_plumber_dealer").addClass("table-responsive");
      }
    });

    //Multi  Items table functions


    //Upload Files code for plumber_photo 
    var hidden_file_input_name_plumber_photo = "plumber_photo";
    $(".upload_files_" + hidden_file_input_name_plumber_photo).upload({
      action: "api/file_upload/insert_file_upload.php",
      //chunked : true,
      maxConcurrent: 1,
      multiple: true,
      //maxSize : 5000,
      maxFiles: 20,
      leave: 'Files being uploaded, please wait.',
      label: '<i class="fe-upload"></i> Upload Plumber Photo',
      autoUpload: true,
      postData: {
        "meta_key": hidden_file_input_name_plumber_photo
      }
    }).on("filestart.upload", uploadFileStart_plumber_photo).on("filecomplete.upload", uploadFileComplete_plumber_photo);

    function uploadFileStart_plumber_photo() {
      //Progress
      swal({
        title: "Uploading...",
        text: "Please wait",
        buttons: false,
        closeOnClickOutside: false
      });
      //Progress
    }
    var multiple_file_ids_plumber_photo = "";

    function uploadFileComplete_plumber_photo(e, file, response) {
      var response_json_file_upload_plumber_photo = JSON.parse(response);
      if (response_json_file_upload_plumber_photo["status"] == "failure") {
        var get_errors_file_upload_plumber_photo = response_json_file_upload_plumber_photo["errors"];
        var errors_returned_file_upload_plumber_photo = "";
        $(get_errors_file_upload_plumber_photo).each(function(index, value) {
          errors_returned_file_upload_plumber_photo = errors_returned_file_upload_plumber_photo + " => " + value;

        });
        swal("Error", errors_returned_file_upload_plumber_photo, {
          icon: "error"
        });

      } else {
        var record_id_file_upload_plumber_photo = response_json_file_upload_plumber_photo["record_id"];
        var unique_identifier_plumber_photo = response_json_file_upload_plumber_photo["file_upload_identifier"];
        multiple_file_ids_plumber_photo = multiple_file_ids_plumber_photo + record_id_file_upload_plumber_photo + ",";
        $("input[name=" + hidden_file_input_name_plumber_photo + "]").val(multiple_file_ids_plumber_photo.slice(0, -1));

        var current_uploaded_ids_plumber_photo = $(".uploaded_file_ids_plumber_photo").html();
        $(".uploaded_file_ids_plumber_photo").html(current_uploaded_ids_plumber_photo + "<li class='file_" + record_id_file_upload_plumber_photo + "'><i class='fe-check-square'></i> " + unique_identifier_plumber_photo + " <a href='javascript:void(0)' record_id='" + record_id_file_upload_plumber_photo + "' class='delete_file_upload btn btn-sm btn-danger'><i class='fe-trash'></i></a></li>");
        swal.close();
      }
    }

    // Delete File Operation

    var delete_record_button_class_file_upload = ".delete_file_upload"; // .classname
    var primary_record_key_attribute_name_file_upload = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
    var delete_api_url_file_upload = "api/file_upload/delete_file_upload.php"; // /api/delete.php

    $(document).on("click", delete_record_button_class_file_upload, function(e) {
      e.preventDefault();


      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var record_id_file_upload_plumber_photo = $(this).attr(primary_record_key_attribute_name_file_upload);

            $.post(delete_api_url_file_upload, {
              "record_id": record_id_file_upload_plumber_photo
            });


            swal("Processing", {
              icon: "success",
              timer: 1000
            }).then(function() {
              swal("File Deleted Successfully");
              $(".file_" + record_id_file_upload_plumber_photo).remove();
              //Loop uploaded files
              multiple_file_ids_plumber_photo = "";
              $(".uploaded_file_ids_plumber_photo li").each(function(index, value) {
                var this_record_id = $(this).children("a").attr("record_id");
                multiple_file_ids_plumber_photo = multiple_file_ids_plumber_photo + this_record_id + ",";
              });
              $("input[name=" + hidden_file_input_name_plumber_photo + "]").val(multiple_file_ids_plumber_photo.slice(0, -1));
            });

          }
        });
    });
    //Upload Files code for plumber_photo ends

    //Upload Files code for plumber_identity_proof 
    var hidden_file_input_name_plumber_identity_proof = "plumber_identity_proof";
    $(".upload_files_" + hidden_file_input_name_plumber_identity_proof).upload({
      action: "api/file_upload/insert_file_upload.php",
      //chunked : true,
      maxConcurrent: 1,
      multiple: true,
      //maxSize : 5000,
      maxFiles: 20,
      leave: 'Files being uploaded, please wait.',
      label: '<i class="fe-upload"></i> Upload Plumber Identity Proof',
      autoUpload: true,
      postData: {
        "meta_key": hidden_file_input_name_plumber_identity_proof
      }
    }).on("filestart.upload", uploadFileStart_plumber_identity_proof).on("filecomplete.upload", uploadFileComplete_plumber_identity_proof);

    function uploadFileStart_plumber_identity_proof() {
      //Progress
      swal({
        title: "Uploading...",
        text: "Please wait",
        buttons: false,
        closeOnClickOutside: false
      });
      //Progress
    }
    var multiple_file_ids_plumber_identity_proof = "";

    function uploadFileComplete_plumber_identity_proof(e, file, response) {
      var response_json_file_upload_plumber_identity_proof = JSON.parse(response);
      if (response_json_file_upload_plumber_identity_proof["status"] == "failure") {
        var get_errors_file_upload_plumber_identity_proof = response_json_file_upload_plumber_identity_proof["errors"];
        var errors_returned_file_upload_plumber_identity_proof = "";
        $(get_errors_file_upload_plumber_identity_proof).each(function(index, value) {
          errors_returned_file_upload_plumber_identity_proof = errors_returned_file_upload_plumber_identity_proof + " => " + value;

        });
        swal("Error", errors_returned_file_upload_plumber_identity_proof, {
          icon: "error"
        });

      } else {
        var record_id_file_upload_plumber_identity_proof = response_json_file_upload_plumber_identity_proof["record_id"];
        var unique_identifier_plumber_identity_proof = response_json_file_upload_plumber_identity_proof["file_upload_identifier"];
        var file_name_plumber_identity_proof = response_json_file_upload_plumber_identity_proof["file_name"];
        multiple_file_ids_plumber_identity_proof = multiple_file_ids_plumber_identity_proof + record_id_file_upload_plumber_identity_proof + ",";
        $("input[name=" + hidden_file_input_name_plumber_identity_proof + "]").val(multiple_file_ids_plumber_identity_proof.slice(0, -1));

        var current_uploaded_ids_plumber_identity_proof = $(".uploaded_file_ids_plumber_identity_proof").html();
        $(".uploaded_file_ids_plumber_identity_proof").html(current_uploaded_ids_plumber_identity_proof + "<li class='file_" + record_id_file_upload_plumber_identity_proof + "'><i class='fe-check-square'></i> " + file_name_plumber_identity_proof + " <a target='_blank' href='uploads/" + unique_identifier_plumber_identity_proof + "' class='btn btn-sm btn-success'><i class='fe-eye'></i> View</a> <a href='javascript:void(0)' record_id='" + record_id_file_upload_plumber_identity_proof + "' class='delete_file_upload btn btn-sm btn-danger'><i class='fe-trash'></i></a></li>");
        swal.close();
      }
    }

    // Delete File Operation

    var delete_record_button_class_file_upload = ".delete_file_upload"; // .classname
    var primary_record_key_attribute_name_file_upload = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
    var delete_api_url_file_upload = "api/file_upload/delete_file_upload.php"; // /api/delete.php

    $(document).on("click", delete_record_button_class_file_upload, function(e) {
      e.preventDefault();


      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var record_id_file_upload_plumber_identity_proof = $(this).attr(primary_record_key_attribute_name_file_upload);

            $.post(delete_api_url_file_upload, {
              "record_id": record_id_file_upload_plumber_identity_proof
            });


            swal("Processing", {
              icon: "success",
              timer: 1000
            }).then(function() {
              swal("File Deleted Successfully");
              $(".file_" + record_id_file_upload_plumber_identity_proof).remove();
              //Loop uploaded files
              multiple_file_ids_plumber_identity_proof = "";
              $(".uploaded_file_ids_plumber_identity_proof li").each(function(index, value) {
                var this_record_id = $(this).children("a").attr("record_id");
                multiple_file_ids_plumber_identity_proof = multiple_file_ids_plumber_identity_proof + this_record_id + ",";
              });
              $("input[name=" + hidden_file_input_name_plumber_identity_proof + "]").val(multiple_file_ids_plumber_identity_proof.slice(0, -1));
            });

          }
        });
    });
    //Upload Files code for plumber_identity_proof ends

    // Auto suggestion for plumber_city
    var as_input_name_plumber_city = "plumber_city";
    var record_type_plumber_city = "city";


    $(document).on("focus", ".auto_suggestions_" + as_input_name_plumber_city, function() {

      $(this).autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "api/" + record_type_plumber_city + "/auto_suggest_" + record_type_plumber_city + ".php",
            dataType: "json",
            data: {
              search_input_value: request.term,
              search_input_name: record_type_plumber_city
            },
            success: function(data) {
              response(data);

            }
          });
        },
        minLength: 1
      });

    });
    //Auto suggestion ends 

    // Auto suggestion for plumber_district
    var as_input_name_plumber_district = "plumber_district";
    var record_type_plumber_district = "district";


    $(document).on("focus", ".auto_suggestions_" + as_input_name_plumber_district, function() {

      $(this).autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "api/" + record_type_plumber_district + "/auto_suggest_" + record_type_plumber_district + ".php",
            dataType: "json",
            data: {
              search_input_value: request.term,
              search_input_name: record_type_plumber_district
            },
            success: function(data) {
              response(data);

            }
          });
        },
        minLength: 1
      });

    });
    //Auto suggestion ends 

    // Auto suggestion for plumber_state
    var as_input_name_plumber_state = "plumber_state";
    var record_type_plumber_state = "state";


    $(document).on("focus", ".auto_suggestions_" + as_input_name_plumber_state, function() {

      $(this).autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "api/" + record_type_plumber_state + "/auto_suggest_" + record_type_plumber_state + ".php",
            dataType: "json",
            data: {
              search_input_value: request.term,
              search_input_name: record_type_plumber_state
            },
            success: function(data) {
              response(data);

            }
          });
        },
        minLength: 1
      });

    });
    //Auto suggestion ends 

    var mobile = [];
     $(".mobile_number").change(function(){
      mobile = [];
            $.each($(".mobile_number:checked"), function(){            
                mobile.push($(this).parents("td:first").nextAll(".plumber_mobile_no:first").text());
            });

             mobile.join(",");
             // mobile number length
             var total_numbers = mobile.length;
             $('.mobile_count').text(total_numbers);
             console.log(mobile);
        });
         $(".reset_process").click(function(){
        $('.mobile_count').text(0);
        $('.mobile_number:checked').each(function() {
            this.checked = false;
        });
     })
      $(".select_all_mobile").click(function(){
        $('.mobile_number').each(function() {
            this.checked = true;
           mobile = [];
            $.each($(".mobile_number:checked"), function(){            
                mobile.push($(this).parents("td:first").nextAll(".plumber_mobile_no:first").text());
            });
             mobile.join(",");
             // mobile number length
             var total_numbers = mobile.length;
             $('.mobile_count').text(total_numbers);
        });
        console.log(mobile);
     })
     $(".sms_to_selected").click(function(){
       var number_count =  $('.mobile_count').text();
       var sms_body = $("textarea.sms_body").val();
       if(number_count == 0 || number_count == ""){
         swal({
  title: "Error?",
  text: "Select contacts to send SMS.",
  icon: "warning",
  dangerMode: true,
})
        //alert("");
       } else {
        if(sms_body == ""){
                   swal({
  title: "Error?",
  text: "Message body is empty!",
  icon: "warning",
  dangerMode: true,
})
        } else {
        swal({
  title: "Are you sure?",
  text: "Send SMS to all selected contacts!",
  icon: "info",
  buttons:true,
  buttons: {
    yes_sure: {text:"Yes Sure",value:"yes_sure"},
    no_cancel: {text:"No Cancel",value:"no_cancel"}
  },
  
})
.then((value) => {
  switch(value){
    case "yes_sure":   
    $.ajax({
      type: "POST",
      url: "api/sms/send_sms.php",
      data: {sms_body:sms_body,mobile_numbers:mobile},
      success: function(data){
        
      }
    });
    break;

    case "no_cancel":
    swal.close();
    break

  }

        });
    }
       }
     });
  </script>
  <?php include("footer.php"); ?>