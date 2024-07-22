document.addEventListener('DOMContentLoaded', function () {
    loadComments();

    document.getElementById('submit-comment').addEventListener('click', function () {
        var commentText = document.getElementById('comment-text').value.trim();
        var filmID = document.querySelector('input[name="filmID"]').value;

        if (commentText === "") {
            alert("Comment cannot be empty!");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../phim/manage/submit_comment.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    loadComments();
                    document.getElementById('comment-text').value = "";
                } else {
                    alert("Failed to submit comment: " + response.message);
                }

            } else {
                alert("Failed to submit comment. Status: " + xhr.status);
            }
        };

        xhr.onerror = function () {
            alert("Request failed.");
        };

        xhr.send("comment=" + encodeURIComponent(commentText) + "&filmID=" + encodeURIComponent(filmID));
    });
});

function loadComments() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../phim/manage/get_comment.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var comments = JSON.parse(xhr.responseText);
                var commentsSection = document.getElementById('comments-section');
                commentsSection.innerHTML = "";
                comments.forEach(function (comment) {
                    var div = document.createElement('div');
                    div.textContent = comment.comment + " (" + comment.datetime + ")";
                    commentsSection.appendChild(div);
                });
            } catch (e) {
                console.error('Failed to parse JSON response:', e);
                alert("Failed to load comments.");
            }
        } else {
            alert("Failed to load comments. Status: " + xhr.status);
        }
    };

    xhr.onerror = function () {
        alert("Request failed.");
    };

    xhr.send();
}
