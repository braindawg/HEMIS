//Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('isssuecomment');


//Bind a function to a Event (the full Laravel class)
channel.bind('App\\Events\\IssueCommentEvent', addComment);


function addComment(data) {
    var name = data.user.name;
    var date = data.date;
    var comment = data.comment.comment;
    var id = data.comment.id;
    var url = data.url;
    var adminUser = data.adminUser;
    var mycomment = "";
    if(adminUser == 1)
        {
            mycomment = "<div id = " + 'c' + id + "><div class=\"media\">\n" +
            "                                <div class=\"media-body\">\n" +
            "                                    <h4 class=\"media-heading\">\n" +
            "                                      <div> <h4 style=\"padding-right: 20px;\">" +
            "                                           <i id=\"+id+\" onclick=\"deletecomment(" + id + ")\"\n class=\"fa fa-times btn-xs pull-right\" title=\"Delete Comment\"\n style=\"cursor: pointer\"></i>\n " +
            "                                      </h4>\n" +
            "                                 </div>\n" +
            "                                        <span class=\"font-blue\">" + name + "</span>\n" +
            "                                    </h4>" + comment +
            "                                    &nbsp;&nbsp;<span class=\"c-date\" style=\"font-size: 11px; color: #0d638f\">زمان نظر:" + date + "</span>\n</div>\n" +
            "                            </div></div>"
        }
        else {
        mycomment = "<div id = " + 'c' + id + "><div class=\"media\">\n" +
            "                                <div class=\"media-body\">\n" +
            "                                    <h4 class=\"media-heading\">\n" +
            "                                        <span class=\"font-blue\">" + name + "</span>\n" +
            "                                    </h4>" + comment +
            "                                    &nbsp;&nbsp;<span class=\"c-date\" style=\"font-size: 11px; color: #0d638f\">زمان نظر:" + date + "</span>\n</div>\n" +
            "                            </div></div>"
        }
    $('#comments').prepend(mycomment);
    $('#summernote').summernote('code', '');
}

function message(issueID) {
    var message = $('#summernote').val();
    var issue = issueID;
    if (message == "") {
        alert("لطفا نظر خودرا بنویسد!");
    }
    else {
        $('#commet_loading').css('display', 'inline');
        $.ajax({
            cache: false,
            url: '/store-comment',
            data: {'issue': issue, 'message': message},
            success: function () {
                $('#commet_loading').css('display', 'none');
            }
        });
    }
}
function deletecomment(id) {
    if (!confirm("آیا مایل به پیشروی هستید؟")) {
        event.preventDefault();
        return false;
    }
    document.getElementById('c' + id +'').style.display="none";
    $.ajax({
        url: '/delete-comment',
        data: {'id': id},
        success: function () {
        }
    });
}