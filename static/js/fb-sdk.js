
 window.fbAsyncInit = function() {
    FB.init({
      appId      : '455936817922541',
      xfbml      : true,
      version    : 'v2.4'
    });

    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            console.log('connected');
        } else if (response.status === 'not_authorized') {
            console.log('not_authorized');
        } else if (response.status === "unknown"){
            console.log('unknown....!!');
        } else {
        	console.log('none');
        }
    });
};

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        testAPI();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into Facebook.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}
//checkLoginState();
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);
    });
}

function fb_login() {
	console.log("fb_login access");
    FB.login(function(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            console.log('login: connected');
            FB.api('/me?fields=id,name,picture,email', function(user) {

				$.ajax({
					method: "POST",
					url: "/wordForYou/auth/signIn/facebook",
					data: { key: user['id'], email: user['email'], profile_img: user['picture']['data']['url'], nickname: user['name']},
					async: false,
					success: function(data, text, jqXHR) {
						location.href="/wordForYou";
					},
					error: function(jqXHR, status, errThrown) {
                        console.log(jqXHR.responseText);
						alert(jqXHR.responseText);
					}
				});
            });
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('login: not_authorized');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('login: login fail');
        }
    });
}

function fb_logout() {
    FB.logout(function(response) {
        // Person is now logged out
    });
}