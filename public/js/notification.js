var pusher = new Pusher('8efcd40da836cc793efa', {
    cluster: 'ap2',
    forceTLS: true,
    encrypted: false
});

//Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('isssuecreated');


//Bind a function to  Event (the full Laravel class)
channel.bind('App\\Events\\IssueNotificationEvent', addIssue);


function addIssue(data) {
    var name = data.user.name;
    var date = data.date;
    var title = data.title;
    var url = data.url;
    var attachIssue = "";
    var attachIssue =  $("<li style ='background-color: #F0FFF0; margin-top:15px;' ><a target ='_blank' href="+ url +"><span style = 'display: block; margin-right: 20px;'><span style ='font-size: 13px; font-weight: 600;color: #5b9bd1' >" + name +" <span style = 'font-size: 11px; font-weight: 300; color:gray'> " + data.message +" </span> </span><span style ='font-size: 12px; margin-left:20px; font-weight: 400; opacity: .5; float: left;'> "+ date +" </span></span> <span style = 'display: block !important; font-size: 12px; line-height: 1.3; margin-right: 26px; font-family: margin-bottom: 0px; Montserrat,nazanin !important;'>" +title +"</span></a></li><hr style = 'opacity: .5;'>");
    
    setInList(attachIssue,data,'notification');
}

function makeNotificationAsRead(){

        $.get('/makeNotificationAsRead');
}

function setInList(listItem,data,appendedPlace)
{

    $('#'+appendedPlace).prepend(listItem);
    $('#'+appendedPlace+'_count').html(function(i, val) { return +val+1 });
    $('#notification_bottom_count').html(function(i, val) { return +val+1 });
    
    $('#no_notification').remove();

}