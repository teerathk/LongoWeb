/**
 * Created by Mustafeez Ali mtfz@msn.com on 5/3/2017.
 */
var baseURL = location.protocol + '//' + location.host,
   testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i,
   testUserName = /[A-Z0-9._-]\S+$/i,
   testNoSpace = /^\S+$/i;

// custom alert function --> success || warning || error
function alerts($type, $msg) {
   var alertUI = '';

   // Remove old alert
   $('div.mzAlert').remove();

   switch ($type) {
      case 'success':
         alertUI = '<div class="modal fade" id="alert-box-custom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content panel-warning"><div class="modal-header success-color-msg"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button><h4 class="modal-title" id="myModalLabel">Success!</h4></div><div class="modal-body text-popup-para alert alert-success "><p>' + $msg + '</p></div></div></div></div>';
         break;

      case 'warning':
         alertUI = '<div class="modal fade" id="alert-box-custom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content panel-warning"><div class="modal-header warning-color-msg"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button><h4 class="modal-title" id="myModalLabel">Warning!</h4></div><div class="modal-body text-popup-para alert alert-warning"><p>' + $msg + '</p></div></div></div></div>';
         break;

      case 'error':
         alertUI = '<div class="modal fade" id="alert-box-custom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content panel-warning"><div class="modal-header danger-color-msg"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button><h4 class="modal-title" id="myModalLabel">Error!</h4></div><div class="modal-body text-popup-para alert alert-danger"><p>' + $msg + '</p></div></div></div></div>';
         break;

      default :
         alertUI = '<div class="modal fade" id="alert-box-custom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content panel-warning"><div class="modal-header info-color-msg"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button><h4 class="modal-title" id="myModalLabel">Info!</h4></div><div class="modal-body text-popup-para alert alert-info"><p>' + $msg + '</p></div></div></div></div>';
         break;

      /*default : alertUI = '<div class="alert alert-info alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Info!</strong> '+$msg+'</div>'; break;*/
   }
   $('body').append("<div class='mzAlert' style='width: 50%; margin: auto'>" + alertUI + "</div>");
   $('#alert-box-custom').modal('show');

   setTimeout(
      function () {
         $('#alert-box-custom').modal('hide');
      }, 3000
   )
}

// button disable and show loading on ajax call by a button
function btnDisable($thisSel, $type, $msg) {
   var mzBtnDisable = '<img class="mzBtnDisable" src="' + baseURL + '/images/throbber_13.gif" alt="wait img" >';

   $('.mzBtnDisable').remove();
   //$('.mzBtnDisable').parent()
   $($thisSel)
      .removeAttr('disabled')
      .removeAttr('title')
      .removeClass('btnDisabled');

   // Remove old disable
   if ($type != '') {
      $($thisSel).append(mzBtnDisable);
      $($thisSel)
         .attr('disabled', 'disabled')
         .attr('title', 'Please wait...')
         .addClass('btnDisabled');
   }
}

// ajax function
function ajaxFunc($thisSel, $ajaxData, $callBack, $debug) {
   if ($thisSel.length > 0) {
      btnDisable($($thisSel), 'on', '');
   }
   $.ajax({
      type: 'post',
      url: $ajaxData.url,
      data: $ajaxData,
      success: function ($response) {
         if ($debug) {
            console.log("data:", $ajaxData);
            console.log("response:", $response);
         }
         btnDisable($thisSel, '', '');
         $callBack($response, $thisSel);
      },
      error: function (a, b) {
         alerts('warning', "Something went wrong, please refresh the page.");
         btnDisable($thisSel, 'on', '');
         console.log("data:", $ajaxData);
         console.error(a, b);
      }
   })
}

// ajax function with file upload
function ajaxFuncFile($thisSel, $ajaxData, $callBack, $debug) {
   if ($thisSel.length > 0) {
      btnDisable($($thisSel), 'on', '');
   }
   $.ajax({
      type: 'post',
      url: baseURL + '/plego/xhr.php',
      data: $ajaxData.db.formData,
      processData: false,  // tell jQuery not to process the data
      contentType: false,  // tell jQuery not to set contentType
      success: function ($response) {
         if ($debug) {
            console.log("data", $ajaxData);
            console.log("response", $response);
         }
         btnDisable($thisSel, '', '');
         $callBack($response, $thisSel);
      },
      error: function (a, b) {
         alerts('warning', "Something went wrong, please refresh the page.");
         btnDisable($thisSel, 'on', '');
         console.log("data", $ajaxData);
         console.error(a, b);
      }
   })
}

// form input validations
function formError($sel, $text) {
   $($sel).text($text);
   $($sel).removeClass('hide');
}

// masking the values
function enableMask() {
   $('.mask-phone').mask('(000) 000-0000', {clearIfNotMatch: true});
   $('.mask-currency').mask('#,###', {reverse: true});

   //$(".tablesorter").tablesorter( {sortList: [[0,0], [1,0]]} );
}

// clear masking prior to get the values
function clearMask() {
   $('.mask-phone').unmask();
   $('.mask-currency').unmask();
}

// Get all form data
function getFormData($formID) {
   var formData = {},
      textFields = $formID + ' input[type="text"]',
      hiddenFields = $formID + ' input[type="hidden"]',
      emailFields = $formID + ' input[type="email"]',
      passwordFields = $formID + ' input[type="password"]',
      textAreaFields = $formID + ' textarea',
      selectFields = $formID + ' select';

   // get all input type text values
   $(textFields).each(function () {
      var fldName = $(this).attr('name'),
         fldVal = $.trim($(this).val());

      formData[fldName] = fldVal;
   });

   // get all input type text values
   $(hiddenFields).each(function () {
      var fldName = $(this).attr('name'),
         fldVal = $.trim($(this).val());

      formData[fldName] = fldVal;
   });

   // get all input type email values
   $(emailFields).each(function () {
      var fldName = $(this).attr('name'),
         fldVal = $.trim($(this).val());

      formData[fldName] = fldVal;
   });

   // get all input type password values
   $(passwordFields).each(function () {
      var fldName = $(this).attr('name'),
         fldVal = $.trim($(this).val());
      formData[fldName] = fldVal;
   });

   // get all select values
   $(selectFields).each(function () {
      var fldName = $(this).attr('name'),
         fldVal = $.trim($(this).val());

      formData[fldName] = fldVal;
   });

   // get all textarea values
   $(textAreaFields).each(function () {
      var fldName = $(this).attr('name'),
         fldVal = $.trim($(this).val());

      formData[fldName] = fldVal;
   });

   //console.log(formData);
   return formData;
}

function cleanFormData($formID) {
   var textFields = $formID + ' input[type="text"]',
      hiddenFields = $formID + ' input[type="hidden"]',
      emailFields = $formID + ' input[type="email"]',
      passwordFields = $formID + ' input[type="password"]',
      fileFields = $formID + ' input[type="file"]',
      textAreaFields = $formID + ' textarea',
      selectFields = $formID + ' select';

   // get all input type text values
   $(textFields).each(function () {
      $(this).val('');
   });

   // get all input type text values
   $(hiddenFields).each(function () {
      $(this).val('');
   });

   // get all input type email values
   $(emailFields).each(function () {
      $(this).val('');
   });

   // get all input type password values
   $(passwordFields).each(function () {
      $(this).val('');
   });

   // get all input type password values
   $(fileFields).each(function () {
      $(this).val('');
   });

   // get all select values
   $(selectFields).each(function () {
      $(this).val('');
   });

   // get all textarea values
   $(textAreaFields).each(function () {
      $(this).val('');
   });
}


// Login function
function login($xhrResp, $thisSel) {
   var data = JSON.parse($xhrResp);
   //console.log(data);
   if (data.error && data.error.length > 0) {
      $($thisSel).parents('form').find('.callbackError').removeClass('hide');
      $($thisSel).parents('form').find('.callbackError').text(data.error);
   }
   else {
      window.open(baseURL + '/jobs', '_self');
   }
}


// Get states
function getStates() {
   var postData = {};

   postData.unique = 'cStates';
   postData.url = baseURL + '/plego/xhr.php';

   ajaxFunc('', postData, statesHtml, false);
}

function statesHtml($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp),
      //thisSel = $('#add-job select[name="state"]'),
      thisSel = $('select[name="state"]'),
      optHtml = "<option value=''>-select-</option>";

   $(data).each(function () {
      optHtml += "<option value='" + this.name + "'>" + this.name + "</option>";
   });
   $(thisSel).html(optHtml);

}

// Fetch jobs
function getJobs() {
   var postData = {},
      errorFound = false;

   postData.db = {};
   postData.unique = 'getJobs';
   postData.url = baseURL + '/plego/xhr.php';

   $('#jobsListTbl tbody').hide();
   $('.bodyLoading').show();

   ajaxFunc('', postData, jobsHtml, false);
}

function jobsHtml($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp),
      thisSel = location.pathname === "/customers/" ? $('#jobs #current-Jobs #jobsListTbl tbody') : $('#jobsListTbl tbody'),
      optHtml = "",
      userRole = $('.main').attr('data-ur');

   if (data.length > 0) {
      $(data).each(function () {
         var phMaskClass = "",
            statusText = 'Not Approved',
            viewEstBtn = '',
            estData = '',
            deleteButton = '',
            archiveBtn = '';

         if (userRole === 'admin') {
            deleteButton = '<a class="dlt-btns remJob" data-jid="' + this.id + '" data-cid="' + this.cid + '" data-uid="' + this.userID + '"><i class="fa fa-trash-o" aria-hidden="true" data-toggle="modal" data-target="#delete-job"></i></a>';

            deleteButton = ''; // Removed Delte btn;

               archiveBtn = '<div><button class="btn btn-primary arcJob btn-space" data-jid="' + this.id + '" data-cid="' + this.cid + '" data-uid="' + this.userID + '">Archive Job</button></div>';
         }
         if (this.phone && ( $.isNumeric(this.phone) )) {
            phMaskClass = "class='mask-phone'";
         }
         if (this.status == "approved") {
            statusText = "Approved"
         }
         if (this.job_file && this.job_file.length > 0) {
            viewEstBtn = '<div><a href="' + baseURL + '/uploads/' + this.job_file + '" target="_blank" class="btn btn-primary btn-space">View Estimate</a></div>';
         }
         if (this.estimate > 0 || this.estimate_max > 0) {
            estData = "$<span class='est-min'>" + this.estimate + "</span> to $<span class='est-max'>" + this.estimate_max + "</span>";
         }

         optHtml += "<tr>";
         optHtml += "<td>" + this.yard + "</td>";
         optHtml += "<td>" + this.location + "</td>";
         optHtml += "<td>" + this.desc + "</td>";
         optHtml += "<td>" + this.city + "</td>";
         optHtml += "<td>" + this.state + "</td>";
         optHtml += "<td " + phMaskClass + ">" + this.phone + "</td>";
         optHtml += "<td>" + this.email + "</td>";
         optHtml += "<td data-status='" + this.status + "'>" + statusText + "</td>";

         optHtml += "<td>" + estData + "</td>";

         optHtml += '<td>' +
            '<a class="edit-btns editJob" data-jid="' + this.id + '" data-cid="' + this.cid + '" data-uid="' + this.userID + '">' +
            '<i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#edit-job"></i></a>'
            + deleteButton
            + viewEstBtn
            + archiveBtn
            + '</td>';
         optHtml += "</tr>";
      });
   }
   else {
      optHtml = "<tr><td colspan='10' align='center'>Currently there are no Jobs</td></tr>";
   }
   $(thisSel).html(optHtml);

   $('.bodyLoading ').hide();
   $(thisSel).fadeIn();

   enableMask();
   //console.log(data);
   return $xhrResp;
}

function archivedJobsHtml($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp),
      thisSel = location.pathname === "/customers/" ? $('#jobs #archive-jobs #jobsListTbl tbody') : $('#jobsListTbl tbody'),
      optHtml = "",
      userRole = $('.main').attr('data-ur');

   if (data.length > 0) {
      $(data).each(function () {
         var phMaskClass = "",
            statusText = 'Not Approved',
            viewEstBtn = '',
            estData = '',
            deleteButton = '',
            editButton = '',
            remArchiveBtn = '';

         editButton = '<a class="edit-btns editJob" data-jid="' + this.id + '" data-cid="' + this.cid + '" data-uid="' + this.userID + '">' +
            '<i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#edit-job"></i></a>';

         editButton = ''; // Removed edit btn in archived.

         if (userRole === 'admin') {
            deleteButton = '<a class="dlt-btns remJob" data-jid="' + this.id + '" data-cid="' + this.cid + '" data-uid="' + this.userID + '"><i class="fa fa-trash-o" aria-hidden="true" data-toggle="modal" data-target="#delete-job"></i></a>';

            deleteButton = '';   // Removed delete btn

               remArchiveBtn = '<div><button class="btn btn-primary remArcJob btn-space" data-jid="' + this.id + '" data-cid="' + this.cid + '" data-uid="' + this.userID + '">Archive Job</button></div>';
         }
         if (this.phone && ( $.isNumeric(this.phone) )) {
            phMaskClass = "class='mask-phone'";
         }
         if (this.status == "approved") {
            statusText = "Approved"
         }
         if (this.job_file && this.job_file.length > 0) {
            viewEstBtn = '<div><a href="' + baseURL + '/uploads/' + this.job_file + '" target="_blank" class="btn btn-primary btn-space">View Estimate</a></div>';
         }
         if (this.estimate > 0 || this.estimate_max > 0) {
            estData = "$<span class='est-min'>" + this.estimate + "</span> to $<span class='est-max'>" + this.estimate_max + "</span>";
         }

         optHtml += "<tr>";
         optHtml += "<td>" + this.yard + "</td>";
         optHtml += "<td>" + this.location + "</td>";
         optHtml += "<td>" + this.desc + "</td>";
         optHtml += "<td>" + this.city + "</td>";
         optHtml += "<td>" + this.state + "</td>";
         optHtml += "<td " + phMaskClass + ">" + this.phone + "</td>";
         optHtml += "<td>" + this.email + "</td>";
         optHtml += "<td data-status='" + this.status + "'>" + statusText + "</td>";

         optHtml += "<td>" + estData + "</td>";

         optHtml += '<td>'
            + editButton
            + deleteButton
            + viewEstBtn
            //+ remArchiveBtn
            + '</td>';
         optHtml += "</tr>";
      });
   }
   else {
      optHtml = "<tr><td colspan='10' align='center'>Currently there are no Jobs</td></tr>";
   }
   $(thisSel).html(optHtml);
   $(thisSel).fadeIn();

   //console.log(data);
   return $xhrResp;
}

// Save new job
function addJob($xhrResp, $thisSel) {
   //console.log($xhrResp);
   //var data = JSON.parse($xhrResp);

   $('#add-job').modal('hide');

   alerts('success', "Job added successfully !");
   if (location.pathname === "/customers/") {
      var cid = $.trim($('#jobs').attr('data-cid'));
      getCJobs('', cid);
   } else {
      getJobs();
   }
}

// Delete Job
function remJob($xhrResp, $thisSel) {
   // console.log($xhrResp);
   var data = JSON.parse($xhrResp);

   if (data.error) {
      var msg = '';

      if (data.error) {
         msg += JSON.stringify(data.error);
      }

      alerts('error', msg);
      console.log($xhrResp);
   }
   else {
      var cid = $('#delete-job').attr('data-cid');
      $('#delete-job').modal('hide');

      alerts('success', data.success);
      getCJobs($thisSel, cid)
   }
}

// Edit job
function editJob($xhrResp, $thisSel) {
   console.log($xhrResp);
   var data = JSON.parse($xhrResp);

   if (data.status === 'success') {

      $('#edit-job').modal('hide');

      $('#edit-job').find('.callbackError')
         .text('')
         .addClass('hide');

      alerts('success', "Job updated successfully !");
   }
   else {
      alerts('error', data.msg);
      $('#edit-job').find('.callbackError')
         .text(data.msg)
         .removeClass('hide');
   }

   if (location.pathname === "/customers/") {
      var cid = $.trim($('#jobs').attr('data-cid'));
      getCJobs('', cid);
   } else {
      getJobs();
   }
}

// switch jobs callback function
function jobsSwitchCallback($xhrResp, $thisSel) {
   // console.log($xhrResp);
   var data = JSON.parse($xhrResp);

   if (data.error) {
      var msg = '';

      if (data.error) {
         msg += JSON.stringify(data.error);
      }

      alerts('error', msg);
      console.log($xhrResp);
   }
   else {
      var id = $('#jobs-switch').attr('data-id');
      $('#jobs-switch').modal('hide');

      alerts('success', data.success);
      //getUJobs($thisSel, id)
   }
}

// send email
function sendEmail($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp);

   $('#contact-longo').modal('hide');

   if (data.success) {
      alerts('success', data.success);
   }
   else {
      alerts('error', data.error);
   }
}


// Fetch customers
function getCustomers() {
   var postData = {},
      errorFound = false;

   postData.db = {};
   postData.unique = 'getCustomers';
   postData.url = baseURL + '/plego/xhr.php';

   $('#customersListTbl tbody').hide();
   $('.bodyLoading').show();

   ajaxFunc('', postData, customersHtml, false);
}

function customersHtml($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp),
      thisSel = $('#customersListTbl tbody'),
      optHtml = "";

   if (data.length > 0) {
      $(data).each(function () {
         optHtml += "<tr>";
         optHtml += "<td>" + this.name + "</td>";
         optHtml += "<td>" + this.address + "</td>";
         optHtml += "<td>" + this.address2 + "</td>";
         optHtml += "<td>" + this.city + "</td>";
         optHtml += "<td>" + this.state + "</td>";
         optHtml += "<td>" + this.zip + "</td>";
         optHtml += '<td><a class="edit-btns editCustomer" data-cid="' + this.id + '">' +
            '<i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#add-customer"></i></a>' +
            '<div class="buttons-sections">' +
            '<a class="add-user-btn viewUsers" data-cid="' + this.id + '" data-toggle="modal" data-target="#users">Users<span class="plus-icon d-none"><img src="' + baseURL + '/images/plus-small.png"></span></a>' +
            '</div><div class="buttons-sections">' +
            '<a class="jobs-view viewJobs" data-cid="' + this.id + '" data-toggle="modal" data-target="#jobs">Jobs<span class="plus-icon d-none">' +
            '<img src="' + baseURL + '/images/jobss-small.png"></span></a></div></td>';
         optHtml += "</tr>";
      });
   }
   else {
      optHtml = "<tr><td colspan='7' align='center'>Currently there are no Customers</td></tr>";
   }

   $(thisSel).html(optHtml);

   $('.bodyLoading ').hide();
   $(thisSel).fadeIn();

   enableMask();
   //console.log(data);
}

// Save new customer
function addCustomer($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp);

   if (data.error) {
      alerts('error', data.error);
      console.log($xhrResp);
   }
   else {
      $('#add-customer').modal('hide');

      alerts('success', data.success);
      getCustomers();
   }
}

// Fetch users
function getUsers($thisSel, $cid) {
   var postData = {};

   postData.db = {cid: $cid};
   postData.unique = 'getUsers';
   postData.url = baseURL + '/plego/xhr.php';

   ajaxFunc($thisSel, postData, usersHtml, false);
}

function usersHtml($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp),
      thisSel = $('#usersListTbl tbody'),
      userInDropDown = $('select[name="userID"]'),
      optHtml = "",
      userInDropDownHtml = '<option value="">-select-</option>',
      userRole = $('.main').attr('data-ur'),
      deleteButton = '';

   if (data.error) {
      alerts('error', data.error);
      return false;
   }

   if (data.length > 0) {
      $(data).each(function () {
         var roleText = this.role == 'cadmin' ? "Customer Admin" : "Standard";

         if (userRole === 'admin') {
            deleteButton = '<a class="dlt-btns remUser" data-id="' + this.id + '" data-cid="' + this.cid + '">' +
               '<i class="fa fa-trash-o"></i></a>';
         }

         // Removed the delete btn
         deleteButton = '';

         optHtml += "<tr>";
         optHtml += "<td>" + this.lastName + ", " + this.firstName + "</td>";
         optHtml += "<td>" + this.username + "</td>";
         optHtml += "<td class='mask-phone'>" + this.phone + "</td>";
         optHtml += "<td>" + this.emailAddress + "</td>";
         optHtml += "<td data-role='" + this.role + "'>" + roleText + "</td>";
         optHtml += '<td>' +
            '<a class="edit-btns editUserBtn" data-id="' + this.id + '" data-cid="' + this.cid + '"><i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#add-users"></i></a>' + deleteButton +
            '</td>';
         optHtml += "</tr>";

         var optSelected = this.role == "cadmin" ? 'selected="selected"' : "";
         userInDropDownHtml += "<option value='" + this.id + "' >" + this.firstName + " " + this.lastName + " (" + this.role + ")</option>";
      });
   }
   else {
      optHtml = "<tr><td colspan='10' align='center'>Currently there are no users for this customer</td></tr>";
      userInDropDownHtml = '<option value="">-no user found-</option>'
   }
   $(thisSel).html(optHtml);
   $(userInDropDown).html(userInDropDownHtml);

   $('.bodyLoading ').hide();
   $(thisSel).fadeIn();

   enableMask();
}

// Get user details
function getUser($thisSel, $id) {
   var postData = {};

   postData.db = {id: $id};
   postData.unique = 'getUser';
   postData.url = baseURL + '/plego/xhr.php';

   ajaxFunc($thisSel, postData, userInfoInForm, false);
}

function userInfoInForm($xhrResp, $thisSel) {
   console.log($xhrResp);
   var data = JSON.parse($xhrResp),
      thisSel = $('#add-users tbody');

   if (data.error) {
      alerts('error', data.error);
      return false;
   }
   data = data[0];

   $(thisSel).find('[name="firstName"]').val(data.firstName);
   $(thisSel).find('[name="lastName"]').val(data.lastName);
   $(thisSel).find('[name="username"]').val(data.username);
   $(thisSel).find('[name="password"]').val(data.password);
   $(thisSel).find('[name="c_password"]').val(data.password);
   $(thisSel).find('[name="phone"]').val(data.phone);
   $(thisSel).find('[name="emailAddress"]').val(data.emailAddress);
   $(thisSel).find('[name="role"]').val(data.role);

   enableMask();
}

// Add User
function addUser($xhrResp, $thisSel) {
   //console.log($xhrResp);
   var data = JSON.parse($xhrResp);

   if (data.error) {
      var mainSel = '#add-users',
         msg = '';
      if (data.error.c_password) {
         msg += data.error.c_password;
         formError($(mainSel).find('[name="c_password"]').next('.formError'), data.error.c_password);
      }
      if (data.error.emailAddress) {
         msg += data.error.emailAddress;
         formError($(mainSel).find('[name="emailAddress"]').next('.formError'), data.error.emailAddress);
      }
      if (data.error.username) {
         msg += data.error.username;
         formError($(mainSel).find('[name="username"]').next('.formError'), data.error.username);
      }
      if (data.error.error) {
         msg += data.error.error;
      }

      alerts('error', msg);
      console.log($xhrResp);
   }
   else {
      var cid = $('#add-users input[name="cid"]').val();
      $('#add-users').modal('hide');

      alerts('success', data.success);
      getUsers('', cid)
   }
}

// get jobs
function getCJobs($thisSel, $cid) {
   var postData = {};

   postData.db = {cid: $cid};
   postData.unique = 'getJobs';
   postData.url = baseURL + '/plego/xhr.php';

   cleanFormData('#add-job');
   $('#jobsListTbl tbody').hide();
   $('#jobs .bodyLoading').show();

   getArchivedJobs($cid);
   ajaxFunc($thisSel, postData, jobsHtml, false);
}

// get Archived jobs
function getArchivedJobs($cid) {
   var postData = {};

   postData.db = {cid: $cid};
   postData.unique = 'getArchivedJobs';
   postData.url = baseURL + '/plego/xhr.php';

   ajaxFunc('', postData, archivedJobsHtml, false);
}

// get User's jobs
function getUJobs($thisSel, $id) {
   var postData = {};

   postData.db = {id: $id};
   postData.unique = 'getUJobs';
   postData.url = baseURL + '/plego/xhr.php';

   ajaxFunc($thisSel, postData, userRemDialog, false);
}

// Delete enables if User's jobs are null
function userRemDialog($xhrResp, $thisSel) {
   var data = JSON.parse($xhrResp);
   //console.log(data.length);

   if (data.length) {
      $('#delete-user').modal('hide');
      $('#jobs-switch').modal('show');
   }
   else {
      $('#delete-user').modal('show');
      $('#jobs-switch').modal('hide');
   }
}

// Delete user
function remUser($thisSel, $id) {
   var postData = {};

   postData.db = {id: $id};
   postData.unique = 'remUser';
   postData.url = baseURL + '/plego/xhr.php';

   ajaxFunc($thisSel, postData, remUserCallback, false);
}

function remUserCallback($xhrResp, $thisSel) {
// console.log($xhrResp);
   var data = JSON.parse($xhrResp);

   if (data.error) {
      var msg = '';

      if (data.error) {
         msg += JSON.stringify(data.error);
      }

      alerts('error', msg);
      console.log($xhrResp);
   }
   else {
      var cid = $('#delete-user').attr('data-cid');
      $('#delete-user').modal('hide');

      alerts('success', data.success);
      getUsers('', cid);
   }
}

// Login function
$(document).on('click', "#cLogin", function () {
   var postData = {},
      errorFound = false,
      msg = 'This cannot be empty.';

   postData.db = {};
   postData.unique = 'cLogin';
   postData.url = baseURL + '/plego/xhr.php';

   postData.db.userName = $.trim($(this).parents('form').find('input[name="userName"]').val());
   postData.db.password = $.trim($(this).parents('form').find('input[name="password"]').val());

   //remove input errors
   $('.formError').addClass('hide');
   $('.formError').text('');

   //remove callback errors
   $('.callbackError').addClass('hide');
   $('.callbackError').text('');

   if (!postData.db.userName) {
      formError($(this).parents('form').find('input[name="userName"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.password) {
      formError($(this).parents('form').find('input[name="password"]').next('.formError'), msg);
      errorFound = true;
   }

   if (errorFound === false) {
      ajaxFunc($(this), postData, login, false);
   }
});

// Add jobs
$(document).on('click', '.addJobBtn', function (e) {
   e.stopImmediatePropagation();
   cleanFormData('#add-job');
});
$(document).on('click', '#jobSaveBtn', function () {
   // Clear the masking prior to get values.
   clearMask();

   var postData = {},
      errorFound = false,
      msg = 'This cannot be empty.',
      mainSel = '#add-job';

   postData.db = {};
   postData.unique = 'addJob';
   postData.url = baseURL + '/plego/xhr.php';

   if (location.pathname === "/customers/") {
      postData.db.cid = $.trim($('#jobs').attr('data-cid'));
      postData.db.userID = $.trim($(this).parents(mainSel).find('select[name="userID"]').val());
   }

   postData.db.yard = $.trim($(this).parents(mainSel).find('input[name="yard"]').val());
   postData.db.location = $.trim($(this).parents(mainSel).find('input[name="location"]').val());
   postData.db.desc = $.trim($(this).parents(mainSel).find('textarea[name="desc"]').val());
   postData.db.city = $.trim($(this).parents(mainSel).find('input[name="city"]').val());
   postData.db.state = $.trim($(this).parents(mainSel).find('select[name="state"] option:selected').val());
   postData.db.phone = $.trim($(this).parents(mainSel).find('input[name="phone"]').val());
   postData.db.email = $.trim($(this).parents(mainSel).find('input[name="email"]').val());
   postData.db.status = $.trim($(this).parents(mainSel).find('select[name="status"] option:selected').val());
   postData.db.estimate = $.trim($(this).parents(mainSel).find('input[name="estimate"]').val());
   postData.db.estimate_max = $.trim($(this).parents(mainSel).find('input[name="estimate_max"]').val());

   //remove input errors
   $(mainSel).find('.formError').addClass('hide');
   $(mainSel).find('.formError').text('');

   //remove callback errors
   $(mainSel).find('.callbackError').addClass('hide');
   $(mainSel).find('.callbackError').text('');

   if (!postData.db.yard) {
      formError($(mainSel).find('input[name="yard"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.location) {
      formError($(mainSel).find('input[name="location"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.desc) {
      formError($(mainSel).find('textarea[name="desc"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.city) {
      formError($(mainSel).find('input[name="city"]').next('.formError'), msg);
      errorFound = true;
   }
   else if ($.isNumeric(postData.db.city)) {
      formError($(mainSel).find('input[name="city"]').next('.formError'), "This must be valid city name.");
      errorFound = true;
   }
   if (!postData.db.state) {
      formError($(mainSel).find('select[name="state"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.phone) {
      formError($(mainSel).find('input[name="phone"]').next('.formError'), msg);
      errorFound = true;
   }
   else if (!$.isNumeric(postData.db.phone)) {
      formError($(mainSel).find('input[name="phone"]').next('.formError'), "This must be a valid phone number.");
      errorFound = true;
   }
   if (!postData.db.email) {
      formError($(mainSel).find('input[name="email"]').next('.formError'), msg);
      errorFound = true;
   }
   else if (!testEmail.test(postData.db.email)) {
      formError($(mainSel).find('input[name="email"]').next('.formError'), 'This must be a valid email address.');
      errorFound = true;
   }
   if (!postData.db.status) {
      formError($(mainSel).find('select[name="status"]').next('.formError'), msg);
      errorFound = true;
   }
   if (postData.db.estimate && (!$.isNumeric(postData.db.estimate) )) {
      formError($(mainSel).find('input[name="estimate"]').next('.formError'), "This must be in number.");
      errorFound = true;
   }
   if (postData.db.estimate_max && (!$.isNumeric(postData.db.estimate_max) )) {
      formError($(mainSel).find('input[name="estimate_max"]').next('.formError'), "This must be in number.");
      errorFound = true;
   }
   if (location.pathname === "/customers/") {
      if (!postData.db.userID) {
         formError($(mainSel).find('select[name="userID"]').next('.formError'), msg);
         errorFound = true;
      }
   }


   postData.db.formData = new FormData();
   postData.db.formData.append('unique', postData.unique);
   $.each(postData.db, function (k, v) {
      postData.db.formData.append(k, v);
   });

   if ($.trim($(mainSel).find('[name="job_file"]').val()).length > 0) {
      var c_logo = $(mainSel).find('[name="job_file"]')[0].files[0];
      postData.db.formData.append('job_file', c_logo);
   }

   if (errorFound === false) {
      ajaxFuncFile($(this), postData, addJob, false);
   }
   else {
      $(mainSel).find('.formError:not(.hide):first').prev().focus();
      enableMask();
   }
});

// Delete Job Confirmation Popup
$(document).on('click', '.remJob', function (e) {
   var jobID = $(this).attr('data-jid'),
      cid = $(this).attr('data-cid');
   $('#delete-job')
      .attr({'data-jid': jobID, 'data-cid': cid});
});
// Delete Job
$(document).on('click', '#delete-job .remJobYes', function (e) {
   var thisSel = $(this),
      modalID = $('#delete-job'),
      jobID = $(modalID).attr('data-jid'),
      cid = $(modalID).attr('data-cid'),
      postData = {};

   postData.db = {jid: jobID, cid: cid};
   postData.unique = 'remJobs';
   postData.url = baseURL + '/plego/xhr.php';

   ajaxFunc(thisSel, postData, remJob, false);
});

// Edit Job
$(document).on('click', '.editJob', function () {
   var jobData = {},
      jobID = $(this).attr('data-jid'),
      jobUserID = $(this).attr('data-uid'),
      mainSel = $(this).parents('tr'),
      userID = $('.main').attr('data-id'),
      userRole = $('.main').attr('data-ur');


   jobData.yard = $.trim($(mainSel).find('td:eq(0)').text());
   jobData.location = $.trim($(mainSel).find('td:eq(1)').text());
   jobData.desc = $.trim($(mainSel).find('td:eq(2)').text());
   jobData.city = $.trim($(mainSel).find('td:eq(3)').text());
   jobData.state = $.trim($(mainSel).find('td:eq(4)').text());
   jobData.phone = $.trim($(mainSel).find('td:eq(5)').text());
   jobData.email = $.trim($(mainSel).find('td:eq(6)').text());
   jobData.status = $.trim($(mainSel).find('td:eq(7)').attr('data-status'));
   jobData.estimate = $.trim($(mainSel).find('td:eq(8) .est-min').text());
   jobData.estimate_max = $.trim($(mainSel).find('td:eq(8) .est-max').text());

   $('#edit-job').find('#editJobSaveBtn').attr('data-jid', jobID);
   $('#edit-job .jobTable tbody').find('input[name="yard"]').val(jobData.yard);
   $('#edit-job .jobTable tbody').find('input[name="location"]').val(jobData.location);
   $('#edit-job .jobTable tbody').find('textarea[name="desc"]').val(jobData.desc);
   $('#edit-job .jobTable tbody').find('input[name="city"]').val(jobData.city);
   $('#edit-job .jobTable tbody').find('select[name="state"]').val(jobData.state);
   $('#edit-job .jobTable tbody').find('input[name="phone"]').val(jobData.phone);
   $('#edit-job .jobTable tbody').find('input[name="email"]').val(jobData.email);
   $('#edit-job .jobTable tbody').find('select[name="status"]').val(jobData.status);
   $('#edit-job .jobTable tbody').find('input[name="estimate"]').val(jobData.estimate);
   $('#edit-job .jobTable tbody').find('input[name="estimate_max"]').val(jobData.estimate_max);

   $('#edit-job').find('#editJobSaveBtn').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('input[name="yard"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('input[name="location"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('textarea[name="desc"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('input[name="city"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('select[name="state"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('input[name="phone"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('input[name="email"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('select[name="status"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('input[name="estimate"]').attr('disabled', 'disabled');
   $('#edit-job .jobTable tbody').find('input[name="estimate_max"]').attr('disabled', 'disabled');

   if (jobUserID === userID || userRole === 'admin') {
      $('#edit-job').find('#editJobSaveBtn').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('input[name="yard"]').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('input[name="location"]').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('textarea[name="desc"]').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('input[name="city"]').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('select[name="state"]').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('input[name="phone"]').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('input[name="email"]').removeAttr('disabled');

      $('#edit-job .jobTable tbody').find('input[name="estimate"]').removeAttr('disabled');
      $('#edit-job .jobTable tbody').find('input[name="estimate_max"]').removeAttr('disabled');
   }
   if (userRole === 'cadmin') {
      $('#edit-job .jobTable tbody').find('select[name="status"]').removeAttr('disabled');
      $('#edit-job').find('#editJobSaveBtn').removeAttr('disabled');
   }


   $('#edit-job').find('.callbackError')
      .text('')
      .addClass('hide');

   //console.log(jobData);
});

// Update job
$(document).on('click', '#editJobSaveBtn', function () {
   // Clear the masking prior to get values.
   clearMask();

   // Show loading animation.
   $('#jobsListTbl tbody').hide();
   $('.bodyLoading').show();

   var postData = {},
      errorFound = false,
      msg = 'This cannot be empty.',
      mainSel = '#edit-job';

   postData.db = {};
   postData.unique = 'updJob';
   postData.url = baseURL + '/plego/xhr.php';

   postData.db.id = $.trim($(this).attr('data-jid'));
   postData.db.yard = $.trim($(this).parents(mainSel).find('input[name="yard"]').val());
   postData.db.location = $.trim($(this).parents(mainSel).find('input[name="location"]').val());
   postData.db.desc = $.trim($(this).parents(mainSel).find('textarea[name="desc"]').val());
   postData.db.city = $.trim($(this).parents(mainSel).find('input[name="city"]').val());
   postData.db.state = $.trim($(this).parents(mainSel).find('select[name="state"] option:selected').val());
   postData.db.phone = $.trim($(this).parents(mainSel).find('input[name="phone"]').val());
   postData.db.email = $.trim($(this).parents(mainSel).find('input[name="email"]').val());
   postData.db.status = $.trim($(this).parents(mainSel).find('select[name="status"] option:selected').val());
   postData.db.estimate = $.trim($(this).parents(mainSel).find('input[name="estimate"]').val());
   postData.db.estimate_max = $.trim($(this).parents(mainSel).find('input[name="estimate_max"]').val());

   //remove input errors
   $(mainSel).find('.formError').addClass('hide');
   $(mainSel).find('.formError').text('');

   //remove callback errors
   $(mainSel).find('.callbackError').addClass('hide');
   $(mainSel).find('.callbackError').text('');

   if (!postData.db.yard) {
      formError($(mainSel).find('input[name="yard"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.location) {
      formError($(mainSel).find('input[name="location"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.desc) {
      formError($(mainSel).find('textarea[name="desc"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.city) {
      formError($(mainSel).find('input[name="city"]').next('.formError'), msg);
      errorFound = true;
   }
   else if ($.isNumeric(postData.db.city)) {
      formError($(mainSel).find('input[name="city"]').next('.formError'), "This must be valid city name.");
      errorFound = true;
   }
   if (!postData.db.state) {
      formError($(mainSel).find('select[name="state"]').next('.formError'), msg);
      errorFound = true;
   }
   if (!postData.db.phone) {
      formError($(mainSel).find('input[name="phone"]').next('.formError'), msg);
      errorFound = true;
   }
   else if (!$.isNumeric(postData.db.phone)) {
      formError($(mainSel).find('input[name="phone"]').next('.formError'), "This must be a valid phone number.");
      errorFound = true;
   }
   if (!postData.db.email) {
      formError($(mainSel).find('input[name="email"]').next('.formError'), msg);
      errorFound = true;
   }
   else if (!testEmail.test(postData.db.email)) {
      formError($(mainSel).find('input[name="email"]').next('.formError'), 'This must be a valid email address.');
      errorFound = true;
   }
   if (!postData.db.status) {
      formError($(mainSel).find('select[name="status"]').next('.formError'), msg);
      errorFound = true;
   }
   if (postData.db.estimate && (!$.isNumeric(postData.db.estimate) )) {
      formError($(mainSel).find('input[name="estimate"]').next('.formError'), "This must be in number.");
      errorFound = true;
   }
   if (postData.db.estimate_max && (!$.isNumeric(postData.db.estimate_max) )) {
      formError($(mainSel).find('input[name="estimate_max"]').next('.formError'), "This must be in number.");
      errorFound = true;
   }

   postData.db.formData = new FormData();
   postData.db.formData.append('unique', postData.unique);
   $.each(postData.db, function (k, v) {
      postData.db.formData.append(k, v);
   });

   if ($.trim($(mainSel).find('[name="job_file"]').val()).length > 0) {
      var c_logo = $(mainSel).find('[name="job_file"]')[0].files[0];
      postData.db.formData.append('job_file', c_logo);
   }

   if (errorFound === false) {
      ajaxFuncFile($(this), postData, editJob, false);
   }
   else {
      $(mainSel).find('.formError:not(.hide):first').prev().focus();
      enableMask();
   }
});

// Put job in archive
$(document).on('click', '.arcJob', function () {
   // Show loading animation.
   $('#jobsListTbl tbody').hide();
   $('.bodyLoading').show();

   var postData = {},
      errorFound = false,
      msg = 'This cannot be empty.',
      mainSel = '#edit-job';

   postData.db = {};
   postData.unique = 'updJob';
   postData.url = baseURL + '/plego/xhr.php';

   postData.db.id = $.trim($(this).attr('data-jid'));
   postData.db.is_archived = 1;

   postData.db.formData = new FormData();
   postData.db.formData.append('unique', postData.unique);
   $.each(postData.db, function (k, v) {
      postData.db.formData.append(k, v);
   });

   ajaxFuncFile($(this), postData, editJob, false);
});

// Send email to longo
$(document).on('click', '#sendEmailBtn', function () {
   // Clear the masking prior to get values.
   clearMask();

   var postData = {},
      errorFound = false,
      msg = 'This cannot be empty.',
      mainSel = '#contact-longo';

   postData.db = getFormData(mainSel);
   postData.unique = 'sendEmail';
   postData.url = baseURL + '/plego/xhr.php';

   //remove input errors
   $(mainSel).find('.formError').addClass('hide');
   $(mainSel).find('.formError').text('');

   //remove callback errors
   $(mainSel).find('.callbackError').addClass('hide');
   $(mainSel).find('.callbackError').text('');

   // form validations
   $.each(postData.db, function (key, val) {
      var fldName = key,
         fldVal = val;

      if (!fldVal) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), msg);
         errorFound = true;
      }
      if (fldVal && (fldName == "Name") && ($.isNumeric(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid " + fldName);
         errorFound = true;
      }
      if (fldVal && (fldName == "Phone") && (!$.isNumeric(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid phone number");
         errorFound = true;
      }
      if (fldVal && (fldName == "Email") && (!testEmail.test(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid email address");
         errorFound = true;
      }
   });

   if (errorFound === false) {
      enableMask();
      ajaxFunc($(this), postData, sendEmail, false);
   }
   else {
      $(mainSel).find('.formError:not(.hide):first').prev().focus();
      enableMask();
   }
});


// Change and clean value on add customer click
$(document).on('click', '#addCustomerBtn', function () {
   // change modal title and image
   $('#add-customer .modal-title').html('<img class="head-icon" src="' + baseURL + '/images/add-customer.png">Add Customer');
   $('#add-customer .customerTbl tbody').find('input[name="id"]').val('');
   cleanFormData('#add-customer');
});

// Add/Edit Customer
$(document).on('click', '#customerSaveBtn', function () {
   // Clear the masking prior to get values.
   clearMask();

   var postData = {},
      errorFound = false,
      msg = 'This cannot be empty.',
      mainSel = '#add-customer';

   postData.db = getFormData(mainSel);
   postData.unique = 'addCustomer';
   postData.url = baseURL + '/plego/xhr.php';

   //remove input errors
   $(mainSel).find('.formError').addClass('hide');
   $(mainSel).find('.formError').text('');

   //remove callback errors
   $(mainSel).find('.callbackError').addClass('hide');
   $(mainSel).find('.callbackError').text('');

   // form validations
   $.each(postData.db, function (key, val) {
      var fldName = key,
         fldVal = val;

      if ((!fldVal) && (fldName != 'id')) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), msg);
         errorFound = true;
      }
      if (fldVal && (fldName == "name") && ($.isNumeric(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid name");
         errorFound = true;
      }
      if (fldVal && (fldName == "city") && ($.isNumeric(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid city name");
         errorFound = true;
      }
      if (fldVal && (fldName == "zip") && ((!$.isNumeric(fldVal) || (fldVal.length < 5)) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid ZIP code");
         errorFound = true;
      }
   });


   postData.db.formData = new FormData();
   postData.db.formData.append('unique', postData.unique);
   $.each(postData.db, function (k, v) {
      postData.db.formData.append(k, v);
   });

   if ($.trim($('#add-customer').find('[name="c_logo"]').val()).length > 0) {
      var c_logo = $('#add-customer').find('[name="c_logo"]')[0].files[0];
      postData.db.formData.append('c_logo', c_logo);
   }


   if (errorFound === false) {
      enableMask();
      //ajaxFuncFile($(this), postData, addCustomer, true);
      ajaxFuncFile($(this), postData, addCustomer, false);
   }
   else {
      $(mainSel).find('.formError:not(.hide):first').prev().focus();
      enableMask();
   }
});

// Edit Customer
$(document).on('click', '.editCustomer', function () {
   var customerData = {},
      cid = $(this).attr('data-cid'),
      mainSel = $(this).parents('tr');

   // change modal title and image
   $('#add-customer .modal-title').html('<img class="head-icon" src="' + baseURL + '/images/edit-customer.png">Edit Customer');

   customerData.name = $.trim($(mainSel).find('td:eq(0)').text());
   customerData.address = $.trim($(mainSel).find('td:eq(1)').text());
   customerData.address2 = $.trim($(mainSel).find('td:eq(2)').text());
   customerData.city = $.trim($(mainSel).find('td:eq(3)').text());
   customerData.state = $.trim($(mainSel).find('td:eq(4)').text());
   customerData.zip = $.trim($(mainSel).find('td:eq(5)').text());

   $('#add-customer .customerTbl tbody').find('input[name="id"]').val(cid);
   $('#add-customer .customerTbl tbody').find('input[name="name"]').val(customerData.name);
   $('#add-customer .customerTbl tbody').find('input[name="address"]').val(customerData.address);
   $('#add-customer .customerTbl tbody').find('input[name="address2"]').val(customerData.address2);
   $('#add-customer .customerTbl tbody').find('input[name="city"]').val(customerData.city);
   $('#add-customer .customerTbl tbody').find('select[name="state"]').val(customerData.state);
   $('#add-customer .customerTbl tbody').find('input[name="zip"]').val(customerData.zip);

});

// Get users
$(document).on('click', '.viewUsers', function (e) {
   e.stopImmediatePropagation();
   var cid = $.trim($(this).attr('data-cid'));

   cleanFormData('#add-users');
   $('#add-users input[name="cid"]').val(cid);

   $('#usersListTbl tbody').hide();
   $('#users .bodyLoading').show();

   getUsers($(this), cid);
});

// Add user
$(document).on('click', '.addUserBtn', function (e) {
   e.stopImmediatePropagation();
   var cid = $.trim($('#add-users input[name="cid"]').val()),
      mainSel = '#add-users';

   cleanFormData('#add-users');
   $('#add-users .modal-title').html('<img class="head-icon" src="' + baseURL + '/images/add-user.png">Add User');
   $('#add-users input[name="cid"]').val(cid);

   //remove input errors
   $(mainSel).find('.formError').addClass('hide');
   $(mainSel).find('.formError').text('');

   //remove callback errors
   $(mainSel).find('.callbackError').addClass('hide');
   $(mainSel).find('.callbackError').text('');
});

// Add/Edit User
$(document).on('click', '#saveUserBtn', function () {
   // Clear the masking prior to get values.
   clearMask();

   var postData = {},
      errorFound = false,
      msg = 'This cannot be empty.',
      mainSel = '#add-users',
      passWord = '';

   postData.db = getFormData(mainSel);
   postData.unique = 'addUser';
   postData.url = baseURL + '/plego/xhr.php';

   //remove input errors
   $(mainSel).find('.formError').addClass('hide');
   $(mainSel).find('.formError').text('');

   //remove callback errors
   $(mainSel).find('.callbackError').addClass('hide');
   $(mainSel).find('.callbackError').text('');

   // form validations
   $.each(postData.db, function (key, val) {
      var fldName = key,
         fldVal = val;

      if (fldName == "password") {
         passWord = fldVal;
      }

      if ((!fldVal) && (fldName != 'id') && (fldName != 'cid')) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), msg);
         errorFound = true;
      }
      if (fldVal && (fldName == "firstName") && ($.isNumeric(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid name");
         errorFound = true;
      }
      if (fldVal && (fldName == "lastName") && ($.isNumeric(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid name");
         errorFound = true;
      }
      if (fldVal && (fldName == "username") && (!testUserName.test(fldVal))) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This can be alphanumeric without any space and may contain: . _ - ");
         errorFound = true;
      }
      if (fldVal && (fldName == "password") && (!testNoSpace.test(fldVal))) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This can not contain any space");
         errorFound = true;
      }
      if (fldVal && (fldName == "c_password") && (fldVal != passWord)) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "Password does not matched");
         errorFound = true;
      }
      if (fldVal && (fldName == "phone") && (!$.isNumeric(fldVal) )) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid phone number");
         errorFound = true;
      }
      if (fldVal && (fldName == "emailAddress") && (!testEmail.test(fldVal))) {
         formError($(mainSel).find('[name="' + fldName + '"]').next('.formError'), "This must be a valid email address");
         errorFound = true;
      }
   });

   if (errorFound === false) {
      enableMask();
      ajaxFunc($(this), postData, addUser, false);
   }
   else {
      $(mainSel).find('.formError:not(.hide):first').prev().focus();
      enableMask();
   }
});

// Edit User
$(document).on('click', '.editUserBtn', function () {
   var id = $(this).attr('data-id'),
      cid = $(this).attr('data-cid'),
      mainSel = '#add-users';

   //remove input errors
   $(mainSel).find('.formError').addClass('hide');
   $(mainSel).find('.formError').text('');

   //remove callback errors
   $(mainSel).find('.callbackError').addClass('hide');
   $(mainSel).find('.callbackError').text('');

   cleanFormData('#add-users');
   $('#add-users .modal-title').html('<img class="head-icon" src="' + baseURL + '/images/edit-user.png">Edit User');
   $('#add-users input[name="id"]').val(id);
   $('#add-users input[name="cid"]').val(cid);

   getUser('', id);
});


// Delete User
$(document).on('click', '.remUser', function () {
   var id = $(this).attr('data-id'),
      cid = $(this).attr('data-cid');

   $('#delete-user')
      .attr({'data-id': id, 'data-cid': cid});

   $('#jobs-switch')
      .attr({'data-id': id, 'data-cid': cid});

   // Enable all options
   $('#jobs-switch select[name="userID"] option').removeAttr('disabled');
   // Disabled current user from selection options
   $('#jobs-switch select[name="userID"] option[value="' + id + '"]').attr('disabled', 'disabled');

   getUJobs($(this), id);
});
-$(document).on('click', '.remUserYes', function () {
   var modalID = $('#delete-user'),
      id = $(modalID).attr('data-id'),
      cid = $(modalID).attr('data-cid');

   remUser($(this), id);
});

// Switch jobs to another users
$(document).on('click', '.jobsSwitchBtn', function () {
   var modalID = '#jobs-switch',
      id = $(modalID).attr('data-id'),
      cid = $(modalID).attr('data-cid'),
      targUserID = $.trim($(modalID).find('select[name="userID"] option:selected').val()),
      postData = {};

   //console.log(targUserID);

   if (id === targUserID) {
      alerts('error', "These jobs already belongs to this user.");
   }
   else {
      postData.db = {id: id, targUserID: targUserID, cid: cid};
      postData.unique = 'switchJobs';
      postData.url = baseURL + '/plego/xhr.php';

      ajaxFunc($(this), postData, jobsSwitchCallback, false);
   }
});


// Get jobs
$(document).on('click', '.viewJobs', function (e) {
   e.stopImmediatePropagation();
   var cid = $.trim($(this).attr('data-cid'));
   $('#jobs').attr('data-cid', cid);

   $('#jobs .nav-tabs a:first').tab('show'); // Enable current jobs tab;
   
   getCJobs($(this), cid);
   getUsers($(this), cid);
});


// Run functions on page load
$(document).ready(function () {
   if (location.pathname === "/jobs/") {
      getJobs();
   }

   if (location.pathname === "/customers/") {
      getCustomers();
   }

   getStates();
   enableMask();
});