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

    <p>Let us help kick start your project. Getting in touch is the easy part. Have a question or need more information?
        We’re here to assist.</p>
</section><!--end welcome-->

<style type="text/css">
    .site-form{  }
    .site-form .title{ font-family: Raleway,Helvetica,Roboto,Arial,sans-serif; font-weight: 300; padding-bottom: .625rem; letter-spacing: .025rem; }
    .site-form .control-label{ margin-bottom: 5px; font-size: 1rem; color: black; }
    .site-form .btn{ padding-top: .375rem;  padding-bottom: .375rem; border: 1px solid #3e3e3e; display: inline-block;  margin: 0;
        -webkit-border-radius: 10px; -moz-border-radius: 10px; -ms-border-radius: 10px; -o-border-radius: 10px; border-radius: 10px; }
    .site-form .btn-reset{ background-color: white; color: #4d4d4d }
    .site-form .form-group--checkbox{ margin-bottom: 5px }
    .site-form .checkbox-wrapper{ display: block; overflow: hidden; padding: 0 0 10px; }
    .site-form .checkbox-wrapper input{ position: absolute; visibility: hidden }
    .site-form .checkbox-wrapper input:checked ~ div .icon:before{ content: ''; position: absolute; top: 3px; left: 3px; width: 8px; height: 8px; display: block; background-color: #4d4d4d;
        -webkit-border-radius: 10px; -moz-border-radius: 10px; -ms-border-radius: 10px; -o-border-radius: 10px; border-radius: 10px; }
    .site-form .checkbox-wrapper .icon{ position: relative; float: left; width: 16px; height: 16px; border: 1px solid #4d4d4d; margin: 3px 6px 0 0;
        -webkit-border-radius: 10px; -moz-border-radius: 10px; -ms-border-radius: 10px; -o-border-radius: 10px; border-radius: 10px; }
    .site-form .checkbox-wrapper .text{ float: left }
    @media screen and (min-width: 768px) {
        .site-form .title{ font-size: 2.375rem; line-height: 2.5rem; }
        .site-form .checkbox-wrapper{ float: left; width: 33.33%; }
    }
</style>

<div class="site-contact">

    <div class="site-form" id="crmWebToEntityForm">
        <form action="https://crm.zoho.com/crm/WebToLeadForm" name="WebToLeads2051214000000352024" method="POST" onsubmit="return checkMandatory();" accept-charset="UTF-8">

            <!-- Do not remove this code. -->
            <input type="text" style="display:none;" name="xnQsjsdp" value="61d7c3988d07edbdefc718d7f94536931d04b65c045179495f206fb253211cbf"/>
            <input type="hidden" name="zc_gad" id="zc_gad" value=""/>
            <input type="text" style="display:none;" name="xmIwtLD" value="bdda9ecafefefa53fb5357611bbe1e0efbbe734193d20edda96d6c7b3196a953"/>
            <input type="text" style="display:none;" name="actionType" value="TGVhZHM="/>

            <input type="text" style="display:none;" name="returnURL" value="http&#x3a;&#x2f;&#x2f;gallery.norstone.global&#x2f;thank-you.html"/>
            <!-- Do not remove this code. -->
            <input type="text" style="display:none;" id="ldeskuid" name="ldeskuid"></input>
            <input type="text" style="display:none;" id="LDTuvid" name="LDTuvid"></input>
            <!-- Do not remove this code. -->

            <h3 class="title">Global Gallery Contact</h3>

            <div class="form-group">
                <label class="control-label" for="first-name">First Name<span style="color: red">*</span></label>
                <div class="input-group">
                    <input type="text" id="first-name" class="form-control" name="First Name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="last-name">Last Name<span style="color: red">*</span></label>
                <div class="input-group">
                    <input type="text" id="last-name" class="form-control" name="Last Name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="company">Company</label>
                <div class="input-group">
                    <input type="text" id="company" class="form-control" name="Company">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="email">Email<span style="color: red">*</span></label>
                <div class="input-group">
                    <input type="text" id="email" class="form-control" name="Email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="phone">Phone<span style="color: red">*</span></label>
                <div class="input-group">
                    <input type="text" id="phone" class="form-control" name="Phone">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="zip-code">Postal Code<span style="color: red">*</span></label>
                <div class="input-group">
                    <input type="text" id="zip-code" class="form-control" name="Zip Code">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="country">Country<span style="color: red">*</span></label>
                <div class="input-group">
                    <input type="text" id="country" class="form-control" name="Country">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="describes">Best Describes You</label>
                <div class="input-group">
                    <select class="form-control" id="describes" name="LEADCF1">
                        <option value="-None-">-None-</option>
                        <option value="Architect&#x20;&#x2f;&#x20;Designer">Architect &#x2f; Designer</option>
                        <option value="Home&#x20;Owner">Home Owner</option>
                        <option value="Builder&#x20;&#x2f;&#x20;Contractor">Builder &#x2f; Contractor</option>
                        <option value="Property&#x20;Developer">Property Developer</option>
                        <option value="Distributor&#x20;&#x2f;&#x20;Reseller">Distributor &#x2f; Reseller
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group--checkbox">
                <label class="control-label" for="interested">Product I am Interested in<span style="color: red">*</span></label>
                <div class="input-group clearfix">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF2" value="Rock&#x20;Panels" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Rock Panels</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF2" value="XL&#x20;Rock&#x20;Panels" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">XL Rock Panels</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF2" value="Basalt&#x20;IL&#x20;Tiles" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Basalt IL Tiles</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF2" value="Basalt&#x20;3D&#x20;Tiles" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Basalt 3D Tiles</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF2" value="Monarostone" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Monarostone</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF2" value="Quartz&#x20;Tiles" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Quartz Tiles</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group form-group--checkbox">
                <label class="control-label" for="colour">Colour<span style="color: red">*</span></label>
                <div class="input-group clearfix">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="Charcoal" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Charcoal</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="Ochre" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Ochre</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="Aztec" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Aztec</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="Sahara" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Sahara</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="Ivory" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Ivory</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="White" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">White</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="Grey" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Grey</span>
                        </div>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="LEADCF5" value="Ebony" />
                        <div>
                            <span class="icon"></span>
                            <span class="text">Ebony</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="quantity">Quantity &#x28;sqm&#x29;</label>
                <div class="input-group">
                    <input type="text" id="quantity" class="form-control" name="LEADCF51">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="description">Project Description</label>
                <div class="input-group">
                    <textarea id="description" class="form-control" name="LEADCF3" rows="6"></textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-reset">Reset</button>
            </div>


            <script>
                var mndFileds = new Array('First Name', 'Last Name', 'Phone', 'Email', 'Zip Code', 'Country', 'LEADCF2', 'LEADCF5');
                var fldLangVal = new Array('First Name', 'Last Name', 'Phone', 'Email', 'Postal Code', 'Country', 'Product I am Interested in', 'Colour');
                var name = '';
                var email = '';

                function checkMandatory() {
                    for (var i = 0; i < mndFileds.length; i++) {
                        var fieldObj = document.forms['WebToLeads2051214000000352024'][mndFileds[i]];
                        if(fieldObj) {
                            if(fieldObj.length > 0){
                                var flag = false;
                                for(var j = 0; j < fieldObj.length; j++) {
                                    if (fieldObj[j].checked) {
                                        flag = true;
                                        break;
                                    }
                                }
                                if(flag === false){
                                    alert('Please select  ' + fldLangVal[i]);
                                    fieldObj[0].focus();
                                    return false;
                                }
                            }
                            else {
                                if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length == 0) {
                                    if (fieldObj.type == 'file') {
                                        alert('Please select a file to upload.');
                                        fieldObj.focus();
                                        return false;
                                    }
                                    alert(fldLangVal[i] + ' cannot be empty');

                                    fieldObj.focus();

                                    return false;
                                } else if (fieldObj.nodeName == 'SELECT') {

                                    if (fieldObj.options[fieldObj.selectedIndex].value == '-None-') {
                                        alert(fldLangVal[i] + ' cannot be none');
                                        fieldObj.focus();
                                        return false;
                                    }
                                } else if (fieldObj.type == 'checkbox') {
                                    if (fieldObj.checked == false) {
                                        alert('Please accept  ' + fldLangVal[i]);
                                        fieldObj.focus();
                                        return false;
                                    }
                                }
                                try {
                                    if (fieldObj.name == 'Last Name') {
                                        name = fieldObj.value;
                                    }
                                } catch (e) {
                                }
                            }
                        }
                    }
                    trackVisitor();
                }
            </script>
            <script type='text/javascript' id='VisitorTracking'>var $zoho = $zoho || {
                        salesiq: {
                            values: {},
                            ready: function () {
                                $zoho.salesiq.floatbutton.visible('hide');
                            }
                        }
                    };
                var d = document;
                s = d.createElement('script');
                s.type = 'text/javascript';
                s.defer = true;
                s.src = 'https://salesiq.zoho.com/norstone/float.ls?embedname=norstone';
                t = d.getElementsByTagName('script')[0];
                t.parentNode.insertBefore(s, t);
                function trackVisitor() {
                    try {
                        if ($zoho) {
                            var LDTuvidObj = document.forms['WebToLeads2051214000000352024']['LDTuvid'];
                            if (LDTuvidObj) {
                                LDTuvidObj.value = $zoho.salesiq.visitor.uniqueid();
                            }
                            var firstnameObj = document.forms['WebToLeads2051214000000352024']['First Name'];
                            if (firstnameObj) {
                                name = firstnameObj.value + ' ' + name;
                            }
                            $zoho.salesiq.visitor.name(name);
                            var emailObj = document.forms['WebToLeads2051214000000352024']['Email'];
                            if (emailObj) {
                                email = emailObj.value;
                                $zoho.salesiq.visitor.email(email);
                            }
                        }
                    } catch (e) {
                    }
                }</script>

        </form>

    </div>

</div>
