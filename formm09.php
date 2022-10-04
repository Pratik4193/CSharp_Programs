<?php 
error_reporting(0);
include_once('joomlasession.php');
  require('config/config.php');
if(!isset($misusername)){
  header('Location:index.php');
  exit;
}
  $accessarray = explode(',',$accessid);
  $countaccess = (count($accessarray));
  //print_r($countaccess);
  
  $currentmonth = date('n');
      $previousmonth = date('n',mktime(0,0,0,$currentmonth,0,0));
      //echo $previousmonth-1;
      //echo $groupid;
	  $pretopremonth = date('n',mktime(0,0,0,($currentmonth-1),0,0)); 
	  //echo $pretopremonth;
      $monthsName=array('January','February','March','April','May','June','July','August',
						'September','October','November','December');
	  $currentyear = date('Y');
	  $previousyear = $currentyear-1;
		 if($currentmonth==1 ) {
		   $checkyear = $previousyear;
		 }else{
		   $checkyear = $currentyear;
		 }
         if($pretopremonth ==12 || $pretopremonth ==11){
		   $precheckyear = $previousyear;
         }else{
		   $precheckyear = $currentyear;
         }?>
<div class="admin-div" >
	<?php   if($groupid==1){
		   $regionaccessidarray = explode(',',$accessid);
		   $regionaccessidarraycheck = $regionaccessidarray[0];
			 switch($regionaccessidarraycheck){
				CASE 1:
					$checkregionid = 1;
					BREAK;
				CASE 5:
					$checkregionid = 2;
					BREAK;
				CASE 10:
					$checkregionid = 3;
					BREAK;
				CASE 15:
					$checkregionid = 4;
					BREAK;
				CASE 23:
					$checkregionid = 5;
					BREAK;
				CASE 28:
					$checkregionid = 6;
				BREAK;
				CASE 36:
					$checkregionid = 7;
				BREAK;
				}
		  } ?>
          
<div class="form-option" >
	<a href="<?php echo JURI::base(); ?>">Go to Back Page</a>
    <a href="admin_kra.php">KRA Form</a>
    
    <?php if(($groupid==2 || $groupid==1 || $groupid==3 ||  $groupid==0) && !in_array($accessid,array('36','37','38','39'))){?> 
            <a href="<?php echo BASE_URL."mis/"; ?>admin_week.php">GP Audit Weekly Form</a>
          <?php }?><?php if($accessid>35 || $groupid == 0 || $groupid==3  || $groupid==2 ){?>
        	<a href="admin_mca.php">MCA Form</a>
        <?php } ?>
	 <?php if($groupid==0 || $groupid==3){?>
            <a href="<?php echo BASE_URL."mis/"; ?>setting.php">Setting</a>
          <?php }?>
</div>
<div style="flost:left;text-align:right;margin-left:50px;margin-right:50px;">
<?php if(isset($misusername)){?>

<?php echo "<b>welcome ".$_SESSION[__default]['misusername']."</b>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
<a href="change_password.php">Change Password</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="logout.php">Logout</a>
<?php  } ?>
</div>

<p class="item-1">Districts are allowed to fill Data till 7th of Every Month.</p>

<p class="item-2">Regions are allowed to fill and approve Data till 7th of Every Month.</p>

<p class="item-3">If any Queries,Please send mail <b style = "color:#FF6600;text-decoration:underline;">TO - ad.computer@mahalfa.in / CC - jondhalepratik2012@gmail.com</b></p>
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans:600);

.item-1, 
.item-2, 
.item-3 {
margin-top:90px;

	position: absolute;
  display: block;
	top: 2em;
  
  width: 80%;
  
  font-size: 23px;
  font-weight:bold;

	animation-duration: 20s;
	animation-timing-function: ease-in-out;
	animation-iteration-count: infinite;
}

.item-1{
	animation-name: anim-1;
	color:#CC0000;
}

.item-2{
	animation-name: anim-2;
		color:#009933;

}

.item-3{
	animation-name: anim-3;
	color:#009933;
}

@keyframes anim-1 {
	0%, 8.3% { left: -100%; opacity: 0; }
  8.3%,25% { left: 25%; opacity: 1; }
  33.33%, 100% { left: 110%; opacity: 0; }
}

@keyframes anim-2 {
	0%, 33.33% { left: -100%; opacity: 0; }
  41.63%, 58.29% { left: 25%; opacity: 1; }
  66.66%, 100% { left: 110%; opacity: 0; }
}

@keyframes anim-3 {
	0%, 66.66% { left: -100%; opacity: 0; }
  74.96%, 91.62% { left: 25%; opacity: 1; }
  100% { left: 110%; opacity: 0; }
}
</style>
<div class="table-list">
<h4>MIS REPORT</h4>	
    <b>Monthly Form (<a href="monthly/premonthlyreport.php">Previous Report</a>)</b>
    <table border="1" cellspacing="1" cellpadding="5" style="text-align:center; width:1050px;">
	     <tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th colspan="2">
			    Status 
			 </th>
		 </tr>
		 <tr>
		     <th>
             </th>
		     <th>
             </th>
		     <th>
			 <?php 
                   echo $lastmonth = date('F',mktime(0,0,0,($currentmonth-1),0,0)).' End';
			 ?>
             </th>
		     <th>
			  <?php 				 
					echo $currentmonthname = date('F',mktime(0,0,0,($currentmonth),0,0)).' End';
			 ?>
             </th>
		 </tr>
		 <?php //PreMonth Query 
				if($groupid < 4){
				if($groupid == 2){
					//$md019prequery = "SELECT did FROM jos_md019 WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
                    $m15drhprequery = "SELECT did FROM jos_m15drh WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
                    /*$m27drhprequery = "SELECT DISTINCT distid FROM jos_m27drh WHERE distid IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; */
                    $m06drhprequery = "SELECT did FROM jos_m06drh WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
                  
                    $m16drhprequery = "SELECT did FROM jos_m16drh WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					/*$m10drhprequery = "SELECT distinct did FROM jos_m10drh WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
					$m11drhprequery = "SELECT distinct rid,did FROM jos_m11drh WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					$m12drhprequery  = "SELECT rid,did FROM jos_m12drh  WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; */
					if($accessid == 34) {
					   $m09rhprequery  = "SELECT rid FROM jos_m09rh WHERE rid=0 AND formmonth=$pretopremonth AND formyear=$checkyear"; 
					}
					$m25drprequery = "SELECT distinct rid,did FROM jos_m25dr WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					$m25drnprequery = "SELECT distinct rid,did FROM jos_m25drn WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					
				}
				if($groupid == 1){
					$checkaccessid = '0,'.$accessid;
					$m15drhprequery = "SELECT md.did FROM jos_m15drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$pretopremonth AND md.formyear=$precheckyear";
					/*$m27drhprequery = "SELECT DISTINCT md.distid FROM jos_m27drh as md WHERE (md.distid IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$pretopremonth AND md.formyear=$precheckyear"; */  

					$m06drhprequery = "SELECT md.did FROM jos_m06drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$pretopremonth AND md.formyear=$precheckyear";  
					
					$m16drhprequery = "SELECT md.did FROM jos_m16drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$pretopremonth AND md.formyear=$precheckyear"; 
					  $m09rhprequery  = "SELECT distinct rid FROM jos_m09rh WHERE rid IN ($checkregionid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					/*$m10drhprequery = "SELECT distinct did FROM jos_m10drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
					$m11drhprequery = "SELECT distinct rid,did FROM jos_m11drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					$m12drhprequery  = "SELECT rid,did FROM jos_m12drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$pretopremonth AND formyear=$precheckyear"; */
					$m25drprequery = "SELECT distinct rid,did FROM jos_m25dr as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					$m25drnprequery = "SELECT distinct rid,did FROM jos_m25drn as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$pretopremonth AND formyear=$precheckyear";
					  $m29rprequery = "SELECT rid FROM jos_m29r_class3 WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
					  $m29rpreresult = mysql_query($m29rprequery);
			 		 $m29rprerows   = mysql_num_rows($m29rpreresult);
				} 
				if($groupid == 0 || $groupid == 3){
					//$md019prequery = "SELECT did FROM jos_md019 WHERE formmonth=$pretopremonth AND formyear=$precheckyear";  
                    $m15drhprequery = "SELECT did FROM jos_m15drh WHERE formmonth=$pretopremonth AND formyear=$precheckyear";  
                    $m06drhprequery = "SELECT did FROM jos_m06drh WHERE formmonth=$pretopremonth AND formyear=$precheckyear";  
                   
                    $m16drhprequery = "SELECT did FROM jos_m16drh WHERE formmonth=$pretopremonth AND formyear=$precheckyear"; 
					$m09rhprequery = "SELECT rid FROM jos_m09rh WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
					/*$m10drhprequery = "SELECT distinct did,rid FROM jos_m10drh WHERE formmonth=$pretopremonth AND formyear=$precheckyear"; 
					$m11drhprequery = "SELECT distinct rid,did FROM jos_m11drh WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
					$m12drhprequery  = "SELECT rid,did FROM jos_m12drh  WHERE formmonth=$pretopremonth AND formyear=$precheckyear"; */
					$m25drprequery = "SELECT distinct rid,did FROM jos_m25dr WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
					 
					/*$m27drhprequery = "SELECT distinct rid,distid FROM jos_m27drh WHERE formmonth=$pretopremonth AND formyear=$precheckyear";*/
					$m29rprequery = "SELECT rid FROM jos_m29r_class3 WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
					$m29rpreresult = mysql_query($m29rprequery);
			        $m29rprerows   = mysql_num_rows($m29rpreresult);
				}
				$m20dprequery = "SELECT DISTINCT did FROM jos_m20d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
				$m21dprequery = "SELECT DISTINCT did FROM jos_m21d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
				$m22dprequery = "SELECT DISTINCT did FROM jos_m22dr WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";				
				$m22dnprequery = "SELECT DISTINCT did FROM jos_m22drn WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";				
				$m23dnprequery = "SELECT DISTINCT did FROM jos_m23dn WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
				
				$m20dpreresult = mysql_query($m20dprequery);
				$m20dprerows   = mysql_num_rows($m20dpreresult);
				$m21dpreresult = mysql_query($m21dprequery);
				$m21dprerows   = mysql_num_rows($m21dpreresult);
				
				$m22dpreresult = mysql_query($m22dprequery);
				$m22dprerows   = mysql_num_rows($m22dpreresult);
				$m22dnpreresult = mysql_query($m22dnprequery);
				$m22dnprerows   = mysql_num_rows($m22dnpreresult);
				
				$m23dnpreresult = mysql_query($m23dnprequery);
				$m23dnprerows   = mysql_num_rows($m23dnpreresult);
				 
				/*$m27drhpreresult = mysql_query($m27drhprequery);
				$m27drhprerows   = mysql_num_rows($m27drhpreresult); */
				
			/* $m10drhpreresult = mysql_query($m10drhprequery);
			 $m10drhprerows = mysql_num_rows($m10drhpreresult);
			 $m11drhpreresult = mysql_query($m11drhprequery);
			 $m11drhprerows = mysql_num_rows($m11drhpreresult);
		     $m12drhpreresult = mysql_query($m12drhprequery);
			 $m12drhprerows = mysql_num_rows($m12drhpreresult); */
			 
			 

			 $m15drhpreresult = mysql_query($m15drhprequery);
			 $m15drhprerows = mysql_num_rows($m15drhpreresult);

			  $m06drhpreresult = mysql_query($m06drhprequery);
			  $m06drhprerows = mysql_num_rows($m06drhpreresult);
			  
			 

			  $m16drhpreresult = mysql_query($m16drhprequery);
			  $m16drhprerows = mysql_num_rows($m16drhpreresult);
			  

			  //Currentmonth Query
				if($groupid == 2){
					//$md019curquery = "SELECT did FROM jos_md019 WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					$m15drhcurquery = "SELECT did FROM jos_m15drh WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					/*$m27drhcurquery = "SELECT DISTINCT distid FROM jos_m27drh WHERE distid IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; */
					$m16drhcurquery = "SELECT did FROM jos_m16drh WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					$m06drhcurquery = "SELECT did FROM jos_m06drh WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					
					/*$m10drhquery = "SELECT distinct did FROM jos_m10drh WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					$m11drhquery = "SELECT distinct did FROM jos_m11drh WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				    $m12drhquery  = "SELECT did FROM jos_m12drh WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; */
					$m25drquery = "SELECT distinct did FROM jos_m25dr WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					$m25drnquery = "SELECT distinct did FROM jos_m25drn WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					if($accessid == 34) {
					    $m09rhcurquery  = "SELECT rid FROM jos_m09rh WHERE rid=0 AND formmonth=$previousmonth AND formyear=$checkyear"; 
				$m09rhvacancy="select * from jos_vacancy WHERE  (rid IN ($regionid)) AND  (did IN ($accessid)) AND formmonth=$previousmonth AND formyear = $checkyear ";
						  
						  $m09rhcurresult = mysql_query($m09rhcurquery);
						  $m09rhcurrows = mysql_num_rows($m09rhcurresult);
						  
					}
				}
				if($groupid == 1){
					$checkaccessid = '0,'.$accessid;
					$m15drhcurquery = "SELECT md.did FROM jos_m15drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$previousmonth AND md.formyear=$checkyear";
					/*$m27drhcurquery = "SELECT md.distid FROM jos_m27drh as md WHERE (md.distid IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$previousmonth AND md.formyear=$checkyear";*/  
					$m16drhcurquery = "SELECT md.did FROM jos_m16drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$previousmonth AND md.formyear=$checkyear";  
  				      $m09rhcurquery  = "SELECT rid FROM jos_m09rh WHERE rid IN ($checkregionid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
					  $m06drhcurquery = "SELECT md.did FROM jos_m06drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.formmonth=$previousmonth AND md.formyear=$checkyear";
					/*$m10drhquery = "SELECT distinct did,rid FROM jos_m10drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear=$checkyear"; 
					$m11drhquery = "SELECT distinct rid FROM jos_m11drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear=$checkyear";
					$m12drhquery  = "SELECT rid,did FROM jos_m12drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear=$checkyear";  */
					$m25drquery = "SELECT distinct rid,did FROM jos_m25dr as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear=$checkyear";
					$m25drnquery = "SELECT distinct rid,did FROM jos_m25drn as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear=$checkyear";
					 $m29rcurquery  = "SELECT rid FROM jos_m29r_class3 WHERE rid IN ($checkregionid) AND formmonth=$previousmonth AND formyear=$checkyear";
					 $m29rcurresult = mysql_query($m29rcurquery);
			  $m29rcurrows   = mysql_num_rows($m29rcurresult);	
				} 
				if($groupid == 0 || $groupid == 3){
					//$md019curquery = "SELECT did FROM jos_md019 WHERE formmonth=$previousmonth AND formyear=$checkyear";  
					$m15drhcurquery = "SELECT did FROM jos_m15drh WHERE formmonth=$previousmonth AND formyear=$checkyear";  
                    $m06drhcurquery = "SELECT did FROM jos_m06drh WHERE formmonth=$previousmonth AND formyear=$checkyear"; 
                   
					$m16drhcurquery = "SELECT did FROM jos_m16drh WHERE formmonth=$previousmonth AND formyear=$checkyear";  
					/*$m10drhquery = "SELECT distinct did,rid FROM jos_m10drh WHERE formmonth=$previousmonth AND formyear=$checkyear";
					$m11drhquery = "SELECT distinct rid,did FROM jos_m11drh as md WHERE formmonth=$previousmonth AND formyear=$checkyear";
					$m12drhquery  = "SELECT rid,did FROM jos_m12drh  WHERE formmonth=$previousmonth AND formyear=$checkyear"; */
					$m09rhcurquery = "SELECT rid FROM jos_m09rh WHERE formmonth=$previousmonth AND formyear=$checkyear";
					$m09rhprequery = "SELECT rid FROM jos_m09rh WHERE formmonth=$previousmonth AND formyear=$checkyear";
					$m25drquery = "SELECT distinct did,rid FROM jos_m25dr WHERE formmonth=$previousmonth AND formyear=$checkyear";
					 $m25drnquery = "SELECT distinct did,rid FROM jos_m25drn WHERE formmonth=$previousmonth AND formyear=$checkyear and did in($accessid)";
					/*$m27drhcurquery = "SELECT distinct distid,rid FROM jos_m27drh WHERE formmonth=$previousmonth AND formyear=$checkyear"; */
					$m29rcurquery = "SELECT rid FROM jos_m29r_class3 WHERE formmonth=$previousmonth AND formyear=$checkyear";
					$m29rcurresult = mysql_query($m29rcurquery);
			         $m29rcurrows   = mysql_num_rows($m29rcurresult);	
				}
				$m20dquery = "SELECT DISTINCT did FROM jos_m20d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				$m21dquery = "SELECT DISTINCT did FROM jos_m21d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				$m22dquery = "SELECT DISTINCT did FROM jos_m22dr WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				$m22dnquery = "SELECT DISTINCT did FROM jos_m22drn WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";				
				$m23dquery = "SELECT DISTINCT did FROM jos_m23d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";	
				$m23dnquery = "SELECT DISTINCT did FROM jos_m23dn WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";	
				 $m25drnprequery = "SELECT  DISTINCT did,rid FROM jos_m25drn WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear and did in($accessid)";
				//Code written by Priyanka on 25-Apr-2013
			 	//$m29dquery = "SELECT DISTINCT did FROM jos_m29dr WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				//Code ended by Priyanka			
				$m20dresult = mysql_query($m20dquery);
				$m20drows   = mysql_num_rows($m20dresult);
				$m21dresult = mysql_query($m21dquery);
				$m21drows   = mysql_num_rows($m21dresult);
				$m22dresult = mysql_query($m22dquery);
				$m22drows   = mysql_num_rows($m22dresult);
				$m22dnresult = mysql_query($m22dnquery);
				$m22dnrows   = mysql_num_rows($m22dnresult);
				
				$m23dresult = mysql_query($m23dquery);
				$m23drows   = mysql_num_rows($m23dresult);
				$m23dnresult = mysql_query($m23dnquery);
				$m23dnrows   = mysql_num_rows($m23dnresult);
				$m25drnresult = mysql_query($m25drnquery);
				$m25drnrows   = mysql_num_rows($m25drnresult);
				$m25drnpreresult = mysql_query($m25drnprequery);
				$m25drnprerows   = mysql_num_rows($m25drnpreresult);
				//Code written by Priyanka on 25-Apr-2013
				//$m29dresult = mysql_query($m29dquery);
				//$m29drows   = mysql_num_rows($m29dresult);
				//Code ended by Priyanka
				/*$m27drhcurresult = mysql_query($m27drhcurquery);
				$m27drhcurrows   = mysql_num_rows($m27drhcurresult); */
				
				
			  $m15drhcurresult = mysql_query($m15drhcurquery);
			  $m15drhcurrows = mysql_num_rows($m15drhcurresult);
			  //print_r($m15drhcurrows);

			  $m06drhcurresult = mysql_query($m06drhcurquery);
			  $m06drhcurrows = mysql_num_rows($m06drhcurresult);
			  
			  $S07drhcurresult = mysql_query($S07drhcurquery);
			  $S07drhcurrows = mysql_num_rows($S07drhcurresult);

			  $m16drhcurresult = mysql_query($m16drhcurquery);
			  $m16drhcurrows = mysql_num_rows($m16drhcurresult);

              $m01dprequery  = "SELECT did FROM jos_m01d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
			  $m01dpreresult = mysql_query($m01dprequery);
			  $m01dprerows = mysql_num_rows($m01dpreresult);
              $m01dcurquery  = "SELECT did FROM jos_m01d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
			  $m01dcurresult = mysql_query($m01dcurquery);
			  $m01dcurrows = mysql_num_rows($m01dcurresult);
		 
              $m02dprequery  = "SELECT did FROM jos_m02d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
			  $m02dpreresult = mysql_query($m02dprequery);
			  $m02dprerows = mysql_num_rows($m02dpreresult);
              $m02dcurquery  = "SELECT did FROM jos_m02d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
			  $m02dcurresult = mysql_query($m02dcurquery);
			  $m02dcurrows = mysql_num_rows($m02dcurresult);

			  $m07dprequery  = "SELECT DISTINCT did FROM jos_m07d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
			  $m07dpreresult = mysql_query($m07dprequery);
			  $m07dprerows = mysql_num_rows($m07dpreresult);
              $m07dcurquery  = "SELECT DISTINCT did FROM jos_m07d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
			  $m07dcurresult = mysql_query($m07dcurquery);
			  $m07dcurrows = mysql_num_rows($m07dcurresult);
			
			  $m08dprequery  = "SELECT did FROM jos_m08d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
			  $m08dpreresult = mysql_query($m08dprequery);
			  $m08dprerows = mysql_num_rows($m08dpreresult);
			  $m08dcurquery  = "SELECT DISTINCT did FROM jos_m08d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
 			  $m08dcurresult = mysql_query($m08dcurquery);
			  $m08dcurrows = mysql_num_rows($m08dcurresult);
			  
			  
			  
			  
			  if(($groupid ==1) || ($groupid ==0) || ($accessid ==34) || ($accessid ==38)|| ($accessid ==39) || ($groupid == 3)) {
			 
				if($accessid==38 || $accessid ==39 ){
						$regionquery = "SELECT id,district,regionid FROM jos_misdistrict WHERE id=$accessid";
					$regionresult = mysql_query($regionquery);
					$row = mysql_fetch_array($regionresult);
					 if(count($row)>0){
					  $regionid=$row[2];
					  //$regionid=0;
					//echo  $m09rhprequery  = "SELECT rid FROM jos_m09rh WHERE rid IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						  $m09rhprequery  ="SELECT rid FROM jos_m09rh WHERE did=$accessid and  rid=$regionid AND formmonth = $previousmonth AND formyear=$checkyear";
						  $m09rhpreresult = mysql_query($m09rhprequery);
						  $m09rhprerows = mysql_num_rows($m09rhpreresult);
						  
						  $m09rhcurquery="select * from jos_m09rh WHERE  (rid IN ($regionid)) AND formmonth=$previousmonth AND formyear = $checkyear ";
						  
						  $m09rhcurresult = mysql_query($m09rhcurquery);
						  $m09rhcurrows = mysql_num_rows($m09rhcurresult);
						  
						  $m09rhvacancy="select * from jos_vacancy WHERE  (rid IN ($regionid)) AND (did = $accessid) AND formmonth=$previousmonth AND formyear = $checkyear ";
						  
						  $m09rhcurresult = mysql_query($m09rhcurquery);
						  $m09rhcurrows = mysql_num_rows($m09rhcurresult);


					  }
				  }else {    
				  		  $m09rhprecurrresult = mysql_query($m09rhprequery);
						  $m09rhprecurrrows = mysql_num_rows($m09rhprecurrresult);
				  		 $m09rhcurresult = mysql_query($m09rhcurquery);
						   $m09rhcurrows = mysql_num_rows($m09rhcurresult);
				  }
				   
				 
			  } 
			  $m19dprequery  = "SELECT did FROM jos_m19d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
			  $m19dpreresult = mysql_query($m19dprequery);
			  $m19dprerows = mysql_num_rows($m19dpreresult);
              $m19dcurquery  = "SELECT did FROM jos_m19d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
			  $m19dcurresult = mysql_query($m19dcurquery);
			  $m19dcurrows = mysql_num_rows($m19dcurresult);
			}  
			  // Code written by Priyanka on 25-Apr-2013
			  $m28dprequery  = "SELECT did FROM jos_m28d WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
			  $m28dpreresult = mysql_query($m28dprequery);
			  $m28dprerows = mysql_num_rows($m28dpreresult);
              $m28dcurquery  = "SELECT did FROM jos_m28d WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
			  $m28dcurresult = mysql_query($m28dcurquery);
			  $m28dcurrows = mysql_num_rows($m28dcurresult);
			  // Code ended by Priyanka on 25-Apr-2013
			  
	  if($groupid < 4){
	  if($accessid != 34) {?>
<!-- For new M-01-D new format-->
        <tr style="background-color:#FFC;">
		     <td>
			    <b>M-01-D (New)</b> 
			 </td>
			 <td>
			   Monthly Progress Report for Zilla Parishad Audit			 </td>
      <?php 
			 	$queryM01dnPreNew=	"select distinct did   from jos_m01dn where did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
				  $m01dnPreResult = mysql_query($queryM01dnPreNew);
				  $m01dnPreRows = mysql_num_rows($m01dnPreResult);
			 
			 ?>
			  <td align="center"> <?php // echo $groupid. $countaccess; ?>
			    <?php if($groupid == 1) {if(($m01dnPreRows !=0) && ($m01dnPreRows == $countaccess)) {?>
				 <a href="monthly/m01dprereportn.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="monthly/m01dprereportn.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($m01dnPreRows !=0) && ($m01dnPreRows == $countaccess)) {?>
				   <a href="monthly/m01dprereportn.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m01dprereportn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m01dnPreRows !=0) && ($m01dnPreRows == ($countaccess-4))) {?>
				   <a href="monthly/m01dprereportn.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m01dprereportn.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td> 
				<td align="center">
			   <?php $queryM01dnNew=	"select distinct did   from jos_m01dn where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m01dnResult = mysql_query($queryM01dnNew);
			  		 	$m01dnRows = mysql_num_rows($m01dnResult);
					
				 ?>
                  <?php if($groupid == 1) { if(($m01dnRows !=0) && ($m01dnRows == ($countaccess))) {?>

				 <a href="monthly/m01dreportn.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="monthly/m01dreportn.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($m01dnRows !=0)  ) {?>
						<a href="monthly/m01dreportn.php"><img src="images/green.png" border="0"/></a>
                        
 	               <?php }else {?>
					   <a href="monthly/m01dn.php"><img src="images/orange.png" border="0"/></a>
        	        <?php }} if($groupid == 0 || $groupid == 3) {if(($m01dnRows !=0) && ($m01dnRows == ($countaccess-4))) {?>
				   <a href="monthly/m01dreportn.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m01dreportn.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
			 </td>
		 </tr>
         <tr style="background-color:#FFC;">
		     <td>
			    <b>M-02-D (New)</b> 
			 </td>
			 <td>
		     Monthly Progress Report for Panchayat Samitis Audit </td>
	    <?php 
			 	 $queryM02dnPreNew=	"select distinct did  from jos_m02dn where did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
				  $m02dnPreResult = mysql_query($queryM02dnPreNew);
				  $m02dnPreRows = mysql_num_rows($m02dnPreResult);
			 
			 ?>
			  <td align="center">
			    <?php if($groupid == 1) {if(($m02dnPreRows !=0) && ($m02dnPreRows == $countaccess)) {?>
				 <a href="monthly/m02dprereportn.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="monthly/m02dprereportn.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($m02dnPreRows !=0) && ($m02dnPreRows == $countaccess)) {?>
				   <a href="monthly/m02dprereportn.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m02dprereportn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m02dnPreRows !=0) && ($m02dnPreRows == ($countaccess-4))) {?>
				   <a href="monthly/m02dprereportn.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m02dprereportn.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td> 
				<td align="center">
				   <?php     $queryM02dnNew=	"select distinct did   from jos_m02dn where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m02dnResult = mysql_query($queryM02dnNew);
			  			  $m02dnRows = mysql_num_rows($m02dnResult );
					
				 ?>
                  <?php if($groupid == 1) { if(($m02dnRows !=0) && ($m02dnRows == ($countaccess))) {?>
				 <a href="monthly/m02dreportn.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m02dreportn.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m02dnRows !=0) ) {?>
				   <a href="monthly/m02dreportn.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m02dn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m02dnRows !=0) && ($m02dnRows == ($countaccess-4))) {?>
				   <a href="monthly/m02dreportn.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m02dreportn.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
           <tr style="background-color:#FFC;">
		     <td>
			    <b>M-03-D (New)			 </b>			 </td>
		    <td>
			    Monthly Progress Report for Nagar Palika Audit
			 </td>
             <?php 
			 	$queryM03dPreNew=	"select *  from jos_m03d where did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
				  $m03dPreResult = mysql_query($queryM03dPreNew);
				  $m03dPreRows = mysql_num_rows($m03dPreResult);
				  //($m03dPreRows);
			 			
				 $queryM03d=	"select *  from jos_m03d where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				$m03dResult = mysql_query($queryM03d);
				$m03currow = mysql_num_rows($m03dResult);
						//print_r($m03row);

			 $m03dCurRows = mysql_num_rows($m03dResult);
				
				//print_r($m03dCurRows);
			 ?>
		    <td align="center">
			    <?php if($groupid == 1) { if(($m03dPreRows !=0) && ($m03dPreRows == ($countaccess))) {?>
				 <a href="monthly/m03dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m03dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m03dPreRows !=0)) {?>
				   <a href="monthly/m03dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m03dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m03dPreRows !=0) && ($m03dPreRows == 70)) {?>
				   <a href="monthly/m03dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m03dprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
			 </td>
				<td align="center">
			    <?php if($groupid == 1) { if(($m03dCurRows !=0) && ($countaccess*3)) {?>
				 <a href="monthly/m03dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m03dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m03dCurRows !=0)) {?>
				   <a href="monthly/m03dreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m03d.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m03dCurRows !=0) && ($m03dCurRows == 102)) {?>
				   <a href="monthly/m03dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m03dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         <tr style="background-color:#FFC;">
		     <td>
			    <b>M-04-D (New)			 </b>			 </td>
	    <td>
			    Monthly Progress Report for Nagar Panchyat Audit
			 </td>
             <?php 
			 	 $queryM04dPreNew=	"select *  from jos_m04d where did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear"; 
				  $m04dPreResult = mysql_query($queryM04dPreNew);
				  $m04dPreRows = mysql_num_rows($m04dPreResult);
				  
				$queryM04d=	"select *  from jos_m04d where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				$m04dResult = mysql_query($queryM04d);
				$m04dCurRows = mysql_num_rows($m04dResult);
			 ?>
		    <td align="center">
             <?php if($groupid == 1) { if(($m04dPreRows !=0) && ($m04dPreRows == ($countaccess))) {?>
				 <a href="monthly/m04dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m04dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m04dPreRows !=0) && ($m04dPreRows == $countaccess)) {?>
				   <a href="monthly/m04dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m04dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m04dPreRows !=0) && ($m04dPreRows == ($countaccess-4))) {?>
				  <a href="monthly/m04dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				 <a href="monthly/m04dprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
	    
			 </td>
				<td align="center">
			    <?php if($groupid == 1) { if(($m04dCurRows !=0) && ($m04dCurRows == ($countaccess))) {?>
				 <a href="monthly/m04dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m04dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {	if(($m04dCurRows !=0) && ($m04dCurRows == ($countaccess))) {
					?>
				   <a href="monthly/m04dreport.php"><img src="images/green.png" border="0"/></a>
                   <?php } else {?>
                    <a href="monthly/m04d.php"><img src="images/orange.png" border="0"/></a>
                   <?php } } 
					//echo $countaccess;				   	
				   if($groupid == 0 || $groupid == 3) {if(($m04dCurRows !=0) && ($m04dCurRows == ($countaccess-4))) {?>
				   <a href="monthly/m04dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m04dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         <?php if((($accessid < 15|| $accessid==35) && ($accessid!= 4)) || ($groupid==0) || ($groupid == 3)) {?>
          <tr style="background-color:#FFC;">
		     <td>
			    <b>M-05-D (New)			 </b>			 </td>
	      <td>
		        Progress Report for School Board Audit			 </td>
            <?php 
			  	$queryM05d=	"select *  from jos_m05d where did IN ($accessid) ";
				$m05dResult = mysql_query($queryM05d);
			 	$m05dCurRows = mysql_num_rows($m05dResult);
			 ?>
		    <td align="center">
			    <a href="monthly/m05dprereport.php"><img src="images/green.png" border="0"/></a> 
               
			 </td>
				<td align="center">
			    <?php if($groupid == 1) { if(($m05dCurRows !=0) && ($m05dCurRows !=0)) {?>
				 <a href="monthly/m05dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m05dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {
						if(($m05dCurRows !=0) && ($m05dCurRows !=0)) {
					?>
				   <a href="monthly/m05dreport.php"><img src="images/green.png" border="0"/></a>
                   <?php } else {?>
                   <a href="monthly/m05d.php"><img src="images/orange.png" border="0"/></a>
                   <?php } ?>
                <?php } if($groupid == 0 || $groupid == 3) {if(($m05dCurRows !=0) ) {?>
				   <a href="monthly/m05dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m05dreport.php">s<img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         <?php }?>
      	<!-- For new M-01-D new format-->
        <?php /* ?> <!-- <tr>

		     <td>
			    <b>M-01-D</b> 
			 </td>
			 <td>
			   Monthly Progress Report for Zilla Parishad Audit
			 </td>
			  <td align="center">
			    <?php if($groupid == 1) { if(($m01dprerows !=0) && ($m01dprerows == ($countaccess))) {?>
				 <a href="monthly/m01dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m01dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m01dprerows !=0) && ($m01dprerows == $countaccess)) {?>
				   <a href="monthly/m01dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m01d.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m01dprerows !=0) && ($m01dprerows == ($countaccess-1))) {?>
				   <a href="monthly/m01dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m01dprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td> 
				<td align="center">
			    <?php if($groupid == 1) { if(($m01dcurrows !=0) && ($m01dcurrows == ($countaccess))) {?>
				 <a href="monthly/m01dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m01dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m01dcurrows !=0) && ($m01dcurrows == $countaccess)) {?>





				   <a href="monthly/m01dreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m01d.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {   if(($m01dcurrows !=0) && ($m01dcurrows == ($countaccess-1))) {?>
				   <a href="monthly/m01dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m01dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         <tr>
		     <td>
			    <b>M-02-D</b> 
			 </td>
			 <td>
			    Monthly Progress Report for Panchayat Samitis Audit
			 </td>
			 <td align="center">
			   <?php if($groupid == 1) { if(($m02dprerows !=0) && ($m02dprerows == ($countaccess))) {?>
				 <a href="monthly/m02dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m02dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m02dprerows !=0) && ($m02dprerows == $countaccess)) {?>
				   <a href="monthly/m02dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m02dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m02dprerows !=0) && ($m02dprerows == ($countaccess-1))) {?>
				   <a href="monthly/m02dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m02dprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?> 
				 </td> 
				<td align="center">
			    <?php if($groupid == 1) { if(($m02dcurrows !=0) && ($m02dcurrows == ($countaccess))) {?>
				 <a href="monthly/m02dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m02dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m02dcurrows !=0) && ($m02dcurrows == $countaccess)) {?>
				   <a href="monthly/m02dreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m02d.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m02dcurrows !=0) && ($m02dcurrows == ($countaccess-1))) {?>
				   <a href="monthly/m02dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m02dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>-->
         <?php */ ?>
    <?php  } 
	
	
	if(($accessid!=37) && ($accessid!=36)){?>
		 
         <tr>
		     <td>
			    <b>M-06-DRH</b> 
			 </td>
			 <td>
		      	    महिला तक्रार निवारण समित्याकडे प्राप्त झालेल्या तक्रारी 
			 </td>
			  <td align="center">
			    <?php if($groupid == 1) {if(($m06drhprerows !=0) && ($m06drhprerows == $countaccess)) {?>
				 <a href="monthly/m06drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="monthly/m06drhprereport.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($m06drhprerows !=0) && ($m06drhprerows == $countaccess)) {?>
				   <a href="monthly/m06drhprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m06drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06drhprerows !=0) && ($m06drhprerows == 42)) {?>
				   <a href="monthly/m06drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center"> <?php //echo $m06drhprerows.$m06drhcurrows;?>
			    <?php if($groupid == 1) {?>
				 <a href="monthly/m06drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="monthly/m06drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($m06drhcurrows !=0) && ($m06drhcurrows == $countaccess)) {?>
				   <a href="monthly/m06drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m06drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06drhcurrows !=0) && ($m06drhcurrows == 42)) {?>
				   <a href="monthly/m06drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>	
	<?php }
	
	/*
	 if((($accessid < 15|| $accessid==35) && ($accessid!= 4)) || ($groupid==0) || ($groupid == 3)) {?>
         <tr>
		     <td>
			    <b>M-07-D</b> 
			 </td>
			 <td>
			    Monthly Progress Report For School Board Audit
			 </td>
			 <td align="center">
			   <?php if($groupid == 1) { if(($m07dprerows !=0) && ($m07dprerows == ($countaccess))) {?>
				 <a href="monthly/m07dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m07dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m07dprerows !=0) && ($m07dprerows == $countaccess)) {?>
				   <a href="monthly/m07dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m07dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m07dprerows !=0) && ($m07dprerows == ($countaccess-1))) {?>
				   <a href="monthly/m07dprereport.php"><img src="images/orange.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m07dprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?> 
			  </td> 
			  <td align="center">
			    <?php if($groupid == 1) { if(($m07dcurrows !=0) && ($m07dcurrows == ($countaccess))) {?>
				 <a href="monthly/m07dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m07dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {?>
				   <a href="monthly/m07dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="monthly/m07d.php"><img src="images/orange.png" border="0"/></a>
                <?php  } if($groupid == 0 || $groupid == 3) {if(($m07dcurrows !=0) && ($m07dcurrows == ($countaccess-1))) {?>
				   <a href="monthly/m07dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m07dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
			  </td>
		 </tr>
<?php } */  
?>          

<?php if($accessid != 34) { ?>
	 <tr style="background-color:#FFC;">
		     <td>
			    <b>M-08-D</b> 
			 </td>
			 <td>
			    Monthly Progress Report for Village Panchayat Audit
			 </td>
		    <td align="center"> 
			    <?php  if($groupid == 1) { if(($m08dprerows !=0) && ($m08dprerows == ($countaccess))) {?>
				 <a href="monthly/m08dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m08dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m08dprerows !=0) && ($m08dprerows == $countaccess)) {?>
				   <a href="monthly/m08dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m08dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m08dprerows !=0) && ($m08dprerows == 34)) {?>
				   <a href="monthly/m08dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m08dprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
			 </td>
				<td align="center">
			    <?php if($groupid == 1) { if(($m08dcurrows !=0) && ($m08dcurrows == ($countaccess))) {?>
				 <a href="monthly/m08dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m08dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m08dcurrows !=0) && ($m08dcurrows == $countaccess)) {?>
				   <a href="monthly/m08dreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m08d.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m08dcurrows !=0) && ($m08dcurrows == ($countaccess-4))) {?>
				   <a href="monthly/m08dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m08dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
  <!-- new M-08D-2 form on 6/dec/2016 -->
        <tr style="background-color:#FFC;">
		     <td>
			    <b>M-08-D2 (New)</b> 
			 </td>
			 <td>Monthly Progress Report for Village Panchayat Audit part 2 </td>
		     <?php 
			   $queryM08d2PreQuery  = "SELECT did FROM jos_m08d2 WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
			   //echo $queryM08d2PreQuery;
			   $m08d2PreResult = mysql_query($queryM08d2PreQuery);
			   $m08d2PreCurrRows = mysql_num_rows($m08d2PreResult);
			    
			   
			  ?>
		    <td align="center">  
            <?php if($groupid == 1) { if(($m08d2PreCurrRows !=0) && ($m08d2PreCurrRows == ($countaccess))) {?>
				 aa<a href="monthly/m08d2prereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				<a href="monthly/m08d2prereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
                 
				<?php   if ($groupid == 2) {if(($m08d2PreCurrRows !=0) || ($m08d2CurrRows !=0)) {?>
				   <a href="monthly/m08d2prereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m08d2prereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m08d2PreCurrRows !=0) && ($m08d2PreCurrRows == ($countaccess-4))) {?>
				   <a href="monthly/m08d2prereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m08d2prereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
            
            </td>
				<td align="center">
				<?php 
                  $queryM08d2Query  = "SELECT did FROM jos_m08d2 WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear"; 
                  $m08d2Result = mysql_query($queryM08d2Query);
                  $m08d2CurrRows = mysql_num_rows($m08d2Result);
				  
				  //print_r($m08d2CurrRows);
                
                 ?>
                 <?php if($groupid == 1) { if(($m08d2CurrRows !=0) && ($m08d2CurrRows == ($countaccess*5))) {?>
				 <a href="monthly/m08d2nreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m08d2nreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m08d2CurrRows !=0)) {?>
				   <a href="monthly/m08d2nreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m08d2n.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m08d2CurrRows !=0) && ($m08d2CurrRows == ($countaccess*3))) {?>
				   <a href="monthly/m08d2nreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m08d2nreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>		 </tr>
          <!-- new M-08D-2 form on 6/dec/2016 -->
           <!----------------------------------------------------------M-08-D3(NEW) start--------- -------------------------------->
        
         <!-- new M-08D-3 form on 22-07-2022  --Pratik  -->
        <tr style="background-color:#FFC;">
		     <td>
			    <b>M-08-D3 (New)</b> 
			 </td>
			 <td>Monthly Progress Report for Village Panchayat Audit part 3 </td>
		     <?php 
			   $queryM08d3PreQuery  = "SELECT did FROM jos_m08d2 WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear AND audit_year='2021-2022' AND valid=1"; 
			   //echo $queryM08d3PreQuery;
			   $m08d3PreResult = mysql_query($queryM08d3PreQuery);
			   $m08d3PreCurrRows = mysql_num_rows($m08d3PreResult);
			   //echo $m08d3PreCurrRows.'=====';
			
			  ?>
		    <td align="center">  
            <?php if($groupid == 1) { if(($m08d3PreCurrRows !=0) && ($m08d3PreCurrRows == ($countaccess))) {?>
				 aa<a href="monthly/m08d3prereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				<a href="monthly/m08d3prereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
                 
				<?php   if ($groupid == 2) 
					{ 
						if(($m08d3PreCurrRows !=0) ) 
						{ ?>
				   <a href="monthly/m08d3prereport.php"><img src="images/green.png" border="0"/></a>
              				  <?php }
              				  	else 
              				  	{  ?>
				   <a href="monthly/m08d3prereport.php"><img src="images/orange.png" border="0"/></a>
               				  <?php }  
               				} 
               				if($groupid == 0 || $groupid == 3) {if(($m08d3PreCurrRows !=0) && ($m08d3PreCurrRows == ($countaccess-4))) {?>
				   <a href="monthly/m08d3prereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m08d3prereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
                        </td>
				<td align="center">
		<?php 
	          $queryM08d3Query  = "SELECT did FROM jos_m08d2 WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear AND audit_year='2021-2022' AND valid=1"; 
                  
                  //echo $queryM08d3Query;
                  $m08d3Result = mysql_query($queryM08d3Query);
                  $m08d3CurrRows = mysql_num_rows($m08d3Result);
                  //echo $m08d3CurrRows;
                 ?>
                 <?php if($groupid == 1) 
                       { 
                            if(($m08d3CurrRows !=0) && ($m08d3CurrRows == ($countaccess*5))) 
                            {?>
				 <a href="monthly/m08d3nreport.php"><img src="images/green.png" border="0"/></a> 
                <?php       } 
                	    else 
                	    {?>
				 <a href="monthly/m08d3nreport.php"><img src="images/orange.png" border="0"/></a>
                <?php       }
                       }?>
		<?php  if ($groupid == 2) 
			{ 
				if(($m08d3CurrRows !=0)) 
				{  ?>
				   <a href="monthly/m08d3nreport.php"><img src="images/green.png" border="0"/></a>
                <?php 		}
                		else 
                		{  ?>
				   <a href="monthly/m08d3nreport.php"><img src="images/orange.png" border="0"/></a>
                <?php 		}  
                	} 
                	if($groupid == 0 || $groupid == 3) 
                	{
                		if(($m08d3CurrRows !=0) && ($m08d3CurrRows == ($countaccess*3))) 
                		{?>
				   <a href="monthly/m08d3nreport.php"><img src="images/green.png" border="0"/></a> 
				<?php 
				} 
				else 
				{?>
				  <a href="monthly/m08d3nreport.php"><img src="images/orange.png" border="0"/></a>
			<?php 	}
			}?>
				 </td>	
				 </tr>
        <!----------------------------------------------------------M-08-D3(NEW) end--------- ---------------------------------->
       
		 <?php }   //|| in_array(39,$accessarray)
		 if(($groupid ==1) || ($groupid ==0) || ($accessid ==34) || ($accessid ==38)|| ($accessid ==39) || ($groupid == 3) ) { ?>
		<tr> <!-- accessarray -->
		    <td>
			  <b>M-09-RH</b>
			</td>
			<td>
			   Monthly Progress Report For Position of Vacant Post
			</td>
            <td align="center">
			     <?php if($groupid == 1 || $accessid ==34) {?>
				     <a href="monthly/m09rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else { if($m09rhprecurrrows ==7) {?>
				       <a href="monthly/m09rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="monthly/m09rhprereport.php"><img src="images/green.png" border="0"/></a>  
				 <?php } } ?> 
             </td>
            <td align="center">  <?php   ?>
                  <?php  if($groupid == 1 || $accessid ==34 ) { 
							 if($m09rhcurrows !=0){ ?>
							 <a href="monthly/m09rhreport.php"><img src="images/green.png" border="0"/></a> 
							<?php }else {?>
							   <a href="monthly/m09rh.php"><img src="images/orange.png" border="0"/></a> 
							<?php }  
					}else if( $groupid==2 && ($accessid ==38 || $accessid ==39)){ 
							 
								if($m09rhcurrows>0){ ?> 
		                            cc <a href="monthly/m09rhreportmca.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/m09rh.php"><img src="images/orange.png" border="0"/></a> 
								<?php }
							}else if($m09rhcurrows ==7) {?>
						       <a href="monthly/m09rhreport.php"><img src="images/green.png" border="0"/></a> 
						 <?php }else { ?>
                                <a href="monthly/m09rhreport.php"><img src="images/green.png" border="0"/></a>  
                         <?php }  ?>             
		    </td>
		</tr>
        <?php }?>
        
        
        <!----------------------------------------------------------M-09-RH (NEW) start--------- -------------------------------->
		
		<?php	if(($accessid!=37) && ($accessid!=36)){?>

        <tr> <!-- accessarray -->
		    <td>
			  <b>M-09-RH (New)</b>
			</td>
			<td>
			   Monthly Progress Report For Position of Vacant Post
			</td>
         
             <td>
			<?php if ($groupid == 0  || $groupid==3){ ?> 
		                             <a href="monthly/vac_adminprereport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vac_adminprereport.php"><img src="images/green.png" border="0"/></a> 
								<?php }?>
             </td> 
				<?php 
                 $m09rhvac="select * from jos_vacancy WHERE did IN ($accessid) and (rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear = $checkyear ";
						  
						  $m09rhvacresult = mysql_query($m09rhvac);
						 $m09rhvacrows = mysql_num_rows($m09rhvacresult);
					//print_r	($m09rhvacrows);
		  $m09rhvaccount="select count(*) from jos_vacancy WHERE did IN ($accessid) and  (rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear = $checkyear ";
						  
				$m09rhvacresultcount =mysql_query($m09rhvaccount);
				$m09rhvacrowscount  = mysql_fetch_array($m09rhvacresultcount);
						//print_r($m09rhvacrowscount[0]);
						 	
					
				 $sqlreg = "select rid FROM jos_vacancy where (rid IN ($checkregionid))";
						$resultreg = mysql_query($sqlreg);
						$row_reg = 	mysql_fetch_array($resultreg);
						//echo $row_reg[0];
						
				 $sqldist = "select * FROM jos_vacancy where did IN ($accessid) AND formmonth=$previousmonth AND formyear = $checkyear";
						$resultdist = mysql_query($sqldist);
						$row_dist = mysql_fetch_array($resultdist);
						$m09rhdistrows = mysql_num_rows($resultdist);
					//print_r	($m09rhdistrows);
					//print_r	($row_dist);

		 $m09rhvacad="select * from jos_vacancy WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear = $checkyear ";
				 $m09rhvacadcresult = mysql_query($m09rhvacad);
						 $m09rhvacadrows = mysql_num_rows($m09rhvacadcresult);
				//print_r	($m09rhvacadrows);


						
						
                 ?>
				 
				  <td align="center">
					                  <?php  if($row_reg[0] ==1 ) { 
							 if(($m09rhvacrowscount[0] == 7) && ($row_reg[0] ==1)){ ?>
							  <a href="monthly/vac_mumbaireport.php"><img src="images/green.png" border="0"/></a> 
							<?php }else {?>
							  <a href="monthly/vacancy_form.php"><img src="images/orange.png" border="0"/></a>
                              <a href="monthly/vac_mumbaireport.php"><img src="images/green.png" border="0"/></a> 
							<?php }  
							}
							else if ($row_reg[0] ==2 ){ 
								if(($m09rhvacrowscount[0] == 6) && ($row_reg[0] ==2)){ ?> 
		                             <a href="monthly/vac_punereport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vacancy_form.php"><img src="images/orange.png" border="0"/></a>
                               <a href="monthly/vac_punereport.php"><img src="images/green.png" border="0"/></a>   

								<?php }
							}
							else if ($row_reg[0] ==3 ){ 
								if(($m09rhvacrowscount[0] ==6) && ($row_reg[0] ==3)){ ?> 
		                             <a href="monthly/vac_nashikreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vacancy_form.php"><img src="images/orange.png" border="0"/></a> 
                               <a href="monthly/vac_nashikreport.php"><img src="images/green.png" border="0"/></a>   

								<?php }
							}
							else if ($row_reg[0] ==4 ){ 
								if(($m09rhvacrowscount[0] ==10) && ($row_reg[0] ==4)){ ?> 
		                             <a href="monthly/vac_aurangabadreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vacancy_form.php"><img src="images/orange.png" border="0"/></a>
                               <a href="monthly/vac_aurangabadreport.php"><img src="images/green.png" border="0"/></a>   
 
								<?php }
							}
							else if ($row_reg[0] ==5 ){ 
								if(($m09rhvacrowscount[0] ==6) && ($row_reg[0] ==5)){ ?> 
		                             <a href="monthly/vac_amravatireport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vacancy_form.php"><img src="images/orange.png" border="0"/></a> 
                                <a href="monthly/vac_amravatireport.php"><img src="images/green.png" border="0"/></a>   

								<?php }
							}
							else if ($row_reg[0] ==6 ){ 
								if(($m09rhvacrowscount[0] ==7) && ($row_reg[0] ==6)){ ?> 
		                             <a href="monthly/vac_nagpurreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vacancy_form.php"><img src="images/orange.png" border="0"/></a> 
                                <a href="monthly/vac_nagpurreport.php"><img src="images/green.png" border="0"/></a>   

								<?php }
							}
							else if ($groupid == 0  || $groupid==3 ){
							
								if(($m09rhvacadrows ==36)){ ?> 
		                             <a href="monthly/vac_adminreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vac_adminreport.php"><img src="images/orange.png" border="0"/></a> 
								<?php }
							}
							
							else if ($groupid == 2 ){ 
								if(($m09rhdistrows !=0)){ ?> 
		                             <a href="monthly/vac_disreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/vacancy_form.php"><img src="images/orange.png" border="0"/></a> 
								<?php }
							}}?>

							     
				  
				  </td>

		</tr>
        <?php	if(($accessid==39) || ($accessid==39) || ($accessid==38) || ($groupid==1) || ($groupid==0 ||($groupid==3))){?>
		
		 <tr> <!-- accessarray -->
		    <td>
			  <b>MCA-10D(New)</b>
			</td>
		    <td >
			  महानगरपालिका लेखापरीक्षण शाखा रिक्त पदांची स्थिती
			</td>
         
             <td style = "background-color:lightgoldenrodyellow;">
			<?php if ($groupid == 0  || $groupid==3){ ?> 
		                             <a href="monthly/mca_vacadminprereport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/mca_vacadminprereport.php"><img src="images/green.png" border="0"/></a> 
								<?php }?>
             </td> 
				<?php 
                		
			 $sqldist = "select * FROM jos_vacancy where did IN ($accessid) AND formmonth=$previousmonth AND formyear = $checkyear";
						$resultdist = mysql_query($sqldist);
						$row_dist = mysql_fetch_array($resultdist);
						$m09rhdistrows = mysql_num_rows($resultdist);
					//print_r	($m09rhdistrows);
					//print_r	($row_dist);
/////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		 $mca10dvac1a="select * from jos_mcavacancy_div1a WHERE did = 39 AND formmonth=$previousmonth AND formyear = $checkyear ";
				 $mca10dvac1aresult = mysql_query($mca10dvac1a);
						 $mca10dvac1arows = mysql_num_rows($mca10dvac1aresult);
																															
													   
													   
			$mca10dvac3a="select * from jos_mcavacancy_div3a WHERE did = 38 AND formmonth=$previousmonth AND formyear = $checkyear ";
				 $mca10dvac3aresult = mysql_query($mca10dvac3a);
						 $mca10dvac3arows = mysql_num_rows($mca10dvac3aresult);
													   
													   
			$mca10dvac3b="select * from jos_mcavacancy_div3b WHERE did = 38 AND formmonth=$previousmonth AND formyear = $checkyear ";
				 $mca10dvac3bresult = mysql_query($mca10dvac3b);
						 $mca10dvac3brows = mysql_num_rows($mca10dvac3bresult);
													   
													   
			$mca10dvac3c="select * from jos_mcavacancy_div3c WHERE did = 38 AND formmonth=$previousmonth AND formyear = $checkyear ";
				 $mca10dvac3cresult = mysql_query($mca10dvac3c);
						 $mca10dvac3crows = mysql_num_rows($mca10dvac3cresult);
													   
													   
			$mca10dvac3d="select * from jos_mcavacancy_div3d WHERE did = 38 AND formmonth=$previousmonth AND formyear = $checkyear ";
				 $mca10dvac3dresult = mysql_query($mca10dvac3d);
						 $mca10dvac3drows = mysql_num_rows($mca10dvac3dresult);
													   
													   
			$mca10dvac4a="select * from jos_mcavacancy_div4a WHERE rid = 6 AND formmonth=$previousmonth AND formyear = $checkyear ";
				 $mca10dvac4aresult = mysql_query($mca10dvac4a);
						 $mca10dvac4arows = mysql_num_rows($mca10dvac4aresult);
													   
				//print_r	($m09rhvacadrows);

/////////////////////////////////////////////////////////////////////////////////////////////////////////
						
						
                 ?>
				 
				  <td align="center">
					        <?php
							if ($groupid == 0  || $groupid==3 ){
							
								if(($mca10dvac1arows !=0)){ ?> 
		                            <a href="monthly/mca_vacadminreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/mca_vacadminreport.php"><img src="images/orange.png" border="0"/></a> 
								<?php }
							}
							
							else if ($accessid == 39 ){ 
								if(($mca10dvac1arows !=0)){ ?> 
		                             <a href="monthly/mcadiv1_2_jointvacformnewreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/mcadiv1_2_jointvacformnew.php"><img src="images/orange.png" border="0"/></a> 
								<?php }
							}
													   
							else if ($accessid == 38 ){ 
								if(($mca10dvac3arows !=0 && $mca10dvac3brows!=0 && $mca10dvac3crows!=0 && $mca10dvac3drows!=0  )){ ?> 
		                             <a href="monthly/mcadiv3_vacformnewreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/mcadiv3_vacformnew.php"><img src="images/orange.png" border="0"/></a> 
								<?php }
							}
																				  
							else if ($groupid == 1 ){ 
								if(($mca10dvac4arows !=0)){ ?> 
		                             <a href="monthly/mcajd_vacformnewreport.php"><img src="images/green.png" border="0"/></a>   
                                 <?php }else{ ?>
								<a href="monthly/mcajd_vacformnew.php"><img src="images/orange.png" border="0"/></a> 
								<?php }
							}
																		
					  ?>

							     
				  
				  </td>

		</tr
		<?php }?>
		
		<?php   $query_paid="select count(*) as cnt from jos_sankirna_listn where type=1 and distid in($accessid)";
		$resCnt=mysql_query($query_paid);
		$resData=mysql_fetch_array($resCnt);
        if($resData['cnt']!=0){
		?>
       <tr style="background-color:#FFC;">
        <th>M-10-DR (New)</th>
        <td>  Monthly Progress Report for Miscellaneous Institutes (Paid Audit) <!--सशुल्क संकीर्ण संस्थांचा लेखापरीक्षणाची सध्यास्थिती दर्शविणारे मासिक विवरणपत्र--></td>
      <td>
                  <a href="monthly/m10drprereport.php"><img src="images/green.png" border="0"/></a> 
                  <?php if($groupid!=0 && $groupid!=3){ ?>
                  <a href="monthly/m10drprereport.php"><img src="images/orange.png" border="0"/></a>
				  <?php }?></td>
         <?php 
			if($groupid == 1){
				 $m10drprequery = "SELECT rid FROM jos_m10dr WHERE rid IN ($checkregionid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
				 $m10drquery = "SELECT rid FROM jos_m10dr WHERE rid IN ($checkregionid) AND formmonth=$previousmonth AND formyear=$checkyear";	        	
			}else{
				 $m10drprequery = "SELECT rid FROM jos_m10dr WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
				 $m10drquery = "SELECT rid FROM jos_m10dr WHERE formmonth=$previousmonth AND formyear=$checkyear";	        	
			}      
			$m10drpreresult   = mysql_query($m10drprequery);
			$m10drprerows  = mysql_num_rows($m10drpreresult); 
			$m10drresult   = mysql_query($m10drquery);
			$m10drrows  = mysql_num_rows($m10drresult);?>  
        <td>
        <?php /*if($groupid == 1) { if(($m10drrows !=0)) {?>
				 <a href="monthly/m10drreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m10dr.php"><img src="images/orange.png" border="0"/></a>
                <?php }} 
				if($groupid == 0 || $groupid == 3) {   if(($m10drrows !=0) ) {?>
				   <a href="monthly/m10drreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m10drreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}*/?>
                  <a href="monthly/m10drreport.php"><img src="images/green.png" border="0"/></a> 
                  <?php if($groupid!=0 && $groupid!=3){ ?>
                  <a href="monthly/m10dr.php"><img src="images/orange.png" border="0"/></a>
				  <?php }?>
        </td>
        </tr>
          <?php } ?>
        <tr style="background-color:#FFC;">
        <th>M-11-DR(New)</th>
        <td>Monthly Progress Report for Miscellaneous Institutes (Free Audit) <!--नि:शुल्क संकीर्ण संस्थांचा लेखापरीक्षणाची सध्यास्थिती दर्शविणारे मासिक विवरणपत्र--></td>
        <td>  <a href="monthly/m11drprereport.php"><img src="images/green.png" border="0"/></a> 
                  <?php if($groupid!=0 && $groupid!=3){ ?>
                  <a href="monthly/m11drprereport.php"><img src="images/orange.png" border="0"/></a>
				  <?php }?></td>
        <?php 
			if($groupid == 1){
				 $m11drprequery = "SELECT rid FROM jos_m11dr WHERE rid IN ($checkregionid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
				 $m11drquery = "SELECT rid FROM jos_m11dr WHERE rid IN ($checkregionid) AND formmonth=$previousmonth AND formyear=$checkyear";	        	
			}else{
				 $m11drprequery = "SELECT rid FROM jos_m11dr WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
				 $m11drquery = "SELECT rid FROM jos_m11dr WHERE formmonth=$previousmonth AND formyear=$checkyear";	        	
			}      
			$m11drpreresult   = mysql_query($m11drprequery);
			$m11drprerows  = mysql_num_rows($m11drpreresult); 
			$m11drresult   = mysql_query($m11drquery);
			$m11drrows  = mysql_num_rows($m11drresult);?>  
        <td>
        <?php /* if($groupid == 1) { if(($m11drrows !=0)) {?>
				 <a href="monthly/m11drreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m11dr.php"><img src="images/orange.png" border="0"/></a>
                <?php }} 
				if($groupid == 0 || $groupid == 3) {   if(($m11drrows !=0) ) {?>
				   <a href="monthly/m11drreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m11drreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}*/ ?>
                  <a href="monthly/m11drreport.php"><img src="images/green.png" border="0"/></a> 
                   <?php if($groupid!=0 && $groupid!=3){ ?>
                   <a href="monthly/m11dr.php"><img src="images/orange.png" border="0"/></a>
                   <?php }?>
        </td>
        </tr> <?php  $array12=array(5,9);//echo $accessid
		
		
		;?>
				 <tr style="background-color:#FFC;">
		      <th>M-13-R(New)</th>
        		<td>महाराष्ट्र  पशु  व  मत्स्य  विज्ञान  विद्यापीठ  नागपूर  अंतर्गत संस्थांची सद्यस्थिती दर्शविणारे मासिक विवरणपत्र</td>
	   			<td align="center"><?php if($groupid == 0 || $groupid == 3) {  ?>
				 <a href="monthly/m13rprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m13rprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }?> </td> 
				<td align="center">
			    <?php if($groupid == 1) { if(($m13rrows ==0)) {?>
				<a href="monthly/m13r.php"><img src="images/orange.png" border="0"/></a>
                <a href="monthly/m13rreport.php"><img src="images/green.png" border="0"/></a>
 
                <?php } else {?>
				 <a href="monthly/m13rreport.php"><img src="images/green.png" border="0"/></a>
                <?php }} 
				if($groupid == 0 || $groupid == 3) {   if(($m13rrows !=0) ) {?>
				   <a href="monthly/m13rreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m13rreport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
        
<?php if(!($accessid==36 || $accessid==37)){   ?>
		 <tr>
		     <td>
			    <b>M-15-DRH</b> 
			 </td>
			 <td>
			    Statement Showing Details of Pending Cases of R.T.I.
			 </td>
			  <td align="center">
			    <?php if($groupid == 1) {if(($m15drhprerows !=0) && ($m15drhprerows == $countaccess)) {?>
				 <a href="monthly/m15drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="monthly/m15drhprereport.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($m15drhprerows !=0) && ($m15drhprerows == $countaccess)) {?>
				   <a href="monthly/m15drhprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m15drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m15drhprerows !=0) && ($m15drhprerows == 43)) {?>
				   <a href="monthly/m15drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m15drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="monthly/m15drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="monthly/m15drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($m15drhcurrows !=0) && ($m15drhcurrows == $countaccess)) {?>
				   <a href="monthly/m15drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m15drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m15drhcurrows !=0) && ($m15drhcurrows == 43)) {?>
				   <a href="monthly/m15drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m15drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
    	 <tr>
		     <td>
			    <b>M-16-DRH</b> 
			 </td>
			 <td>
			    Compliances of R.T.I. Appeals Received to the Appilate Authority
			 </td>
			  <td align="center">
			    <?php if($groupid == 1) {if(($m16drhprerows !=0) && ($m16drhprerows == $countaccess)) {?>
				 <a href="monthly/m16drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="monthly/m16drhprereport.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($m16drhprerows !=0) && ($m16drhprerows == $countaccess)) {?>
				   <a href="monthly/m16drhprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m16drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m16drhprerows !=0) && ($m16drhprerows == 43)) {?>
				   <a href="monthly/m16drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m16drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="monthly/m16drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="monthly/m16drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($m16drhcurrows !=0) && ($m16drhcurrows == $countaccess)) {?>
				   <a href="monthly/m16drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m16drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m16drhcurrows !=0) && ($m16drhcurrows == 43)) {?>
				   <a href="monthly/m16drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m16drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
    <?php } ?>	<!-- <tr>
		     <td>
			    <b>M-18-DRH</b> 
			 </td>
			 <td>
			    Monthly Expenditure Statement
			 </td>
			  <td align="center">
			    <?php //if($groupid == 2) {?>
				   <a href="monthly/m18drhprereport.php"><img src="images/green.png" border="0"/></a>
                   <a href="monthly/m18drhpredistconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
                   <a href="monthly/m18drhpregrantreport.php"><img src="images/grant.png" border="0" height="18" width="18" /></a>
                   <a href="monthly/m18drhchalprereport.php"><img src="images/chalanreport.png" border="0" height="18" width="18" /></a>
 				<?php //}else if($groupid == 1) {?>
				   <a href="monthly/m18drhprereport.php"><img src="images/green.png" border="0"/></a>
                   <a href="monthly/m18drhpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
                   <a href="monthly/m18drhpregrantreport.php"><img src="images/grant.png" border="0" height="18" width="18"/></a>
                   <a href="monthly/m18drhchalprereport.php"><img src="images/chalanreport.png" border="0" height="18" width="18" /></a>
				<?php //}else {?>
				   <a href="monthly/m18drhprereport.php"><img src="images/green.png" border="0"/></a>
                   <a href="monthly/m18drhpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
                   <a href="monthly/m18drhpregrantreport.php"><img src="images/grant.png" border="0" height="18" width="18"/></a>
                   <a href="monthly/m18drhchalprereport.php"><img src="images/chalanreport.png" border="0" height="18" width="18" /></a>
                <?php //} ?> 
			  </td>
			  <td align="center">
			    <?php //if($groupid == 2) {?>
				   <a href="monthly/m18drhreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="monthly/m18drh.php"><img src="images/orange.png" border="0"/></a> 
                   <a href="monthly/m18drhdistconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
                   <a href="monthly/m18drhgrantreport.php"><img src="images/grant.png" border="0" height="18" width="18"/></a>
                   <a href="monthly/m18drhchalreport.php"><img src="images/chalanreport.png" border="0" height="18" width="18" /></a>
				<?php //}else if($groupid == 1) {?>
				   <a href="monthly/m18drhreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="monthly/m18drh.php"><img src="images/orange.png" border="0"/></a> 
                   <a href="monthly/m18drhconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
                   <a href="monthly/m18drhgrantreport.php"><img src="images/grant.png" border="0" height="18" width="18"/></a>
                   <a href="monthly/m18drhchalreport.php"><img src="images/chalanreport.png" border="0" height="18" width="18" /></a>
				<?php //}else {?>
				   <a href="monthly/m18drhreport.php"><img src="images/green.png" border="0"/></a>
                   <a href="monthly/m18drhconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
                   <a href="monthly/m18drhgrantreport.php"><img src="images/grant.png" border="0" height="18" width="18" /></a>
                   <a href="monthly/m18drhchalreport.php"><img src="images/chalanreport.png" border="0" height="18" width="18" /></a>
                <?php //} ?>
			  </td>
		 </tr> -->
		 <?php if($accessid != 34) {  ?>
		 <tr>
		      <td>
		         <b>M-19-D</b> 
		      </td>
		      <td>
		             स्थानिक संस्थाचे विशेष लेखापरीक्षणाबाबतचे मासिक विवरणपत्र
		      </td>
			  <td align="center">
			    <?php   if($groupid == 1) { if(($m19dprerows !=0) && ($m19dprerows == ($countaccess))) {?>
				 <a href="monthly/m19dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m19dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m19dprerows !=0) && ($m19dprerows == $countaccess)) {?>
				   <a href="monthly/m19dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m19dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m19dprerows !=0) && ($m19dprerows == ($countaccess))) {?>
				   <a href="monthly/m19dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m19dprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td> 
				<td align="center">
			    <?php if($groupid == 1) { if(($m19dcurrows !=0) && ($m19dcurrows == ($countaccess))) {?>
				 <a href="monthly/m19dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m19dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m19dcurrows !=0) && ($m19dcurrows == $countaccess)) {?>
				   <a href="monthly/m19dreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m19d.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {   if(($m19dcurrows !=0) && ($m19dcurrows == 34)) {?>
				   <a href="monthly/m19dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m19dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
		 <?php } if($accessid != 34){ ?>
          <?php   $query_panchayat_samati="SELECT DISTINCT distid FROM jos_panchayat_samati where distid in ($accessid)"; 
			  $resPS=mysql_query($query_panchayat_samati);
			    $totPS=mysql_num_rows($resPS);
		?>

	<?php } if((($accessid < 15 || $accessid ==35) && ($accessid!= 4)) || ($groupid==0) || ($groupid == 3)) {?>
		
        <?php $query_school_board="SELECT DISTINCT did FROM jos_school_board where did in ($accessid)"; 
			  $resSB=mysql_query($query_school_board);
			    $totSB=mysql_num_rows($resSB);
		?>
        
		 <tr style="background-color:#FFC;">
		      <td>
		         <b>M-23-D (New)</b> 
		      </td>
		      <td>
		             नगरपालिका शिक्षण मंडळ लेखापरीक्षणाची सद्यस्थिती दर्शविणारे मासिक विवरणपत्र
		      </td>
			  <td align="center">
			    <?php if($groupid == 1) { if(($m23dnprerows !=0) && ($m23dnprerows == ($totSB))) {?>
				 <a href="monthly/m23dnprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m23dnprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m23dnprerows !=0) && ($m23dnprerows == $totSB)) {?>
				   <a href="monthly/m23dnsingleprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m23dnsingleprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m23dnprerows !=0) && ($m23dnprerows == $totSB)) {?>
				    <a href="monthly/m23dnprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m23dnprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td> 
				<td align="center">
			    <?php if($groupid == 1) { if(($m23dnrows !=0) && ($m23dnrows == ($totSB))) {?>
				 <a href="monthly/m23dnreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m23dnreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m23dnrows !=0) && ($m23dnrows == $totSB)) {?>
				   <a href="monthly/m23dnsinglereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m23dn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {   if(($m23dnrows !=0) && ($m23dnrows == $totSB)) {?>
				    <a href="monthly/m23dnreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m23dnreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		</tr>
 <?php } if($accessid != 34){
 		$noenteredarray = array(26,27,30);
	    if(!(in_array($accessid, $noenteredarray))) { 
	        if($groupid == 2){
		        	 $m24drprequery = "SELECT distinct did FROM jos_m24dr WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m24drquery = "SELECT distinct did FROM jos_m24dr WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					 $m24drnprequery = "SELECT distinct did FROM jos_m24drn WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m24drnquery = "SELECT  did FROM jos_m24drn WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";	        	
	        }elseif($groupid == 1){
	        	 if($checkregionid == 1){
		        	 $m24drprequery = "SELECT distinct did,rid FROM jos_m24dr WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m24drquery = "SELECT  did,rid FROM jos_m24dr WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear=$checkyear";
					 $m24drnprequery = "SELECT distinct did,rid FROM jos_m24drn WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m24drnquery = "SELECT  did,rid FROM jos_m24drn WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND formmonth=$previousmonth AND formyear=$checkyear";	        	
	        	 }else{
		        	 $m24drprequery = "SELECT distinct did FROM jos_m24dr WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m24drquery = "SELECT distinct did FROM jos_m24dr WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
					 $m24drnprequery = "SELECT distinct did FROM jos_m24drn WHERE did IN ($accessid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m24drnquery = "SELECT   did FROM jos_m24drn WHERE did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";	        	
	        	 }
	        }else{
	        	 $m24drprequery = "SELECT distinct did,rid FROM jos_m24dr WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
                 $m24drquery = "SELECT  did,rid FROM jos_m24dr WHERE  did in($accessid) and formmonth=$previousmonth AND formyear=$checkyear";
				 $m24drnprequery = "SELECT   did,rid FROM jos_m24drn WHERE did in($accessid) and formmonth=$pretopremonth AND formyear=$precheckyear";
                 $m24drnquery = "SELECT   did,rid FROM jos_m24drn WHERE formmonth=$previousmonth AND formyear=$checkyear and did in($accessid)";	        	
	        } 
	        $m24drresult = mysql_query($m24drquery);
	          $m24drrows = mysql_num_rows($m24drresult);
			$m24drnpreresult = mysql_query($m24drnprequery);
	          $m24drnprerows = mysql_num_rows($m24drnpreresult);
		
	        $m24drnresult = mysql_query($m24drnquery);  
	        $m24drnrows = mysql_num_rows($m24drnresult);?>
 	 
        <?php   $queryPaid=" select * from jos_sankirna_listn where type=1 and distid in($accessid)  " ; 
		 
			  $resPF=mysql_query($queryPaid);
			    $totPF=mysql_num_rows($resPF);
			     
		?>
         <tr  style="background-color:#FFC;">
		      <td>
		         <b>M-24-DR(New)</b> 
		      </td>
		      <td>
		            सशुल्क संकीर्ण संस्थांच्या लेखापरीक्षणाची सद्यस्थिती दर्शविणारे मासिक विवरणपत्र   
		      </td>
			  <td align="center">
			    <?php if($groupid == 1) { 			             
			    	switch ($checkregionid){
                             CASE 1:
                             	$noofaccess = $countaccess+1;
                             BREAK;
                             CASE 3:
                             	$noofaccess = $countaccess-1;
                             BREAK;
                             CASE 4:
                             	$noofaccess = $countaccess-1;
                             BREAK;
                             CASE 5:
                             	$noofaccess = $countaccess-2;
                             BREAK;
                             CASE 6:
                             	$noofaccess = $countaccess-1;
                             BREAK;
                             default:
                             	$noofaccess = $countaccess;
                             BREAK;
			             } 
						 
						
						 if(($m24drnprerows !=0) && ($m24drnprerows == ($totPF))) {
			    	?>
				 <a href="monthly/m24drnsingleprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {; ?>
				 <a href="monthly/m24drnprereport.php"><img src="images/green.png" border="0"/></a>
				<?php  }}  ?>
				<?php if ($groupid == 2) {if(($m24drnprerows !=0)) {?>
				   <a href="monthly/m24drnsingleprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php }else {?>
				    <a href="monthly/m24drnsingleprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  }if($groupid == 0 || $groupid == 3) {if(($m24drnprerows !=0) && ($m24drnprerows == ($totPF))) {?>
				    <a href="monthly/m24drnprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				 <a href="monthly/m24drnprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td> 
				<td align="center"> 
			    <?php if($groupid == 1){ 
			             switch ($checkregionid){
                             CASE 1:
                             	$noofaccess = $countaccess+1;
                             BREAK;
                             CASE 3:
                             	$noofaccess = $countaccess-1;
                             BREAK;
                             CASE 4:
                             	$noofaccess = $countaccess-1;
                             BREAK;
                             CASE 5:
                             	$noofaccess = $countaccess-2;
                             BREAK;
                             CASE 6:
                             	$noofaccess = $countaccess-1;
                             BREAK;
                             default:
                             	$noofaccess = $countaccess;
                             BREAK;
			             }  
			   if(($m24drnrows !=0) && ($m24drnrows == ($totPF))) {  ?>
			            <a href="monthly/m24drnreport.php"><img src="images/green.png" border="0"/></a>
			    <?php }else { ?> 
						<a href="monthly/m24drnreport.php"><img src="images/orange.png" border="0"/></a> 
                        <a href="monthly/m24drn.php"><img src="images/orange.png" border="0"/></a>
			<?php }}else { ?>
			           <!-- <a href="monthly/m24drnsinglereport.php"><img src="images/green.png" border="0"/></a> -->
			    <?php }?> 
				<?php if ($groupid == 2) {if(($m24drnrows !=0) && ($m24drnrows == $totPF)) {?>
				    <a href="monthly/m24drnsinglereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else{?>
				   <a href="monthly/m24drn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  }    if($groupid == 0 || $groupid == 3) {  
				 
				 if(($m24drnrows !=0) && ($m24drnrows == ($totPF))) {?>
				    <a href="monthly/m24drnreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				   <a href="monthly/m24drnreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
        </tr> 
<?php } } if($accessid != 34){ ?>  
       	  <?php   $queryFree="select  distinct distid,rid   from jos_sankirna_listn where type=2 and distid in($accessid)" ; 
		 
			  $resFF=mysql_query($queryFree);
			      $totFF=mysql_num_rows($resFF);
		?>
         <tr style="background-color:#FFC;">
          <td><b>M-25-DR (New)</b> </td>
          <td>
		            नि:शुल्क संकीर्ण संस्थांच्या लेखापरीक्षणाची सद्यस्थिती दर्शविणारे मासिक विवरणपत्र   
          </td>
          <td> 
           <?php   if($groupid == 1) {  if(($m25drnprerows !=0) && ($m25drnprerows == ($totFF))) {?>
				 <a href="monthly/m25drnprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m25drnprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m25drnprerows !=0) && ($m25drnprerows == $totFF)) {?>
				   <a href="monthly/m25drnreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m25drnsingleprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m25drnprerows !=0) && ($m25drnprerows == ($totFF))) {?>
				   <a href="monthly/m25drnprereport.php"><img src="images/green.png" border="0"/></a> 
				   
				<?php } else {?>
				  <a href="monthly/m25drnprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
          </td>
          <td> 
           <?php   if($groupid == 1) {  if(($m25drnprerows !=0) && ($m25drnprerows == ($totFF))) {?>
				 <a href="monthly/m25drnreport.php"><img src="images/green.png" border="0"/></a>
        		<a href="monthly/m25drn.php"><img src="images/orange.png" border="0"/></a>

                <?php } else {?>
				 <a href="monthly/m25drnreport.php"><img src="images/green.png" border="0"/></a>
                 <a href="monthly/m25drn.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m25drnprerows !=0) && ($m25drnprerows == $totFF)) {?>
				   <a href="monthly/m25drnsinglereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m25drn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m25drnprerows !=0) && ($m25drnprerows == ($totFF))) {?>
				   <a href="monthly/m25drnreport.php"><img src="images/green.png" border="0"/></a> 
				   
				<?php } else {?>
				  <a href="monthly/m25drnreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
          </td>
           
          
          </tr>
          <?php  }?>  
    <?php } if($groupid != 2) {
    	     $goaheadform26 = true;  
    	     if($groupid == 1){ 
    	       $m26accessarray = array(1,3,4,5); 
    	       if(in_array($checkregionid, $m26accessarray)) { $goaheadform26 = true;}else{ $goaheadform26 = false;} 
    	     }
    	     if($goaheadform26) {
    	        if($groupid == 1){
		        	 $m26rprequery = "SELECT rid FROM jos_m26r WHERE rid IN ($checkregionid) AND formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m26rquery = "SELECT rid FROM jos_m26r WHERE rid IN ($checkregionid) AND formmonth=$previousmonth AND formyear=$checkyear";	        	
    	        }else{
		        	 $m26rprequery = "SELECT rid FROM jos_m26r WHERE formmonth=$pretopremonth AND formyear=$precheckyear";
	                 $m26rquery = "SELECT rid FROM jos_m26r WHERE formmonth=$previousmonth AND formyear=$checkyear";	        	
    	        }        
    	     	$m26rpreresult   = mysql_query($m26rprequery);
    	     	$m26rprerows  = mysql_num_rows($m26rpreresult); 
    	     	$m26rresult   = mysql_query($m26rquery);
    	     	$m26rrows  = mysql_num_rows($m26rresult);?>    
		 <tr style="background-color:#FFC;">
		      <td>
		         <b>M-26-R</b> 
		      </td>
		      <td>
		            कृषि विद्यापीठ लेखापरीक्षणाची सद्यस्थिती दर्शविणारे मासिक विवरणपत्र
		      </td>
			  <td align="center">
			    <?php if($groupid == 1) { if(($m26rprerows !=0)) {?>
				 <a href="monthly/m26rprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m26rprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }} if($groupid == 0 || $groupid == 3) {   if(($m26rprerows !=0) && ($m26rprerows == 4)) {?>
				   <a href="monthly/m26rprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m26rprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td> 
				<td align="center">
			    <?php if($groupid == 1) { if(($m26rrows !=0)) {?>
				 <a href="monthly/m26rreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="monthly/m26r.php"><img src="images/orange.png" border="0"/></a>
                <?php }} if($groupid == 0 || $groupid == 3) {   if(($m26rrows !=0) && ($m26rrows == 4)) {?>
				   <a href="monthly/m26rreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m26rreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
   <?php  } ?>
   <tr>
		    <td>
			  <b>M-29-R</b>
			</td>
			<td>
			  गट - क व गट - ड मधील भरण्यात आलेली पदे व रिक्त पदे यांची सध्यस्थिती दर्शविणारे मासिक विवरणपत्र
			</td>
            <td align="center">
			     <?php /*?><?php if($groupid == 1) {?> 
				     <a href="monthly/m29rprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else { if($m29rprerows ==6) {?>
				       <a href="monthly/m29rprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="monthly/m29rprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?> <?php */?>
				 
				 <?php  if($groupid == 1) { if($m29rprerows !=0){?>
				   <a href="monthly/m29rprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php }else {?>
				   <a href="monthly/m29rprereport.php"><img src="images/orange.png" border="0"/></a> 
                <?php }  }else  if($m29rprerows ==6) {?>
				       <a href="monthly/m29rprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="monthly/m29rprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } ?> 
             </td>
            <td align="center">
                  <?php  				  
				 
					 if($groupid == 1 ) {
					  if($m29rcurrows !=0){?>
					   <a href="monthly/m29rreport.php"><img src="images/green.png" border="0"/></a> 
					<?php }else {  ?>
					   <a href="monthly/m29r.php"><img src="images/orange.png" border="0"/></a> 
					<?php }  }else  if($m29rcurrows ==6) {?>
						   <a href="monthly/m29rreport.php"><img src="images/green.png" border="0"/></a> 
					 <?php } else{ ?> 
						<a href="monthly/m29rreport.php"><img src="images/orange.png" border="0"/></a>  
					 <?php } ?>             
		    </td>
		</tr>
        
        
       
   
   <?php } ?>
   
    <?php
		
		$m30drhnewpre=	"select distinct did from jos_m30drh where did IN ($accessid) AND  formmonth=$pretopremonth AND formyear=$checkyear";
						$m30drhpreResult = mysql_query($m30drhnewpre);
			  			 $m30drhpreRows = mysql_num_rows($m30drhpreResult );
		
		$m30drhnew=	"select distinct did from jos_m30drh where did IN ($accessid) AND  formmonth=$previousmonth AND formyear=$checkyear";
						$m30drhResult = mysql_query($m30drhnew);
			  			 $m30drhRows = mysql_num_rows($m30drhResult );
						 
					
						 
				
		
		 ?>
         <tr>
		     <td>
			    <b>M-30-DRH (New)</b> 
			 </td>
			 <td style = "font-size:15px;">
			 लाचलुचपत प्रतिबंधक कायधा अंतर्गत कारवाई झालेल्या प्रकरणांची माहिती  
			 </td>
			<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="monthly/m30drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($m30drhpreRows > 0)) {?>
				   <a href="monthly/m30drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m30drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m30drhpreRows !=0) && ($m30drhpreRows == 36)) {?>
				   <a href="monthly/m30drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m30drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="monthly/m30drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="monthly/m30drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($m30drhRows > 0)) {?>
				   <a href="monthly/m30drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m30drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m30drhRows !=0) && ($m30drhRows == 36)) {?>
				   <a href="monthly/m30drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m30drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
          <?php
		  
 $m31drhnewpre =	"select distinct did from jos_m31drh where did IN ($accessid) AND  formmonth=$pretopremonth AND formyear=$checkyear";
						$m31drhpreResult = mysql_query($m31drhnewpre);
			  			 $m31drhpreRows = mysql_num_rows($m31drhpreResult );
						 
					
		
		  $m31drhnew=	"select distinct did from jos_m31drh where did IN ($accessid) AND  formmonth=$previousmonth AND formyear=$checkyear";
						$m31drhResult = mysql_query($m31drhnew);
			  			 $m31drhRows = mysql_num_rows($m31drhResult );
						 
					 //print_r($m31drhRows);
		
		 ?>
          <tr>
		     <td>
			    <b>M-31-DRH (New)</b> 
			 </td>
			 <td style = "font-size:15px;">
			 विविध न्यायालयात दाखल झालेल्या प्रलंबित न्यायालयीन प्रकरणांची सद्यस्थिती दर्शविणारे मासिक विवरण 
			 </td>
			<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="monthly/m31drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($m31drhpreRows > 0)) {?>
				   <a href="monthly/m31drhprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m31drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m31drhpreRows !=0) && ($m31drhpreRows == 43)) {?>
				   <a href="monthly/m31drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m31drhprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="monthly/m31drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="monthly/m31drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($m31drhRows > 0)) {?>
				   <a href="monthly/m31drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="monthly/m31drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m31drhRows !=0) && ($m31drhRows == 36)) {?>
				   <a href="monthly/m31drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m31drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
  <!-- <?php if($groupid==1 || $groupid==2){ ?>
   		<tr>
        	<th>M-30-D</th>
            <td>नगरपंचायत यांच्या लेखापरीक्षणाची सध्यस्थिती दर्शविणारे माहे डिसेंबर 2015 अखेरचे विवरणपत्र </td>
            <td></td>
            <td> 
            	<a href="monthly/monthly.php"><img src="images/orange.png" border="0" title="Form M-30-D"/></a> 
            	<a href="monthly/monthly_report.php"><img src="images/green.png" border="0" title="Report"/></a> 
            </td>
        </tr>
   <?php }?>-->
</table>
</br></br></br></br>
<h4> AG Reports &nbsp;<b style = "color:blue">(Monthly forms)</b></h4>

<table border="2" cellspacing="2" cellpadding="5" style="text-align:center; width:1050px;">
	<tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th colspan="2">
			    Status 
			 </th>
		 </tr>
		 <tr>
		     <th>
             </th>
		     <th>
             </th>
		     <th>
			 <?php 
                   echo $lastmonth = date('F',mktime(0,0,0,($currentmonth-1),0,0)).' End';
			 ?>
             </th>
		     <th>
			  <?php 				 
					echo $currentmonthname = date('F',mktime(0,0,0,($currentmonth),0,0)).' End';
			 ?>
             </th>
		 </tr>
		 <tr style="background-color:#FFC;">
		     <td>
			    <b>M-06-A (New)</b> 
			 </td>
			 <td>
		     Status of Certification of Annual Accounts of Zilla Parishad </td>
	    
				<td align="center">
				   <?php     $queryM06aNew=	"select distinct did from jos_form6a where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06anResult = mysql_query($queryM06aNew);
			  			  $m06anRows = mysql_num_rows($m06anResult );
						  
					$queryzp = "select distinct did  from jos_form6a where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $queryzpResult = mysql_query($queryzp);
				  $m06zpRows = mysql_num_rows($queryzpResult);
				  //print_r($m06zpRows);
			 $mis_districtzp = "Select count(*) from jos_miszp where id in ($accessid) ";
				$queryzpdisresult =mysql_query($mis_districtzp);
				$queryzpDisCount    = mysql_fetch_array($queryzpdisresult);
				//print_r($queryzpDisCount);

					
				 ?>
                  <?php if($groupid == 1) { if(($m06anRows !=0) && ($m06anRows == ($countaccess))) {?>
				 <a href="monthly/m06aprereportall.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06aprereportall.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06anRows !=0) && ($m06zpRows == $queryzpDisCount[0]) ) {?>
				   <a href="monthly/m06aprereportall.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06aprereportall.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06anRows !=0) && ($m06anRows == 34)) {?>
				   <a href="monthly/m06aprereportall.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06aprereportall.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
				   <?php     $queryM06aNew=	"select distinct did from jos_form6a where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06anResult = mysql_query($queryM06aNew);
			  			  $m06anRows = mysql_num_rows($m06anResult );
						  
					$queryzp = "select distinct did  from jos_form6a where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $queryzpResult = mysql_query($queryzp);
				  $m06zpRows = mysql_num_rows($queryzpResult);
				  //print_r($m06zpRows);
			 $mis_districtzp = "Select count(*) from jos_miszp where id in ($accessid) ";
				$queryzpdisresult =mysql_query($mis_districtzp);
				$queryzpDisCount    = mysql_fetch_array($queryzpdisresult);
				//print_r($queryzpDisCount);

					
				 ?>
                  <?php if($groupid == 1) { if(($m06anRows !=0) && ($m06anRows == ($countaccess))) {?>
				 <a href="monthly/m06areport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06areport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06anRows !=0) && ($m06zpRows == $queryzpDisCount[0]) ) {?>
				   <a href="monthly/m06areport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06a.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06anRows !=0) && ($m06anRows == 34)) {?>
				   <a href="monthly/m06areport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06areport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
		 
		 <tr style="background-color:#FFC;">
		     <td>
			    <b>M-06-B (New)</b> 
			 </td>
			 <td>
		     Status of Certification of Annual Accounts of Nagar Parishad/Nagar Palika </td>
	    
				<td align="center">
				   <?php     $queryM06bNew=	"select distinct did from jos_form6b where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06bnResult = mysql_query($queryM06bNew);
			  			  $m06bnRows = mysql_num_rows($m06bnResult );
						  
				 $querynp = "select distinct nagar_palika_id from jos_form6b where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $querynpResult = mysql_query($querynp);
				  $m06npRows = mysql_num_rows($querynpResult);
				  	//print_r($m06npRows);
				  
			 $mis_districtnp = "Select count(*) from  jos_nagar_palika_latest where did in ($accessid) ";
				$querynpdisresult =mysql_query($mis_districtnp);
				$querynpDisCount    = mysql_fetch_array($querynpdisresult);
					//print_r($querynpDisCount);
	
				 ?>
                  <?php if($groupid == 1) { if(($m06bnRows !=0) && ($m06bnRows == ($countaccess))) {?>
				 <a href="monthly/m06bprereportall.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06bprereportall.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06bnRows !=0)  && ($m06npRows == $querynpDisCount[0]) ) {?>
				   <a href="monthly/m06bprereportall.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06bprereportall.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06bnRows !=0) && ($m06bnRows == 34)) {?>
				   <a href="monthly/m06bprereportall.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06bprereportall.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
				   <?php     $queryM06bNew=	"select distinct did from jos_form6b where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06bnResult = mysql_query($queryM06bNew);
			  			  $m06bnRows = mysql_num_rows($m06bnResult );
						  //print_r($m06bnRows);
						  
				 $querynp = "select distinct nagar_palika_id from jos_form6b where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $querynpResult = mysql_query($querynp);
				  $m06npRows = mysql_num_rows($querynpResult);
				  	//print_r($m06npRows);
				  
			 $mis_districtnp = "Select count(*) from  jos_nagar_palika_latest where did in ($accessid) ";
				$querynpdisresult =mysql_query($mis_districtnp);
				$querynpDisCount    = mysql_fetch_array($querynpdisresult);
					//print_r($querynpDisCount);
	
				 ?>
                  <?php if($groupid == 1) { if(($m06bnRows !=0) && ($m06bnRows == ($countaccess))) {?>
				 <a href="monthly/m06breport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06breport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06bnRows !=0)  && ($m06npRows == $querynpDisCount[0]) ) {?>
				   <a href="monthly/m06breport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06b.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06bnRows !=0) && ($m06bnRows == 34)) {?>
				   <a href="monthly/m06breport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06breport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
         <tr style="background-color:#FFC;">
		     <td>
			    <b>M-06-C (New)</b> 
			 </td>
			 <td>
		     Status of Certification of Annual Accounts of Nagar Panchayat</td>
	    
				<td align="center">
				   <?php     $queryM06cNew=	"select distinct did from jos_form6c where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06cnResult = mysql_query($queryM06cNew);
			  			  $m06cnRows = mysql_num_rows($m06cnResult );
						  
						  $querynpanch = "select distinct nagar_panch_id from jos_form6c where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $querynpanchResult = mysql_query($querynpanch);
				  $m06npanchRows = mysql_num_rows($querynpanchResult);
				 // print_r($m06npanchRows);
				  
			 $mis_districtnpanch = "Select count(*) from  jos_nagar_panchyat_new where did in ($accessid) ";
				$querynpanchdisresult =mysql_query($mis_districtnpanch);
				$querynpanchDisCount    = mysql_fetch_array($querynpanchdisresult);
								  //print_r($querynpDisCount);
					
				 ?>
                  <?php if($groupid == 1) { if(($m06cnRows !=0) && ($m06cnRows == ($countaccess))) {?>
				 <a href="monthly/m06creport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06creport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06bnRows !=0) && ($m06npanchRows == $querynpanchDisCount[0])) {?>
				   <a href="monthly/m06creport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06c.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06cnRows !=0) && ($m06cnRows == 34)) {?>
				   <a href="monthly/m06cprereportall.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06cprereportall.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
				   <?php     $queryM06cNew=	"select distinct did from jos_form6c where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06cnResult = mysql_query($queryM06cNew);
			  			  $m06cnRows = mysql_num_rows($m06cnResult );
						  	//print_r($m06cnRows);
							

						  $querynpanch = "select distinct nagar_panch_id from jos_form6c where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $querynpanchResult = mysql_query($querynpanch);
				  $m06npanchRows = mysql_num_rows($querynpanchResult);
				  //print_r($m06npanchRows);
				  
			 $mis_districtnpanch = "Select count(*) from  jos_nagar_panchyat_new where did in ($accessid) ";
				$querynpanchdisresult =mysql_query($mis_districtnpanch);
				$querynpanchDisCount    = mysql_fetch_array($querynpanchdisresult);
								  //print_r($querynpanchDisCount);
					
				 ?>
                  <?php if($groupid == 1) { if(($m06cnRows !=0) && ($m06cnRows == ($countaccess))) {?>
				 <a href="monthly/m06creport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06creport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06cnRows !=0) && ($m06npanchRows == $querynpanchDisCount[0])) {?>
				   <a href="monthly/m06creport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06c.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06cnRows !=0) && ($m06cnRows == 32)) {?>
				   <a href="monthly/m06creport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06creport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
         <tr style="background-color:#FFC;">
		     <td>
			    <b>M-06-D (New)</b> 
			 </td>
			 <td>
		     Status of Certification of Annual Accounts of Village Panchayat</td>
	    
		<td align="center">
				   <?php     $queryM06dNew=	"select distinct did from jos_form6d where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06dnResult = mysql_query($queryM06dNew);
			  			  $m06dnRows = mysql_num_rows($m06dnResult );
						  
			$queryvp = "select distinct did  from jos_form6d where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $queryvpResult = mysql_query($queryvp);
				  $m06vpRows = mysql_num_rows($queryvpResult);
				  //print_r($m06vpRows);
				  
			$mis_districtvp = "Select count(*) from jos_misdistrict where id in ($accessid) AND id NOT in (34,36,37,38,39)";
				$queryvpdisresult =mysql_query($mis_districtvp);
				$queryvpDisCount    = mysql_fetch_array($queryvpdisresult);
				//print_r($queryvpDisCount);
	
				 ?>
                  <?php if($groupid == 1) { if(($m06cnRows !=0) && ($m06dnRows == ($countaccess))) {?>
				 <a href="monthly/m06dprereportall.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06dprereportall.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06dnRows !=0) && ($m06vpRows == $queryvpDisCount[0]) ) {?>
				   <a href="monthly/m06dprereportall.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06dprereportall.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06dnRows !=0) && ($m06dnRows == 34)) {?>
				   <a href="monthly/m06dprereportall.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06dprereportall.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
				   <?php     $queryM06dNew=	"select distinct did from jos_form6d where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06dnResult = mysql_query($queryM06dNew);
			  			  $m06dnRows = mysql_num_rows($m06dnResult );
						  
			$queryvp = "select distinct did  from jos_form6d where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $queryvpResult = mysql_query($queryvp);
				  $m06vpRows = mysql_num_rows($queryvpResult);
				  //print_r($m06vpRows);
				  
			$mis_districtvp = "Select count(*) from jos_misdistrict where id in ($accessid) AND id NOT in (34,36,37,38,39)";
				$queryvpdisresult =mysql_query($mis_districtvp);
				$queryvpDisCount    = mysql_fetch_array($queryvpdisresult);
				//print_r($queryvpDisCount);
	
				 ?>
                  <?php if($groupid == 1) { if(($m06cnRows !=0) && ($m06dnRows == ($countaccess))) {?>
				 <a href="monthly/m06dreport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06dnRows !=0) && ($m06vpRows == $queryvpDisCount[0]) ) {?>
				   <a href="monthly/m06dreport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06d.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06dnRows !=0) && ($m06dnRows == 34)) {?>
				   <a href="monthly/m06dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06dreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
          <tr style="background-color:#FFC;">
		     <td>
			    <b>M-06-E (New)</b> 
			 </td>
			 <td>
		     Status of Certification of Annual Accounts of Municipal corporation</td>
	    
				<td align="center">
				   <?php     $queryM06eNew=	"select distinct did from jos_form6e where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06enResult = mysql_query($queryM06eNew);
			  			 $m06enRows = mysql_num_rows($m06enResult );
						  
			 $querymc = "select distinct muncip_id from jos_form6e where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $querymcResult = mysql_query($querymc);
				  $m06mcRows = mysql_num_rows($querymcResult);
				 // print_r($m06mcRows);
				  
			 $mis_districtmc = "Select count(*) from  jos_municipal_corp where did in ($accessid) ";
				$querymcdisresult =mysql_query($mis_districtmc);
				$querymcDisCount    = mysql_fetch_array($querymcdisresult);
								  //print_r($querymcDisCount);
	
				 ?>
                  <?php if($groupid == 1) { if(($m06enRows !=0) && ($m06enRows == ($countaccess))) {?>
				 <a href="monthly/m06eprereport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06eprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06enRows !=0) && ($m06mcRows == $querymcDisCount[0]) ) {?>
				   <a href="monthly/m06eprereport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06eprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06enRows !=0) && ($m06enRows == 3)) {?>
				   <a href="monthly/m06eprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06eprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
				   <?php     $queryM06eNew=	"select distinct did from jos_form6e where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m06enResult = mysql_query($queryM06eNew);
			  			 $m06enRows = mysql_num_rows($m06enResult );
						   //print_r($m06enRows);

			 $querymc = "select distinct muncip_id from jos_form6e where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $querymcResult = mysql_query($querymc);
				  $m06mcRows = mysql_num_rows($querymcResult);
				 // print_r($m06mcRows);
				  
			 $mis_districtmc = "Select count(*) from  jos_municipal_corp where did in ($accessid) ";
				$querymcdisresult =mysql_query($mis_districtmc);
				$querymcDisCount    = mysql_fetch_array($querymcdisresult);
								  print_r($querymcDisCount);
	
				 ?>
                  <?php if($groupid == 1) { if(($m06enRows !=0) && ($m06enRows == ($countaccess))) {?>
				 <a href="monthly/m06ereport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m06ereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06enRows !=0) && ($m06enRows == $querymcDisCount[0]) ) {?>
				   <a href="monthly/m06e.php"><img src="images/orange.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m06ereport.php"><img src="images/green.png" border="0"/></a>
                   				   <a href="monthly/m06e.php"><img src="images/orange.png" border="0"/></a>

                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m06enRows !=0) && ($m06enRows == 3)) {?>
				   <a href="monthly/m06ereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m06ereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
          <tr style="background-color:#FFC;">
		     <td>
			    <b>M-07-N (New)</b> 
			 </td>
			 <td>
		     Report of Irregularities in respect of PRI and ULBs</td>
	    
				<td align="center">
				   <?php     $queryM07New=	"select distinct did from jos_form7n where did IN ($accessid) AND formmonth=$previousmonth-1 AND formyear=$checkyear";
						$m07nResult = mysql_query($queryM07New);
			  			 $m07nRows = mysql_num_rows($m07nResult );
						  
	$query_irr = "select distinct instit_id from jos_form7n where did in ($accessid) AND formmonth=$previousmonth-1 AND formyear=$checkyear";
				  $queryirrResult = mysql_query($query_irr);
				  $m06irrRows = mysql_num_rows($queryirrResult);
				  //print_r($m06irrRows);
				  

					
				 ?>
                  <?php if($groupid == 1) { if(($m07nRows !=0) && ($m07nRows == ($countaccess))) {?>
				 <a href="monthly/m07nprereport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m07nprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m06irrRows ==8) ) {?>
				   <a href="monthly/m07nprereport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m07nprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m07nRows !=0) && ($m07nRows == 34)) {?>
				   <a href="monthly/m07nprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m07nprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
				   <?php    $queryM07New=	"select * from jos_form7n where did IN ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
						$m07nResult = mysql_query($queryM07New);
			  			 $m07nRows = mysql_num_rows($m07nResult );
						  				  //print_r($m07nRows);

	$query_irr = "select distinct instit_id from jos_form7n where did in ($accessid) AND formmonth=$previousmonth AND formyear=$checkyear";
				  $queryirrResult = mysql_query($query_irr);
				  $m06irrRows = mysql_num_rows($queryirrResult);
				  //print_r($m06irrRows);
				  

					
				 ?>
                  <?php if($groupid == 1) { if(($m07nRows !=0) && ($m07nRows == ($countaccess))) {?>
				 <a href="monthly/m07nreport.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="monthly/m07nreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($m07nRows ==8) ) {?>
				   <a href="monthly/m07nreport.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="monthly/m07n.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($m07nRows !=0) && ($m07nRows == 34)) {?>
				   <a href="monthly/m07nreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="monthly/m07nreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>



         
</table>
</div>


<?php if($groupid < 4){ ?>
<div class="table-list">
    <b>Quarterly Form (<a href="quaterly/prequaterreport.php">Previous Report</a>)</b>
    <table border="1" cellspacing="1" cellpadding="5" style="text-align:center;width:950px">
	     <tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th colspan="2">
			    Status 
			 </th>
		 </tr>
		 <tr>
		     <th>
             </th>
		     <th>
             </th>
		     <th>
			 <?php  switch($currentmonth) {
				CASE '01':
				CASE '04':
				CASE '07':
				CASE '10':	
					$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-5),0,0));
					$firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-3),0,0));
					$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-5),0,0));
					$prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-3),0,0));
					$prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					$displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
					//echo $displayprequatermonth;
					Break;
					CASE '02':
                    CASE '05':
					CASE '08':
					CASE '11':
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-6),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-4),0,0));

						$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-6),0,0));
					    $prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-4),0,0));
                        $prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					    $displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
					CASE '03':
                    CASE '06':
                    CASE '09':
                    CASE '12': 
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-7),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-5),0,0));

						$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-7),0,0));
					    $prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-5),0,0));
                        $prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					    $displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
			 }
			 if($currentmonth==1||$currentmonth==2||$currentmonth==3||$currentmonth==4||$currentmonth==5||$currentmonth==6) {
					   $prequateryear = $previousyear;
			 }else{
					   $prequateryear = $currentyear;
			 }
			 echo $displayprequatermonth.'  '.$prequateryear;
			 if($groupid == 1){
               $q04rprequery = "SELECT rid FROM jos_q04r WHERE rid = $checkregionid AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q05rprequery = "SELECT rid FROM jos_q05r WHERE rid = $checkregionid AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             }
			 if($groupid == 0 || $groupid == 3){
			   $q04rprequery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q05rprequery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q01rhprequery = "SELECT DISTINCT rid FROM jos_q01rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q01rhpreresult =mysql_query($q01rhprequery);
               $q01rhprerows = mysql_num_rows($q01rhpreresult);
			   $q06rhprequery = "SELECT DISTINCT rid FROM jos_q06rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q06rhpreresult =mysql_query($q06rhprequery);
               $q06rhprerows = mysql_num_rows($q06rhpreresult);
			   $q07rhprequery = "SELECT DISTINCT rid FROM jos_q07rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q07rhpreresult =mysql_query($q07rhprequery);
               $q07rhprerows = mysql_num_rows($q07rhpreresult);
               
			 }
			 if($groupid == 1 || $groupid == 0 || $groupid == 3) {
				 $q04preresult =mysql_query($q04rprequery);
				 $q04prerows = mysql_num_rows($q04preresult);
				 $q05preresult =mysql_query($q05rprequery);
				 $q05prerows = mysql_num_rows($q05preresult);
             }
             $q02dprequery = "SELECT did FROM jos_q02d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             $q03dprequery = "SELECT did FROM jos_q03d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             $q10dprequery = "SELECT did FROM jos_q10d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 $q02dpreresult =mysql_query($q02dprequery);
			 $q02dprerows = mysql_num_rows($q02dpreresult);
			 $q10dpreresult =mysql_query($q10dprequery);
			 $q10dprerows = mysql_num_rows($q10dpreresult);
			 
			 $q03dpreresult =mysql_query($q03dprequery);
			 $q03dprerows = mysql_num_rows($q03dpreresult); 
			 if($groupid == 2){
			 	$q08drhprequery = "SELECT did FROM jos_q08drh WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did FROM jos_q09drh WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }else if ($groupid == 1){
			 	$q08drhprequery = "SELECT distinct did,rid FROM jos_q08drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did,rid FROM jos_q09drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }else{
			 	$q08drhprequery = "SELECT did,rid FROM jos_q08drh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did,rid FROM jos_q09drh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }  
			 $q08drhpreresult =mysql_query($q08drhprequery);
			 $q08drhprerows = mysql_num_rows($q08drhpreresult);
			 $q09drhpreresult =mysql_query($q09drhprequery);
			 $q09drhprerows = mysql_num_rows($q09drhpreresult);?>
             </th>
		     <th>
			    <?php 				 
				    switch($currentmonth) {
			        CASE '01':
                    CASE '04':
					CASE '07':
					CASE '10':	
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-2),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth),0,0));

						$firstquaterfirstmonthno  = date('m',mktime(0,0,0,($currentmonth-2),0,0));
					    $firstquatersecondmonthno = date('m',mktime(0,0,0,($currentmonth),0,0));
                        $quatermonthvalue   = $firstquaterfirstmonthno.'-'.$firstquatersecondmonthno;
					    $displayquatermonth = $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
					CASE '02':
                    CASE '05':
					CASE '08':
					CASE '11':
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-3),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-1),0,0));

						$firstquaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-3),0,0));
					    $firstquatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-1),0,0));
						$quatermonthvalue   = $firstquaterfirstmonthno.'-'.$firstquatersecondmonthno;
					    $displayquatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
					CASE '03':
                    CASE '06':
                    CASE '09':
                    CASE '12': 
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-4),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-2),0,0));

						$firstquaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-4),0,0));
					    $firstquatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-2),0,0));
                        $quatermonthvalue   = $firstquaterfirstmonthno.'-'.$firstquatersecondmonthno;
					    $displayquatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
			  }
			  if($currentmonth==1||$currentmonth==2||$currentmonth==3) {
					   $quateryear = $previousyear;
			  }else{
					   $quateryear = $currentyear;
			  }
              echo  $displayquatermonth. '  '.$quateryear;
			 if($groupid == 1 || $accessid ==34){
               $q04rquery = "SELECT rid FROM jos_q04r WHERE rid = $checkregionid AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q05rquery = "SELECT rid FROM jos_q05r WHERE rid = $checkregionid AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
             }
			 if($groupid == 0 || $groupid == 3){
			   $q04rquery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q05rquery = "SELECT rid FROM jos_q05r WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q01rhquery = "SELECT DISTINCT rid FROM jos_q01rh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q01rhresult =mysql_query($q01rhquery);
               $q01rhrows = mysql_num_rows($q01rhresult);
			   $q06rhquery = "SELECT DISTINCT rid FROM jos_q06rh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q06rhresult =mysql_query($q06rhquery);
               $q06rhrows = mysql_num_rows($q06rhresult);
			   $q07rhquery = "SELECT DISTINCT rid FROM jos_q07rh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q07rhresult =mysql_query($q07rhquery);
               $q07rhrows = mysql_num_rows($q07rhresult);
			 }
			 if($groupid == 1 || $groupid == 0 || $groupid == 3) {
					 $q04rresult =mysql_query($q04rquery);
					 $q04rrows = mysql_num_rows($q04rresult);
					 $q05rresult =mysql_query($q05rquery);
					 $q05rrows = mysql_num_rows($q05rresult);  
             }
             $q02dquery = "SELECT did FROM jos_q02d WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
             $q03dquery = "SELECT did FROM jos_q03d WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 $q02dresult =mysql_query($q02dquery);
			 $q02drows = mysql_num_rows($q02dresult);  
			 $q03dresult =mysql_query($q03dquery);
			 $q03drows = mysql_num_rows($q03dresult);
			 if($groupid == 2){
			 	$q08drhcurquery = "SELECT did FROM jos_q08drh WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 	$q09drhcurquery = "SELECT did FROM jos_q09drh WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 }else if ($groupid == 1){
			 	$q08drhcurquery = "SELECT distinct did,rid FROM jos_q08drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 	$q09drhcurquery = "SELECT did,rid FROM jos_q09drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 }else{
			 	$q08drhcurquery = "SELECT did,rid FROM jos_q08drh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 	$q09drhcurquery = "SELECT did,rid FROM jos_q09drh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 }  
			 $q08drhresult =mysql_query($q08drhcurquery);
			 $q08drhrows = mysql_num_rows($q08drhresult);
			 $q09drhresult =mysql_query($q09drhcurquery);
			 $q09drhrows = mysql_num_rows($q09drhresult);?>
             </th>
		 </tr>
  <?php if(($groupid !=2) || ($accessid == 34)|| ($accessid ==38)|| ($accessid ==39) ) {?>
		 <tr>
		    <td>
			  <b>Q-01-RH</b>
			</td>
			<td>
			   STATEMENT REGARDING PENDING CASES OF D.E.
			</td>
            <td align="center">
			     <?php if($groupid == 1 || $accessid ==34) {?>
				     <a href="quaterly/q01rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else { if($q01rhprerows ==7) {?>
				       <a href="quaterly/q01rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="quaterly/q01rhprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?>
             </td>
            <td align="center">
			     <?php if($groupid == 1 || $accessid ==34 || $accessid ==38 || $accessid ==39 ) {?>
				     <a href="quaterly/q01rhreport.php"><img src="images/green.png" border="0"/></a> 
				     <a href="quaterly/q01rh.php"><img src="images/orange.png" border="0"/></a>
				 <?php }else { if($q01rhrows ==6) {?>
				       <a href="quaterly/q01rhreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="quaterly/q01rhreport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?>
             </td>
		</tr>
<?php } ?>
<?php 
	$queryZpDept ="Select count(*) from jos_zp_dept_list where  status=1";
	$queryZpDeptResult =mysql_query($queryZpDept);
	$queryZpDeptCount    = mysql_fetch_array($queryZpDeptResult);
  $queryZPData   ="select count(*) from  `jos_q02dn` where did in($accessid) and quatermonth = '$prequatermonth' AND formyear=$prequateryear";
	$queryZPDataResult =mysql_query($queryZPData);
	$queryZPDataCount  = mysql_fetch_array($queryZPDataResult);

 $querypreZP = "select distinct did  from jos_q02dn where did in($accessid) and quatermonth = '$prequatermonth' AND formyear=$prequateryear";
				  $queryZPPreResult = mysql_query($querypreZP);
				  $q02ZPPreRows = mysql_num_rows($queryZPPreResult);
				  //print_r($q02ZPPreRows);
			 $mis_district = "Select count(*) from jos_misdistrict where id NOT in (34,36,37,38,39)";
				$queryZpdisresult =mysql_query($mis_district);
				$queryZpDisCount    = mysql_fetch_array($queryZpdisresult);
				 // print_r($queryZpDisCount);
				 
	 $queryZP = "select distinct did  from jos_q02dn where did in($accessid) and quatermonth = '$quatermonthvalue' AND formyear=$prequateryear";
				  $queryZPResult = mysql_query($queryZP);
				  $q02ZPRows = mysql_num_rows($queryZPResult);
				 // print_r($q02ZPRows);


				  
?>
    
       <?php 
	   if( ($groupid==0 || $groupid==1 || $groupid==2 || $groupid==3) ){
		    $queryPanchayat ="Select count(*) from jos_panchayat_samati where distid in($accessid)";
			$queryPanchResult =mysql_query($queryPanchayat);
			$queryPanchCount    = mysql_fetch_array($queryPanchResult);
			//print_r($queryPanchCount);
	$queryPanchayatData   ="select count(*) from  `jos_q03dn` where did in($accessid) and quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			$queryPanchDataResult =mysql_query($queryPanchayatData);
			$queryPanchDataCount  = mysql_fetch_array($queryPanchDataResult);
			
			 $queryprePS = "select distinct did  from jos_q03dn where did in($accessid) and quatermonth = '$prequatermonth' AND formyear=$prequateryear";
				  $queryPSPreResult = mysql_query($queryprePS);
				  $q03PSPreRows = mysql_num_rows($queryPSPreResult);
				  //print_r($q02ZPPreRows);
			 $mis_districttwo = "Select count(*) from jos_misdistrict where id NOT in (34,36,37,38,39)";
				$queryPSdisresult =mysql_query($mis_districttwo);
				$queryPSDisCount    = mysql_fetch_array($queryPSdisresult);
				 // print_r($queryZpDisCount);
				 
$queryPS = "select distinct did  from jos_q03dn where did in($accessid) and quatermonth = '$quatermonthvalue' AND formyear=$prequateryear";
				  $queryPSResult = mysql_query($queryPS);
				  $q03PSRows = mysql_num_rows($queryPSResult);
				  print_r($q02PSRows);


	   ?>
        
	<?php }?>
<?php	  if($accessid != 34) {?>	
	
		 
  <?php } if(($groupid !=2)) {?>
		 <tr>
		    <td>
			  <b>Q-04-R</b>
			</td>
			<td>
			   Statement of Filled and Vacant Post
			</td>
            <td align="center">
			     <?php if($groupid == 1) { if($q04prerows == 1) {?>
				     <a href="quaterly/q04rprereport.php"><img src="images/green.png" border="0"/></a> 
                  <?php }else{ ?>
				     <a href="quaterly/q04rprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php } } if($groupid == 0 || $groupid == 3) { if($q04prerows == 6) {?>
				   <a href="quaterly/q04rprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else { ?>
				   <a href="quaterly/q04rprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } }?> 
             </td>
            <td align="center">
			      <?php if($groupid == 1) { if($q04rrows == 1) {?>
				     <a href="quaterly/q04rreport.php"><img src="images/green.png" border="0"/></a> 
                  <?php }else{ ?>

				     <a href="quaterly/q04r.php"><img src="images/orange.png" border="0"/></a>
				 <?php } } if($groupid == 0 || $groupid == 3) { if($q04rrows == 6) {?>
				   <a href="quaterly/q04rreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else { ?>
				   <a href="quaterly/q04rreport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } }?>
             </td>
		</tr>

		 <tr>
		    <td>
			  <b>Q-05-R</b>
			</td>
			<td>
			   Statement of handicapped Person Recruitment
			</td>
            <td align="center">
			     <?php if($groupid == 1) { if($q05prerows == 1) {?>
				     <a href="quaterly/q05rprereport.php"><img src="images/green.png" border="0"/></a> 
                  <?php }else{ ?>
				     <a href="quaterly/q05rprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php } } if($groupid == 0 || $groupid == 3) { if($q05prerows == 6) {?>
				   <a href="quaterly/q05rprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else { ?>
				   <a href="quaterly/q05rprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } }?>  
             </td>
            <td align="center">
			      <?php  if($groupid == 1) { if($q05rrows == 1) {?>
				     <a href="quaterly/q05rreport.php"><img src="images/green.png" border="0"/></a> 
                  <?php }else{ ?>
				     <a href="quaterly/q05r.php"><img src="images/orange.png" border="0"/></a>
				 <?php } } if($groupid == 0 || $groupid == 3) { if($q05rrows == 6) {?>
				   <a href="quaterly/q05rreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else { ?>
				   <a href="quaterly/q05rreport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } }?>
             </td>
		</tr>
  <?php } if(($groupid !=2)  || ($accessid == 34) || ($accessid ==38) || ($accessid ==39)) {?>
  		 <tr>
		    <td>
			  <b>Q-06-RH</b>
			</td>
			<td>
			   STATEMENT REGARDING CASES OF SUSPENSION
			</td>
            <td align="center">
			     <?php if($groupid == 1 || $accessid ==34) {?>
				     <a href="quaterly/q06rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else { if($q06rhprerows ==7) {?>
				       <a href="quaterly/q06rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="quaterly/q06rhprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?> 

             </td>
            <td align="center">
			     <?php if($groupid == 1 || $accessid ==34 || $accessid ==38 || $accessid ==39 ) {?>
				     <a href="quaterly/q06rhreport.php"><img src="images/green.png" border="0"/></a> 
				     <a href="quaterly/q06rh.php"><img src="images/orange.png" border="0"/></a>
				 <?php }else { if($q07rhrows ==6) {?>
				       <a href="quaterly/q06rhreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="quaterly/q06rhreport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?>
             </td>
		</tr>
  		 <tr>
		    <td>
			  <b>Q-07-RH</b>
			</td>
			<td>
			   अनुसूचित जमातीच्या राखीव जागांवर सरळसेवा/पदोन्नती झालेल्या बिगर आदिवासी अधिकारी/कर्मचारी यांना शासकीय/निमशासकीय सेवेत संरक्षण देणेबाबत
			</td>

            <td align="center">
			     <?php if($groupid == 1 || $accessid ==34) {?>
				     <a href="quaterly/q07rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else { if($q07rhprerows ==7) {?>
				       <a href="quaterly/q07rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="quaterly/q07rhprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?> 
             </td>
            <td align="center">
			     <?php if($groupid == 1 || $accessid ==34) {?>
				     <a href="quaterly/q07rhreport.php"><img src="images/green.png" border="0"/></a> 
				     <a href="quaterly/q07rh.php"><img src="images/orange.png" border="0"/></a>
				 <?php }else { if($q07rhrows ==7) {?>

				       <a href="quaterly/q07rhreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="quaterly/q07rhreport.php"><img src="images/green.png" border="0"/></a>  
				 <?php } } ?>
             </td>
		</tr>		
<?php } ?> 
    <!--   <tr>
		     <td>
			    <b>Q-08-DRH</b> 
			 </td>
			 <td>
			      सेवेत असतांना मृत्यु पावलेल्या राज्य शासकीय कर्मचाऱ्यांच्या वारसांना गट विमा योजनेखाली दिलेल्या लाभ प्रदानांची माहिती देणारे विवरणपत्र 
			 </td>
			  <td align="center">
			    <?php //if($groupid == 1) {if(($q08drhprerows !=0) && ($q08drhprerows == $countaccess)) {?>
				 <a href="quaterly/q08drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php //} else {?>
				 <a href="quaterly/q08drhprereport.php"><img src="images/orange.png" border="0"/></a>
				<?php //}} if ($groupid == 2) {if(($q08drhprerows !=0) && ($q08drhprerows == $countaccess)) {?>
				   <a href="quaterly/q08drhprereport.php"><img src="images/green.png" border="0"/></a>
                <?php //}else {?>
				   <a href="quaterly/q08drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php //}  } if($groupid == 0 || $groupid == 3) {if(($q08drhprerows !=0) && ($q08drhprerows == 40)) {?>
				   <a href="quaterly/q08drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php //} else {?>
				  <a href="quaterly/q08drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php //}}?>
				</td>
				<td align="center">
			    <?php //if($groupid == 1) {?>
				 <a href="quaterly/q08drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="quaterly/q08drh.php"><img src="images/orange.png" border="0"/></a>
				<?php //} if ($groupid == 2) {if(($q08drhrows !=0) && ($q08drhrows == $countaccess)) {?>
				   <a href="quaterly/q08drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php //}else {?>
				   <a href="quaterly/q08drh.php"><img src="images/orange.png" border="0"/></a>
                <?php //}  } if($groupid == 0 || $groupid == 3) {if(($q08drhrows !=0) && ($q08drhrows == 40)) {?>
				   <a href="quaterly/q08drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php //} else{?>
				  <a href="quaterly/q08drhreport.php"><img src="images/orange.png" border="0"/></a>
				<?php //} }?>
				</td>
       </tr>-->
	   <?php if(($groupid !=2)) {?>

       <tr>
		     <td>
			    <b>Q-09-R</b> 
			 </td>
			 <td>
			      अंध,अपंग,अल्पदृष्टी कर्मचारी यांच्या अद्यावत माहिती बाबत
			 </td>
			  <!--<td align="center">
			    <?php if($groupid == 1) {if(($q09drhprerows !=0) && ($q09drhprerows == $countaccess)) {?>
				 <a href="quaterly/q09drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="quaterly/q09drhprereport.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($q09drhprerows !=0) && ($q09drhprerows == $countaccess)) {?>
				   <a href="quaterly/q09drhsingleprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q09drhsingleprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($q09drhprerows !=0) && ($q09drhprerows == 40)) {?>
				   <a href="quaterly/q09drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q09drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }} if($groupid == 2){?>
				      <a href="quaterly/q09drhconsolsingprereport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php } else{?>
				  	  <a href="quaterly/q09drhconsolprereport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php } ?>
				</td>
				<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="quaterly/q09drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="quaterly/q09drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($q09drhrows !=0) && ($q09drhrows == $countaccess)) {?>
				   <a href="quaterly/q09drhsinglereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q09drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }} if($groupid == 0 || $groupid == 3) {if(($q09drhrows !=0) && ($q09drhrows == 40)) {?>
				   <a href="quaterly/q09drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else{?>
				  <a href="quaterly/q09drhreport.php"><img src="images/orange.png" border="0"/></a>
				<?php }}if($groupid == 2){?>
				      <a href="quaterly/q09drhconsolsingreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php } else{?>
				  	  <a href="quaterly/q09drhconsolreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php } ?>
				</td>-->
				<td align="center">
			    <?php if($groupid == 1) {if($q09drhprerows ==1) {?>
				 <a href="quaterly/q09drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="quaterly/q09drhprereport.php"><img src="images/orange.png" border="0"/></a>
				<?php }}  if($groupid == 0 || $groupid == 3) {if($q09drhprerows ==6) {?>
				   <a href="quaterly/q09drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q09drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }} ?>
				</td>
				<td align="center">
			    <?php if($groupid == 1) {if($q09drhrows ==1) {?>
				 <a href="quaterly/q09drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="quaterly/q09drh.php"><img src="images/orange.png" border="0"/></a>
				<?php }}  if($groupid == 0 || $groupid == 3) {if($q09drhrows ==6) {?>
				   <a href="quaterly/q09drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else { ?>
				  <a href="quaterly/q09drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }} ?>
				</td>
       </tr> 
	   <?php }  if($accessid != 34) {?>	
	
		 <tr>
		    <td>
			  <b>Q-10-D</b>
			</td>
			<td>
			   STATEMENT SHOWING THE POSITION OF PENDING AND DROPPED PARAS OF <b>GRAM PANCHAYAT</b>
			</td>
			  <td align="center">
			    <?php if($groupid == 1) { if(($q10dprerows !=0) && ($q10dprerows == ($countaccess))) {?>
				 <a href="quaterly/q10dprereport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="quaterly/q10dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($q10dprerows !=0) && ($q10dprerows == $countaccess)) {?>
				   <a href="quaterly/q10dprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q10dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($q10dprerows !=0) && ($q10dprerows == ($countaccess-1))) {?>
				   <a href="quaterly/q10dprereport.php"><img src="images/green.png" border="0"/></a>
				   <a href="quaterly/q10dpreconsolreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q10dprereport.php"><img src="images/orange.png" border="0"/></a>
				  <a href="quaterly/q10dpreconsolreport.php"><img src="images/green.png" border="0" /></a> 
				 <?php }}?>
				 </td> 
				<td align="center">
			    <?php if($groupid == 1) { if(($q10drows !=0) && ($q10drows == ($countaccess))) {?>
				 <a href="quaterly/q10dreport.php"><img src="images/green.png" border="0"/></a> 
                <?php } else {?>
				 <a href="quaterly/q10dreport.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($q10drows !=0) && ($q10drows == $countaccess)) {?>
				   <a href="quaterly/q10d.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q10d.php"><img src="images/orange.png" border="0"/></a>
				   <a href="quaterly/q10dreport.php"><img src="images/green.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {  if(($q10drows !=0) && ($q10drows == ($countaccess-1))) {?>
				   <a href="quaterly/q10dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="quaterly/q10dconsolreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q10dreport.php"><img src="images/orange.png" border="0"/></a>
				  <a href="quaterly/q10dconsolreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }}?>
				 </td>
				 
		<?php } ?>
		</tr>
        
        <?php if(!($accessid==36 || $accessid==37)){  
		$newquateryear = $prequateryear;
		$queryQ11dNew=	"select distinct did from jos_q11drn where did IN ($accessid) AND  quatermonth = '$quatermonthvalue' AND formyear=$newquateryear";
						$Q11dResult = mysql_query($queryQ11dNew);
			  			 $q11dRows = mysql_num_rows($Q11dResult );
						 //print_r($q11dRows);
		
		 ?>
		 <tr>
		     <td>
			    <b>Q-11-DRH (New)</b> 
			 </td>
			 <td style = "font-size:18px;">
			  प्रलंबित सेवा निवृत्ती वेतन प्रकरणांची सध्यस्थितीबाबतची माहिती 
			 </td>
			  <td align="center">
              	 <?php if($groupid == 1) {?>
				 <a href="quaterly/q11drnprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($q11dRows > 0)) {?>
				   <a href="quaterly/q11drnprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q11drnprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($q11dRows !=0) && ($q11dRows == 43)) {?>
				   <a href="quaterly/q11drnprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q11drnprereport.php"><img src="images/green.png" border="0"/></a>
				 <?php }}?>
			   
				 </td>
				<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="quaterly/q11drnreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="quaterly/q11drn.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($q11dRows > 0)) {?>
				   <a href="quaterly/q11drnreport.php"><img src="images/green.png" border="0"/></a>
                   	<a href="quaterly/q11drn.php"><img src="images/orange.png" border="0"/></a>

                <?php }else {?>
				   <a href="quaterly/q11drn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($q11dRows !=0) && ($q11dRows == 36)) {?>
				   <a href="quaterly/q11drnreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q11drnreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
		<?php 
	  		$previousyear = $currentyear-1;
					if($currentmonth==1||$currentmonth==2||$currentmonth==3) {
					   $selectyear = $previousyear;
					}else{
					   $selectyear = $currentyear;
					}
	  
	  
	   $querys10drhNew =	"select distinct did from jos_q12drhn where did IN ($accessid) AND  quatermonth = '$quatermonthvalue' AND formyear=$selectyear ";
						$s10drhResult = mysql_query($querys10drhNew);
			  			 $s10drhRows = mysql_num_rows($s10drhResult);?>
		
		<tr style = "background-color:#FFFFCC;">		 
		<td>
			  <b>Q-12-DRH (New)</b>
			</td>
			<th style = "font-size:15px;">
                अनाधिकृतपणे &nbsp;  गैरहजर &nbsp;राहणाऱ्या &nbsp; शासकीय &nbsp; कर्मचाऱ्याविरुद्ध &nbsp; कार्यवाही &nbsp; करण्याबाबतच्या &nbsp;</br>तिमाही  &nbsp; विवरण 
			</th>
			  <th align="center">
			  --
				 </th>
				<td align="center">
			   <?php if($groupid == 1) {?>
				 <a href="quaterly/q12drhnreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="quaterly/q12drhn.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($s10drhRows > 0)) {?>
				   <a href="quaterly/q12drhnreport.php"><img src="images/green.png" border="0"/></a>

                <?php }else {?>
				   <a href="quaterly/q12drhn.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($s10drhRows !=0)) {?>
				   <a href="quaterly/q12drhnreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q12drhnreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		</tr>
<?php }?>
</table>
</div>
<div class="table-list">
    <b> New Quarterly Form</b>
    <table border="1" cellspacing="1" cellpadding="5" style="text-align:center;width:950px">
    <tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th colspan="3">
			    Status 
			 </th>
		 </tr>
         
  <tr>
		     <th>
             </th>
		     <th>
             </th>
  <th>
			 <?php  switch($currentmonth) {
				CASE '01':
				CASE '04':
				CASE '07':
				CASE '10':	
					$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth+4),0,0));
					$firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth+6),0,0));
					$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-5),0,0));
					$prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-3),0,0));
					$prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					$displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
				Break;
				CASE '02':
				CASE '05':
				CASE '08':
				CASE '11':
					$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-9),0,0));
					$firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-7),0,0));
					$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-6),0,0));
					$prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-4),0,0));
					$prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					$displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
				Break;
				CASE '03':
				CASE '06':
				CASE '09':
				CASE '12': 
					$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth+2),0,0));
					$firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth+4),0,0));
					$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-7),0,0));
					$prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-5),0,0));
					$prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					$displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
				Break;
			 }
			 if($currentmonth==1||$currentmonth==2||$currentmonth==3||$currentmonth==4||$currentmonth==5||$currentmonth==6||$currentmonth==7||$currentmonth==8||$currentmonth==9||$currentmonth==10) 
			 {
					   $prequateryear = $currentyear-1;
					   $prequateryear1=$prequateryear;
			 }
			 else{
					   $prequateryear = $currentyear;
					   $prequateryear1=$prequateryear;
			 }
			 echo $displayprequatermonth.'  '.$prequateryear;
			 if($groupid == 1){
               $q04rprequery = "SELECT rid FROM jos_q04r WHERE rid = $checkregionid AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q05rprequery = "SELECT rid FROM jos_q05r WHERE rid = $checkregionid AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             }
			 if($groupid == 0 || $groupid == 3){
			   $q04rprequery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q05rprequery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q01rhprequery = "SELECT DISTINCT rid FROM jos_q01rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q01rhpreresult =mysql_query($q01rhprequery);
               $q01rhprerows = mysql_num_rows($q01rhpreresult);
			   $q06rhprequery = "SELECT DISTINCT rid FROM jos_q06rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q06rhpreresult =mysql_query($q06rhprequery);
               $q06rhprerows = mysql_num_rows($q06rhpreresult);
			   $q07rhprequery = "SELECT DISTINCT rid FROM jos_q07rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q07rhpreresult =mysql_query($q07rhprequery);
               $q07rhprerows = mysql_num_rows($q07rhpreresult);
               
			 }
			 if($groupid == 1 || $groupid == 0 || $groupid == 3) {
				 $q04preresult =mysql_query($q04rprequery);
				 $q04prerows = mysql_num_rows($q04preresult);
				 $q05preresult =mysql_query($q05rprequery);
				 $q05prerows = mysql_num_rows($q05preresult);
             }
             $q02dprequery = "SELECT did FROM jos_q02d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             $q03dprequery = "SELECT did FROM jos_q03d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             $q10dprequery = "SELECT did FROM jos_q10d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 $q02dpreresult =mysql_query($q02dprequery);
			 $q02dprerows = mysql_num_rows($q02dpreresult);
			 $q10dpreresult =mysql_query($q10dprequery);
			 $q10dprerows = mysql_num_rows($q10dpreresult);
			 
			 $q03dpreresult =mysql_query($q03dprequery);
			 $q03dprerows = mysql_num_rows($q03dpreresult); 
			 if($groupid == 2){
			 	$q08drhprequery = "SELECT did FROM jos_q08drh WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did FROM jos_q09drh WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }else if ($groupid == 1){
			 	$q08drhprequery = "SELECT distinct did,rid FROM jos_q08drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did,rid FROM jos_q09drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }else{
			 	$q08drhprequery = "SELECT did,rid FROM jos_q08drh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did,rid FROM jos_q09drh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }  
			 $q08drhpreresult =mysql_query($q08drhprequery);
			 $q08drhprerows = mysql_num_rows($q08drhpreresult);
			 $q09drhpreresult =mysql_query($q09drhprequery);
			 $q09drhprerows = mysql_num_rows($q09drhpreresult);?>
             </th>		     <th>
			 <?php  switch($currentmonth) {
					CASE '01':
					CASE '04':
					CASE '07':
					CASE '10':	
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-5),0,0));
						//echo $firstquaterfirstmonth;
						$firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-3),0,0));
						//echo "<br/>".$firstquatersecondmonth."<br/>";
						$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-5),0,0));
						//echo "<br/>".$prequaterfirstmonthno."<br/>";
						$prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-3),0,0));
						//echo "<br/>".$prequatersecondmonthno."<br/>";
						$prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
						//echo "<br/>".$prequatermonth."<br/>";
						$displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						//echo "<br/>".$displayprequatermonth."<br/>";
						Break;
					CASE '02':
                    CASE '05':
					CASE '08':
					CASE '11':
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-6),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-4),0,0));

						$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-6),0,0));
					    $prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-4),0,0));
                        $prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					    $displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
					CASE '03':
                    CASE '06':
                    CASE '09':
                    CASE '12': 
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-7),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-5),0,0));

						$prequaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-7),0,0));
					    $prequatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-5),0,0));
                        $prequatermonth  = $prequaterfirstmonthno .'-'.$prequatersecondmonthno;
					    $displayprequatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
			 }
			 if($currentmonth==1||$currentmonth==2||$currentmonth==3 || $currentmonth==4||$currentmonth==5||$currentmonth==6) 
			 {
					   $prequateryear = $currentyear-1;
					   $prequateryear2=$prequateryear;
			 }else{
					   $prequateryear = $currentyear;
					   $prequateryear2=$prequateryear;
			 }
			 echo $displayprequatermonth.'  '.$prequateryear;
			 if($groupid == 1){
               $q04rprequery = "SELECT rid FROM jos_q04r WHERE rid = $checkregionid AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q05rprequery = "SELECT rid FROM jos_q05r WHERE rid = $checkregionid AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             }
			 if($groupid == 0 || $groupid == 3){
			   $q04rprequery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q05rprequery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q01rhprequery = "SELECT DISTINCT rid FROM jos_q01rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q01rhpreresult =mysql_query($q01rhprequery);
               $q01rhprerows = mysql_num_rows($q01rhpreresult);
			   $q06rhprequery = "SELECT DISTINCT rid FROM jos_q06rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q06rhpreresult =mysql_query($q06rhprequery);
               $q06rhprerows = mysql_num_rows($q06rhpreresult);
			   $q07rhprequery = "SELECT DISTINCT rid FROM jos_q07rh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			   $q07rhpreresult =mysql_query($q07rhprequery);
               $q07rhprerows = mysql_num_rows($q07rhpreresult);
               
			 }
			 if($groupid == 1 || $groupid == 0 || $groupid == 3) {
				 $q04preresult =mysql_query($q04rprequery);
				 $q04prerows = mysql_num_rows($q04preresult);
				 $q05preresult =mysql_query($q05rprequery);
				 $q05prerows = mysql_num_rows($q05preresult);
             }
             $q02dprequery = "SELECT did FROM jos_q02d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             $q03dprequery = "SELECT did FROM jos_q03d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
             $q10dprequery = "SELECT did FROM jos_q10d WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 $q02dpreresult =mysql_query($q02dprequery);
			 $q02dprerows = mysql_num_rows($q02dpreresult);
			 $q10dpreresult =mysql_query($q10dprequery);
			 $q10dprerows = mysql_num_rows($q10dpreresult);
			 
			 $q03dpreresult =mysql_query($q03dprequery);
			 $q03dprerows = mysql_num_rows($q03dpreresult); 
			 if($groupid == 2){
			 	$q08drhprequery = "SELECT did FROM jos_q08drh WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did FROM jos_q09drh WHERE did IN ($accessid) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }else if ($groupid == 1){
			 	$q08drhprequery = "SELECT distinct did,rid FROM jos_q08drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did,rid FROM jos_q09drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }else{
			 	$q08drhprequery = "SELECT did,rid FROM jos_q08drh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 	$q09drhprequery = "SELECT did,rid FROM jos_q09drh WHERE quatermonth = '$prequatermonth' AND formyear=$prequateryear";
			 }  
			 $q08drhpreresult =mysql_query($q08drhprequery);
			 $q08drhprerows = mysql_num_rows($q08drhpreresult);
			 $q09drhpreresult =mysql_query($q09drhprequery);
			 $q09drhprerows = mysql_num_rows($q09drhpreresult);?>
             </th>
		     <th>
			    <?php 				 
				    switch($currentmonth) {
			        CASE '01':
                    CASE '04':
					CASE '07':
					CASE '10':	
	$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-2),0,0));
	//echo "<br/>".$firstquaterfirstmonth;
	$firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth),0,0));
	//echo "<br/>".$firstquatersecondmonth;
	$firstquaterfirstmonthno  = date('m',mktime(0,0,0,($currentmonth-2),0,0));
	//echo "<br/>".$firstquaterfirstmonthno;
	$firstquatersecondmonthno = date('m',mktime(0,0,0,($currentmonth),0,0));
	//echo "<br/>".$firstquatersecondmonthno;
	$quatermonthvalue   = $firstquaterfirstmonthno.'-'.$firstquatersecondmonthno;
	//echo "<br/>".$quatermonthvalue;
	$displayquatermonth = $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
	//echo "<br/>".$displayquatermonth;
	Break;
					CASE '02':
                    CASE '05':
					CASE '08':
					CASE '11':
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-3),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-1),0,0));

						$firstquaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-3),0,0));
					    $firstquatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-1),0,0));
						$quatermonthvalue   = $firstquaterfirstmonthno.'-'.$firstquatersecondmonthno;
					    $displayquatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
					CASE '03':
                    CASE '06':
                    CASE '09':
                    CASE '12': 
						$firstquaterfirstmonth = date('M',mktime(0,0,0,($currentmonth-4),0,0));
					    $firstquatersecondmonth = date('M',mktime(0,0,0,($currentmonth-2),0,0));

						$firstquaterfirstmonthno = date('m',mktime(0,0,0,($currentmonth-4),0,0));
					    $firstquatersecondmonthno = date('m',mktime(0,0,0,($currentmonth-2),0,0));
                        $quatermonthvalue   = $firstquaterfirstmonthno.'-'.$firstquatersecondmonthno;
					    $displayquatermonth =  $firstquaterfirstmonth.'-'.$firstquatersecondmonth;
						Break;
			  }
			  if($currentmonth==1||$currentmonth==2||$currentmonth==3) {
					   $quateryear = $previousyear;
			  }else{
					   $quateryear = $currentyear;
			  }
              echo  $displayquatermonth. '  '.$quateryear;
			 if($groupid == 1 || $accessid ==34){
               $q04rquery = "SELECT rid FROM jos_q04r WHERE rid = $checkregionid AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q05rquery = "SELECT rid FROM jos_q05r WHERE rid = $checkregionid AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
             }
			 if($groupid == 0 || $groupid == 3){
			   $q04rquery = "SELECT rid FROM jos_q04r WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q05rquery = "SELECT rid FROM jos_q05r WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q01rhquery = "SELECT DISTINCT rid FROM jos_q01rh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q01rhresult =mysql_query($q01rhquery);
               $q01rhrows = mysql_num_rows($q01rhresult);
			   $q06rhquery = "SELECT DISTINCT rid FROM jos_q06rh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q06rhresult =mysql_query($q06rhquery);
               $q06rhrows = mysql_num_rows($q06rhresult);
			   $q07rhquery = "SELECT DISTINCT rid FROM jos_q07rh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			   $q07rhresult =mysql_query($q07rhquery);
               $q07rhrows = mysql_num_rows($q07rhresult);
			 }
			 if($groupid == 1 || $groupid == 0 || $groupid == 3) {
					 $q04rresult =mysql_query($q04rquery);
					 $q04rrows = mysql_num_rows($q04rresult);
					 $q05rresult =mysql_query($q05rquery);
					 $q05rrows = mysql_num_rows($q05rresult);  
             }
             $q02dquery = "SELECT did FROM jos_q02d WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
             $q03dquery = "SELECT did FROM jos_q03d WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 $q02dresult =mysql_query($q02dquery);
			 $q02drows = mysql_num_rows($q02dresult);  
			 $q03dresult =mysql_query($q03dquery);
			 $q03drows = mysql_num_rows($q03dresult);
			 if($groupid == 2){
			 	$q08drhcurquery = "SELECT did FROM jos_q08drh WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 	$q09drhcurquery = "SELECT did FROM jos_q09drh WHERE did IN ($accessid) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 }else if ($groupid == 1){
			 	$q08drhcurquery = "SELECT distinct did,rid FROM jos_q08drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 	$q09drhcurquery = "SELECT did,rid FROM jos_q09drh WHERE (did IN ($checkaccessid) AND rid IN ($checkregionid)) AND quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 }else{
			 	$q08drhcurquery = "SELECT did,rid FROM jos_q08drh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 	$q09drhcurquery = "SELECT did,rid FROM jos_q09drh WHERE quatermonth = '$quatermonthvalue' AND formyear=$quateryear";
			 }  
			 $q08drhresult =mysql_query($q08drhcurquery);
			 $q08drhrows = mysql_num_rows($q08drhresult);
			 $q09drhresult =mysql_query($q09drhcurquery);
			 $q09drhrows = mysql_num_rows($q09drhresult);?>
             </th>
		 </tr>
         <?php 
	$queryZpDept ="Select count(*) from jos_zp_dept_list where  status=1";
	$queryZpDeptResult =mysql_query($queryZpDept);
	$queryZpDeptCount    = mysql_fetch_array($queryZpDeptResult);
  $queryZPData   ="select count(*) from  `jos_q02dn` where did in($accessid) and quatermonth = '$prequatermonth' AND formyear=$prequateryear";
	$queryZPDataResult =mysql_query($queryZPData);
	$queryZPDataCount  = mysql_fetch_array($queryZPDataResult);

 $querypreZP = "select distinct did  from jos_q02dn where did in($accessid) and quatermonth = '$prequatermonth' AND formyear=$prequateryear";
				  $queryZPPreResult = mysql_query($querypreZP);
				  $q02ZPPreRows = mysql_num_rows($queryZPPreResult);
				  //print_r($q02ZPPreRows);
			 $mis_district = "Select count(*) from jos_misdistrict where id NOT in (34,36,37,38,39)";
				$queryZpdisresult =mysql_query($mis_district);
				$queryZpDisCount    = mysql_fetch_array($queryZpdisresult);
				 // print_r($queryZpDisCount);
				 
	  $queryZP12 = "select *  from jos_q02dnone where did in($accessid) and quatermonth ='10-12' AND formyear='$prequateryear1'";
	  //echo $queryZP12;
				  $queryZPResult = mysql_query($queryZP12);
				  $q02ZP12Rows = mysql_num_rows($queryZPResult);
				  //echo $q02ZP12Rows;
					   				 //print_r($q02ZP12Rows);

				  
		  $queryZP12two = "select *  from jos_q02dnone where did in($accessid) and quatermonth IN ('01-03','04-06''07-09','10-12') AND formyear='$prequateryear2'";
				//echo $queryZP12two;
				  $queryZPResulttwo = mysql_query($queryZP12two);
				  $q02ZP12twoRows = mysql_num_rows($queryZPResulttwo);		  
				// print_r($q02ZP12twoRows);
				 
				$queryZPcur=	"select *  from jos_q02dnone where did IN ($accessid) AND  quatermonth = '$quatermonthvalue' AND formyear= '$quateryear'";
						$ZPcurResult = mysql_query($queryZPcur);
			  			 $ZPcurRows = mysql_num_rows($ZPcurResult);
						 
			  $queryPS13 = "select *  from jos_q03dnone where did in($accessid) and quatermonth ='10-12' AND formyear='$prequateryear1'";
				  $queryPSResult = mysql_query($queryPS13);
				  $q03PS13Rows = mysql_num_rows($queryPSResult);
				  
		 $queryPS13two = "select *  from jos_q03dnone where did in($accessid) and quatermonth IN ('01-03','04-06''07-09','10-12') AND formyear=$prequateryear2";
				  $queryPsResulttwo = mysql_query($queryPS13two);
				  $q03PS13twoRows = mysql_num_rows($queryPsResulttwo);		
				 // print_r($q02ZPRows);
				 
			$queryPScur=	"select *  from jos_q03dnone where did IN ($accessid) AND  quatermonth = '$quatermonthvalue' AND formyear='$quateryear'";
						$PScurResult = mysql_query($queryPScur);
			  			 $PScurRows = mysql_num_rows($PScurResult );


				  
?>
		     <td>
			    <b>Q-02-D (New)</b> 
			 </td>
			 <td style = "font-size:15px;">
		जिल्हा परिषेदच्या प्रलंबित आणि वगळलेल्या परिच्छेदांबाबतची माहिती दर्शविणारा तक्ता 
			 </td>
				<td width="10%">
					<?php if($groupid == 1) 
					{?>
						<a href="quaterly/q02dnonereport.php"><img src="images/green.png" border="0"/></a> 
			  <?php } 
					if ($groupid == 2) 
					{
						//echo $q02ZP12Rows;
						if(($q02ZP12Rows > 0)) 
						{?>
							<a href="quaterly/q02dnonereport.php"><img src="images/green.png" border="0"/></a>
				  <?php }
						else 
						{?>
							<a href="quaterly/q02dnone.php"><img src="images/orange.png" border="0"/></a>
				  <?php }  
					} 
					if($groupid == 0 || $groupid == 3) 
					{
						if(($q11dRows !=0) && ($q11dRows == 43)) 
						{?>
							<a href="quaterly/q02dnonereport.php"><img src="images/orange.png" border="0"/></a> 
				  <?php } 
						else 
						{?>
							<a href="quaterly/q02dnonereport.php"><img src="images/orange.png" border="0"/></a>
				  <?php }
				    }?>
				</td>
                 
				<td width="10%">
              	 <?php if($groupid == 1) {?>
				 <a href="quaterly/q02dntworeport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($q02ZP12twoRows > 0)) {?>
				   <a href="quaterly/q02dntworeport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q02dntwo.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($q11dRows !=0) && ($q11dRows == 43)) {?>
				   <a href="quaterly/q02dntworeport.php"><img src="images/orange.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q02dntworeport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
                 
				<td width="10%">
              	 <?php if($groupid == 1) {?>
				 <a href="quaterly/q02dnthreereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($ZPcurRows > 0)) {?>
				   <a href="quaterly/q02dnthreereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q02dnthree.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($ZPcurRows !=0) && ($q11dRows == 43)) {?>
				   <a href="quaterly/q02dnthreereport.php"><img src="images/orange.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q02dnthreereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
                 
		 </tr>
         <tr>
          <td>
			    <b>Q-03-D (New)</b> 
			 </td>
			 <td style = "font-size:15px;">
		पंचायत समितीयांचा प्रलंबित आणि वगळलेल्या परिच्छेदांबाबतची माहिती दर्शविणारा तक्ता 
			 </td>
				<td width="10%">
              	 <?php if($groupid == 1) {?>
				 <a href="quaterly/q03dnonereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($q03PS13Rows > 0)) {?>
				   <a href="quaterly/q03dnonereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q03dnone.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($q11dRows !=0) && ($q11dRows == 43)) {?>
				   <a href="quaterly/q03dnonereport.php"><img src="images/orange.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q03dnonereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
                 
				<td width="10%">
              	 <?php if($groupid == 1) {?>
				 <a href="quaterly/q03dntworeport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($q03PS13twoRows > 0)) {?>
				   <a href="quaterly/q03dntworeport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q03dntwo.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($q11dRows !=0) && ($q11dRows == 43)) {?>
				   <a href="quaterly/q03dntworeport.php"><img src="images/orange.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q03dntworeport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
                 
				<td width="10%">
              	 <?php if($groupid == 1) {?>
				 <a href="quaterly/q03dnthreereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {if(($PScurRows > 0)) {?>
				   <a href="quaterly/q03dnthreereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="quaterly/q03dnthree.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($ZPcurRows !=0) && ($q11dRows == 43)) {?>
				   <a href="quaterly/q03dnthreereport.php"><img src="images/orange.png" border="0"/></a> 
				<?php } else {?>
				  <a href="quaterly/q03dnthreereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
                </tr> 
         
         </table>
         </div>
<!-- Six Monthly Previous Six Month Code (January to June Format) -->
<?php				
	switch($currentmonth) {
	CASE '04':
	CASE '10':   
		$jprefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-2),0,0));
		$jprefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+3),0,0));
		$jprefirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jprefirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jpredisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '05':
	CASE '11': 
		$jprefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-3),0,0));
		$jprefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+2),0,0));
		$jprefirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jprefirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jpredisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '06' :
	CASE '12' :
		$jprefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-4),0,0));
		$jprefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+1),0,0));
		$jprefirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jprefirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jpredisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '07' :
	CASE '01' :   
		$jprefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth+1),0,0));
		$jprefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+6),0,0));
		$jprefirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jprefirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jpredisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '08' :
	CASE '02' :
		$jprefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth),0,0));
		$jprefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+5),0,0));
		$jprefirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jprefirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jpredisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '09' :
	CASE '03' : 
		$jprefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-4),0,0));
		//echo $jprefirstsixfirstmonth;
		//echo "</br>";
		$jprefirstsixsecondmonth = date('m');
		//echo $jprefirstsixsecondmonth;
		//echo "</br>";
		$presixmonthnum=$jprefirstsixfirstmonth .'-'.$jprefirstsixsecondmonth ;
		//echo $presixmonthnum;
		//echo "</br>";
		$jprefirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		//echo $jprefirstsixfirstmonthname;
		//echo "</br>";
		$jprefirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		//echo $jprefirstsixsecondmonthname;
		//echo "</br>";
		$jpredisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		//echo $jpredisplaymonth;
		//echo "</br>";
				
		BREAK;
	}
	
	$previousyear = $currentyear-1;
	$pretopreyear = $currentyear-2;
	/*if($currentmonth==3 || $currentmonth==2 || $currentmonth==1) 
	{
		$preselectyear =$pretopreyear.'-'.$previousyear;
	}
	else
	{
		$preselectyear =$previousyear;
	}*/
	
	
					$jprecheckmonth = $jprefirstsixfirstmonth.'-'.$jprefirstsixsecondmonth;  
					if($accessid == 34) {
					   $s02rhprequery  = "SELECT rid FROM jos_s02rh WHERE rid=0 AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					}

					if($groupid == 1) {

					  $checkaccessid = '0,'.$accessid;	
					   $s02rhprequery  = "SELECT rid FROM jos_s02rh WHERE rid=$checkregionid AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					   $s07drhprequery  = "SELECT DISTINCT did,rid FROM jos_s07drh WHERE (did IN ($checkaccessid) OR rid IN ($checkregionid)) AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					   
					    $S07drhprequery  = "SELECT DISTINCT did,rid FROM jos_S07drh WHERE (did IN ($checkaccessid) OR rid IN ($checkregionid)) AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					   
					   $s08drhprequery  = "SELECT DISTINCT did,rid FROM jos_s08drh WHERE (did IN ($checkaccessid) OR rid IN ($checkregionid)) AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					}
					if($groupid == 0 || $groupid == 3){
					   $s02rhprequery = "SELECT rid FROM jos_s02rh WHERE sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					   $s07drhprequery = "SELECT DISTINCT rid,did FROM jos_s07drh WHERE sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
 $S07drhprequery = "SELECT DISTINCT rid,did FROM jos_S07drh WHERE sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					   					  
					  $s08drhprequery = "SELECT DISTINCT rid,did FROM jos_s08drh WHERE sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					}
					if($groupid == 2){
					   $s07drhprequery  = "SELECT DISTINCT did FROM jos_s07drh WHERE did IN ($accessid) AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					    $S07_drhprequery  = "SELECT DISTINCT did FROM jos_S07drh WHERE did IN ($accessid) AND sixformmonth='$jprecheckmonth' AND formyear='$previousyear'";
					   $s08drhprequery  = "SELECT DISTINCT did FROM jos_s08drh WHERE did IN ($accessid) AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					//echo $S07_drhprequery;
					}
				  if(($groupid ==1) || ($groupid ==0) || ($accessid ==34) || ($groupid == 3)) {
					  $s02rhpreresult = mysql_query($s02rhprequery);
					  $s02rhprerows = mysql_num_rows($s02rhpreresult);
				  } 
					  $s07drhpreresult = mysql_query($s07drhprequery);
					  $s07drhprerows = mysql_num_rows($s07drhpreresult);
					  $S07drhpreresult = mysql_query($S07drhprequery);
					  $S07drhprerows = mysql_num_rows($S07drhpreresult);
					  $s08drhpreresult = mysql_query($s08drhprequery);
					  $s08drhprerows = mysql_num_rows($s08drhpreresult);
				  ?>
<!-- Six Monthly Previous Six Month Code -->
<?php  
	switch($currentmonth) {
	CASE '04':
	CASE '10':   
		$prefirstsixfirstmonth = date('m');
		$prefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+6),0,0));
		$prefirstsixfirstmonthname=$monthsName[$prefirstsixfirstmonth-1];
		$prefirstsixsecondmonthname=$monthsName[$prefirstsixsecondmonth-1];
		$predisplaymonth =  $prefirstsixfirstmonthname.'-'.$prefirstsixsecondmonthname;
		BREAK;
	CASE '05':
	CASE '11': 
		$prefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth),0,0));
		$prefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+5),0,0));
		$prefirstsixfirstmonthname=$monthsName[$prefirstsixfirstmonth-1];
		$prefirstsixsecondmonthname=$monthsName[$prefirstsixsecondmonth-1];
		$predisplaymonth =  $prefirstsixfirstmonthname.'-'.$prefirstsixsecondmonthname;
		BREAK;
	CASE '06' :
	CASE '12' :
		$prefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-1),0,0));
		$prefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+4),0,0));
		$prefirstsixfirstmonthname=$monthsName[$prefirstsixfirstmonth-1];
		$prefirstsixsecondmonthname=$monthsName[$prefirstsixsecondmonth-1];
		$predisplaymonth =  $prefirstsixfirstmonthname.'-'.$prefirstsixsecondmonthname;
		BREAK;
	CASE '07' :
	CASE '01' :   
		$prefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-2),0,0));
		$prefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+3),0,0));
		$prefirstsixfirstmonthname=$monthsName[$prefirstsixfirstmonth-1];
		$prefirstsixsecondmonthname=$monthsName[$prefirstsixsecondmonth-1];
		$predisplaymonth =  $prefirstsixfirstmonthname.'-'.$prefirstsixsecondmonthname;
		BREAK;
	CASE '08' :
	CASE '02' :
		$prefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-3),0,0));
		$prefirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+2),0,0));
		$prefirstsixfirstmonthname=$monthsName[$prefirstsixfirstmonth-1];
		$prefirstsixsecondmonthname=$monthsName[$prefirstsixsecondmonth-1];
		$predisplaymonth =  $prefirstsixfirstmonthname.'-'.$prefirstsixsecondmonthname;
		BREAK;
	CASE '09' :
	CASE '03' : 
		$prefirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-4),0,0));
		//echo $prefirstsixfirstmonth ;
		$prefirstsixsecondmonth = date('m');
		//echo $prefirstsixsecondmonth ;
		$presixmonthnum=$prefirstsixfirstmonth.'-'.$prefirstsixsecondmonth;
		//echo $presixmonthnum;
		$prefirstsixfirstmonthname=$monthsName[$prefirstsixfirstmonth-1];
		$prefirstsixsecondmonthname=$monthsName[$prefirstsixsecondmonth-1];
		$predisplaymonth =  $prefirstsixfirstmonthname.'-'.$prefirstsixsecondmonthname;
		//echo $predisplaymonth;
		BREAK;
	} 
                    $precheckmonth = $firstsixfirstmonth.'-'.$firstsixsecondmonth;
					$previousyear = $currentyear-1;
					$pretopreyear = $currentyear-2;
					if($currentmonth==3 || $currentmonth==2 || $currentmonth==1) {
					   $preselectyear =$pretopreyear.'-'.$previousyear;
					}else{
					   $preselectyear =$previousyear;
					}
             
			        if($groupid == 2) {
					    $s06drhprequery = "SELECT did FROM jos_s06drh WHERE did IN ($accessid) AND sixformmonth='$precheckmonth' AND formyear='$preselectyear'";
					}else if($groupid == 1) {
						$checkaccessid = '0,'.$accessid;
						$s06drhprequery = "SELECT md.did FROM jos_s06drh as md WHERE (md.did IN ($checkaccessid) AND md.rid IN ($checkregionid)) AND md.sixformmonth='$precheckmonth' AND md.formyear='$preselectyear'";  
					}if($groupid == 0 || $groupid == 3){
					    $s06drhprequery = "SELECT did FROM jos_s06drh WHERE sixformmonth='$precheckmonth' AND formyear='$preselectyear'";  
					}
                    $s06drhpreresult = mysql_query($s06drhprequery);
                    $s06drhprerows   = mysql_num_rows($s06drhpreresult); ?>
<!-- Six Monthly Current Six Month Code January to June Code Format-->
<?php				
	switch($currentmonth) {
	CASE '04':
	CASE '10':   
		$jfirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth+4),0,0));
		$jfirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+9),0,0));
		$jfirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jfirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jdisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '05':
	CASE '11': 
		$jfirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth+3),0,0));
		$jfirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+8),0,0));
		$jfirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jfirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jdisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '06' :
	CASE '12' :
		$jfirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth+2),0,0));
		$jfirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth+7),0,0));
		$jfirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jfirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jdisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '07' :
	CASE '01' :   
		$jfirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-5),0,0));
		$jfirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth),0,0));
		$jfirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jfirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jdisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '08' :
	CASE '02' :
		$jfirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-6),0,0));
		$jfirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth-1),0,0));
		$jfirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jfirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jdisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	CASE '09' :
	CASE '03' : 
		$jfirstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-7),0,0));
		$jfirstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth-2),0,0));
		$jfirstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
		$jfirstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
		$jdisplaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
		BREAK;
	} 
$jcheckmonth = $jfirstsixfirstmonth.'-'.$jfirstsixsecondmonth;  
if($currentmonth==1||$currentmonth==2||$currentmonth==3 || $currentmonth==4||$currentmonth==5||$currentmonth==6) {
$selectyear = $previousyear;
}else{
$selectyear = $currentyear;
}
					if($accessid == 34) {
					   $s02rhquery  = "SELECT rid FROM jos_s02rh WHERE rid=0 AND sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					}
					if($groupid == 1) {
					   $checkaccessid = '0,'.$accessid;	
					   $s02rhquery  = "SELECT rid FROM jos_s02rh WHERE rid=$checkregionid AND sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					   $s07drhquery  = "SELECT DISTINCT rid,did FROM jos_s07drh WHERE (did IN ($checkaccessid) OR rid IN ($checkregionid)) AND sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					   $S07drhquery  = "SELECT DISTINCT rid,did FROM jos_S07drh WHERE (did IN ($checkaccessid) OR rid IN ($checkregionid)) AND sixformmonth='$jcheckmonth' AND formyear=$selectyear";
					   $s08drhquery  = "SELECT DISTINCT rid,did FROM jos_s08drh WHERE (did IN ($checkaccessid) OR rid IN ($checkregionid)) AND sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					}if($groupid == 0 || $groupid == 3){
					   $s02rhquery = "SELECT rid FROM jos_s02rh WHERE sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					   $s07drhquery = "SELECT DISTINCT rid,did FROM jos_s07drh WHERE sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					   $S07drhquery = "SELECT DISTINCT rid,did FROM jos_S07drh WHERE sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					   
					   $s08drhquery = "SELECT DISTINCT rid,did FROM jos_s08drh WHERE sixformmonth='$jcheckmonth' AND formyear=$selectyear"; 
					}
					if($groupid == 2){
					   $s07drhprequery  = "SELECT DISTINCT did FROM jos_s07drh WHERE did IN ($accessid) AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
$S07_drhprequery  = "SELECT DISTINCT did FROM jos_S07drh WHERE did IN ($accessid) AND formmonth='$jprecheckmonth' AND formyear='$previousyear'";

$S07_drhquery  = "SELECT DISTINCT did FROM jos_S07drh WHERE did IN ($accessid) AND formmonth='10-03' AND formyear='$currentyear'";

					   $s08drhprequery  = "SELECT DISTINCT did FROM jos_s08drh WHERE did IN ($accessid) AND sixformmonth='$jprecheckmonth' AND formyear=$previousyear"; 
					//echo $S07_drhquery;
					}
				  if(($groupid ==1) || ($groupid ==0) || ($accessid ==34) || ($groupid == 3)) {
					  $s02rhresult = mysql_query($s02rhquery);
					  $s02rhrows = mysql_num_rows($s02rhresult);
				  }	
					  $s07drhresult = mysql_query($s07drhquery);
					  $s07drhrows = mysql_num_rows($s07drhresult);
					  $S07drhresult = mysql_query($S07drhquery);
					  $S07drhrows = mysql_num_rows($S07drhresult);
					  $s08drhresult = mysql_query($s08drhquery);
					  $s08drhrows = mysql_num_rows($s08drhresult);
					  
					  $S07_drhcurresult=mysql_query($S07_drhquery);
					  //echo "========".$S07_drhcurresult;
					  $S07_drhcurrows=mysql_num_rows($S07_drhcurresult);
					  
					  //echo $S07_drhcurrows;
				  ?>

<!-- Six Monthly Current Six Month Code -->
<?php 		switch($currentmonth) {
					   CASE '04':
                       CASE '10':   
						   	$firstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-5),0,0));
                            $firstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth),0,0));
							$firstsixfirstmonthnew = date('m',mktime(0,0,0,($currentmonth+4),0,0));
                            $firstsixsecondmonthnew = date('m',mktime(0,0,0,($currentmonth+9),0,0));
     						$firstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
						    $firstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
						    $displaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
							BREAK;
                      CASE '05':
                      CASE '11': 
						   	$firstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-6),0,0));
                            $firstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth-1),0,0));
							$firstsixfirstmonthnew = date('m',mktime(0,0,0,($currentmonth+3),0,0));
                            $firstsixsecondmonthnew = date('m',mktime(0,0,0,($currentmonth+8),0,0));
     						$firstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
						    $firstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
						    $displaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
							BREAK;
                     CASE '06' :
                     CASE '12' :
						   	$firstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-7),0,0));
                            $firstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth-2),0,0));
							 $firstsixfirstmonthnew = date('m',mktime(0,0,0,($currentmonth+2),0,0));
                            $firstsixsecondmonthnew = date('m',mktime(0,0,0,($currentmonth+7),0,0));
     						$firstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
						    $firstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
						    $displaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
							BREAK;
                      CASE '07' :
                      CASE '01' :   
						   	$firstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-8),0,0));
                            $firstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth-3),0,0));
							$firstsixfirstmonthnew = date('m',mktime(0,0,0,($currentmonth-5),0,0));
                            $firstsixsecondmonthnew = date('m',mktime(0,0,0,($currentmonth),0,0));
     						$firstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
						    $firstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
						    $displaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
							BREAK;
                     CASE '08' :
                     CASE '02' :
						   	$firstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-9),0,0));
                            $firstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth-4),0,0));
							$firstsixfirstmonthnew = date('m',mktime(0,0,0,($currentmonth-6),0,0));
                            $firstsixsecondmonthnew = date('m',mktime(0,0,0,($currentmonth-1),0,0));
     						$firstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
						    $firstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
						    $displaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
							BREAK;
                     CASE '09' :
                     CASE '03' : 
						   	$firstsixfirstmonth = date('m',mktime(0,0,0,($currentmonth-10),0,0));
                            $firstsixsecondmonth = date('m',mktime(0,0,0,($currentmonth-5),0,0));
							$firstsixfirstmonthnew = date('m',mktime(0,0,0,($currentmonth-7),0,0));
                            $firstsixsecondmonthnew = date('m',mktime(0,0,0,($currentmonth-2),0,0));
     						$firstsixfirstmonthname=$monthsName[$firstsixfirstmonth-1];
						    $firstsixsecondmonthname=$monthsName[$firstsixsecondmonth-1];
						    $displaymonth =  $firstsixfirstmonthname.'-'.$firstsixsecondmonthname;
							BREAK;
					 } 
                    $checkmonth = $firstsixfirstmonth.'-'.$firstsixsecondmonth;
					$checkmonthnew = $firstsixfirstmonthnew.'-'.$firstsixsecondmonthnew;

					$previousyear = $currentyear-1;
					$nextyear = $currentyear+1;
					if($currentmonth==10||$currentmonth==11||$currentmonth==12) {
					   $selectyear =$currentyear.'-'.$nextyear;
					}else{
					   $selectyear =$previousyear.'-'.$currentyear;
					}

			        if($groupid == 2) {
					    $s06drhcurquery = "SELECT did FROM jos_s06drh WHERE did IN ($accessid) AND sixformmonth='$checkmonth' AND formyear='$selectyear'";
					}else if($groupid == 1) {
						$checkaccessid = '0,'.$accessid;
						$s06drhcurquery = "SELECT md.did FROM jos_s06drh as md WHERE (md.did IN ($checkaccessid) OR md.rid IN ($checkregionid)) AND md.sixformmonth='$checkmonth' AND md.formyear='$selectyear'";  
 
					}else{
					    $s06drhcurquery = "SELECT did FROM jos_s06drh WHERE sixformmonth='$checkmonth' AND formyear='$selectyear'";  
					}


					$s06drhcurresult = mysql_query($s06drhcurquery);
                    $s06drhcurrows   = mysql_num_rows($s06drhcurresult);

?>
<div class="table-list">

    <b>Six-Monthly Form  (<a href="sixmonthly/presixreport.php">Previous Report</a>)</b>
    <table border="1" cellspacing="1" cellpadding="5" style="text-align:center;width:950px">
	     <tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th colspan="2">
			    Status 
			 </th>
		 </tr>
		 <tr>
		     <th>
             </th>
		     <th>
             </th>
		     <th>
			     <?php echo $predisplaymonth .'<br />'.$preselectyear;?>
             </th>
		     <th>
				<?php
					

				 $selectyearnew =$previousyear.'-'.$currentyear;?>
			    <?php echo $displaymonth .'<br />'.$selectyearnew;?>
             </th>
		 </tr>
		<?php if(($accessid!=36) && ($accessid!=37)){ ?>
         <tr>
		     <td>
			    <b>S-01-DRH</b>
			 </td>
			 <td>
			    कार्यालयीन/ न्यायालयीन कार्यवाहीची पुर्तता न झाल्यामुळे प्रलंबित <br />असलेल्या अफरातफरीच्या प्रकरणांचा सहामाही अहवाल
			 </td>
			  <td align="center">
				   <a href="sixmonthly/s01drhprereport.php"><img src="images/a_report.jpg" border="0"/></a> 
				   <a href="sixmonthly/s01drhbprereport.php"><img src="images/b_report.jpg" border="0"/></a>
				 </td>
				<td align="center">
				   <a href="sixmonthly/s01drhreport.php"><img src="images/a_report.jpg" border="0"/></a> 
				   <a href="sixmonthly/s01drhbreport.php"><img src="images/b_report.jpg" border="0"/></a>
				   <?php if($groupid == 1 || $groupid == 2) { ?>
				   <a href="sixmonthly/s01drh.php"><img src="images/a_form.jpg" border="0"/></a> 
				   <a href="sixmonthly/s01drhb.php"><img src="images/b_form.jpg" border="0"/></a>
				   <?php } ?>
				</td>
		 </tr>
         <?php } ?>
		 <?php  if(($groupid ==1) || ($groupid ==0) || ($accessid ==34) || ($groupid == 3)) { ?>
		 <tr>
		    <td>
			  <b>S-02-RH</b>
			</td>
			<td>
                   शासकीय सेवेत असताना दिवंगत /अकाली सेवानिवृत झालेल्या <br />कर्मचार्यांच्या नातेवाईकास अनुकंपातत्वावर नियुक्ति देणे 
			</td>
            <td align="center">
                  <?php if($groupid == 1 || $accessid ==34) { if($s02rhprerows == 1) { ?>
				       <a href="sixmonthly/s02rhprereport.php"><img src="images/green.png" border="0"/></a> 
					   <?php } else { ?>
					   <a href="sixmonthly/s02rhprereport.php"><img src="images/orange.png" border="0"/></a> 
				 <?php } }else { if($s02rhprerows ==7) {?>
				       <a href="sixmonthly/s02rhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="sixmonthly/s02rhprereport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?>             
		    </td>
            <td align="center">
                  <?php if($groupid == 1 || $accessid ==34) { if($s02rhrows == 1) { ?>
				       <a href="sixmonthly/s02rhreport.php"><img src="images/green.png" border="0"/></a> 
					   <?php } else { ?>
					   <a href="sixmonthly/s02rh.php"><img src="images/orange.png" border="0"/></a> 
				 <?php } }else { if($s02rhrows ==6) {?>
				       <a href="sixmonthly/s02rhreport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }else{ ?> 
				       <a href="sixmonthly/s02rhreport.php"><img src="images/orange.png" border="0"/></a>  
				 <?php } } ?>             
		    </td>
		</tr>
	    <?php } if ($accessid != 34) {?>
		 <tr>
		     <td>
			    <b>S-03-D</b>
			 </td>
			 <td>
			    Statement of Charge and Surcharge
			 </td>
			 <td align="center">
			    <?php if($groupid == 2 || $groupid == 1) {?>
				 <a href="sixmonthly/s03dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if($groupid == 0 || $groupid == 3) {?>
				   <a href="sixmonthly/s03dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="sixmonthly/s03dpreconsolreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php }?>
             </td>  
		     <td align="center">
			    <?php if($groupid == 2) {?>
				 <a href="sixmonthly/s03dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="sixmonthly/s03d.php"><img src="images/orange.png" border="0"/></a>
			    <?php } if($groupid == 1) {?>
				 <a href="sixmonthly/s03dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if($groupid == 0 || $groupid == 3) {?>
				   <a href="sixmonthly/s03dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="sixmonthly/s03dconsolreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php }?>
			</td>
		 </tr>
		 <tr>
		     <td>
			    <b>S-04-DR</b>
			 </td>
			 <td>
			    Statement of Frauds for Zilla Parishad, Nagar Parishad, <br />Nagar Palika School Board and Miscellaneous Institute
			 </td>
			 <td align="center">
			    <?php if($groupid == 1 || $groupid ==2 ) {?>
				 <a href="sixmonthly/s04drprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if($groupid == 0 || $groupid == 3) {?>
				   <a href="sixmonthly/s04drprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="sixmonthly/s04drpreconsolreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php }?>
             </td>  
				<td align="center">
			    <?php if($groupid == 2) {?>
				 <a href="sixmonthly/s04drreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="sixmonthly/s04dr.php"><img src="images/orange.png" border="0"/></a>
			    <?php } if($groupid == 1) {?>
				 <a href="sixmonthly/s04drreport.php"><img src="images/green.png" border="0"/></a>
				 <a href="sixmonthly/s04dr.php"><img src="images/orange.png" border="0"/></a>
				<?php } if($groupid == 0 || $groupid == 3) {?>
				   <a href="sixmonthly/s04drreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="sixmonthly/s04drconsolreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php }?>
				 </td>
		 </tr>
		 <tr>
		     <td>
			    <b>S-05-D</b>
			 </td>
			 <td>
			    Statement of Frauds for Gram Nidhi, Jawahar Gram Samridhi Yojna, <br />Jawahar Rojgar Yojna and Sampoorna Gramin Rozgar Yojna
			 </td>
			 <td align="center">
			    <?php if($groupid == 2 || $groupid == 1) {?>
				 <a href="sixmonthly/s05dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if($groupid == 0 || $groupid == 3) {?>
				   <a href="sixmonthly/s05dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="sixmonthly/s05dpreconsolreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php }?>
             </td>  
		     <td align="center">
			    <?php if($groupid == 2) {?>
				 <a href="sixmonthly/s05dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="sixmonthly/s05d.php"><img src="images/orange.png" border="0"/></a>
			    <?php } if($groupid == 1) {?>
				 <a href="sixmonthly/s05dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if($groupid == 0 || $groupid == 3) {?>
				   <a href="sixmonthly/s05dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="sixmonthly/s05dconsolreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a> 
				 <?php }?>
			</td>
		 </tr>
		 <?php } 
		 
		 if(($accessid!=36) && ($accessid!=37)){
		 ?>
		 <tr>
		     <td>
			    <b>S-06-DRH</b> 
			 </td>
			 <td>
			    Details of Computer Peripherals
			 </td>
			  <td align="center">
			    <?php if($groupid == 1) {if(($s06drhprerows !=0) && ($s07drhrows == $countaccess)) {?>
				   <a href="sixmonthly/s06drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="sixmonthly/s06drhprereport.php"><img src="images/orange.png" border="0"/></a>
				<?php }} if ($groupid == 2) {if(($s06drhprerows !=0) && ($s06drhprerows == $countaccess)) {?>
				   <a href="sixmonthly/s06drhprereport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="sixmonthly/s06drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($s06drhprerows !=0) && ($s06drhprerows == ($countaccess-3))) {?>
				   <a href="sixmonthly/s06drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="sixmonthly/s06drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="sixmonthly/s06drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="sixmonthly/s06drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($s06drhcurrows !=0) && ($s06drhcurrows == $countaccess)) {?>
				   <a href="sixmonthly/s06drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="sixmonthly/s06drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($s06drhcurrows !=0) && ($s06drhcurrows == 42)) {?>
				   <a href="sixmonthly/s06drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="sixmonthly/s06drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
		<!-- <tr>
		    <td>
			  <b>S-07-DRH</b>
			</td>
			<td>
                      अनुसूचित जाती/अनुसूचित जमातीचे खोटे प्रमाणपत्र  <br />धारण केल्याबाबत सहामाही विवरणपत्र			
			</td>
			  <td align="center">
			    <?php //if($groupid == 1 || $groupid == 2) {if(($s07drhprerows !=0) && ($s07drhprerows == $countaccess)) {?>
				   <a href="sixmonthly/s07drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php //} else {?>
				 <a href="sixmonthly/s07drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php //}} if($groupid == 0 || $groupid == 3) {if(($s07drhprerows !=0) && ($s07drhprerows == 40)) {?>
				   <a href="sixmonthly/s07drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php// } else {?>
				  <a href="sixmonthly/s07drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php //}}?>
				 </td>
				<td align="center">
			    <?php //if($groupid == 1 || $groupid == 2) {?>
				 <a href="sixmonthly/s07drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="sixmonthly/s07drh.php"><img src="images/orange.png" border="0"/></a>
                <?php //} if($groupid == 0 || $groupid == 3) {if(($s07drhrows !=0) && ($s07drhrows == 40)) {?>
				   <a href="sixmonthly/s07drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php// } else {?>
				  <a href="sixmonthly/s07drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php //}}?>
				 </td>
		</tr>-->
<!--      --------------------------------------Start code महिलातक्रार निवारण समितीत--------     Create By Pratik  29/08/2022  -->
		<?php
	if(($accessid!=37) && ($accessid!=36)){?>
		 
         <tr>
		     <td>
			    <b>S-07-DRH</b> 
			 </td>
			 <td>
		      	    महिला तक्रार निवारण समित्याकडे प्राप्त झालेल्या तक्रारी 
			 </td>
			  
	<td align="center">
	<?php 	
	if($groupid == 1) 
	{
	if(($S07drhprerows !=0) && ($S07drhprerows == $countaccess)) 
	{?>
	<a href="sixmonthly/S07drhprereport.php"><img src="images/green.png" border="0"/></a> 
	<?php 	} 
	else 
	{?>
	<a href="sixmonthly/S07drhprereport.php"><img src="images/orange.png" border="0"/></a>
	<?php 	}
	} 
	if ($groupid == 2) 
	{
	if(($S07drhprerows !=0) && ($S07drhprerows == $countaccess)) 
	{?>
	<a href="sixmonthly/S07drhprereport.php"><img src="images/green.png" border="0"/></a>
	<?php 	}
	else 
	{?>
	<a href="sixmonthly/S07drhpre.php"><img src="images/orange.png" border="0"/></a>	
	<?php 	}
	} 
	if($groupid == 0 || $groupid == 3) 
	{
	if(($S07drhprerows !=0) && ($S07drhprerows == 42)) 
	{?>
	<a href="monthly/S07drhprereport.php"><img src="images/green.png" border="0"/></a> 
	<?php 	} 
	else 
	{?>
	<a href="sixmonthly/S07drhprereport.php"><img src="images/orange.png" border="0"/></a>
	<?php 	}
	}?>
	</td>
			  
				<td align="center"> 
			    <?php if($groupid == 1) {?>
				 <a href="sixmonthly/S07drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="sixmonthly/S07drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($S07_drhcurrows!=0)) {?>
				   <a href="sixmonthly/S07drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="sixmonthly/S07drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($S07drhcurrows !=0) && ($S07drhcurrows == 42)) {?>
				   <a href="sixmonthly/S07drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="sixmonthly/S07drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>	
	<?php } 
?>          
  <!---------------------------- End----महिलातक्रार निवारण समितीत -------------------------  -->
		
		
		 <tr>
		    <td>
			  <b>S-08-DRH</b>
			</td>
			<td>
                      सेवानिवृत्त होणाऱ्या शासकीय अधिकारी व कर्मचार्यांची यादी <br />(पुढील २४ ते ३० महिन्यात)			
			</td>
			  <td align="center">
			    <?php if($groupid == 1 || $groupid == 2) {if(($s08drhprerows !=0) && ($s08drhprerows == $countaccess)) {?>
				   <a href="sixmonthly/s08drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="sixmonthly/s08drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }} if($groupid == 0 || $groupid == 3) {if(($s08drhprerows !=0) && ($s08drhprerows == 40)) {?>
				   <a href="sixmonthly/s08drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="sixmonthly/s08drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
			    <?php if($groupid == 1 || $groupid == 2) {  ?>
				 <a href="sixmonthly/s08drhreport.php"><img src="images/green.png" border="0"/></a> 
				<a href="sixmonthly/s08drh.php"><img src="images/orange.png" border="0"/></a>
                      <?php if(!($s08drhrows>0)){?>
                 <?php }
                 
                	 } if($groupid == 0 || $groupid == 3) {if(($s08drhrows !=0) && ($s08drhrows == 40)) {?>
				   <a href="sixmonthly/s08drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="sixmonthly/s08drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				 </tr>
		<tr>		 
		<td>
			  <b>S-09-DRH</b>
			</td>
			<td>
                भविष्य निर्वाह निधीतील रक्कमा प्रदान करण्यामधील विलंब तसेच गहाळ रकमांचा तपशील कळविण्याबाबतची कार्यपद्धती संबंधी सहामाही विवरणपत्र 
	
			</td>
			  <td align="center">
			    <?php if($groupid == 1 || $groupid == 2) {if(($s09drhprerows !=0) && ($s09drhprerows == $countaccess)) {?>
				   <a href="sixmonthly/s09drhprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php } else {?>
				 <a href="sixmonthly/s09drhprereport.php"><img src="images/orange.png" border="0"/></a>
                <?php }} if($groupid == 0 || $groupid == 3) {if(($s09drhprerows !=0) && ($s09drhprerows == 40)) {?>
				   <a href="sixmonthly/s09drhprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="sixmonthly/s09drhprereport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
				<td align="center">
			    <?php if($groupid == 1 || $groupid == 2) { ?>
				 <a href="sixmonthly/s09drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="sixmonthly/s09drh.php"><img src="images/orange.png" border="0"/></a>
                
				<?php } if($groupid == 0 || $groupid == 3) {if(($s08drhrows !=0) && ($s08drhrows == 40)) {?>
				   <a href="sixmonthly/s09drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="sixmonthly/s09drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		</tr>
           
        <?php }?>
    </table>
</div>
<div class="table-list">
<?php	if(($accessid!=36) && ($accessid!=37) && ($accessid!=38)){ ?>
<b>Annual Form (<a href="yearly/preannualreport.php">Previous Report</a>)</b>

    <table border="1" cellspacing="1" cellpadding="5" style="text-align:center;width:950px">
	     <tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th>
			    Status 
			 </th>
		 </tr>
		 <tr>
		     <th>
             </th>
		     <th>
             </th>
             <?php  if($currentmonth >= 4) {
			      $checkfinanceyear = (($currentyear-1).'-'.($currentyear));
			 }else{
			   $checkfinanceyear = (($currentyear-2).'-'.($currentyear-1));
			 }?>
		     <th>
			    <?php echo $checkfinanceyear;?>
             </th>
		 </tr>
		 <?php  // Yearly Query
				if($groupid == 2){
					$y01drhquery = "SELECT yd.did FROM jos_y01drh as yd WHERE yd.did IN ($accessid) AND formyear = '$checkfinanceyear'";
					$y02drhquery = "SELECT yd.did,yd.regionid FROM jos_y02drh as yd WHERE yd.did IN ($accessid) AND formyear = '$checkfinanceyear'";
					$y03drhquery = "SELECT yd.did,yd.regionid FROM jos_y03drh as yd WHERE yd.did IN ($accessid) AND formyear = '$checkfinanceyear'";
				}
				if($groupid == 1){
					$checkaccessid = '0,'.$accessid;
					$y01drhquery = "SELECT yd.did,yd.rid FROM jos_y01drh as yd WHERE (yd.did IN ($checkaccessid) AND yd.rid IN ($checkregionid)) AND formyear = '$checkfinanceyear' ";
					$y02drhquery = "SELECT yd.did,yd.regionid FROM jos_y02drh as yd WHERE (yd.did IN ($checkaccessid) AND yd.regionid IN ($checkregionid)) AND formyear = '$checkfinanceyear' ";  
					$y03drhquery = "SELECT yd.did,yd.regionid FROM jos_y03drh as yd WHERE (yd.did IN ($checkaccessid) AND yd.regionid IN ($checkregionid)) AND formyear = '$checkfinanceyear' ";  
				} 
				if($groupid == 0 || $groupid == 3){
					$y01drhquery = "SELECT yd.did,yd.rid FROM jos_y01drh as yd WHERE formyear = '$checkfinanceyear'";
					$y02drhquery = "SELECT yd.did,yd.regionid FROM jos_y02drh as yd WHERE formyear = '$checkfinanceyear'";  
					$y03drhquery = "SELECT yd.did,yd.regionid FROM jos_y03drh as yd WHERE formyear = '$checkfinanceyear'";  
				}
			  $y01drhresult = mysql_query($y01drhquery);
			  $y01drhrows = mysql_num_rows($y01drhresult);
			  $y02drhresult = mysql_query($y02drhquery);
			  $y02drhrows = mysql_num_rows($y02drhresult);
			  $y03drhresult = mysql_query($y03drhquery);
			  $y03drhrows = mysql_num_rows($y03drhresult);?>
		<tr>
		   <td>
		      <b>Y-01-DRH</b>
		   </td>
		   <td>
		        विवरण- २ भविष्य निर्वाह निधी विवरण
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y01drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y01drh.php"><img src="images/orange.png" border="0"/></a>
				<?php } if ($groupid == 2) {if(($y01drhrows !=0) && ($y01drhrows == $countaccess)) {?>
				   <a href="yearly/y01drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="yearly/y01drh.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($y01drhrows !=0) && ($y01drhrows == 41)) {?>
				   <a href="yearly/y01drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="yearly/y01drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
			 </td>
		</tr>
		   <!--
		<tr>
		   <td>
		      <b>Y-02-DRH</b>
		   </td>
		   <td>
		      Updation of Original Service Books
		   </td>
		     <td align="center">
			    <?php //if($groupid == 1) {?>
				 <a href="yearly/y02drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y02drh.php"><img src="images/orange.png" border="0"/></a>
				<?php //} if ($groupid == 2) {if(($y02drhrows !=0) && ($y02drhrows == $countaccess)) {?>
				   <a href="yearly/y02drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php //}else {?>
				   <a href="yearly/y02drh.php"><img src="images/orange.png" border="0"/></a>
                <?php //}  } if($groupid == 0 || $groupid == 3) {if(($y02drhrows !=0) && ($y02drhrows == 41)) {?>
				   <a href="yearly/y02drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php //} else {?>
				  <a href="yearly/y02drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php //}}?>
			 </td>
		</tr>
		<tr>
		   <td>
		      <b>Y-03-DRH</b>
		   </td>
		   <td>
		      Updation of Duplicate Service Books
		   </td>
		     <td align="center">
			    <?php //if($groupid == 1) {?>
				 <a href="yearly/y03drhreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y03drh.php"><img src="images/orange.png" border="0"/></a>
				<?php //} if ($groupid == 2) {if(($y03drhrows !=0) && ($y03drhrows == $countaccess)) {?>
				   <a href="yearly/y03drhreport.php"><img src="images/green.png" border="0"/></a>
                <?php //}else {?>
				   <a href="yearly/y03drh.php"><img src="images/orange.png" border="0"/></a>
                <?php //}  } if($groupid == 0 || $groupid == 3) {if(($y03drhrows !=0) && ($y03drhrows == 41)) {?>
				   <a href="yearly/y03drhreport.php"><img src="images/green.png" border="0"/></a> 
				<?php //} else {?>
				  <a href="yearly/y03drhreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php //}}?>
			 </td>
		</tr>
		<tr>
		   <td>
		      <b>Y-KRA-25R</b>
		   </td>
		   <td>
		      ज्येष्ठा सूची प्रसिद्ध कारणे 
		   </td>
		     <td align="center">
			    <?php //if($groupid == 1) {?>
				 <a href="yearly/y25rreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y25r.php"><img src="images/orange.png" border="0"/></a>
				<?php //} if ($groupid == 2) {if(($y03drhrows !=0) && ($y03drhrows == $countaccess)) {?>
				   <a href="yearly/y25report.php"><img src="images/green.png" border="0"/></a>
                <?php //}else {?>
				   <a href="yearly/y25r.php"><img src="images/orange.png" border="0"/></a>
                <?php //}  } if($groupid == 0 || $groupid == 3) {if(($y03drhrows !=0) && ($y03drhrows == 41)) {?>
				   <a href="yearly/y25rreport.php"><img src="images/green.png" border="0"/></a> 
				<?php //} else {?>
				  <a href="yearly/y25rreport.php"><img src="images/orange.png" border="0"/></a>
				 <?php //}}?>
			 </td>
		</tr>-->
            
	 </table>
     </br></br></br>
     <h4> AG Reports &nbsp;<b style = "color:blue">(Yearly forms)</b></h4>

<table border="2" cellspacing="2" cellpadding="5" style="text-align:center; width:950px;">
	<tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th colspan="2">
			    Status 
			 </th>
		 </tr>
         
         <tr>
		     <th>
             </th>
		     <th>
             </th>
             <?php  if($currentmonth >= 7) {
				   $checkfinanceyearnew = (($currentyear).'-'.($currentyear+1));
			 }else{
			   $checkfinanceyear = (($currentyear-2).'-'.($currentyear-1));
			 }?>
		     <th>
			    <?php echo $checkfinanceyearnew;?>
             </th>
		 </tr>
          <tr style="background-color:#FFC;">
		     <td>
			    <b>Y-Form-1 (New)</b> 
			 </td>
			 <td>
		     Annual Audit Programme of PRIs and ULBs </td>
	    
				
				<td align="center">
				   <?php 
				   $checkfinanceyearnew = (($currentyear).'-'.($currentyear+1));
				   
				       $queryy1New=	"select distinct did from jos_formy1 where did IN ($accessid) AND formyear='$checkfinanceyearnew'";
						$y1nResult = mysql_query($queryy1New);
			  			  $y1nRows = mysql_num_rows($y1nResult);
						  
					 $insquery = "SELECT * FROM jos_formy1 WHERE did IN ($accessid) and formyear='$checkfinanceyearnew'";
  
  							$insresult = mysql_query($insquery);
  							$insrowsone = mysql_num_rows($insresult);  
						  //print_r($insrowsone);
			
				 ?>
                  <?php if($groupid == 1) { if(($y1nRows !=0) && ($y1nRows == ($countaccess))) {?>
				 <a href="yearly/yform1report.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="yearly/yform1report.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($y1nRows !=0) && ($insrowsone > 1) ) {?>
				   <a href="yearly/yform1report.php"><img src="images/green.png" border="0"/></a>
                <?php }else {?>
				   <a href="yearly/yform1.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($y1nRows !=0) && ($y1nRows == 34)) {?>
				   <a href="yearly/yform1report.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="yearly/yform1report.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
         <tr style="background-color:#FFC;">
		     <td>
			    <b>Y-Form-2 (New)</b> 
			 </td>
			 <td>
		    Implementation of Audit Plan  </td>
	    
				
				<td align="center">
				   <?php 
				   $checkfinanceyearnew = (($currentyear).'-'.($currentyear+1));
				   
				     $queryy2New=	"select distinct did from jos_formy2 where did IN ($accessid) AND formyear='$checkfinanceyear'";
						$y2nResult = mysql_query($queryy2New);
			  			  $y2nRows = mysql_num_rows($y2nResult);
				//print_r($y2nRows);

						 $insquerytwo = "SELECT instit_id FROM jos_formy2 WHERE did IN ($accessid) and formyear='$checkfinanceyearnew'";
  
  							$insresulttwo = mysql_query($insquerytwo);
  							$insrowstwo = mysql_num_rows($insresulttwo);  
						 //print_r($insrowstwo);
			
				 ?>
                  <?php if($groupid == 1) { if(($y1nRows !=0) && ($y1nRows == ($countaccess))) {?>
				 <a href="yearly/yform2report.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="yearly/yform2report.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($y2nRows !=0) && ($insrowstwo > 1) ) {?>
				   <a href="yearly/yform2report.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="yearly/yform2.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($y2nRows !=0) && ($y2nRows == 34)) {?>
				   <a href="yearly/yform2report.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="yearly/yform2report.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         <tr style="background-color:#FFC;">
		     <td>
			    <b>Y-Form-3 (New)</b> 
			 </td>
			 <td>
		    Annual return in respect of frauds,embezzlement,misappropriation and other serious irregularities in PRI and ULB's  </td>
	    
				
				<td align="center">
				   <?php 
				   $checkfinanceyearnew = (($currentyear).'-'.($currentyear+1));
				   
				     $queryy3New=	"select distinct did from jos_formy3 where did IN ($accessid) AND formyear='$checkfinanceyearnew'";
						$y3nResult = mysql_query($queryy3New);
			  			  $y3nRows = mysql_num_rows($y3nResult);
				//print_r($y3nRows);

						 $insquery = "SELECT instit_id FROM jos_formy3 WHERE did IN ($accessid) and formyear='$checkfinanceyearnew'";
  
  							$insresult = mysql_query($insquery);
  							$insrowsthree = mysql_num_rows($insresult);  
						 //print_r($insrowsthree);
			
				 ?>
                  <?php if($groupid == 1) { if(($y3nRows !=0) && ($y3nRows == ($countaccess))) {?>
				 <a href="yearly/yform3report.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="yearly/yform3report.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($y3nRows !=0) && ($insrowsthree > 1) ) {?>
                   <a href="yearly/yform3report.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/yform3.php"><img src="images/orange.png" border="0"/></a>
                 
                <?php }else {?>
				   <a href="yearly/yform3.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($y3nRows !=0) && ($y3nRows == 34)) {?>
				   <a href="yearly/yform3report.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="yearly/yform3report.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
          <tr style="background-color:#FFC;">
		     <td>
			    <b>Y-Form-4 (New)</b> 
			 </td>
			 <td>
		   Annual Audit Return in respect of details of Outstnding paras </td>
	    
				
				<td align="center">
				   <?php 
				   $checkfinanceyearnew = (($currentyear).'-'.($currentyear+1));
				   
				     $queryy4New=	"select distinct did from jos_formy4 where did IN ($accessid) AND formyear='$checkfinanceyear'";
						$y4nResult = mysql_query($queryy4New);
			  			  $y4nRows = mysql_num_rows($y4nResult);
				//print_r($y2nRows);

						 $insquery = "SELECT instit_id FROM jos_formy4 WHERE did IN ($accessid) and formyear='$checkfinanceyearnew'";
  
  							$insresult = mysql_query($insquery);
  							$insrowsfour = mysql_num_rows($insresult);  
						 // print_r($insrows);
			
				 ?>
                  <?php if($groupid == 1) { if(($y4nRows !=0) && ($y4nRows == ($countaccess))) {?>
				 <a href="yearly/yform4report.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="yearly/yform4report.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($y4nRows !=0) && ($insrowsfour <1) ) {?>
				   <a href="yearly/yform4.php"><img src="images/orange.png" border="0"/></a>
                 
                <?php }else {?>
                				  <a href="yearly/yform4report.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/yform4.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($y4nRows !=0) && ($y4nRows == 34)) {?>
				   <a href="yearly/yform4report.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="yearly/yform4report.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
           <tr style="background-color:#FFC;">
		     <td>
			    <b>Y-Form-5 (New)</b> 
			 </td>
			 <td>
		   Placement of Audit Report of PRIs nd ULBs in the Legislature </td>
	    
				
				<td align="center">
				   <?php 
				   $checkfinanceyearnew = (($currentyear-1).'-'.($currentyear));
				   
				     $queryy5New=	"select distinct did from jos_formy5 where did IN ($accessid) AND formyear='$checkfinanceyear'";
						$y5nResult = mysql_query($queryy5New);
			  			  $y5nRows = mysql_num_rows($y5nResult);
				//print_r($y2nRows);

						$insquery = "SELECT instit_id FROM jos_formy5 WHERE did IN ($accessid) and formyear='$checkfinanceyear'";
  
  							$insresult = mysql_query($insquery);
  							$insrowsfive = mysql_num_rows($insresult);  
						 // print_r($insrows);
			
				 ?>
                  <?php if($groupid == 1) { if(($y5nRows !=0) && ($y5nRows == ($countaccess))) {?>
				 <a href="yearly/yform5report.php"><img src="images/green.png" border="0"/></a> 
                
                <?php } else {?>
				 <a href="yearly/yform5report.php"><img src="images/orange.png" border="0"/></a>
                <?php }}?>
				<?php if ($groupid == 2) {if(($y5nRows !=0) && ($insrowsfive == 5) ) {?>
				   <a href="yearly/yform5report.php"><img src="images/green.png" border="0"/></a>
                 
                <?php }else {?>
                				   <a href="yearly/yform5report.php"><img src="images/green.png" border="0"/></a> 

				   <a href="yearly/yform5.php"><img src="images/orange.png" border="0"/></a>
                <?php }  } if($groupid == 0 || $groupid == 3) {if(($y5nRows !=0) && ($y5nRows == 34)) {?>
				   <a href="yearly/yform5report.php"><img src="images/green.png" border="0"/></a> 
				<?php } else {?>
				  <a href="yearly/yform5report.php"><img src="images/orange.png" border="0"/></a>
				 <?php }}?>
				 </td>
		 </tr>
         
         
         </table>
     <?php } ?>
     
     
    </div>
<?php if($groupid == 0 || $groupid == 3) { ?>    
<!--	<div class="table-list">
<b>PRC SECTION FORM </b>
    <table border="1" cellspacing="1" cellpadding="5" style="text-align:center;width:950px">
	     <tr>
		     <th>
			    Form No.
			 </th>
			 <th>
			    Description
			 </th>
			 <th colspan="2">
			    Status 
			 </th>
		 </tr>
		 <tr>
		     <th>
             </th>
		     <th>
             </th>
             <?php if($currentmonth >= 4) {
				        $curminyear = ($currentyear-2);
				        $curmaxyear = ($currentyear-1); 
				        $preminyear = ($currentyear-3);
				        $premaxyear = ($currentyear-2); 
                    }else{
				        $curminyear = ($currentyear-3);
				        $curmaxyear = ($currentyear-2);
				        $preminyear = ($currentyear-4);
				        $premaxyear = ($currentyear-3); 
                    }?>
		     <th>
			    <?php echo $preminyear.'-'.$premaxyear;?>
             </th>
		     <th>
			    <?php echo $curminyear.'-'.$curmaxyear;?>
             </th>
		 </tr>

		
		<tr>
		   <td>
		      <b>Y-04-D</b>
		   </td>
		   <td>
		            जिप - १  अर्थसंकल्प व प्रत्यक्ष रकमा -- महसुली जमा 
		   </td>
		   <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y04dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y04dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y04dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y04dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y04dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php }?>
			 </td>
		   <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y04dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y04dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y04dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y04d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y04dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y04dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				   <a href="yearly/y04d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr>
		<tr>
		   <td>
		      <b>Y-05-D</b>
		   </td>

		   <td>
		            जिप - १  अर्थसंकल्प व प्रत्यक्ष रकमा -- महसुलामधून केलेला खर्च
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y05dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y05dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y05dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y05dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y05dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y05dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y05dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y05dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y05d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y05dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y05dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				   <a href="yearly/y05d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
		      
			 </td>
		</tr>
		<tr>
		   <td>
		      <b>Y-06-D</b>
		   </td>
		   <td>
		           जमा व खर्च  जिप  २ (अ)  --  महसुली जमा
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y06dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y06dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y06dsingleprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y06dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y06dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y06dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y06dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y06dsinglereport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y06d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y06dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y06dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				   <a href="yearly/y06d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr>
 	<tr>
		   <td>
		      <b>Y-07-D</b>
		   </td>
		   <td>
		           जमा व खर्च  जिप  २ (ब)  --  महसुली खर्च
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y07dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y07dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y07dsingleprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y07dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y07dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y07dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y07dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>

				   <a href="yearly/y07dsinglereport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y07d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y07dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y07dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				   <a href="yearly/y07d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 
 	<tr>
		   <td>
		      <b>Y-08-D</b>
		   </td>
		   <td>
		           महसुली खर्चाच्या पुरक बाबींची विभागणी
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y08dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y08dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y08dsingleprereport.php"><img src="images/green.png" border="0"/></a>

                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y08dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y08dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y08dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y08dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y08dsinglereport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y08d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y08dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y08dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				   <a href="yearly/y08d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr>
	  <tr>
		   <td>
		      <b>Y-09-D</b>
		   </td>
		   <td>
		           विभागवार व जिल्हा परिषदेस मिळालेली सहाय्यक अनुदान (पंचायत समितीसह) यांचे विवरणपत्र
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y09dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y09dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y09dsingleprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y09dprereport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y09dpreconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y09dreport.php"><img src="images/green.png" border="0"/></a> 
				 <a href="yearly/y09dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y09dsinglereport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y09d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y09dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y09dconsreport.php"><img src="images/consoli.gif" border="0" height="15" width="15" /></a>
				   <a href="yearly/y09d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 
        <tr>
		   <td>
		      <b>Y-10-D</b>
		   </td>
		   <td>
		          बदललेल्या शासकीय योजनांशी संबंधित प्रयोजानाखेरीज इतर अनुदानाविषयी
		   </td>
		     <td align="center">
				 <a href="yearly/y10dprereport.php"><img src="images/green.png" border="0"/></a> 
			 </td>
		     <td align="center">
				 <a href="yearly/y10dreport.php"><img src="images/green.png" border="0"/></a> 
			 </td>
        </tr> 
	  <tr>
		   <td>
		      <b>Y-11-D</b>
		   </td>
		   <td>
		           जि.प.१० परिशिष्ठ अ अभिकरण योजनेवरील ५% कमिशनची जमा रक्कम
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y11dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y11dprereport.php"><img src="images/green.png" border="0"/></a>
                                   <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y11dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y11dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y11dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y11d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y11dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y11d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 

	  <tr>
		   <td>
		      <b>Y-12-D</b>
		   </td>
		   <td>
		           जि.प.४ (अ)शासनाकडून मिळणारी व्याजी कर्जे
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y12dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y12dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y12dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y12dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y12dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y12d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y12dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y12d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 
	  <tr>
		   <td>
		      <b>Y-13-D</b>
		   </td>
		   <td>
		           जि.प.४ (ब) व्याजरहित शासकीय कर्जे
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y13dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y13dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y13dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y13dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y13dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y13d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y13dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y13d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 
	  <tr>
		   <td>
		      <b>Y-14-D</b>
		   </td>
		   <td>
		           जि.प. ४ (क) जिल्हा परिषदांनी इतर संस्थांकडून घेतलेली कर्जे
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y14dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y14dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y14dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y14dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y14dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y14d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y14dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y14d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 
			  <tr>
		   <td>

		      <b>Y-15-D</b>
		   </td>
		   <td>
		           जि.प. ५  जिल्हा परिषदांनी दिलेली कर्जे (व्याजी/व्याजरहित)
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y15dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y15dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y15dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y15dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y15dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y15d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y15dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y15d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 
	    <tr>
		   <td>
		      <b>Y-16-D</b>
		   </td>
		   <td>
		        शिल्लक असलेल्या आगाऊ रक्कमा   
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y16dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y16dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y16dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y16dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y16dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y16d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y16dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y16d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 
	    <tr>
		   <td>
		      <b>Y-17-D</b>
		   </td>
		   <td>
		        शिल्लक असलेल्या अनामत रक्कमा   
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y17dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y17dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y17dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y17dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y17dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y17d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y17dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y17d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr>
	    <tr>
		   <td>
		      <b>Y-18-D</b>
		   </td>
		   <td>
		        मार्च अखेरची स्थिती दर्शविणारे करांची शिल्लक,वसुली व मागणी करावयाचे करावे विवरणपत्र 
		   </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y18dprereport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y18dprereport.php"><img src="images/green.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y18dprereport.php"><img src="images/green.png" border="0"/></a> 
				 <?php }?>
			 </td>
		     <td align="center">
			    <?php if($groupid == 1) {?>
				 <a href="yearly/y18dreport.php"><img src="images/green.png" border="0"/></a> 
				<?php } if ($groupid == 2) {?>
				   <a href="yearly/y18dreport.php"><img src="images/green.png" border="0"/></a>
				   <a href="yearly/y18d.php"><img src="images/orange.png" border="0"/></a>
                <?php } if($groupid == 0 || $groupid == 3) { ?>
				   <a href="yearly/y18dreport.php"><img src="images/green.png" border="0"/></a> 
				   <a href="yearly/y18d.php"><img src="images/orange.png" border="0"/></a>
				 <?php }?>
			 </td>
		</tr> 


    </table>
</div>-->
<?php }} ?>
</div>

