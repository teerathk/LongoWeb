$(document).ready(function () {
    
    $('.unsavedItemsText').on('click', function(e) {
        
         var text = $(this).children('span').text();
         var trimText = $.trim(text);
         $('.home_site').val(trimText);
         $('#section-3').hide();
         $(".next").click();
         return;
         
    });

    $(".next").click(function (e) {

        var home_site = $('.home_site').val().toLowerCase();
        var category = $('#category').val().toLowerCase();

        if(home_site.length < 1) {
            alert('Please, fill the home site input');
            return;
        }

        $.ajax({
            url: "checklistPost.php?action=homeSiteCheck&home_site=" + home_site + "&category="+ category,
            method: "GET",
            success: function (response) {
                var res = JSON.parse(response);
                $('#home_site_id').val(res.homesite);
                if(res.checks) {
                    $.each(res.checks, function (index, value) {
                        $('#check'+value.check_id).prop('checked', true);
                        $('#check'+value.check_id).prop('disabled', true);
                    });
                }

                if(res.site_images) {

                    var images = JSON.parse(res.site_images);

                    $.each(images, function (index, value) {
                        $('#preview').append('<div class="container_PrevImg key'+index+'"><span class="del-prevImg" data-name="'+value+'" data-key="'+index+'" title="Remove Image"></span><img src="images/uploads/'+value+'" width="200px;" height="200px"></div>');
                    });
                }

                if(res.rows_comment) {

                    $.each(res.rows_comment, function (index, value) {
                        // $('.commentBox').append('<p>'+ value.comment +'</p>');
                        $('.commentBox').append('<div class="each_Comment"><div class="head"><img src="images/comment-user.png"><span id="Name_Comment">' + value.created_at + '</span><span id="Date_Comment"></span></div><div class="body"><p class="message_Comment">' + value.comment + '</p></div></div>');

                    });
                }
            }
        });

        $("#section-2").show();
        $("#section-1").hide();
        $(".next").hide();

        return;
    });

    $(".checkboxWrapper input[type=checkbox]").change(function (e) {

        var home_site   = $('#home_site_id').val();
        var process     = 'del';
        var checkbox    = $(this).val();

        if (this.checked) {
            process = 'add';
        }

        $.ajax({
            url: "checklistPost.php?action=postChecklist&home_site="+home_site+"&checkbox="+checkbox+"&process="+process,
            method: "GET",
            success: function (response) {
                console.log(response);
            }
        });

    });

});

function sortSavedItems(type = 'asc')
{
     var order = type;
      var mylist = $('ul.content-section');
      var listitems = mylist.children('li').get();
      listitems.sort(function(a, b) {
          if(order == 'asc') {
                return $(a).text().toUpperCase().localeCompare($(b).text().toUpperCase());
          } else {
                return $(b).text().toUpperCase().localeCompare($(a).text().toUpperCase());
          }
      })
      $.each(listitems, function(idx, itm) {
        mylist.append(itm);
      });
}

function submitHomesiteChecklist()
{
    /* if(!confirm('All the checked items will be disabled, do you want to continue?')) {
        return;
    } */

    if($('.checkboxWrapper input:checkbox:not(:checked)').length) {
        alert('Please check all the checkboxes before you save the report.');
        return;
    }

    var submission  = $('#submission').val();
    var crew_leader = $('.crew_leader').val();
    var site_name   = $('.home_site').val();
    var category    = $('#category').val();

    if(submission.length < 1 || crew_leader.length < 1) {
        alert('Please Enter Crew Leader and/or Date Information');
        return;
    }

    var home_site   = $('#home_site_id').val();

    window.open("checklistPost.php?action=submitHomeSiteCheckList&submission="+submission+"&crew_leader="+crew_leader+"&home_site="+home_site+"&name="+site_name+"&category="+category, '_blank');
    location.reload();
}


