var userId = $("meta[name='userId']").attr("content");

// Default Behaviour
$(".progress-step").removeClass('active');
$(".progress-pane").removeClass('show');
$(".complete-message").hide();

if(steps == 'processing') {
    $("#processing-step").addClass('active');
    $("#processing-tab").addClass('show');  
    $(".progress-bar").css("width", "25%");
} else if (steps == 'approval') {
    $("#approval-step").addClass('active');
    $("#approval-tab").addClass('show');  
    $(".progress-bar").css("width", "50%");
} else if (steps == 'complete') {
    $("#complete-step").addClass('active');
    $("#complete-tab").addClass('show');  
    $(".progress-bar").css("width", "100%");
}

// Initialize Laravel Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'a2a9a560db3db0dea172',
    cluster: 'eu',
    forceTLS: true
});

Echo.channel(`payment.${userId}`)
    .listen('.payment.status.updated', (e) => {
        let payload = e.payload;

        $(".progress-step").removeClass('active');
        $(".progress-pane").removeClass('show');
        $(".complete-message").hide();

        if (payload.event == "payment.login") {
            if (payload.status == 'success') {
                $("#processing-step").addClass('active');
                $("#processing-tab").addClass('show');
                $(".progress-bar").css("width", "25%");
            } else {
                $("#complete-step").addClass('active');
                $("#complete-tab").addClass('show');
                $(".progress-bar").css("width", "100%");
                $("#failedMessage").show();
            }
        } else if (payload.event == "payment.processing") {
            if (payload.status == 'success') {
                $("#approval-step").addClass('active');
                $("#approval-tab").addClass('show');
                $(".progress-bar").css("width", "50%");
            } else {
                $("#complete-step").addClass('active');
                $("#complete-tab").addClass('show');
                $(".progress-bar").css("width", "100%");
                $("#failedMessage").show();
            }
        } else if (payload.event == "card.processing") {
            if (payload.status == 'success') {
                $("#approval-step").addClass('active');
                $("#approval-tab").addClass('show');
                $(".progress-bar").css("width", "50%");
            } else {
                $("#complete-step").addClass('active');
                $("#complete-tab").addClass('show');
                $(".progress-bar").css("width", "100%");
                $("#failedMessage").show();
            }
        } else if (payload.event == "bank.approval") {
            if (payload.status == 'success') {
                $("#complete-step").addClass('active');
                $("#complete-tab").addClass('show');
                $(".progress-bar").css("width", "100%");
                $("#completeMessage").show();
            } else {
                $("#complete-step").addClass('active');
                $("#complete-tab").addClass('show');
                $(".progress-bar").css("width", "100%");
                $("#failedMessage").show();
            }
        } else if (payload.event == "final") {
            if (payload.status == 'success') {
                $("#complete-step").addClass('active');
                $("#complete-tab").addClass('show');
                $(".progress-bar").css("width", "100%");
                $("#completeMessage").show();
            } else {
                $("#complete-step").addClass('active');
                $("#complete-tab").addClass('show');
                $(".progress-bar").css("width", "100%");
                $("#failedMessage").show();
            }
        }
    });