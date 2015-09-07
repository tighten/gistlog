var commentForm = (function(){

    var el = {
        $comment_input: $('#comment_input'),
        $comment_buttons_container: $('.comment-form__button-container'),
        $github_signin: $('#github_signin')
    };

    var bindUIElements = function() {
        el.$comment_input.on('focus', showCommentButton);
        el.$comment_input.on('blur', hideCommentButton);
        el.$github_signin.on('click', handleSignin);
    };

    var init = function() {
        bindUIElements();
        refillPreviousComment();
    };

    var handleSignin = function (e) {
        var comment = el.$comment_input.val();
        localStorage.setItem('gist_comment', comment);
    };

    var showCommentButton = function () {
        el.$comment_buttons_container.addClass('active');
    };

    var hideCommentButton = function () {
        if(el.$comment_input.val() === "") el.$comment_buttons_container.removeClass('active');
    };

    var refillPreviousComment = function () {
        if(localStorage.hasOwnProperty('gist_comment') === false) return false;
        el.$comment_input.val(localStorage.getItem('gist_comment')).focus();
        localStorage.removeItem('gist_comment');
    };

    return {
        init: init
    }

})();