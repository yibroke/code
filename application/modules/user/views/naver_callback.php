<!doctype html>
<html lang="ko">
<head><script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<script type="text/javascript">
     var base_url = "<?php echo base_url(); ?>";
  var naver_id_login = new naver_id_login("lOM32aEk7Rh4lwbhObxt", "http://wellbeingbox.co.kr/");
  // 접근 토큰 값 출력
  //alert(naver_id_login.oauthParams.access_token);
  // 네이버 사용자 프로필 조회
  naver_id_login.get_naver_userprofile("naverSignInCallback()");
  // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
  function naverSignInCallback() {
    //alert(naver_id_login.getProfileData('email'));
   // alert(naver_id_login.getProfileData('nickname'));
  //  alert(naver_id_login.getProfileData('age'));
     //Codeigniter session set up.
                var user_name =naver_id_login.getProfileData('nickname');
                var user_id =naver_id_login.getProfileData('email');
                 if (user_name === null || user_name === "underfined"|| user_name === ""||user_id === null || user_id === "") {
                    alert("Naver Login Error");
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
                         }else{
                                console.log('not work');
			        alert(data);
			}
                 }
	 });// end ajax
  }
</script>
</body>
</html>
	