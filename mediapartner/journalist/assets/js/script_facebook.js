var email_fb_globe = "";
var name           = "";

$(document).ready(function ()
{
	$("#facebook").click(function ()
	{
		console.log('isi email from facebook btn :' + email_fb_globe);

		if (email_fb_globe != "")
		{
			console.log('here...1');
			// $.ajax
			// ({
			//     type  : "POST",
			//     url   : "api_mf/development.php",
			//     data  : "type=reqchelogfb"+"&name="+name+"&email="+email_fb_globe,
			//     dataType: "JSON",
			//     cache   : false,
			//     success : function(JSONObject)
			//     {
			//         for (var key in JSONObject)
			//         {
			//           if(JSONObject.hasOwnProperty(key))
			//           {
			//             if((JSONObject[key]["type"])=="reschelogfb")
			//             {
			//                 if((JSONObject[key]["registered"])=="true")
			//                 {
			//                 }
			//             }
			//           }
			//         }
			//     }
			// });
			// return false;
		}
		else
		{
			console.log('here...2');
			Login();
		}
	});
});


function Login()
{
	FB.login(function (response)
	{
		if (response.authResponse)
		{
			getUserInfo();
			console.log('message from getUserInfo');
		}
		else
		{
			console.log('Authorization failed.');
		}
	}, {scope: 'email'});
}


function getUserInfo()
{
	FB.api('/me', {fields: 'id,name,email'}, function (response)
	{
		var name     = response.name;
		var email_fb = response.email;
		console.log("getting email in first run from getUserInfo :" + response.email);
		$.ajax
		({
			type    : "POST",
			url     : "API_journalist/api_journalist.php",
			data    : "type=reqregfbakun" + "&name=" + name + "&email=" + email_fb,
			dataType: "JSON",
			cache   : false,
			async   : false,
			success : function (JSONObject)
			{
				console.log('execute in ajax response');
				for (var key in JSONObject)
				{
					if (JSONObject.hasOwnProperty(key))
					{
						if ((JSONObject[key]["type"]) == "resregfbakun")
						{
							if ((JSONObject[key]["state"]) == "true")
							{
								//$('#modalLogin').modal('hide');
								//location.reload();
								document.location.href="main";
							}
						}
					}
				}
			}
		});
		return false;
	});
}


window.fbAsyncInit = function ()
{
	FB.init
	({
		appId     : '1319418264846494',
		channelUrl: 'http://mediapesona.com/login.php',
		cookie    : true,
		xfbml     : true,
		version   : 'v2.5'
	});

	FB.getLoginStatus(function (response)
	{
		if (response.status === 'connected')
		{
			FB.api('/me', {fields: 'id,name,email'}, function (response)
			{
				var email_fb = response.email;
				var name     = response.name;
				console.log("after refresh, get email if user is login : " + email_fb);
			});
		}
		else
		{
			//user is not authorized
		}
	});

	FB.Event.subscribe('auth.login', function (response)
	{
		FB.api('/me', {fields: 'id,name,email'}, function (response)
		{
			var name     = response.name;
			var email_fb = response.email;
			console.log("getting email after click login button :" + response.email);

			if (email_fb === undefined)
			{

			}
			else
			{
				// $.ajax
				// ({
				// 	type    : "POST",
				// 	url     : "api_mf/development.php",
				// 	data    : "type=reqchelogfb" + "&name=" + name + "&email=" + email_fb,
				// 	dataType: "JSON",
				// 	cache   : false,
				// 	success : function (JSONObject)
				// 	{
				// 		for (var key in JSONObject)
				// 		{
				// 			if (JSONObject.hasOwnProperty(key))
				// 			{
				// 				if ((JSONObject[key]["type"]) == "reschelogfb")
				// 				{
				// 					if ((JSONObject[key]["registered"]) == "true")
				// 					{
				// 						if ((JSONObject[key]["genre"]) == "")
				// 						{
				// 							console.log('show genre modal');
				// 						}
				// 						else
				// 						{
				// 							location.reload();
				// 						}
				//
				// 					}
				// 				}
				// 			}
				// 		}
				// 	}
				// });
				// return false;
			}

		});
		//location.reload();
	});

};


(function (d, s, id)
{
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id))
	{
		return;
	}
	js     = d.createElement(s);
	js.id  = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));