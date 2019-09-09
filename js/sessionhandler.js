function setCookie(llname,value) {
var now = new Date();
var time = now.getTime();
time += 3600 * 1000;
now.setTime(time);
expires = "; expires=" + now.toUTCString();
document.cookie = llname + "=" + (value || "")  + expires + "; path=/"; // add secure andd HttpOnly tag if lets encrypt was set" secure";
}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

function cookieExists(cname) {
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + cname + '=([^;]*)'));
    var unformated = match ? match[1] : null;
    if (unformated != null && unformated != "") {
      return true;
    } else {
      return false;
    }
}


/*
function checkCookie() {
  var user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}*/
