
// harddisk gb number only
$('#harddisk').keypress(function (e) {
  var txt = String.fromCharCode(e.which);
  if (!txt.match(/[0-9]/)) {
    return false;
  }
});

// internet speed mbps number only
$('#internetspeed').keypress(function (e) {
  var txt = String.fromCharCode(e.which);
  if (!txt.match(/[0-9]/)) {
    return false;
  }
});

//input mask bundle ip address
var ipv4_address = $('#ipv4');
ipv4_address.inputmask({
  alias: "ip",
  greedy: false //The initial mask shown will be "" instead of "-____".
});

//input mask bundle subnet
var subnet_mask = $('#subnet');
subnet_mask.inputmask({
  alias: "ip",
  greedy: false //The initial mask shown will be "" instead of "-____".
});

//input mask bundle default gateway
var default_gateway = $('#defaultgateway');
default_gateway.inputmask({
  alias: "ip",
  greedy: false //The initial mask shown will be "" instead of "-____".
});

//input mask bundle dns server
var dns_server = $('#dnsserver');
dns_server.inputmask({
  alias: "ip",
  greedy: false //The initial mask shown will be "" instead of "-____".
});

//asset caterory filter

$(function () {
  $('#asset').change(function () {
    $('#demo-form2')[0].reset();
    if ($('#asset').val() == 'komputer') {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).show();
      $('#usetype-div',).show();
      $('#shared-div',).show();
      $('#button-div',).show();
      $('#pconly-div',).show();
      $('#printer-div',).hide();
      $('#scanner-div',).hide();
      $('#network-div',).hide();
     
    }
    else if ($('#asset').val() == 'monitor') {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).show();
      $('#usetype-div',).show();
      $('#shared-div',).show();
      $('#button-div',).show();
      $('#pconly-div',).hide();
      $('#printer-div',).hide();
      $('#scanner-div',).hide();
      $('#network-div',).hide();
    }
    else if ($('#asset').val() == 'printer') {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).show();
      $('#usetype-div',).show();
      $('#shared-div',).show();
      $('#pconly-div',).hide();
      $('#printer-div',).show();
      $('#button-div',).show();
      $('#scanner-div',).hide();
      $('#network-div',).show();
    }
    else if ($('#asset').val() == 'scanner') {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).show();
      $('#usetype-div',).show();
      $('#shared-div',).show();
      $('#pconly-div',).hide();
      $('#button-div',).show();
      $('#scanner-div',).show();
      $('#printer-div',).hide();
      $('#network-div',).show();
    }
    else if ($('#asset').val() == 'ups') {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).show();
      $('#usetype-div',).show();
      $('#shared-div',).show();
      $('#pconly-div',).hide();
      $('#button-div',).show();
      $('#scanner-div',).hide();
      $('#printer-div',).hide();
      $('#network-div',).hide();
    }
    else if ($('#asset').val() == 'avr') {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).show();
      $('#usetype-div',).show();
      $('#shared-div',).show();
      $('#pconly-div',).hide();
      $('#button-div',).show();
      $('#scanner-div',).hide();
      $('#printer-div',).hide();
      $('#network-div',).hide();
    }
    else if ($('#asset').val() == 'lcd') {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).show();
      $('#usetype-div',).show();
      $('#shared-div',).show();
      $('#pconly-div',).hide();
      $('#button-div',).show();
      $('#scanner-div',).hide();
      $('#printer-div',).hide();
      $('#network-div',).hide();
    }
    else {
      $('#demo-form2')[0].reset();
      $('#assetform-div',).hide();
      $('#usetype-div',).hide();
      $('#shared-div',).hide();
      $('#pconly-div',).hide();
      $('#button-div',).hide();
      $('#scanner-div',).hide();
      $('#printer-div',).hide();
      $('#network-div',).hide();
    }
  });
});

//usetype cat
$(function () {
  $('#usetype').change(function () {
    selection = $(this).val();
    switch (selection) {
      case 'Individu':
        $('#individu-select').show();
        break;
      default:
        $('#individu-select').hide();
        break;
    }
  });
});



//asset caterory filter
//$(document).ready(function () {
  //$("#asset").change(function () {
    //$(this).find("option:selected").each(function () {
      //var optionValue = $(this).attr("value");
      //if (optionValue) {
       // $(".form").not("." + optionValue).hide();
        //$("." + optionValue).show();
      //} else {
        //$(".form").hide();
      //}
    //});
  //}).change();
//});
