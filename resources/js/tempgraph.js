window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light1",
        title:{
            text: "Latest Temperatures"
        },
        data: [{        
            type: "area",
              indexLabelFontSize: 16,
            dataPoints: [
                { y: {{$sum[0]->temperature}} },
                { y: 400 },
                { y: 520 },
                { y: 460 },
                { y: 450 },
                { y: 500 },
                { y: 480 },
                { y: 480 },
                { y: 410 },
                { y: 500 },
                { y: 480 },
                { y: 510 }
            ]
        }]
    });
    chart.render();
    
}