<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.raneydaydesign.com
 * @since      1.0.0
 *
 * @package    Settings_Page
 * @subpackage Settings_Page/admin/partials
 */

include 'rdd-care-plan-includes.php';


$rdd_care_plan_settings = get_option( 'rdd_care_plan_settings' );

$project_id = $rdd_care_plan_settings['client_project_id'];
// $project_id = '493652';


$website_care_plans = $rdd_care_plan_settings['website_care_plans']; // Website Care Plans
$google_drive_link = $rdd_care_plan_settings['google_drive_link']; // Google Drive Link
$email_support = $rdd_care_plan_settings['email_support']; // Email Support
$additional_info = $rdd_care_plan_settings['additional_info']; // Additional Info

$curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://raneydaydesignllc.teamwork.com/projects/". $project_id ."/time_entries.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
        "Authorization: Basic dHdwXzNsRGJ4WVF1T0U3MG00ekpHU0tORmt2T1V1aE06MQ==",
    "Cookie: tw-auth=tw-45A6282286A1F02872F4654921B4A018-V9DkkrX2xdDnWry8DFjYNfQIrCoFUV-278622; JSESSIONID=3830c0efd101adc3331c64596b1117722850; RDS=2; PROJLB=s2"
  ),
));

$response = json_decode(curl_exec($curl), true);
// print_r($response);
curl_close($curl);

// echo '<pre>';
// print_r($rdd_care_plan_settings);
// echo '</pre>';

if ($website_care_plans === 'Platinum Care Plan') {
	// echo "Platinum Care Plan";
} else {
	echo 'Invalid data';
}

if (!empty($project_id)) {

} else {
  echo "Not Provided";
}


?>
<div id="care-plan-dashboard" class="welcome-panel care-plan-dashboard" style="background-color: #fff;">
    <div class="care-plan-dashboard-heading-section">
		<h2 class="care-plan-dashboard-heading"><strong>WELCOME TO THE</strong> DASHBOARD!</h2>
<div class="care-plan-dashboard-content">
<p class="care-plan-title"><span style="font-size: 20px;"><strong><span style="color: #b92360;">

<?= (empty($website_care_plans) || $website_care_plans == 'No Care Plan') ? '<b>Oh No!</b>' : '<b>Congratulations!</b>'; ?>
</span></strong> You are currently
<?= (empty($website_care_plans) || $website_care_plans == 'No Care Plan') ? '<b>NOT</b>' : ''; ?>

 on our <strong><?= ($rdd_care_plan_settings['website_care_plans'] == null || $website_care_plans == 'No Care Plan' ) ? 'Care Plan' : $rdd_care_plan_settings['website_care_plans'];



?></strong>!</span></p>

<!-- Care Plan Includes -->
<div class="container">	
	<div class="row">	
		<div class="col-md-8 care-plan-includes">	
			<h3>Your Care Plan includes:</h3>
			<div class="care-plan-item">
     <?php

     $website_care_plans;

     switch ($website_care_plans) {
      case 'Platinum Care Plan_':
         echo 'Platinum';
      break;
      case 'Silver Care Plan':
         echo $silver_plan_data;
      break;
      case 'Gold Care Plan':
         echo $gold_plan_html;
      break;      
      case 'No Care Plan_':
         echo 'No Care Plan';
      break;
      default;
      echo '<p class="seeting-page-url" >Please Select Plan from <a href="' . admin_url( 'admin.php?page=rdd-care-plan-settings' ) .'">Settings</a> Page </p>';
     }

     ?>   
      </div>
		</div>
		<div class="col-md-4 important-link">
				<h2>Important Links</h2>
				<a href="#" target="_self" class="button email-support-button" role="button"><span class="fl-button-text">Email Support</span></a>
				<a href="#" target="_blank" class="button google-drive-button">Google Drive Folder</a>
		</div>
	</div>
</div>
<!-- end Care Plan Includes  -->
<!-- Support Task List -->
<div class="container">	
	<div class="row">	
		<div class="col-md-12">	
			<h3 class="support-task-list-title">Support Tasks from the Past 30-days:</h3>
			<div class="support-task-list">

        <?php if (!empty($project_id)) { ?>
				<table id="customers">
  <tr>
    <th>Sr No.</th>
    <th>Task ID</th>
    <th>Creation Date</th>
    <th>Task List</th>
    <th>Task</th>
    <th>Hours</th>
    <th>Person</th>
    <th>Tag</th>
    <!-- <td>test</td> -->
  </tr>

  <?php


$sr_no = 0 ;
$total_h = 0; 
// echo json_encode($response);
$id_array = array();
$add_id = array();

foreach ($response['time-entries'] as $index=>$value) {
	$id_array[$index] = $value['todo-item-id'];
}
// print_r($id_array);
// echo "<br>";
$uniq_id = array_count_values($id_array);
// print_r($uniq_id);

$endDate = date('Y-m-d', strtotime('-30 days'));
foreach ($response['time-entries'] as $key) {
  
//   # code...
// if ($key['project-name'] == 'Arendosh Heating & Cooling (PLATINUM)' ) {
  # code...
// echo 'Task:' . $key['todo-item-name'] . '<br>';
// echo "<pre>";
  $crtdAT = strtotime($key['createdAt']);
  $crtdAT_task = date('Y-m-d',$crtdAT);
   // echo $crtdAT_task.'<br>';
if (!empty($key['todo-item-id'])) {
  if ($endDate>=$crtdAT_task) {
  	continue;
  }
  $total_h += $key['hoursDecimal'];
  $task_h = $key['hoursDecimal'];
  if(in_array($key['todo-item-id'], $add_id)) {
  	continue;
  } else {
  	array_push($add_id, $key['todo-item-id']);
  }
  if ($uniq_id[$key['todo-item-id']]>1) {
  	// echo $uniq_id[$key['todo-item-id']].'test';
  	// array_search($key['todo-item-id'], $id_array);
  	$count_h = 0;
  	foreach ($id_array as $IDkey => $IDvalue) {
  		if ($IDvalue==$key['todo-item-id']) {
  			$count_h += $response['time-entries'][$IDkey]['hoursDecimal'];
  		}
  	}
  	$task_h = $count_h;
  }
  // echo $ind;
  /*echo '<pre>';
  print_r($key);
  echo '</pre>';
  echo "--------------------";*/
  $sr_no++;
  # code...
?>
<tr>
  <!-- <td><b>Task:</b></td> -->
  <td><?php echo $sr_no ?></td>
  <td><?php echo $key['todo-item-id'] ?></td>
  <td><?php echo $crtdAT_task; ?></td>
  <td><?php echo $key['todo-list-name'] ?></td>
  <td><?php echo $key['todo-item-name'] ?></td>
  <td><?php echo  gmdate('H:i:s', floor($task_h * 3600)); ?></td>
  <!-- <td><?php echo  gmdate('H:i:s', floor($key['hoursDecimal'] * 3600)); ?></td> -->
  <td><?php echo $key['person-first-name'] ?></td>
  <td></td>
</tr>
<?php 
} // close todo 
} // time-entries
 
?>
</table>
<p class="total-time">Total Hours: <?php echo gmdate('H:i:s', floor($total_h * 3600)); ?></p>
<?php 
}else {
  echo '<p class="seeting-page-url" >Please enter Projct ID in the <a href="' . admin_url( 'admin.php?page=rdd-care-plan-settings' ) .'">Settings</a> Page </p>';;
} 
?>
				
			</div>
		</div>
	</div>
</div>
<!-- End Support Task List -->
</div>
</div>
</div>