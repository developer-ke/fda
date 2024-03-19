    //doughnut
var ctxD = document.getElementById("subscribers").getContext('2d');
var subscribers = <?php echo json_encode($subscribers) ?>;
var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
        labels: ["Males", "Females"],
        datasets: [
            {
                data: [subscribers.males, subscribers.females],
                backgroundColor: ["#F7464A", "#46BFBD"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1"]
            }
        ]
    },
    options: {
        responsive: true
    }
});

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);
var documentTypes = <?php echo json_encode($documentTypes) ?>;
let typeData = (myArray) => {
    let dataArray = [['Type', 'Total Reported']];
    myArray.forEach((item)=>{
        let dataItem = [item.name, parseInt(item.totalReported)];
        dataArray.push(dataItem);
    });
    return dataArray;
};
function drawBasic() {
    var data = google.visualization.arrayToDataTable(typeData(documentTypes));

      /*var data = google.visualization.arrayToDataTable([
        ['City', '2010 Population',],
        ['New York City, NY', 8175000],
        ['Los Angeles, CA', 3792000],
        ['Chicago, IL', 2695000],
        ['Houston, TX', 2099000],
        ['Philadelphia, PA', 1526000]
      ]);*/

      var options = {
        title: 'Documents Reported By Type',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total Documents',
          minValue: 0
        },
        vAxis: {
          title: 'Document Types'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }