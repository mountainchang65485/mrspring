
//定義變數
var chartRadarDOM;
var chartRadarDOM2;
var chartRadarDOM3;
var chartRadarData;
var chartRadarOptions;
var a1 = parseFloat($("#pointA1").text());
var b1 = parseFloat($("#pointB1").text());
var c1 = parseFloat($("#pointC1").text());
var a2 = parseFloat($("#pointA2").text());
var b2 = parseFloat($("#pointB2").text());
var c2 = parseFloat($("#pointC2").text());
var a3 = parseFloat($("#pointA3").text());
var b3 = parseFloat($("#pointB3").text());
var c3 = parseFloat($("#pointC3").text());


    //載入雷達圖
Chart.defaults.global.legend.display = false;
Chart.defaults.global.defaultFontColor = 'rgba(0,0,74, 1)';
chartRadarDOM = document.getElementById("chartRadar1");
chartRadarDOM2 = document.getElementById("chartRadar2");
chartRadarDOM3 = document.getElementById("chartRadar3");
chartRadarData;
chartRadarOptions = 
{   
    scale: 
    {
        ticks: 
        {
            fontSize: 18,
            beginAtZero: true,
            maxTicksLimit: 7,
            min:0,
            max:1
        },
        pointLabels: //類別字
        {   
            fontFamily: "pigmo",
            fontSize: 18,
            fontColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)']
        },
        gridLines: //網線
        {   

            color: '#aaa',
        },
        legend:
        {
        },
    }
};

// console.log("---------Rader Data--------");
var graphData =[a1, c1, b1];
var graphData2 =[a2, c2, b2];
var graphData3 =[a3, c3, b3];


// console.log("--------Rader Create-------------");
// console.log(graphData);
// console.log(graphData2);
// console.log(graphData3);
    
//CreateData
chartRadarData = {

    labels: ['舒筋活骨', '養顏美容', '安定心神'],
    datasets: [{
        // label: `療效`,
        backgroundColor: "rgba(250,180,0,.6)",
        borderColor: "rgba(225,225,225,.3)",
        pointBackgroundColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointBorderColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointHoverBackgroundColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointHoverBorderColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointBorderWidth: 1,
        pointHoverBorderWidth: 0,
        borderJoinStyle: 'round',
        fillColor: '#f00',
        data: graphData}]
};
chartRadarData2 = {

    labels: ['舒筋活骨', '養顏美容', '安定心神'],
    datasets: [{
        // label: `療效`,
        backgroundColor: "rgba(250,180,0,.6)",
        borderColor: "rgba(225,225,225,.3)",
        pointBackgroundColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointBorderColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointHoverBackgroundColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointHoverBorderColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointBorderWidth: 1,
        pointHoverBorderWidth: 0,
        borderJoinStyle: 'round',
        fillColor: '#f00',
        data: graphData2}]
};
chartRadarData3 = {

    labels: ['舒筋活骨', '養顏美容', '安定心神'],
    datasets: [{
        // label: `療效`,
        backgroundColor: "rgba(250,180,0,.6)",
        borderColor: "rgba(225,225,225,.3)",
        pointBackgroundColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointBorderColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointHoverBackgroundColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointHoverBorderColor: ['rgba(178,79,89,1)', 'rgba(106,145,45,1)', 'rgba(221,125,29,1)'],
        pointBorderWidth: 1,
        pointHoverBorderWidth: 0,
        borderJoinStyle: 'round',
        fillColor: '#f00',
        data: graphData3}]
};
    
//Draw
var chartRadar = new Chart(chartRadarDOM, {
    type: 'radar',
    data: chartRadarData,
    options: chartRadarOptions
});
var chartRadar = new Chart(chartRadarDOM2, {
    type: 'radar',
    data: chartRadarData2,
    options: chartRadarOptions
});
var chartRadar = new Chart(chartRadarDOM3, {
    type: 'radar',
    data: chartRadarData3,
    options: chartRadarOptions
});