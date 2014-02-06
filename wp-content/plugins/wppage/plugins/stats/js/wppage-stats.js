// does not used, all code is in head
jQuery(function($){
    $.post(ajax_object.ajaxurl, {
        action: 'wppage_stats_ajax_action',
        page_id: wpp_page_id,
        page_title: $(document).attr('title'),
        page_url: $(location).attr('href'),
        referer: document.referrer
    }, function(data) {
        alert(data); // alerts 'ajax submitted'
    });
});