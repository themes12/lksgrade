jQuery.post('show_data.php', {
    'data': JSON.stringify(localStorage.getItem('grade'))
});
