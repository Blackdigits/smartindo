$(document).ready(function() {
    reload_table();
    $('select').selectize({
        sortField: 'text'
    });

    $('select').change(function() {
        var thevalue = $(this).val();
        var target = 'ajax/' + $(this).attr('id');
        var text = this.options[this.selectedIndex].text;
        $.ajax({
            url: target + '.php',
            type: "get",
            data: {
                "value": thevalue,
                "text": text
            },
            dataType: "html",
            success: function(data) {
                if (target == "ajax/select-product") {
                    $("#selling").html($(data).append(data)); 
                    $("#qty").attr({
                        "value": $("#quantity").val(), 
                        "max": $("#quantity").val(),
                        "min": 0,
                    });
                }
                console.log(data);
            }
        });
    });
    $('#select-product').change(function() {
        var idp = $(this).val();
        var element = $(this).find('option:selected');
        var myTag = element.attr("data");
        $.ajax({
            url: 'ajax/select-price.php',
            type: "get",
            data: {
                "idp": idp
            },
            dataType: "html",
            success: function(data) {
                console.log(data);
                $("#selected-product").html($(data).append(data));
                $('select').selectize({
                    sortField: 'text'
                });
                $('#label-harga').css('display', 'block');
                $('#label-qty').css('display', 'block');
            }
        });
    }); 
});

var $rows = [];
$(function() {
    $('#tableSelected').TableSelection({
        sort: false, // sort or not (true | false)
        status: 'multiple', // single or multiple selection (default is 'single')
    }, function(obj) { // callback function return selected rows array
        $rows = obj.rows;
    });

});

function showSelectedRow(array) {
    $.each(array, function(i, row) {
        sessionStorage.removeItem($('#tableSelected').RowValue(row).find('input').eq(0).val());
        $('#tableSelected').RowValue(row).remove();
    });
    reload_table();
}

function reload_table() {
    var subtotal = 0;
    if (sessionStorage.length > 0) {
        $("#tableSelected > tbody").empty();
        $("#hapus").show();
    }
    var tbodyRef = document.getElementById('tableSelected').getElementsByTagName('tbody')[0];
    for (var i = 0; i < sessionStorage.length; i++) {
        var data = JSON.parse(sessionStorage.getItem(sessionStorage.key(i)));
        $("#tableSelected").find('tbody').append("<tr><td style='display: none;'><input type='hidden' value='" + sessionStorage.key(i) + "'></td><td>" + data[1] + "</td><td>" + data[2].toLocaleString('id-ID') + "</td><td>" + data[3] + "</td></tr>");
        subtotal = subtotal + (data[2] * data[3]);
    }
    document.getElementById('substotal').value = subtotal;
    document.getElementById("totale").value = subtotal;
    if (subtotal > 0) {
        document.getElementById("konfir").disabled = false;
        document.getElementById("konfir").style.backgroundColor = "lightgreen";
    } else {
        document.getElementById("konfir").disabled = true;
        document.getElementById("konfir").style.backgroundColor = "grey";
    }
}

function selling() {
    var jumlah = parseInt(document.getElementById("qty").value);
    var batas = document.getElementById("quantity").value;
    if (jumlah <= batas) {
        var e = document.getElementById("select-product");
        var idp = parseInt(e.value);
        var namaproduk = e.options[e.selectedIndex].text;
        var harga = parseInt(document.getElementById("select-price").value);
        let pcode = namaproduk.slice(0, 5);
        let namap = namaproduk.substring(5);
        sessionStorage.setItem(pcode, JSON.stringify([idp, namap, harga, jumlah])); // idp and pcode can be rotate
        location.href = '#';
        reload_table();
    } else {
        alert('Jumlah melebih stok kamu yang tersedia');
    }
}

function diskon() {
    if (document.getElementById('cek-diskon').checked) {
        var diskon = document.getElementById("dengan-rupiah").value;
    } else {
        var diskon = 0;
    }
    var subtotal = document.getElementById("substotal").value;
    document.getElementById("disc").value = diskon;
    var total = subtotal - diskon;
    document.getElementById("totale").value = total.toLocaleString("id-ID");
}

function pajak() {
    var diskon = document.getElementById("dengan-rupiah").value;
    var subtotal = document.getElementById("substotal").value;
    if (document.getElementById('cek-pajak').checked) {
        var pajak = (subtotal - diskon) * 0.11;
    } else {
        var pajak = 0;
    }
    document.getElementById('pajak').innerHTML = "Rp " + pajak.toLocaleString("id-ID");
    var total = subtotal - diskon + pajak;
    document.getElementById("totale").value = total
}

function myFunction() {
    var x = document.getElementById("dengan-diskon");
    if (x.style.display === "none") {
        x.style.display = "block";
        x.childNodes[1].value = "";
    } else {
        x.childNodes[1].value = "0";
        x.style.display = "none";
    }
    diskon();
}