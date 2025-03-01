
function load3Comments() {
    $.getJSON('index.php?controller=front.comment&action=get', function (rows) {
        
        $('#comments-section').empty();
        for (let i = 0; i < 3; i++) {
            let row = rows[i];
            console.log(row);
            console.log(row.datetime);
            $('#comments-section').append(
                `<div class="user_comment">
                    <img src="http:#" alt="img" class="user_icon">
                    <div class="cmt_main">
                        <div class="cmt_info"><span class="user_name_comment">user_name</span>
                        <span>${row.datetime}</span></div>
                        <div><span> ${row.comment}</span></div>
                    </div>
                    <div class="clear"></div>
                </div>`);
        }

        $('#endComment').html(`<button id="view">View comments</button>`);
        return;
    })



}

function loadComments() {
    $.getJSON('index.php?controller=front.comment&action=get', function (rows) {
        $('#comments-section').empty();
        for (let i = 0; i < rows.length; i++) {
            let row = rows[i];
            $('#comments-section').append(
                `<div class="user_comment">
                    <img src="http:#" alt="img" class="user_icon">
                    <div class="cmt_main">
                        <div class="cmt_info"><span class="user_name_comment">user_name</span>
                        <span>${row.datetime}</span></div>
                        <div><span> ${row.comment}</span></div>
                    </div>
                    <div class="clear"></div>
                </div>`);
        }
        $('#endComment').empty();
        $('#endComment').html(`<button id="hide">Hide comments</button>`);
        return;
    })


}

$(document).ready(function () {
    load3Comments();
    console.log("load1")
    $('#comment-form').submit(function (event) {
        event.preventDefault();
        postComment();
    })

    $('#endComment').on('click', '#view', function(){
        loadComments()
    })

    $('#endComment').on('click', '#hide', function(){
        load3Comments();
    })

});

function postComment() {
    let filmID = $('#filmID').val();
    let comment = $('#comment-text').val();
    $.ajax({
        url: 'index.php?controller=front.comment&action=post',
        type: 'POST',
        data: {
            filmID: filmID,
            comment: comment
        },
        success: function (response) {
            let res = JSON.parse(response);
            if (res.status === 'success') {
                loadComments();
                $('#comment-text').val(''); 
            } else {
                alert('Error: ' + res.message);
            }
        }
    })

}



