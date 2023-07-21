
class table {
    //----------------------------------------------------------------
    constructor(options) {
        this.options = $.extend({
            id: null,
            url: null,
            total_pages: 0,
            total_items: 0,
        }, (options === undefined ? {} : options));

        this.data = {
            page:1,
            search:"",
            is_reset:0,
            sortfield:0,
            sortorder:0,
            ui_table:this.options.id,
        };

    }
    //----------------------------------------------------------------
    set_options(options){
        this.options = $.extend({
            id: null,
            url: null,
            total_pages: 0,
            total_items: 0,
        }, (options === undefined ? {} : options));

        //update pagination
        if(this.options.total_pages <= 1){
            $("#"+this.options.id+"_pagination").addClass('d-none');
        }else{
            
            $("#"+this.options.id+"_pagination").removeClass('d-none');

            let pagination = eval(this.options.id+"_pagination");
            pagination.update({total:this.options.total_pages});
        }

    }
    //----------------------------------------------------------------
    paginate(page){

        this.data.page = page;
        this.update();
    }
    //----------------------------------------------------------------
    sort(sortfield, sortorder){

        this.data.sortfield = sortfield;
        this.data.sortorder = sortorder;
        this.data.is_sort = true;
        this.data.is_reset = 0;
        this.update();
        
        this.data.is_sort = false;
    }
    //----------------------------------------------------------------
    reset(){

        this.data.page = 1;
        this.data.search = "";
        this.data.is_reset = 1;
        this.data.sortfield = 0;
        this.data.sortorder = 0;
        this.update();

        let reset_btn = this.get_element("reset_btn");
        if(!reset_btn.hasClass("d-none")) reset_btn.addClass('d-none');
        this.get_element("search_input").val('');
        
        let pagination = eval(this.options.id+"_pagination");
        pagination.update({page:this.data.page});

    }
    //----------------------------------------------------------------
    search(){

        this.data.search = $("#search\\\["+this.options.id+"\\\]").val();
        this.data.page = 1;

        if(this.data.search !== ""){
            this.update();

            this.get_element("reset_btn").removeClass('d-none');
        }

    }
    //----------------------------------------------------------------
    get_element(type){

        switch (type) {
            case "reset_btn":
                return $(".ui-table-wrapper[data-id="+this.options.id+"]").find('.btn-reset');

            case "search_input":
                return $("#search\\\["+this.options.id+"\\\]");
        }

    }
    //----------------------------------------------------------------
    update(){

        let instance = this;

        app.ajax.request(instance.options.url, {
            no_overlay:true,
            data:instance.data,
            beforeSend:function(){
                $("#"+instance.options.id).addClass('loading');
            },
            success:function(response){
                setTimeout(function(){
                    $("#"+instance.options.id).html(response);
                    $("#"+instance.options.id).removeClass('loading');
                    instance.data.is_reset = 0;
                }, 200);
            },
        });
    }
    //----------------------------------------------------------------
}