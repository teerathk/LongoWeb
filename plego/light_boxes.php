<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/10/2017
 * Time: 3:53 PM
 */
?>

<!-- Modal Users -->
<div class="modal fade" id="jobs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><img class="head-icon" src="<?php echo $baseLoc ?>/images/add-job.png">Jobs</h4>
         </div>
         <div class="modal-body">
            <div class="table-modal">
               <div class="btn-right-align margin-tb">
                  <a href="" class="add-job addJobBtn" data-toggle="modal" data-target="#add-job">Add Job <img src="<?php echo $baseLoc ?>/images/plus.png"></a>
               </div>

               <div class="ourtabs">

                  <div class="text-left">
                     <ul class="nav nav-tabs active-bg">
                        <!--	 <li role="presentation" class="active"><a href="#current-Jobss" aria-controls="current" role="tab" data-toggle="tab"></li>
                            <li role="presentation"><a href="#archive-jobss" aria-controls="archive" role="tab" data-toggle="tab"> </li>-->
                        <li class="active"><a data-toggle="tab" href="#current-Jobs">Current Jobs</a></li>
                        <li><a data-toggle="tab" href="#archive-jobs">Archived Jobs</a></li>
                     </ul>
                  </div>


                  <div class="tab-content">
                     <div id="current-Jobs" class="tab-pane fade in active">
                        <div class="main-table-page" style="overflow-x:auto;">
                           <table id="jobsListTbl" class="tablesorter">
                              <thead>
                              <tr>
                                 <th>Yard</th>
                                 <th>Building / Location</th>
                                 <th>Job description</th>
                                 <th>City</th>
                                 <th>State</th>
                                 <th>Contact phone</th>
                                 <th>Contact email</th>
                                 <th>Status</th>
                                 <th>Estimate</th>
                                 <th>Action</th>
                              </tr>
                              </thead>
                              <tbody></tbody>
                           </table>
                           <div class="bodyLoading"><img src="<?php echo $baseLoc ?>/images/throbber_13.gif" alt="loading"></div>
                        </div>
                     </div>

                     <div id="archive-jobs" class="tab-pane fade">
                        <div class="main-table-page" style="overflow-x:auto;">
                           <table id="jobsListTbl" class="tablesorter">
                              <thead>
                              <tr>
                                 <th>Yardssss</th>
                                 <th>Building / Location</th>
                                 <th>Job description</th>
                                 <th>City</th>
                                 <th>State</th>
                                 <th>Contact phone</th>
                                 <th>Contact email</th>
                                 <th>Status</th>
                                 <th>Estimate</th>
                                 <th>Action</th>
                              </tr>
                              </thead>
                              <tbody></tbody>
                           </table>
                           <div class="bodyLoading"><img src="<?php echo $baseLoc ?>/images/throbber_13.gif" alt="loading"></div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
         <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>-->
      </div>
   </div>
</div>
<!-- Modal Users End -->

<!-- Modal Add Job -->
<div class="modal fade" id="add-job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/add-job.png"> Add Job</h4>
         </div>
         <div class="modal-body">
            <div class="table-modal">
               <p class="callbackError text-danger hide"></p>
               <table class="table-bordered jobTable" style="width:100%;">
                  <tbody>
                  <tr>
                     <th>Yard:</th>
                     <td><input type="text" name="yard">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Building/Location:</th>
                     <td><input type="text" name="location">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Job description:</th>
                     <td><textarea name="desc" rows="3" placeholder="Job description"></textarea>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>City:</th>
                     <td><input type="text" name="city">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>State:</th>
                     <td><select name="state" class="form-control"></select>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Contact phone:</th>
                     <td><input type="text" name="phone" class="mask-phone">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Contact email:</th>
                     <td><input type="text" name="email">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Status:</th>
                     <td>
                        <select name="status" class="form-control">
                           <option value="not approved">Not Approved</option>
                           <option value="approved" <?php echo $disabled ?> >Approved</option>
                        </select>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <?php if ($userRole == 'admin') { ?>
                     <tr>
                        <th>Estimate:</th>
                        <td>
                           <div class="currency">
                              <div class="est-min">
                                 <span class="fa fa-usd"></span>
                                 <input type="text" name="estimate" class="mask-currency" placeholder="Minimum value">
                                 <div class="text-danger hide formError"></div>
                              </div>&nbsp;to&nbsp;
                              <div class="est-max">
                                 <span class="fa fa-usd"></span>
                                 <input type="text" name="estimate_max" class="mask-currency" placeholder="Maximum value">
                                 <div class="text-danger hide formError"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <th>File Upload:</th>
                        <td><input class="custom-file-input" type="file" name="job_file" accept="application/pdf">
                           <div class="text-danger hide formError"></div>
                        </td>
                     </tr>
                     <tr>
                        <th>Job from:</th>
                        <td><select name="userID" class="form-control"></select>
                           <div class="text-danger hide formError"></div>
                        </td>
                     </tr>
                  <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="jobSaveBtn">Save</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Add Job End -->


<!-- Modal Edit Job-->
<div class="modal fade" id="edit-job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/edit-job.png"> Edit Job</h4>
         </div>
         <div class="modal-body">
            <div class="table-modal">
               <p class="callbackError text-danger hide"></p>
               <table class="table-bordered jobTable" style="width:100%;">
                  <tbody>
                  <tr>
                     <th>Yard:</th>
                     <td><input type="text" name="yard">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Building/Location:</th>
                     <td><input type="text" name="location">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Job description:</th>
                     <td><textarea name="desc" rows="3" placeholder="Job description"></textarea>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>City:</th>
                     <td><input type="text" name="city">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>State:</th>
                     <td><select name="state" class="form-control"></select>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Contact phone:</th>
                     <td><input type="text" name="phone" class="mask-phone">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Contact email:</th>
                     <td><input type="text" name="email">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Status:</th>
                     <td>
                        <select name="status" class="form-control">
                           <option value="not approved">Not Approved</option>
                           <option value="approved" <?php echo $disabled ?> >Approved</option>
                        </select>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <?php if ($userRole == 'admin') { ?>
                     <tr>
                        <th>Estimate:</th>
                        <td>
                           <div class="currency">
                              <div class="est-min">
                                 <span class="fa fa-usd"></span>
                                 <input type="text" name="estimate" class="mask-currency" placeholder="Minimum value">
                                 <div class="text-danger hide formError"></div>
                              </div>&nbsp;to&nbsp;
                              <div class="est-max">
                                 <span class="fa fa-usd"></span>
                                 <input type="text" name="estimate_max" class="mask-currency" placeholder="Maximum value">
                                 <div class="text-danger hide formError"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <th>File Upload:</th>
                        <td><input class="custom-file-input" type="file" name="job_file" accept="application/pdf">
                           <div class="text-danger hide formError"></div>
                        </td>
                     </tr>
                  <?php } else { ?>
                     <input type="hidden" name="estimate">
                     <input type="hidden" name="estimate_max">
                  <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="editJobSaveBtn">Save</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Edit Job End -->


<!-- Modal Delete -->
<div class="modal fade" id="delete-job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/delete.png">Delete</h4>
         </div>
         <div class="modal-body">
            <div class="delete-popup">
               <div class="img-icon"><img src="<?php echo $baseLoc ?>/images/delete-main.png"></div>
               <p class="deleting-user">Please Click "Yes" to Delete or "No" to Cancel</p>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary remJobYes">Yes</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Delete End -->


<!-- Modal contact longo-->
<div class="modal fade" id="contact-longo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/contact-lg.png">Contact</h4>
         </div>
         <div class="modal-body">
            <div class="table-modal">
               <p class="callbackError text-danger hide"></p>
               <table class="table-bordered" style="width:100%;">
                  <tbody>
                  <tr>
                     <th>Name:</th>
                     <td><input type="text" name="Name">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Email:</th>
                     <td><input type="email" name="Email">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Phone:</th>
                     <td><input type="text" name="Phone" class="mask-phone">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Message:</th>
                     <td><textarea name="Message"></textarea>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
            <button type="button" class="btn btn-primary" id="sendEmailBtn">Send</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal contact longo End -->








<!-- Modal Add Customer -->
<div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/add-customer.png">Add Customer</h4>
         </div>
         <div class="modal-body">
            <div class="table-modal">
               <p class="callbackError text-danger hide"></p>
               <table class="table-bordered customerTbl" style="width:100%;">
                  <tbody>
                  <input type="hidden" name="id">
                  <tr>
                     <th>Name:</th>
                     <td><input type="text" name="name">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Address 1:</th>
                     <td><input type="text" name="address">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Address 2:</th>
                     <td><input type="text" name="address2">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>City:</th>
                     <td><input type="text" name="city">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>State:</th>
                     <td><select name="state" class="form-control"></select>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Zip:</th>
                     <td><input type="text" name="zip">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <!--<tr>
               <th>Customer Logo:</th>
               <td><input class="custom-file-input" type="file" name="c_logo" accept="image/*">
                  <div class="text-danger hide formError"></div></td>
            </tr>-->
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="customerSaveBtn">Save</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Add Customer End -->

<!-- Modal Delete -->
<div class="modal fade" id="Delete-customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/delete.png">Delete</h4>
         </div>
         <div class="modal-body">
            <div class="delete-popup">
               <div class="img-icon"><img src="<?php echo $baseLoc ?>/images/delete-main.png"></div>
               <p class="deleting-user">Please Click "Yes" to Delete or "No" to Cancel</p>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary">Yes</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Delete End -->



<!-- Modal Users -->
<div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/users.png">Users</h4>
         </div>
         <div class="modal-body">
            <div class="table-modal">
               <div class="btn-right-align margin-tb">
                  <a href="#" class="add-user-btn addUserBtn" data-toggle="modal" data-target="#add-users">Add Users<span class="plus-icon"><img
                           src="<?php echo $baseLoc ?>/images/smalls-plus.png"></span></a>
               </div>
               <div class="main-table-page" style="overflow-x:auto;">
                  <table id="usersListTbl" class="tablesorter">
                     <thead>
                     <tr>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Phone No</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                     </tr>
                     </thead>
                     <tbody></tbody>
                  </table>
                  <div class="bodyLoading"><img src="<?php echo $baseLoc ?>/images/throbber_13.gif" alt="loading"></div>
               </div>
            </div>
         </div>
         <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>-->
      </div>
   </div>
</div>
<!-- Modal Users End -->

<!-- Modal Add Users start -->
<div class="modal fade" id="add-users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><img class="head-icon" src="<?php echo $baseLoc ?>/images/add-user.png">Add User</h4>
         </div>
         <div class="modal-body">
            <div class="table-modal">
               <p class="callbackError text-danger hide"></p>
               <table class="table-bordered" style="width:100%;">
                  <tbody>
                  <input type="hidden" name="id">
                  <input type="hidden" name="cid">
                  <tr>
                     <th>First Name:</th>
                     <td><input type="text" name="firstName">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Last Name:</th>
                     <td><input type="text" name="lastName">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Email:</th>
                     <td><input type="email" name="emailAddress">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>User Name:</th>
                     <td><input type="text" name="username">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Password:</th>
                     <td><input type="password" name="password">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Confirm Password:</th>
                     <td><input type="password" name="c_password">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Phone No:</th>
                     <td><input type="text" name="phone" class="mask-phone">
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  <tr>
                     <th>Role:</th>
                     <td><select name="role" class="form-control">
                           <option value="" selected="selected">-select-</option>
                           <option value="user">Standard</option>
                           <option value="cadmin">Customer Admin</option>
                           <option value="admin" class="hide">Admin</option>
                        </select>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveUserBtn">Save</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Add Users End -->

<!-- Modal Delete Users -->
<div class="modal" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">

      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/delete.png">Delete</h4>
         </div>
         <div class="modal-body">
            <div class="delete-popup">
               <div class="img-icon"><img src="<?php echo $baseLoc ?>/images/delete-main.png"></div>
               <p class="deleting-user">Please Click "Yes" to Delete or "No" to Cancel</p>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary remUserYes">Yes</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Delete Users End -->

<!-- Modal Jobs Reassign -->
<div class="modal" id="jobs-switch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">

      <div class="modal-content">
         <div class="modal-header modalhead-color">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><img class="head-icon" src="<?php echo $baseLoc ?>/images/delete.png">Switch jobs</h4>
         </div>
         <div class="modal-body">
            <div class="delete-popup">
               <p class="deleting-user">Prior removing this user you must assign jobs of this user to another user.</p>
            </div>
            <div class="table-modal">
               <table class="table-bordered jobTable" style="width:100%;">
                  <tbody>
                  <tr>
                     <th>Jobs switch to:</th>
                     <td><select name="userID" class="form-control"></select>
                        <div class="text-danger hide formError"></div>
                     </td>
                  </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary jobsSwitchBtn">Save</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Jobs Reassign End -->