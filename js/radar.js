
//定義變數
var chartRadarDOM;
var chartRadarData;
var chartRadarOptions;

    //載入雷達圖
Chart.defaults.global.legend.display = false;
Chart.defaults.global.defaultFontColor = 'rgba(0,0,74, 1)';
chartRadarDOM = document.getElementById("chartRadar");
chartRadarData;
chartRadarOptions = 
{   
    scale: 
    {
        ticks: 
        {
            fontSize: 13,
            beginAtZero: true,
            maxTicksLimit: 7,
            min:0,
            max:1
        },
        pointLabels: 
        {
            fontSize: 18,
            fontColor: ['rgba(178,79,89,1)', 'rgba(221,125,29,1)', 'rgba(106,145,45,1)'],
            fontFamily: 'Noto Sans TC',
        },
        gridLines: 
        {
            color: '#aaa',
        },
        legend:
        {
        }
    }
};

var graphData =[0,0,0];
    
//CreateData
chartRadarData = {

    labels: ['舒筋活骨', '安定心神', '養顏美容'],
    datasets: [{
        // label: `療效`,
        backgroundColor: "rgba(250,180,0,.8)",
        pointBackgroundColor: ['rgba(178,79,89,1)', 'rgba(221,125,29,1)', 'rgba(106,145,45,1)'],
        pointBorderColor: ['rgba(178,79,89,1)', 'rgba(221,125,29,1)', 'rgba(106,145,45,1)'],
        pointHoverBackgroundColor: ['rgba(178,79,89,1)', 'rgba(221,125,29,1)', 'rgba(106,145,45,1)'],
        pointHoverBorderColor: ['rgba(178,79,89,1)', 'rgba(221,125,29,1)', 'rgba(106,145,45,1)'],
        pointBorderWidth: 3,
        pointHoverBorderWidth: 3,
        borderJoinStyle: 'round',
        data: graphData}]
};
    
//Draw
var chartRadar = new Chart(chartRadarDOM, {
    type: 'radar',
    data: chartRadarData,
    options: chartRadarOptions
});

