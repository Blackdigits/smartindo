const rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR"
    }).format(number);
}
function setCookie(cName, cValue, expDays) {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

function snackbar() {  var snackbar = document.getElementById("snackbar");  snackbar.className = "show"; 
setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);  }

$(document).ready(function(){
    $('#data').after('<div id="nav"></div>');
    var rowsShown = 10;
    var rowsTotal = $('#data tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#tokod" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#data tbody tr').hide();
    $('#data tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});

$(document).ready(function(){
    $('#datas').after('<div id="nav"></div>');
    var rowsShown = 10;
    var rowsTotal = $('#datas tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#tokos" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#datas tbody tr').hide();
    $('#datas tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#datas tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});

$(document).ready(function(){
    $('#datad').after('<div id="nav"></div>');
    var rowsShown = 10;
    var rowsTotal = $('#datad tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#toko" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#datad tbody tr').hide();
    $('#datad tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#datad tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});
function balancing() {
$.ajax({
    url: 'ajax/bill_of_leading.php?function=rebalancing',
    type: "POST",
    data: {
        "id": <?= $sid ?> 
    },
    dataType: "json",
    success: function(data) { 
            console.log(data);
            var balance = rupiah(data.balance)
            document.getElementById("balance").innerHTML = balance;
            setCookie('balance', data.balance, 1);
            snackbar();
        }  
});
}