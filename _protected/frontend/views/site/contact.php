<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = Yii::t('app', 'Contact us') . ' - Let\'s get in touch | ' . Yii::t('app', Yii::$app->name);
$this->registerMetaTag(['name' => 'description', 'value' => 'Norstone. New dimensions in natural stone. Innovative natural stone products hand-crafted and designed to inspire you']);
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="welcome new text-center">
    <h2><span>Contact us</span> Let's get in touch</h2>
    <p>Let us help kick start your project. Getting in touch is the easy part. Have a question or need more information? We’re here to assist.</p>
</section><!--end welcome-->
<div class="site-contact">

    <div class="col-lg-5 well bs-component">

   <!-- Note :
   - You can modify the font style and form style to suit your website. 
   - Code lines with comments “Do not remove this code”  are required for the form to work properly, make sure that you do not remove these lines of code. 
   - The Mandatory check script can modified as to suit your business needs. 
   - It is important that you test the modified form before going live.-->
<div id='crmWebToEntityForm' style='width:600px;margin:auto;'>
   <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
   <form action='https://crm.zoho.com/crm/WebToLeadForm' name=WebToLeads2051214000000352024 method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory()' accept-charset='UTF-8'>

<!-- Do not remove this code. -->
<input type='text' style='display:none;' name='xnQsjsdp' value='61d7c3988d07edbdefc718d7f94536931d04b65c045179495f206fb253211cbf'/>
<input type='hidden' name='zc_gad' id='zc_gad' value=''/>
<input type='text' style='display:none;' name='xmIwtLD' value='bdda9ecafefefa53fb5357611bbe1e0efbbe734193d20edda96d6c7b3196a953'/>
<input type='text' style='display:none;'  name='actionType' value='TGVhZHM='/>

<input type='text' style='display:none;' name='returnURL' value='http&#x3a;&#x2f;&#x2f;gallery.norstone.global&#x2f;thank-you.html' /> 
<!-- Do not remove this code. -->
<input type='text' style='display:none;' id='ldeskuid' name='ldeskuid'></input>
<input type='text' style='display:none;' id='LDTuvid' name='LDTuvid'></input>
<!-- Do not remove this code. -->
<style>
tr , td { 
padding:6px;
border-spacing:0px;
border-width:0px;
}
</style>
<table style='width:600px;background-color:white;color:black'>

<tr><td colspan='2' style='text-align:left;color:black;font-family:Arial;font-size:14px;'><strong>Global Gallery Contact</strong></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>First Name<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='40' name='First Name' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Last Name<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='80' name='Last Name' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Company</td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='100' name='Company' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Email<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='100' name='Email' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Phone<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='Phone' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Postal Code<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='Zip Code' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Country<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='Country' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Best Describes You</td><td style='width:250px;'>
<select style='width:250px;' name='LEADCF1'>
<option value='-None-'>-None-</option>
<option value='Architect&#x20;&#x2f;&#x20;Designer'>Architect &#x2f; Designer</option>
<option value='Home&#x20;Owner'>Home Owner</option>
<option value='Builder&#x20;&#x2f;&#x20;Contractor'>Builder &#x2f; Contractor</option>
<option value='Property&#x20;Developer'>Property Developer</option>
<option value='Distributor&#x20;&#x2f;&#x20;Reseller'>Distributor &#x2f; Reseller</option>
</select></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Product I am Interested in<span style='color:red;'>*</span></td><td style='width:250px;'>
<select style='width:250px;' name='LEADCF2' multiple>
<option value='Rock&#x20;Panels'>Rock Panels</option>
<option value='XL&#x20;Rock&#x20;Panels'>XL Rock Panels</option>
<option value='Basalt&#x20;IL&#x20;Tiles'>Basalt IL Tiles</option>
<option value='Basalt&#x20;3D&#x20;Tiles'>Basalt 3D Tiles</option>
<option value='Monarostone'>Monarostone</option>
<option value='Quartz&#x20;Tiles'>Quartz Tiles</option>
</select></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Colour<span style='color:red;'>*</span></td><td style='width:250px;'>
<select style='width:250px;' name='LEADCF5' multiple>
<option value='Charcoal'>Charcoal</option>
<option value='Ochre'>Ochre</option>
<option value='Aztec'>Aztec</option>
<option value='Sahara'>Sahara</option>
<option value='Ivory'>Ivory</option>
<option value='White'>White</option>
<option value='Grey'>Grey</option>
<option value='Ebony'>Ebony</option>
</select></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Quantity &#x28;sqm&#x29;</td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='9' name='LEADCF51' /></td></tr>

<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Project Description </td><td> <textarea name='LEADCF3' maxlength='2000' style='width:250px;'>&nbsp;</textarea></td></tr>

<tr><td colspan='2' style='text-align:center; padding-top:15px;'>
<input style='font-size:12px;color:#131307' type='submit' value='Submit' />
<input type='reset' style='font-size:12px;color:#131307' value='Reset' />
   </td>
</tr>
   </table>
<script>
   var mndFileds=new Array('First Name','Last Name','Phone','Email','Zip Code','Country','LEADCF2','LEADCF5');
   var fldLangVal=new Array('First Name','Last Name','Phone','Email','Postal Code','Country','Product I am Interested in','Colour');
var name='';
var email='';

   function checkMandatory() {
for(i=0;i<mndFileds.length;i++) {
 var fieldObj=document.forms['WebToLeads2051214000000352024'][mndFileds[i]];
 if(fieldObj) {
if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
if(fieldObj.type =='file')
{ 
alert('Please select a file to upload.'); 
fieldObj.focus(); 
return false;
} 
alert(fldLangVal[i] +' cannot be empty'); 
     
   fieldObj.focus();
     
   return false;
}  else if(fieldObj.nodeName=='SELECT') {
   
  if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
alert(fldLangVal[i] +' cannot be none'); 
fieldObj.focus();
return false;
  }
} else if(fieldObj.type =='checkbox'){
  if(fieldObj.checked == false){
alert('Please accept  '+fldLangVal[i]);
fieldObj.focus();
return false;
  } 
} 
try {
    if(fieldObj.name == 'Last Name') {
name = fieldObj.value;
     }
} catch (e) {}
   }
}
trackVisitor();
}
</script><script type='text/javascript' id='VisitorTracking'>var $zoho= $zoho || {salesiq:{values:{},ready:function(){$zoho.salesiq.floatbutton.visible('hide');}}};var d=document;s=d.createElement('script');s.type='text/javascript';s.defer=true;s.src='https://salesiq.zoho.com/norstone/float.ls?embedname=norstone';t=d.getElementsByTagName('script')[0];t.parentNode.insertBefore(s,t);function trackVisitor(){try{if($zoho){var LDTuvidObj = document.forms['WebToLeads2051214000000352024']['LDTuvid'];if(LDTuvidObj){LDTuvidObj.value = $zoho.salesiq.visitor.uniqueid();}var firstnameObj = document.forms['WebToLeads2051214000000352024']['First Name'];if(firstnameObj){name = firstnameObj.value +' '+name;}$zoho.salesiq.visitor.name(name);var emailObj = document.forms['WebToLeads2051214000000352024']['Email'];if(emailObj){email = emailObj.value;$zoho.salesiq.visitor.email(email);}}} catch(e){}}</script>
</form>
</div>


    </div>

</div>
