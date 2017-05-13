$(document).ready(function () {
    
    //begin form post Comment

    $('#form_post_comment').submit(function (event) {
        event.preventDefault();
        var value = CKEDITOR.instances['content'].getData();

        $.ajax({
            url: base_url+'comment/comment_validation',
            type: 'post',
            data: {
                content: value,
                topic_id: $('#topic_id').val()

            },
            beforeSend: function () {
                $('#load').show();
            },
            complete: function () {
                $('#load').hide();

            },
            error: function () {
                $('#myerror').html('Error');
            },
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.success === true) {
                    $('ol#update').prepend(jsonData.data);
                    $('ol#update li:first').slideDown('slow');
                    CKEDITOR.instances.content.setData('');
                } else {
                    $('#myerror1').html(jsonData.data);
                }

            }

        });//end ajax comment

    });//end form comment topic 
 $('#form_change_password').submit(function(e){
      e.preventDefault();
              $.ajax({
            url: base_url +'user/change_password_validation',
            type: 'post',
            data: {
                current_password: $('#current_password').val(),
                password: $('#password').val(),
                confirm_password:$('#confirm_password').val()
            },
            beforeSend: function () {
                $('#load').show();
            },
            complete: function () {
                $('#load').hide();
            },
            error: function () {
                $('#myerror').html('Error');
            },
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.success === true) {
                  $('#myerror').html(jsonData.data);
                  $('#form_change_password')[0].reset();
                } else {
                  $('#myerror').html(jsonData.data);
                }
            }
        });//end ajax comment
 });  
// pay
$('input:radio[name="payment"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() === '3') {
           $('#form_paypal').show();
        }else{
            $('#form_paypal').hide();
        }
    });
// end pay
     $('#select_soft_by').change(function(){
     $('#myform').find('[type="submit"]').trigger('click');
  }) ;//end select_soft_by change
        // language
           // $('.reply-link').click(function(e){
             $(document).on('click','.reply-link',function(e){
                e.preventDefault();
                 var parent_id = $(this).attr('data-reply');
                  console.log('parent id: '+parent_id);
                $('.wra-comment'+parent_id).toggle('slow');
            });// end reply show.
            // Send reply
           // $('.send-reply').click(function(){
             $(document).on('click','.send-reply',function(){
               // alert(1);
                 var parent_id = $(this).attr('data-button');
                  console.log('parent id: '+parent_id);
                  var con=$('#reply_content'+parent_id).val();
                  var main_id=$('#main_id').val();
                  console.log('comment:'+con);
                  if($('#comment_user_id').val()===''){
            alert('You are not login yet. We will ');
            return;
        }
       $.ajax({
            url: base_url+'reply/insert_validation',
            type: 'post',
            data: {
                reply: con,
                fk_comment_id:parent_id,
                main_id:main_id
            },
            beforeSend: function () {
                $('#reply_load'+parent_id).show();
            },
            complete: function () {
                $('#reply_load'+parent_id).hide();
            },
            error: function () {
                $('#my_reply_error'+parent_id).html('Error');
            },
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.success === true) {
                    $('ol#update_rep').prepend(jsonData.data);
                    $('ol#update_rep li:first').slideDown('slow');
                     $('#reply_content'+parent_id).val('');
                      $('#my_reply_error'+parent_id).html('');// set errir ti empty
                } else {
                    $('#my_reply_error'+parent_id).html(jsonData.data);
                }
            }
        }); //end ajax comment    
            });
            // end send reply
    //popover bell.
          $('[data-toggle="popover"]').popover();//popover
//body click hide the popover.
 $('body').on('click', function (e) {
    $('[data-toggle=popover]').each(function () {
        // hide any open popovers when the anywhere else in the body is clicked
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});//end body click
     //begin form post Comment
    $('#form_insert_comment').submit(function (event) {
        event.preventDefault();
        if($('#comment_user_id').val()===''){
            alert('You are not login yet. We will ');
            return;
        }
        $.ajax({
            url: base_url +'comment/insert_validation',
            type: 'post',
            data: {
                comment_content: $('#comment_content').val(),
                comment_for_id: $('#comment_for_id').val(),
                comment_user_id:$('#comment_user_id').val()
            },
            beforeSend: function () {
                $('#load').show();
            },
            complete: function () {
                $('#load').hide();
            },
            error: function () {
                $('#myerror').html('Error');
            },
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.success === true) {
                    $('ol#update').prepend(jsonData.data);
                    $('ol#update li:first').slideDown('slow');
                     $('#form_insert_comment')[0].reset();    
                      $('#myerror').html('');// set errir ti empty
                } else {
                    $('#myerror').html(jsonData.data);
                }
            }
        });//end ajax comment
    });//end form comment topic
      //start load more
             $(document).on('click','#loadmore',function(){
                $.ajax({
                    url:base_url+'comment/loadmore',
                    type:'post',
                     beforeSend: function () {
                        $('#load').show();
                    },
                   complete: function ( ) {
                          $('#load').hide();
                  },
                   error: function () {
                         alert('Some error');
                    },
                    data:{
                        offset :$('#offset').val(),
                       question_id:$('#loadmore').val(),
                        total :$('#total').val()
                    },
                      success :function(data){
                       var jsonData = JSON.parse(data);
                      $('#moredata').append(jsonData.view);
                      $('#offset').val(jsonData.offset);
                     $('#total_load').html(jsonData.total);
                      $('#total').val(jsonData.total);
                      if(jsonData.total<=0){
                          $('#loadmore').hide();
                      }
                       }
                });
                   //  $('ol#moredata').prepend('More Data');
                  //  $('ol#moredata li:first').slideDown('slow');
            });//end click
   // Only enable if the document has a long scroll bar
// Note the window height + offset
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}
 //begin register
    $('#form_register').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: base_url + 'user/register_validation',
            type: 'post',
            data: {
                email: $('#email').val(),
                name: $('#name').val(),
                password: $('#password').val(),
                confirm_password: $('#confirm_password').val()
            },
            beforeSend: function () {
                        $('#load').show();
                         $('#myerror').hide();
                    },
                   complete: function ( ) {
                          $('#load').hide();
                           $('#myerror').show();
                  },
                   error: function () {
                         $('#myerror').html('This is not work!');
                    },
            success: function (data) {
                var jsonData=JSON.parse(data);
                if (jsonData.success === true)
                {
                     $('#myerror').html(jsonData.data);
                     $('#form_register').hide();
                }
                else
                {
                    $('#myerror').html(jsonData.data);
                }
            }
        });//end ajax login
    });//end form login
 //begin email form
    $('#email_form').submit(function (event) {
        event.preventDefault();
        $('#myerror').html('');
        $.ajax({
            url: base_url + 'user/email_validation',
            type: 'post',
            data: {
                email: $('#email').val()
            },
            beforeSend: function () {
                        $('#load').show();
                        $('#myerror').hide();
                    },
                   complete: function ( ) {
                          $('#load').hide();
                           $('#myerror').show();
                         
                  },
                   error: function () {
                         $('#myerror').html('This is not work!');
                    },
                success: function (data) {
                var jsonData=JSON.parse(data);
                if (jsonData.success === true)
                {
                   
                   $('#myerror').html(jsonData.data);
                   $('#email_form').hide();
                }
                else
                {
                    $('#myerror').html(jsonData.data);
                }

            }

        });//end ajax login
    });//end form
 //begin reset password form
    $('#form_reset_password').submit(function (event) {
        event.preventDefault();
        $('#myerror').html('');
        $.ajax({
            url: base_url + 'user/reset_password_validation',
            type: 'post',
            data: {
                password: $('#password').val(),
                confirm_password:$('#confirm_password').val(),
                reset_key:$('#reset_key').val()
            },
            beforeSend: function () {
                        $('#load').show();
                        $('#myerror').hide();
                    },
                   complete: function ( ) {
                          $('#load').hide();
                          $('#myerror').show();
                  },
                   error: function () {
                         $('#myerror').html('This is not work!');
                    },
                success: function (data) {
                var jsonData=JSON.parse(data);
                if (jsonData.success === true)
                {
                    alert(jsonData.data)
                   $('#form_reset_password')[0].reset();
                   $('#form_reset_password').hide();
                     window.location.href = base_url+'user/login';
                }
                else
                {
                    $('#myerror').append(jsonData.data).show('slow');
                }

            }

        });//end ajax login
    });//end form
    //begin login
   $('#form_login').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: base_url + 'user/login_validation',
            type: 'post',
            data: {
                email_login: $('#email_login').val(),
                password_login: $('#password_login').val()
            },
            error: function () {
                $('#error_login').html('Error');
            },
            success: function (data) {
                if (data === 'true')
                {
                     window.location.reload(true);
                }
                else
                {
                    $('#error_login').html(data);
                }
            }
        });//end ajax login
    });//end form login
    
//GOOGLE SIGN IN/ LOGIN
//auto sign out when user leave
 $(".call-modal-login").click(function () { // Click to only happen on announce links
            $('#loginModal').modal('show');
        });
  //user logout.     
 $('.user_logout').click(function(){
       $.post( base_url+'user/logout', function( data ) {
       location.reload();  
});
 });// end logout

});//end ready
 //GOOGLE SIGN IN/ LOGIN

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
  //AJAX LOGIN/REGISGER
//Codeigniter session set up.
var user_name =profile.getName();
var user_id =profile.getEmail();
 if (user_name === null || user_name === "underfined"|| user_name === ""||user_id === null || user_id === "") {
    alert("Facebook Login Error");
    return false;
}
  $.ajax({
    url:base_url+'user/fb_login',
    type:'post',
                        data: { 
                                       'user_name': user_name,
                                       'user_id': user_id
                                 },
    success:function(data){
                        if(data==='true'){
       window.location.href = base_url;
        console.log('Work');
         var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
        });

        }else{
        checkLoginState();
        alert(data);
        }
}
});// end ajax
}

// delete reply
//search
    function dosearch()
{
     k= str;
    if(k=='')
    {
        document.getElementById("ketqua").innerHTML="";
        return;
    }
    
     $.ajax({
         
        type:'get',
        url:'include/data.php',
        data:'k='+k,
        
        success: function (data) {
            document.getElementById("ketqua").innerHTML=data;
                  
        }   
    });
   
}
function dokeyup(str)
{
    k= str;
    if(k=='')
    {
        document.getElementById("ketqua").innerHTML="";
        return;
    }
    
     $.ajax({
         
        type:'get',
        url:base_url+'topic/keyup',
        data:'k='+k,
        
        success: function (data) {
            document.getElementById("ketqua").innerHTML=data;
                  
        }   
    });
}
//end search

