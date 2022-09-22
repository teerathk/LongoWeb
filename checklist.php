<?php
require 'php/template.php';
require 'php/mysqli.php';

$title = 'Longo Corporation - Checklist Page';
$description = 'This is the description';
$keywords = 'These are the keywords';

printHead($title, $description, $keywords);

printHeader();

$category = strtolower($_GET['cat']);

$sql = "select * from checklist where category = '$category' order by id asc";
$result = $mysqli->query($sql);

$unsaved_sql = "select * from homesites where category = '$category' and crew_leader IS NULL";
$unsaved = $mysqli->query($unsaved_sql);
?>
<style>

body #checkListForm #section-1 .content-section label.checkboxWrapper {
    margin-top: 15px;
    font-size: 20px;
}
</style>
    <!--==============================content================================-->
    <section id="content">
        <div class="container_12">
            <div class="grid_12">
                <div class="pad-0 border-1">
                    <div id="checkListForm">
                    <div id="section-3" style="display:none;">
                        
                        <h2 class="top-1 p0">In Progress <?php echo ucfirst($category); ?></h2>

                        <ul class="sorting">
                            <li onclick="sortSavedItems('asc')">
                                <img src="/images/up.png" />
                            </li>
                            <li onclick="sortSavedItems('desc')">
                                <img src="/images/down.png" />
                            </li>
                        </ul>
                            <ul class="unsaved">
                                <li class="checkboxWrapper">
                                    <span>Site</span> Last Updated
                                <li>
                            </ul>
                            <ul class="unsaved content-section">
                                <?php
                                if ($unsaved->num_rows > 0) {
                                    // output data of each row
                                    while ($skirt = $unsaved->fetch_assoc()) {
                                        ?>
                                        <li class="checkboxWrapper unsavedItemsText">
                                            <span><?= $skirt["homesite"]; ?></span> <?php echo date('m/d/Y', strtotime($skirt["submission"])); ?>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </ul>
                        
                        </div>
                        <div id="section-1">
                            <div class="content-section right-m">
                                <label class="checkboxWrapper cstCheckBoxW">
                                    <?php if($category == 'homesite'): ?>
                                        Home Site
                                    <?php else: ?>
                                        Skirting Site
                                    <?php endif; ?></label>
                                <input style="margin-top:20px" type="text" class="home_site" name="home_site">
                                <?php if($category == 'homesite'): ?>
                                    <input type="hidden" id="category" value="homesite">
                                <?php else: ?>
                                    <input type="hidden" id="category" value="skirting">
                                <?php endif; ?>
                                <input type="hidden" id="home_site_id" value="">
                                <button class="savedItems" onclick="$('#section-1, #section-1').hide();$('#section-3').fadeIn();">
                                    In Progress
                                    <?php if($category == 'homesite'): ?>
                                        Homesites
                                    <?php else: ?>
                                    Skirtings
                                    <?php endif; ?></label>
                                </button>
                            </div>
                            <button class="next">
                                Next
                            </button>
                        </div>

                        <div id="section-2">
                        <p class="red-color"<sup>*</sup> Data is Autosaved</p>
                        <p>*Upon submission, the data would not be displayed under the "In Progress" tab</p>
                        <br>
                                                    <h2 class="top-1 p0">Checklist</h2>
                            <div class="content-section">

                                <?php
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <label class="checkboxWrapper">
                                            <input id="check<?= $row["id"]; ?>" type="checkbox" name="checklist_items[]" value="<?= $row["id"]; ?>">
                                            <?= $row["check_text"]; ?>
                                        </label>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $mysqli->close(); ?>

                                <div class="sendComments">
                                    <h2 class="top-1 p0">Comments</h2>
                                    <div class="commentBox">
                                    </div>
                                    <div class="comment_Addition">
                                    <label class="checkboxWrapper cstCheckBoxW">
                                        Write your comments
                                    </label>
                                    <form id="commentsForm" method='post' action=''>
                                            <textarea name="comments" id="comments" placeholder="Add a Comment!"></textarea>
                                            <input type="button" id="submitHomesiteComments" value='Post'>
                                    </form>
                                </div>
                                </div>

                                <div class="uploadImages">
                                    <h2 class="top-1 p0">Images</h2>
                                    <div id='preview'></div>
                                    <label class="checkboxWrapper cstCheckBoxW">
                                        Upload Images
                                    </label>
                                    <form id="extraImages" method='post' action='' enctype="multipart/form-data">
                                        <label class="upload_FileLabel" for="files"><img src="images/upload.png" title="upload images" class="uplaod_Image" /></label>
                                        <input type="file"  class="sbmt-ClassCount" id="files" multiple name="files" accept="image/*" style="display:none"/>
                                        <input type="button" id="submitHomesiteImages" value='Upload Images'>
                                        <span id="numOfCount"></span>
                                        <div class="loader-imgChklst"></div>
                                    </form>
                                </div>

                            </div>

                            <div class="clear"></div>
                            <div class="left-form m-leftform">
                                <div>
                                    <label class="checkboxWrapper">Crew leader:</label>
                                    <input type="text" class="crew_leader" name="crew_leader" />
                                </div>
                            </div>
                            <div class="right-form m-rightform">
                                <div>
                                    <label class="checkboxWrapper">Date:</label>
                                    <input type="date" id="submission" name="submission">
                                </div>
                                <button type="submit" onclick="submitHomesiteChecklist()" class="btn-r">Submit</button>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>

    </section>

    <style>
        #preview img {
            margin: 5px;
    object-fit: contain;
    background: #12121217;
        }
        
@media (max-width: 768px) {
    #checkListForm .m-leftform {margin-right:20px;}
    #preview img {
        width:90%;
        }
}
    </style>

    <script>
        $(document).ready(function() {

            $('.sbmt-ClassCount').on('change', function(){
                $('#numOfCount').text("File(s) Selected.")
            })

            $('#submitHomesiteComments').click(function(){

                var form_data = new FormData();
                var comment = $('#comments').val();
                $('#commentsForm')[0].reset();


                if(comment.length < 1) {
                    alert('Write the comments first');
                    return;
                }

                form_data.append('action',      'homeSiteComments');
                form_data.append('comments',    comment);
                form_data.append('id',          $('#home_site_id').val());

                $('.commentBox').append('<div class="each_Comment"><div class="head"><img src="images/comment-user.png"><span id="Name_Comment">Just posted...</span><span id="Date_Comment"></span></div><div class="body"><p class="message_Comment">' + comment + '</p></div></div>');

                // AJAX request
                $.ajax({
                    url: 'checklistPost.php',
                    type: 'post',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('.commentBox').append('<div class="each_Comment"><div class="head"><img src="images/comment-user.png"><span id="Name_Comment">Just posted...</span></div><div class="body"><p class="message_Comment">' + comment + '</p></div></div>');

                    }
                });

            });

            // $('.del-prevImg').click(function(e) {
            $(document).on("click",".del-prevImg",function() {
                var form_data = new FormData();

                form_data.append('action',      'deleteImage');
                form_data.append('image',       $(this).data('name'));
                form_data.append('site',        $('#home_site_id').val());

                var key = $(this).data('key');
                $('.key'+key).fadeOut();
                $('.key'+key).remove();

                // AJAX request
                $.ajax({
                    url: 'checklistPost.php',
                    type: 'post',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('.commentBox').append('<div class="each_Comment"><div class="head"><img src="images/comment-user.png"><span id="Name_Comment">Just posted...</span></div><div class="body"><p class="message_Comment">' + comment + '</p></div></div>');

                    }
                });

            });

            $('#submitHomesiteImages').click(function(){

                var form_data = new FormData();

                // Read selected files
                var totalfiles = document.getElementById('files').files.length;

                var preview_images = parseInt($('#preview img').length);

                var total = totalfiles + preview_images;

                if(total > 5) {
                    alert('Sorry, you can not upload images more than five');
                    return;
                }

                for (var index = 0; index < totalfiles; index++) {
                    form_data.append("files[]", document.getElementById('files').files[index]);
                }
                form_data.append('action', 'upload_images');
                form_data.append('id', $('#home_site_id').val());
                $('#preview').empty();
                $('#extraImages')[0].reset();

                // AJAX request
                $.ajax({
                    url: 'checklistPost.php',
                    type: 'post',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $('.loader-imgChklst').show();
                    },
                    success: function (response) {
                        $('.loader-imgChklst').hide();
                        for(var index = 0; index < response.length; index++) {
                            var src = response[index];
                            $('#preview').append('<div class="container_PrevImg key'+index+'just"><span class="del-prevImg" data-name="'+src+'" data-key="'+index+'just" title="Remove Image"></span><img src="images/uploads/'+src+'" width="200px;" height="200px"></div>');
                        }

                    }
                });

            });

        });
    </script>

<?php printFooter(); ?>
