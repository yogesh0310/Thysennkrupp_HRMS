// function for opening dialouge box
function openmodal(cid) {
    $("#appending_id").empty()
    $("#appending_id").append("<b id='bid' name='" + cid + "'></b>")
    $("#modal2").modal("open")
}

// function withdraw(confr)
// {
//   var btn_id = $('#bid').attr('name')
//   if(confr)
//   {
//     $.ajax({
//       url:'http://localhost/hrms/api/withdrawposition.php',
//       type:'POST',
//       data:{'id':btn_id},
//       success : function(para)
//       {
//         if(para == "success")
//         {
//           alert("Position Withdrawn Successfully")
//           window.setTimeout(function(){location.reload()},400)
//         }
//         else if(para == "fail")
//         {
//           alert("Position Can't be Withdrawn")
//         }
//         else
//         {
//           alert("Error Occured")
//         }
//       }

//     })  
//   }

// }


function showmodal(x) {
    $("#modalrow").text("")
    $.ajax({
        url: 'http://localhost/hrms/api/getfullprf.php',
        type: 'POST',
        data: {
            'prf': x
        },
        success: function(para) {
            para = JSON.parse(para)
            console.log("this is asdassd", para)
            for (let i = 0; i < para.length; i++) {
                var str = '<td>' + para[i] + '</td>'
                $("#modalrow").append(str)
            }
        }
    })
}



$('#kindlybtn').hide();
$('#selectedrow').hide();


$('#logoutuser').click(function() {

    $.ajax({
        url: "http://localhost/hrms/api/logout.php",
        type: "POST",
        success: function(para) {

            if (para == "success") {
                $("#row").hide()
                $("#logout").show()
                document.location.replace("http://localhost/hrms/index.php")
            } else {
                $("#notlogout").show()
                document.location.replace("/hrms/")
            }
        }

    })

});

var id;

function xyz(x) {

    $('#kindlybtn').show();
    $('#selectedrow').show();
    $("#ordiv").show();
    $(document.getElementById(x)).attr("disabled", "disabled")
    j = x
        // alert(j)
    var res = j.split("*");
    id = '#' + res[0];
    // alert("Here - "+res[0])
    window.prf = res[0]
    window.position = res[1]
    window.zone = res[2]
    window.dept = res[3]
    window.pos = res[4]
    window.status = res[5]

    console.log("position  - ", window.position);


    // <td id="oniid">one</td>
    //   <td id="onpos">one</td>
    //   <td id="onzone">one</td>
    //   <td id="ondept">one</td>
    //   <td id="onnpos">one</td>
    //   <td id="onsts">one</td>

    $("#oniid").html(res[0])
    $("#onpos").html(res[1])
    $("#onzone").html(res[2])
    $("#ondept").html(res[3])
    $("#onnpos").html(res[4])
    $("#onsts").html(res[5])

    // data = {'prf':prf,'dept':dept,'pos':pos,'zone':zone,'posno':posno,'status':status}
    // alert(window.prf)
    $('#dumpdiv').fadeIn();
    $('#submitmaildump').fadeIn();
    $('#emailcollection').fadeIn();
    $('#submitmail').fadeIn();
    $(document).scrollTop($(document).height());
    positionapp = encodeURIComponent(window.position.trim())
    document.getElementById('forms').action = 'uploademails.php?prf=' + window.prf + '&' + 'position=' + window.position + '&' + 'pos=' + window.pos + "&" + 'dept=' + window.dept;

}


function readURL(input) {
    var f = $('#uploadcsv').val().split('.')
    var x = f[1]
    if (x == 'csv') {
        var f = $('#uploadcsv').val()

        $('#myfile0').text(f)
    } else {
        alert('Invalid File\n Only CSV Files Accepted')
        $('#uploadcsv').val(" ")
    }
}

function mymodalopen() {

    $("#modal3").modal('open');
}

$('#dumpdiv').hide();
$('#emailcollection').hide();
$('#edump').hide();
$('#submitmaildump').hide();
$('#submitmail').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#unsentmails').hide()

$('#emaildump').change(function() {
    var f = $('#emaildump').val()
    var filesplit = f.split(".")
    checkfile = filesplit[1]
    if (checkfile == "csv") {
        $('#myfile').replaceWith(f);
    } else {
        alert("Invalid File Format")
    }


})

function removeusingSet(arr) {
    let outputArray = Array.from(new Set(arr))
    return outputArray
}

function filterbydept() {
    $('#deptchoice').fadeIn(600)
    $('#deptchoice').empty()

    $.ajax({
        url: 'http://localhost/hrms/api/getdepartments.php',
        type: 'POST',
        success: function(para) {
            para = JSON.parse(para)
            uniquedept = removeusingSet(para);
            for (i = 0; i < uniquedept.length; i++) {
                var str = '<option value="' + uniquedept[i] + '"  style="color: white">' + uniquedept[i] + '</option>'
                $('#deptchoice').append(str);

            }


        }
    })
}


var ctr = 0

function addText(x) {
    ctr = ctr + 1
    var str = 'email' + ctr
    var txt1 = "<div class='input-field col s12 m4 offset-m4  blue-text' style='width:60%;margin-left:20%;' >"
    var txt2 = "<i class='material-icons prefix'>email</i>"
    var txt3 = "<input id='" + str + "' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email Address'>"
    var txt4 = "</div>"
    $("#emailcollection").append(txt1 + txt2 + txt3 + txt4);
}
var arr = []
var dept = []
$(document).ready(function() {

    // functionality for notifications start here
    $('#badge_ongoing').hide();
    $('#badge_rescheduling').hide();
    $('#badge_letter').hide();
    // ajax call for getting notification details
    $.ajax({
            url: 'http://localhost/hrms/demo.txt',
            type: 'GET',
            success: function(para) {
                // dummy data : give notification count, if no new notification please give 0 ex offerletter:0
                para = { 'ongoing': 10, 'rescheduling': 5, "offerletter": 0 }
                if (para.ongoing > 0) {
                    $('#badge_ongoing').text(para.ongoing);
                    $('#badge_ongoing').show();
                }
                if (para.rescheduling > 0) {
                    $('#badge_rescheduling').text(para.rescheduling);
                    $('#badge_rescheduling').show();
                }
                if (para.offerletter > 0) {
                    $('#badge_letter').text(para.offerletter);
                    $('#badge_letter').show();
                }
            }
        })
        // functionality for notification ends here
    $("#loader").hide();
    $('.modal').modal();

    $('#zonechoice').hide();
    $("#uploaddump").hide()
    $("#nodata").hide()
    $("#ordiv").hide()

    $.ajax({
        url: 'http://localhost/hrms/api/getprfdump.php',
        type: 'POST',
        // data:{'arr1':arr1},
        success: function(para) {
            if (para == "No Data") {
                $("#nodatamodal").modal("open");
            } else {
                console.log(para + "<br>")
                para = JSON.parse(para)
                    // window.data=para
                    // para=['1001','Developer','North','Sales','5','ongoing']
                console.log("this is length : " + para.length)
                for (let i = 0; i <= para.length; i++) {
                    arr[i] = para[i];

                }
                document.getElementById("result").innerHTML = arr.length;
                document.getElementById("result1").innerHTML = arr.length;

                dept[0] = "All"
                for (let i = 1; i < para.length; i++) {
                    dept[i] = para[i - 1][3]
                }
                uniquedept = removeusingSet(dept);

                for (i = 0; i < uniquedept.length; i++) {
                    var str = '<option value="' + uniquedept[i] + '"  style="color: white">' + uniquedept[i] + '</option>'

                    $('#deptchoice').append(str);
                }
                countdept = uniquedept.length;
                $strs = '<span class="new badge green">4</span>';
                $("#badges").append($strs)

                for (let j = 0; j < arr.length - 1; j++) {

                    if (arr[j][6] == "initiated") {
                        var x = '<tr id="rows" style="background-color:orange;"><td id="prf" value="' + arr[j][0] + '"><b class="modal-trigger" href="#modal1" id="' + arr[j][0] + '" onclick=showmodal(this.id) style="cursor:pointer">' + arr[j][0] + '</b></td><td id="pos">' + arr[j][1] + '</td><td id="zone">' + arr[j][2] + '</td><td id="dept">' + arr[j][3] + '</td><td id="posno">' + arr[j][4] + '</td><td id="status">' + arr[j][5] + '</td><td><a id="' + arr[j][0] + "*" + arr[j][1] + "*" + arr[j][2] + "*" + arr[j][3] + "*" + arr[j][4] + "*" + arr[j][5] + '" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
                    } else {
                        var x = '<tr id="rows"><td id="prf" value="' + arr[j][0] + '" ><b class="modal-trigger" href="#modal1" id="' + arr[j][0] + '" onclick=showmodal(this.id) style="cursor:pointer">' + arr[j][0] + '</b></td><td id="pos">' + arr[j][1] + '</td><td id="zone">' + arr[j][2] + '</td><td id="dept">' + arr[j][3] + '</td><td id="posno">' + arr[j][4] + '</td><td id="status">' + arr[j][5] + '</td><td><a id="' + arr[j][0] + "*" + arr[j][1] + "*" + arr[j][2] + "*" + arr[j][3] + "*" + arr[j][4] + "*" + arr[j][5] + '" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
                    }
                    $('#rawdata').append(x);
                }
            }


        },
    })



})
$('#submitmail').click(function() {
    $("#loader").show();
    $('#submitmail').prop('disabled', true);
    $('#emailcollection').fadeOut(600)
        // $('#creatinggrp').fadeIn(600)


    var arr1 = []
    arr1[0] = $('#email').val()
    for (let i = 1; i < ctr; i++) {
        var x = '#email' + i
        arr1[i] = $(x).val()
        arr1 = arr1.filter(function(entry) { return entry.trim() != ""; });
    }

    $.ajax({
        url: 'http://localhost/hrms/api/sendmail.php',

        type: 'POST',

        data: {
            'emails': arr1,
            'prf': window.prf,
            'dept': window.dept,
            'pos': window.pos,
            'status': window.status,
            'position': window.position,
            'poszone': window.zone
        },
        success: function(para) {
            // para=JSON.parse(para);
            console.log("this is ", para[0]);

            if (para == "sent") {
                $("#loader").hide();
                $('#groupcreated').show();
                $('#submitmail').prop('disabled', false);
                // alert("This is 2 : "+id)
                $(id).attr('disabled', 'disabled')
                $(id).text('Initiated')
                console.log("sent")
                $('#creatinggrp').fadeOut(600)
                window.setTimeout(function() { location.reload() }, 1000)


            } else {
                $("#loader").hide();
                para = JSON.parse(para);
                console.log("This is : ", para)
                $('#creatinggrp').fadeOut(100)
                $('#unsentmails').fadeIn(500)
                for (i = 0; i < para.length; i++) {
                    s2 = "<b style='color:red;'>" + (i + 1) + ". " + para[i] + "<b><br>";
                    $("#get").append(s2);
                    $("#submitmail").hide();
                }
            }


        },
    })
})

function showupdump() {

    if ($('#uploadcsv').val() == "") {
        alert('Please Upload a File..!')
    } else {
        $("#uploaddump").fadeIn()
    }
}

//Added by Sarang - 03/14/2020



$('#deptchoice').change(function() {

    $("#prfno").empty()
    var ap1 = "<option disabled selected style='color: white'>Select PRF</option>"
    $("#prfno").append(ap1)
    $('#rawdata').empty();


    $.ajax({
        url: "http://localhost/hrms/api/getfilteredprf.php",
        type: "POST",
        data: { "dept": $('#deptchoice').val() },
        success: function(arr) {

            if (arr == "No Data") {
                document.getElementById("result").innerHTML = 0;
                $("#nodatamodal").modal("open");
            } else {

                // console.log("this are prflist = ",arr.length)
                arr = JSON.parse(arr);
                console.log("this are prflist = ", arr.length)

                //Count of result, filtered
                document.getElementById("result").innerHTML = arr.length;
                for (let j = 0; j < arr.length; j++) {

                    if (arr[j][6] == "initiated") {
                        var x = '<tr id="rows" style="background-color:orange;"><td id="prf" value="' + arr[j][0] + '"><b class="modal-trigger" href="#modal1" id="' + arr[j][0] + '" onclick=showmodal(this.id) style="cursor:pointer">' + arr[j][0] + '</b></td><td id="pos">' + arr[j][1] + '</td><td id="zone">' + arr[j][2] + '</td><td id="dept">' + arr[j][3] + '</td><td id="posno">' + arr[j][4] + '</td><td id="status">' + arr[j][5] + '</td><td><a id="' + arr[j][0] + "*" + arr[j][1] + "*" + arr[j][2] + "*" + arr[j][3] + "*" + arr[j][4] + "*" + arr[j][5] + '" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
                    } else {
                        var x = '<tr id="rows"><td id="prf" value="' + arr[j][0] + '" ><b class="modal-trigger" href="#modal1" id="' + arr[j][0] + '" onclick=showmodal(this.id) style="cursor:pointer">' + arr[j][0] + '</b></td><td id="pos">' + arr[j][1] + '</td><td id="zone">' + arr[j][2] + '</td><td id="dept">' + arr[j][3] + '</td><td id="posno">' + arr[j][4] + '</td><td id="status">' + arr[j][5] + '</td><td><a id="' + arr[j][0] + "*" + arr[j][1] + "*" + arr[j][2] + "*" + arr[j][3] + "*" + arr[j][4] + "*" + arr[j][5] + '" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
                    }

                    $('#rawdata').append(x);
                }
                $('#zonechoice').fadeIn(300);

                //---------------------------------Sarang -------------get unique zones
                $.ajax({
                    url: 'http://localhost/hrms/api/getzones.php',
                    type: 'POST',
                    // data:{'arr1':arr1},
                    success: function(para) {
                        zone = []
                        para = JSON.parse(para)

                        for (let i = 0; i < para.length; i++) {
                            zone[i] = para[i]
                        }
                        $("#zonechoice").empty();
                        $("#zonechoice").append('<option value="" disabled selected style="color: white">Select Zone</option>')
                        uniquezone = removeusingSet(zone);

                        for (i = 0; i < uniquezone.length; i++) {
                            var str = '<option value="' + uniquezone[i] + '"  style="color: white">' + uniquezone[i] + '</option>'
                            $('#zonechoice').append(str);
                        }
                    },
                })
            }

        }

    })

})


//-------------------------------------------Get Filtered Zones -------------------------------------------------

//get filtered department
$('#zonechoice').change(function() {

    console.log("Selected Zones : " + $('#deptchoice').val() + $('#zonechoice').val())

    $('#rawdata').empty();
    //Sarang Yesterday  13/03/2020
    $.ajax({
        url: "http://localhost/hrms/api/hrgetfilteredzones.php",
        type: "POST",
        data: {
            "dept": $('#deptchoice').val(),
            "zone": $('#zonechoice').val()
        },
        success: function(arr) {
            console.log(arr)
            if (arr == "No data") {
                document.getElementById("result").innerHTML = 0;
                $("#nodatamodal").modal("open");
                console.log("Entered");
                $('#nodata').fadeIn(300);

            } else {
                $('#nodata').hide();
                console.log("This is my data : " + arr)
                arr = JSON.parse(arr);
                console.log("this are prflist = ", arr)
                document.getElementById("result").innerHTML = arr.length;
                for (let j = 0; j < arr.length; j++) {
                    if (arr[j][6] == "initiated") {
                        var x = '<tr id="rows" style="background-color:orange;"><td id="prf" value="' + arr[j][0] + '"><b class="modal-trigger" href="#modal1" id="' + arr[j][0] + '" onclick=showmodal(this.id) style="cursor:pointer">' + arr[j][0] + '</b></td><td id="pos">' + arr[j][1] + '</td><td id="zone">' + arr[j][2] + '</td><td id="dept">' + arr[j][3] + '</td><td id="posno">' + arr[j][4] + '</td><td id="status">' + arr[j][5] + '</td><td><a id="' + arr[j][0] + "*" + arr[j][1] + "*" + arr[j][2] + "*" + arr[j][3] + "*" + arr[j][4] + "*" + arr[j][5] + '" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
                    } else {
                        var x = '<tr id="rows"><td id="prf" value="' + arr[j][0] + '" ><b class="modal-trigger" href="#modal1" id="' + arr[j][0] + '" onclick=showmodal(this.id) style="cursor:pointer">' + arr[j][0] + '</b></td><td id="pos">' + arr[j][1] + '</td><td id="zone">' + arr[j][2] + '</td><td id="dept">' + arr[j][3] + '</td><td id="posno">' + arr[j][4] + '</td><td id="status">' + arr[j][5] + '</td><td><a id="' + arr[j][0] + "*" + arr[j][1] + "*" + arr[j][2] + "*" + arr[j][3] + "*" + arr[j][4] + "*" + arr[j][5] + '" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
                    }
                    $('#rawdata').append(x);
                }

            }


        }

    })

})