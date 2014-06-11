<?php
//PLUGIN MENU
add_action('admin_menu', 'fcwebmaintenance');

wp_enqueue_script('jquery');

function fcwebmaintenance()
{
//TOP LEVEL MENU
    add_menu_page('Admin Maintenance',
        'Admin Maintenance',
        'administrator',
        'fcwebmaintenance_option',
        'fcwebmaintenance_option_page',
        plugins_url('/images/logoicon.png', __FILE__),
        100
    );
}

// ADMIN VALUE
function fcwebmaintenance_option_page()
{
    global $wp_roles;
    $roles = $wp_roles->get_names();

    $fcwebSettings['pageTitle'] = "Website Under Maintenance";
    $fcwebSettings['companyName'] = "Company Name";
    $fcwebSettings['message'] = "We are doing a schedule maintenance";
    $fcwebSettings['template'] = "Under Maintenance";
    $fcwebSettings['year'] = "2014";
    $fcwebSettings['month'] = "01";
    $fcwebSettings['day'] = "01";
    $fcwebSettings['hour'] = "01";
    $fcwebSettings['minute'] = "00";
    $fcwebSettings['status'] = "1";
    $fcwebSettings['contactEmail'] = "";
    $fcwebSettings['contactNumber'] = "";
    $fcwebSettings['facebookLink'] = "";
    $fcwebSettings['twitterLink'] = "";
    $fcwebSettings['googleLink'] = "";
//DEFAULT DATA VARIABLES
    $templates = array();
    $templates[0]="Still_Image_Background";
    $templates[1]="Yoututbe_Video_Background";
    $templates[2]="CSS3_Background_Animation1";
    $templates[3]="CSS3_Background_Animation2";
    $templates[4]="CSS3_Background_Animation3";
    $templates[5]="Simple_Image_Background";

    $months = array();
    $months[0]="January";
    $months[1]="February";
    $months[2]="March";
    $months[3]="April";
    $months[4]="May";
    $months[5]="June";
    $months[6]="July";
    $months[7]="August";
    $months[8]="September";
    $months[9]="October";
    $months[10]="November";
    $months[11]="December";
    $errorMessage = "";
//DEFAULT DATA VARIABLES
    if (isset($_POST['SaveSettings'])) {

        $fcwebSettings['pageTitle'] = trim($_POST['pageTitle']);
        $fcwebSettings['companyName'] = trim($_POST['companyName']);
        $fcwebSettings['message'] = trim($_POST['message']);
        $fcwebSettings['template'] = trim($_POST['template']);
        $fcwebSettings['year'] = trim($_POST['year']);
        $fcwebSettings['month'] = trim($_POST['month']);
        $fcwebSettings['day'] = trim($_POST['day']);
        $fcwebSettings['hour'] = trim($_POST['hour']);
        $fcwebSettings['minute'] = trim($_POST['minute']);
        $fcwebSettings['status'] = trim($_POST['status']);
        $fcwebSettings['contactEmail'] = trim($_POST['contactEmail']);
        $fcwebSettings['contactNumber'] = trim($_POST['contactNumber']);
        $fcwebSettings['facebookLink'] = trim($_POST['facebookLink']);
        $fcwebSettings['twitterLink'] = trim($_POST['twitterLink']);
        $fcwebSettings['googleLink'] = trim($_POST['googleLink']);
        foreach($roles as $temp){
            if($temp != "Administrator"){
                if (isset($_POST[$temp])) {
                    $fcwebSettings[$temp] = $_POST[$temp];
                }
            }
        }

        $chk = get_option('fcwebmaintenance_settings');

        if($errorMessage ==""){
            if($chk == false){
                add_option('fcwebmaintenance_settings', $fcwebSettings);
		echo '<div class="" style="background: none repeat scroll 0 0 #000000;margin-left: -20px;color: #98FB98;float: left;overflow: hidden;padding: 6px 22px;width:52%;z-index: 999;">Settigns Added</div>';
            }
            else{
                update_option('fcwebmaintenance_settings', $fcwebSettings);
				echo '<div class="" style="background: none repeat scroll 0 0 #000000;margin-left: -20px;color: #98FB98;float: left;overflow: hidden;padding: 6px 22px;width:52%;z-index: 999;">Settigns Updated</div>';
            }
        }
    }
    $chk = get_option('fcwebmaintenance_settings');

    if($chk == true){
        $fcwebSettings['pageTitle'] = $chk['pageTitle'];
        $fcwebSettings['companyName'] = $chk['companyName'];
        $fcwebSettings['message'] = $chk['message'];
        $fcwebSettings['template'] = $chk['template'];
        $fcwebSettings['year'] = $chk['year'];
        $fcwebSettings['month'] = $chk['month'];
        $fcwebSettings['day'] = $chk['day'];
        $fcwebSettings['hour'] = $chk['hour'];
        $fcwebSettings['minute'] = $chk['minute'];
        $fcwebSettings['status'] = $chk['status'];
        $fcwebSettings['contactEmail'] = $chk['contactEmail'];
        $fcwebSettings['contactNumber'] = $chk['contactNumber'];
        $fcwebSettings['facebookLink'] = $chk['facebookLink'];
        $fcwebSettings['twitterLink'] = $chk['twitterLink'];
        $fcwebSettings['googleLink'] = $chk['googleLink'];

        foreach($roles as $temp){
            if($temp != "Administrator"){
                if (isset($chk['status'])) {
                    $fcwebSettings[$temp] = $chk[$temp];
                }
            }
        }
    }
    if($errorMessage ==""){
        echo $errorMessage."";
    }

    $adminBody = '
    <form style="background: none repeat scroll 0 0 #FFFFFF;clear: both;display: block;margin-left: -20px;overflow: hidden;padding: 20px 20px 20px 40px;position: relative;
z-index: 6;" name="settings" action="" method="post">
    <table style="border: 1px solid #DDDDDD;padding: 20px;" border="0" cellpadding="2" cellspacing="0">
	<tr>
        <td colspan="7" style="text-align: center;"><h1 style="margin-bottom: 0;margin-top: 0;padding-bottom: 15px;">Responsive Admin Maintenance PRO</h1><p style="color: #FF9353;margin-bottom: 7%;margin-top: 0;">Please setup bellows settings properly to active awesome maintenance screen on your board</p></td>
    </tr>
    <tr>
    	<td  style="font-weight:bold" width="130px">Plugin Switch</td>
        <td>:</td>
        <td colspan="5">
        	<select name="status" id="status">';
    if ($fcwebSettings['status'] == "1") {
        $adminBody = $adminBody . '<option value="1" selected="selected">ON</option>
            	<option value="0">OFF</option>';
    } else {
        $adminBody = $adminBody . '<option value="1">ON</option>
            	<option value="0" selected="selected">OFF</option>';
    }
    $adminBody = $adminBody . '</select>
        </td>
    </tr>
	<tr>
    	<td style="font-weight:bold">Page Title</td>
        <td>:</td>
        <td colspan="5"><input type="text" name="pageTitle" id="pageTitle" value=\'' . $fcwebSettings['pageTitle'] . '\' /></td>
    </tr>
	<tr>
    	<td style="font-weight:bold">Company Name</td>
        <td>:</td>
        <td colspan="5"><input type="text" name="companyName" id="companyName" value=\'' . $fcwebSettings['companyName'] . '\' /></td>
    </tr>
	<tr>
    	<td style="font-weight:bold">Maintenance Note</td>
        <td>:</td>
        <td colspan="5"><input type="text" name="message" id="message" value=\'' . $fcwebSettings['message'] . '\' /></td>
    </tr>
	<tr>
    	<td  style="font-weight:bold">Style</td>
        <td>:</td>
        <td colspan="5">
        	<select name="template" id="template">';
    foreach($templates as $temp){
        if ($fcwebSettings['template'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select>
        </td>
    </tr>
	<tr>
    	<td style="font-weight:bold">Roles To Deny</td>
        <td>:</td>
        <td colspan="5">';

    foreach($roles as $temp){
        if($temp != "Administrator"){
            if ($fcwebSettings[$temp] == $temp) {
                $adminBody = $adminBody . '<input type="checkbox" name="'.$temp.'" id="'.$temp.'" value="'.$temp.'" checked="checked" />'.$temp.'<br />';
            } else {
                $adminBody = $adminBody . '<input type="checkbox" name="'.$temp.'" id="'.$temp.'" value="'.$temp.'" />'.$temp.'<br />';
            }
        }
    }
    $adminBody = $adminBody . '</select>
        </td>
    </tr>
	<tr>
    	<td></td>
        <td></td>
        <td style=" color: #FF985A;font-weight: bold;padding-top: 30px;">Year</td>
        <td style=" color: #FF985A;font-weight: bold;padding-top:30px">Month</td>
        <td style=" color: #FF985A;font-weight: bold;padding-top:30px">Day</td>
        <td style=" color: #FF985A;font-weight: bold;padding-top:30px">Hour</td>
        <td style=" color: #FF985A;font-weight: bold;padding-top:30px">Minute</td>
    </tr>
	<tr>
    	<td  style="font-weight:bold" >Maintenance will over <span style="color:#ff0000">(Required)</span></td>
        <td>:</td>
        <td><select name="year" id="year">';
    for($temp=date("Y");$temp<date("Y")+10;$temp++){
        if ($fcwebSettings['year'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select></td>
        <td><select name="month" id="month">';
    foreach($months as $temp){
        if ($fcwebSettings['month'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select></td>
        <td><select name="day" id="day">';
    for($temp=1;$temp<32;$temp++){
        if ($fcwebSettings['day'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select></td>
        <td><select name="hour" id="hour">';
    for($temp=0;$temp<24;$temp++){
        if ($fcwebSettings['hour'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select></td>
        <td><select name="minute" id="minute">';
    for($temp=0;$temp<61;$temp++){
        if ($fcwebSettings['minute'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select></td>
    </tr>
	<tr>
    	<td style="font-weight:bold"> Email Address</td>
        <td>:</td>
        <td colspan="5"><input type="email" name="contactEmail" id="contactEmail" value=\'' . $fcwebSettings['contactEmail'] . '\' /></td>
     </tr>
	<tr>
    	<td style="font-weight:bold">Phone Number</td>
        <td>:</td>
        <td colspan="5"><input type="text" name="contactNumber" id="contactNumber" value=\'' . $fcwebSettings['contactNumber'] . '\' /></td>
    </tr>
	<tr>
    	<td style="font-weight:bold">Facebook URL</td>
        <td>:</td>
        <td colspan="5"><input type="text" name="facebookLink" id="facebookLink" value=\'' . $fcwebSettings['facebookLink'] . '\' /></td>
     </tr>
	<tr>
    	<td style="font-weight:bold">Twitter URL</td>
        <td>:</td>
        <td colspan="5"><input type="text" name="twitterLink" id="twitterLink" value=\'' . $fcwebSettings['twitterLink'] . '\' /></td>
    </tr>
	<tr>
    	<td style="font-weight:bold">Google+ URL</td>
        <td>:</td>
        <td colspan="5"><input type="text" name="googleLink" id="googleLink" value=\'' . $fcwebSettings['googleLink'] . '\' /></td>
    </tr>
    <tr>
        <td colspan="7" align="center">
			<input style= "background: none repeat scroll 0 0 #FF4000;border: medium none;border-radius: 15px;-webkit-border-radius: 15px;-moz-border-radius: 15px;color: #FFFFFF;margin-top: 12px;padding: 4px 9px;" type="SUBMIT" id="SaveSettings" name="SaveSettings" value="Save Settings" />
        </td>
    </tr>
    </table>
	<p style="background: none repeat scroll 0px 0px rgb(255, 255, 255); margin: 0px; padding: 20px; float: left; width: 100%;">After press "Save Settings" Open a new private tab or different browser to check the site as maintenance mode.</p>
</form>';
    echo $adminBody;
}

?>