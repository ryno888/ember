
class toast {
    //----------------------------------------------------------------
    constructor(options) {

        this.options = $.extend({
            id: null,
        }, (options === undefined ? {} : options));

        this.toast_arr = [];

    }
    //----------------------------------------------------------------
    add_toast(message, options){
        options = $.extend({
            id: app.str.generate_id(),
            header: false,
            header_bold: false,
            sub_header: false,
            message: message,
            color: 'bg-primary',
            autohide: true,
            delay: 2000,
        }, (options === undefined ? {} : options));


        let header_type = options.header_bold ? 'strong' : 'span';

        //build toasts
        options.html = '' +
            '<div id="'+options.id+'" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="'+(options.autohide ? 'true' : 'false')+'" data-bs-delay="'+options.delay+'" class="toast">' +
                '<div class="toast-header">' +
                    '<div class="rounded me-2 p-2 '+options.color+'"></div>' +
                    (options.header ? '<'+header_type+' class="me-auto">'+options.header+'</'+header_type+'>' : '') +
                    (options.sub_header ? '<small class="text-muted">'+options.sub_header+'</small>' : '') +

                    '<button type="button" class="ml-auto mb-1 btn-close" data-bs-dismiss="toast" aria-label="Close">' +
                        '<span class="text">×</span>' +
                    '</button>' +
                '</div>' +
                (options.message ? '<div class="toast-body">'+options.message+'</div>' : '') +
            '</div>';

        this.toast_arr.push(options);

    }
    //----------------------------------------------------------------
    build(){

        //see if toast wrapper is present
        if(!$('.toast-wrapper').length)
            $('html').append('<div class="toast-wrapper"><div class="toast-item-wrapper"></div></div>');

        let toast_wrapper = $('.toast-item-wrapper');

        //build toasts
        $.each(this.toast_arr, function( index, options ) {
            toast_wrapper.append(options.html);

            $('#'+options.id).on('hidden.bs.toast', function () {
                $('#'+options.id).remove();
            }).toast('show');

        });
    }
    //----------------------------------------------------------------
}