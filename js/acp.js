function validate()
{
var x=document.forms["adv_form"]["ACP_advance_settings[post_record]"].value;
if (x==null || x=="")
  {
  alert("Post record must be filled out");
  return false;
  }
  
var r = document.getElementsByName("ACP_advance_settings[category]")
var c = -1

for(var i=0; i < r.length; i++){
   if(r[i].checked) {
      c = i; 
   }
}
if (c == -1)
{
	 alert("please select at least one option in category");
	 return false;
}

var a = document.getElementsByName("ACP_advance_settings[interval]")
var b = -1

for(var j=0; j < a.length; j++){
   if(a[j].checked) {
      b = j; 
   }
}
if (b == -1)
{
	 alert("please select at least one option in Interval");
	 return false;
}

}

function show()
{ 
	document.getElementById('custom_int').style.display = 'block'; 
}

function hide()
{
	document.getElementById('custom_int').style.display = 'none';
}

function show2()
{ 
	document.getElementById('category_name').style.display = 'block'; 
}

function hide2()
{
	document.getElementById('category_name').style.display = 'none';
}
function show3()
{ 
	document.getElementById('cselect').style.display = 'block'; 
}

function hide3()
{
	document.getElementById('cselect').style.display = 'none';
}