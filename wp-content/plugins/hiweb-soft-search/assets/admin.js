/**
 * Created by hiweb on 22.08.2016.
 */


var hw_search_tool = {

    data: [],
    total: 0,
    current: 0,


    init: function (data, start_button_selector, form_selector) {
        hw_search_tool.data = data;
        if (typeof data == 'object') {
            hw_search_tool.total = data.length;
        }
        hw_search_tool.make_events(start_button_selector, form_selector)
    },

    make_events: function (start_button_selector, form_selector) {
        jQuery(start_button_selector).off('click').on('click', function () {
            jQuery(this).fadeOut();
            hw_search_tool.do_step(hw_search_tool.do_end);
        });
        jQuery(form_selector).find('input[type="checkbox"]').off('click').on('click', function () {
            var post_types = [];
            jQuery(form_selector).find('input[type="checkbox"]:checked').each(function (i) {
                post_types[i] = jQuery(this).val();
            });
            jQuery.ajax({
                url: ajaxurl + '?action=hiweb_search',
                type: 'post',
                dataType: 'json',
                data: {do: 'regenerate_select_pt', post_types: post_types},
                success: function (data) {
                    if (data.hasOwnProperty('success')) {
                        if (data.success) {
                            jQuery('[data-count-ids]').html(data.data.length);
                            hw_search_tool.init(data.data, start_button_selector, form_selector);
                        } else {
                            alert(data.data);
                        }
                    } else {
                        alert('Неизвестная оишбка');
                        console.warn(data);
                    }

                },
                error: function (data) {
                    console.warn(data);
                }
            });
        });
    },

    do_step: function (fn_end) {
        if (typeof hw_search_tool.data != 'object') {
            if (typeof fn_end == 'function') {
                fn_end();
            }
            return;
        }
        if (hw_search_tool.data.length == 0) {
            if (typeof fn_end == 'function') {
                fn_end();
            }
            return;
        }
        ///
        var element = hw_search_tool.data.pop();
        hw_search_tool.current++;
        console.info(hw_search_tool.current + '...');
        jQuery.ajax({
            url: ajaxurl + '?action=hiweb_search',
            type: 'post',
            dataType: 'json',
            data: {do: 'regenerate', id: element},
            success: function (data) {
                if (data.hasOwnProperty('success')) {
                    if (data.success) {
                        console.info(hw_search_tool.current + '...done!');
                    } else {
                        console.info(hw_search_tool.current + '...' + data.data);
                    }
                } else {
                    alert('Неизвестная ошибка');
                    console.warn(data);
                }

                hw_search_tool.do_step(fn_end);
                hw_search_tool.loader_update();
            },
            error: function (data) {
                console.error(hw_search_tool.current + '...error!');
                console.warn(data);
                hw_search_tool.do_step(fn_end);
            }
        });

    },


    do_end: function () {
        jQuery('.media-toolbar').hide();
        jQuery('[data-count]').html(hw_search_tool.total);
        jQuery('.hw_io_message_done').fadeIn();
    },

    loader_update: function () {
        jQuery('.progress-bar > div').css('width', hw_search_tool.current / hw_search_tool.total * 100 + '%');
    }

};