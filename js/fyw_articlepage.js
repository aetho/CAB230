/* JS article page FyW */

/* GLOBAL VARIABLES */

/* We are declaring as global variables two strings with the wifi name and location this pages is about 
var str_name = 'Name1';
var str_location = 'Addresnumber1'; 

/* -------------- */


write_name_location('Name1', 'Addresnumber1');

function write_name_location(str_nam, str_loc){
	console.log(str_nam);
	console.log(str_loc);
	var name = document.getElementById('insert_name');
	name.innerHTML = str_nam;
	var loc = document.getElementById('insert_location');
	loc.innerHTML = str_loc;
}

/* DEBUG */
function times2(number) {
	console.log(number*2);
}
/*---*/

function show_rvw() {
	
	var rvw_div = document.getElementById('reviews');
	var see_rvw = document.getElementById('see_rvw');
	var close_rvw = document.getElementById('close_rvw');
	
	see_rvw.style.display = "none";
	close_rvw.style.display = "inline-block";
	rvw_div.style.display = "block";

}

function hid_rvw() {
	 
	 var rvw_div = document.getElementById('reviews');
	 var see_rvw = document.getElementById('see_rvw');
	 var close_rvw = document.getElementById('close_rvw');
	 
	 see_rvw.style.display = "inline-block";
	 close_rvw.style.display = "none";
	 rvw_div.style.display = "none";
}
	 
	 