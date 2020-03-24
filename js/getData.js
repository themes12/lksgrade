document.getElementById('cpblock2').style.visibility = "hidden";
var table = $('#ContentPlaceHolder1_GridView1').tableToJSON(); // Convert the table into a javascript object
var data = JSON.stringify(table);
sessionStorage.setItem('grade',data);
jQuery.post('show_data.php', {
    'data': localStorage.getItem('grade')
});
console.log(localStorage.getItem('grade'));
window.location.href = 'show_data.php';