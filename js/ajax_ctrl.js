function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    console.log(out);

    // or, if you wanted to avoid alerts...

    // var pre = document.createElement('pre');
    // pre.innerHTML = out;
    // document.body.appendChild(pre)
}
//paing call. login_check(passible)
function ajax_call(method, action_url, form_data, sc_fc){
	$.ajax({
		type : method,
		url : action_url,
		dataType : 'json',
		data : form_data,
		success : function(data){
			if(data.status == 200){
				if(sc_fc) sc_fc(data);
			}
			if(data.status == 401){
				window.location.replace('/token_error.php');
			}
		},
		error : function(data){
			console.log("paing call error"+dump(data));
			window.location.replace('/template/error.html');
		}
	});
}



function login_check(method, action_url, form_data){
	$.ajax({
		type : method,
		url : action_url,
		dataType : 'json',
		data : form_data,
		success : function(data){
			console.log(data)
			if(data.status != 200){
				window.location.replace('/template/login.html');
			}
		},
		error : function(data){
			console.log("login_check error"+dump(data));
			window.location.replace('/template/error.html');
		}
	});
}

function auto_login(method, action_url, form_data){
	$.ajax({
		type : method,
		url : action_url,
		dataType : 'json',
		data : form_data,
		//이렇게 아래와 한줄만 다름... 이럴때는 어떻게 하는 것이 좋은가?
		success : function(data){
			if(data.status == 200){
				window.location.replace('/template/menu.html');
			}
		},
		error : function(data){
			console.log("auto_login error"+dump(data));
			window.location.replace('/template/error.html');
		}
	});
}

function login_ajax(method, action_url, form_data){
	$.ajax({
		type : method,
		url : action_url,
		dataType : 'json',
		data : form_data,
		success : function(data){
			if(data.status == 200){
				window.location.replace('/template/menu.html');
			}else{
				$("#message").html("<p styple='color:green; font-weight:bold'>아이디 또는 비밀번호가 틀렸습니다.</p>")
			}
		},
		error : function(data){
			console.log("login_ajax error"+dump(data));
			window.location.replace('/template/error.html');
		}
	});
}