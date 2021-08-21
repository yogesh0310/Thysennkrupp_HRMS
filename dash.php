<!DOCTYPE html>
<html lang="en-US">
<body>

<nav>
  <div class="nav-wrapper blue darken-1">
    <a href="#!" class="brand-logo center">thyssenkrupp</a>
  </div>
</nav>  

<center>
<div id="piechart">
</div>
</center>
<div id="mytabledata" class="row">
<table class="col s6 offset-m3 stripped">
    <thead class="purple lighten-4 ">
        <tr>
            <th>Round ID</th>
            <th>Round Name</th>
            <th>Round Date</th>
        </tr>
    </thead>
    <tbody id="mytable">

    </tbody>
</table>


</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="public\css\materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="public\css\materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <script src="public\js\jquery-3.2.1.min.js"></script>
  
  <script src="public\js\materialize.js"></script>
  <script src="public\js\materialize.min.js"></script>

<script type="text/javascript">



$(document).ready(function(){
    $("#mytabledata").hide();


var data;
function callback(response) {

console.log(response)

 google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {



var data = google.visualization.arrayToDataTable([
  ['Rounds', 'Count',{role:"style"}],
  ['Ongoing', parseInt(response.ongoing),'blue'],    // Count for Ongoing Rounds
  ['Completed',parseInt(response.completed),'green'], // Count For Completed Rounds
  ['Pending',parseInt(response.pending),'red']      // Count for Pending Rounds
]);

 

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'http://localhost/hrms ROUNDS', 'width':550, 'height':400,
  animation:
  {
    duration:1500,
    startup:true,    
  },
  hAxis: 
  {
    title: 'Total Count',
  },
  vAxis: 
  {
    title: 'Rounds'
  },

  annotations: {
          alwaysOutside: true,
  }
  };


function selectHandler() 
{
   var selectedItem = chart.getSelection()[0];
   if (selectedItem) 
   {
       $("#mytabledata").show(1500);
      var mydata = data.getValue(selectedItem.row, 0);
      //alert('Clicked On  '+mydata);
      var para1=response.ongoings;
      var para2=response.compl_array;
      var para3=response.pendings;
      // DUMMY DATA FOR TABLES
      //var para1=[['1010','GD Round','20/10/2020'],['2020','HR ROUND','10/20/2020']]
      //var para2=[['1111','APTITIUDE Round','15/10/2020'],['5555','Case Study Round','10/20/2020']]
      //var para3=[['2222','XYZ Round','01/10/2020'],['2020','MOCK TEST','10/20/2020']]
      if(mydata=="Ongoing")
      {
        $("#mytable").text(" ");   
          for(let i=0;i<para1.length;i++)
        {
          var x='<tr><td>'+para1[i][0]+'</td><td>'+para1[i][1]+'</td><td>'+para1[i][2]+'</td></tr>'
          $("#mytable").append(x);
        }
      }

      if(mydata=="Completed")
      {
        $("#mytable").text(" ");
          for(let i=0;i<para2.length;i++)
        {
          var x='<tr><td>'+para2[i][0]+'</td><td>'+para2[i][1]+'</td><td>'+para2[i][2]+'</td></tr>'
          $("#mytable").append(x);
        }
      }

      if(mydata=="Pending")
      {
        $("#mytable").text(" ");
          for(let i=0;i<para3.length;i++)
        {
          var x='<tr><td>'+para3[i][0]+'</td><td>'+para3[i][1]+'</td><td>'+para3[i][2]+'</td></tr>'
          $("#mytable").append(x);
        }
      }


      
      
      
   }
}


  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.BarChart(document.getElementById('piechart'));
 google.visualization.events.addListener(chart, 'select', selectHandler);  
 chart.draw(data, options);
}

  
  //use return_first variable here
}
   
$.ajax({
url:"http://localhost/hrms/api/getroundsforinv.php",
type:"GET",
success:function(para){
  
  

callback(para)

} 

})



// Load google charts

})
</script>

</body>
</html>
