
function verifyName () {
	var myform = document.getElementById("registerform");
      var name = myform.nickname.value;
      var reg=/^\w{1,10}$/;
      if(reg.test(name)==false)
      {
        nameDiv.innerHTML = "<font color='red'>昵称不超过10位（数字、英文、下划线）</font>";
        return false;
      }
      else {
      	 nameDiv.innerHTML = " ";
      	 return true;
      }
}

function verifyEamil(){
	var myform = document.getElementById("registerform");
      var email = myform.email.value;
      var reg=/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/; 
      if(reg.test(email)==false)
      {
        emailDiv.innerHTML = "<font color='red'>请输入正确的邮箱格式</font>";
        return false;
      }
      else {
      	 emailDiv.innerHTML = " ";
      	 return true;
      }
}
function verifyPsw1(){
	var myform = document.getElementById("registerform");
      var psw1 = myform.psw1.value;
      var reg=/^[a-zA-Z0-9]{4,10}$/;
      if(reg.test(psw1)==false)
      {
        psw1Div.innerHTML = "<font color='red'>密码不能含有非法字符，长度在4-10之间</font>";
       return false;
      }
      else {
      	psw1Div.innerHTML = " ";
      	return true;
      }
}
function verifyPsw2(){
	var myform = document.getElementById("registerform");
      var psw1 = myform.psw1.value;
      var psw2 = myform.psw2.value;
      if(!(psw2==psw1))
      {
        psw2Div.innerHTML = "<font color='red'>两次输入密码不一致</font>";
        return false;
      }
      else {
      	psw2Div.innerHTML = " ";
      	return true;
      }
}

function submitRegister(){
	var myform = document.getElementById("registerform");
	if(verifyName()&&verifyEamil()&&verifyPsw1()&&verifyPsw2()){
		return true;
	}
	else {
		alert("请正确填写后再提交信息");
		return false;
	}
}
function submitLogin(){
	if(verifyName ()&&verifyPsw1()){
		return true;
	}
	else {
		alert("请正确填写后再提交信息");
		return false;
	}
}

var countdown=60; 
function sendcode() {
	var email=document.getElementById("email"); 
	if(email.value==""){
		alert("请输入邮箱后点击");
		return;
	}
 timer=setTimeout("",0);	
	var btn=document.getElementById("btn"); 
	if (countdown == 0) { 
	clearTimeout(timer);
	btn.removeAttribute("disabled");    
	btn.value="发送验证码"; 
	countdown = 60; 
	return;
	} else { 

	btn.disabled=1;
	btn.value= countdown + "s"; 
	countdown--; 
	} 
	timer=setTimeout( "sendcode()" ,1000) ;
} 