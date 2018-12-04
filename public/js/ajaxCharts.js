// this function is used to make an ajax call to get the students of a 
// specific city in all universeties 
function getCitySpecData(province, container) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/cityupdate',
        data: {
            pro: province
        },

        success: function (data) {
            generateBarChart(data, container);
        }
    });
}


// this function is used to make an ajax call to get the students of a 
// specific university grouped by provinces
function getUniSpecData(university, container) {

    // console.log(university);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/universityupdate',
        data: {
            uni: university
        },

        success: function (data) {
            generateBarChart(data, container);
        }
    });
}


// this method is used to generate university activity for specific anterwal of time

// This method is used to generate bar column chart on the @data fed to it

function generateBarChart(data, container) {

    // $("#university-specific").html(data.specData);
    // console.log(data.specData);
    // console.log(data.meta[0].name);


    // getting the data from the controller
    var specData = data.specData;

    // resetting the title
    var tempTitle = ' تعداد محصلین  ولایت ' + data.meta[0].name + ' بر اساس پوهنتون ها';

    var color = ['#17a2b8'];
    var plotBGColor = '#FCFFC5';

    if (container == 'province-specific') {
        color.push('#e62739');
        plotBGColor = '#e1e8f0';
        var tempTitle = 'تعداد محصلین در پوهنتون ' + data.meta[0].name + ' بر اساس ولایت';
    }

    var chart = {
        renderTo: container,
        type: 'column',
        plotBackgroundColor: plotBGColor
    };


    var credits = {
        enabled: false
    };

    var title = {
        text: tempTitle
    };


    // assigning the categories 

    //temp array to assign
    var categories = [];

    for (i = 0; i < specData.length; i++) {
        if (specData[i].name == 'انستیتوت تکنالوژی معلوماتی ومخابراتی وزارت مخابرات')
            categories.push('انستیتوت مخابرات');
        else
            categories.push(specData[i].name);
    }


    var xAxis = {
        categories: categories
    };

    var yAxis = {
        min: 0,
        title: {
            text: 'تعداد محصلین کامیاب'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    };

    var legend = {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    };
    var tooltip = {
        headerFormat: '<span><b>{series.name}</b></span><table>',
        pointFormat: '<tr><td>{point.y}</td></tr>',
        footerFormat: '</table>',
        useHTML: true

    };
    var plotOptions = {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: false,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || '17a2b8'
            }

        }
    };


    //extracting data from the array and the assigning it to the data of the series
    // temp array @tempData
    var tempData = [];

    for (i = 0; i < specData.length; i++) {
        tempData.push(specData[i].std_count);
    }



    var series = [{
        name: 'تعداد محصلین',
        data: tempData
    }]


    //recollecting and connection the peices of the chart
    var json = {};

    json.chart = chart;
    json.colors = color;
    json.title = title;
    json.tooltip = tooltip;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.series = series;
    json.plotOptions = plotOptions;
    json.credits = credits;
    json.legend = legend;


    Highcharts.chart(json);
}

