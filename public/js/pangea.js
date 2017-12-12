
/**
 * Setup CSRF-TOKEN para $.ajax jQuery
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var Pangea = {

    /**
     * var btnText
     */
    btnText : '',

    /**
     * var btn
     */
    btn : null,

    /**
     * var error mensaje de error general
     */
    msg_error : 'Error Interno',

    /**
     * @param btn '<button>' presionado
     * @param btnText Texto que se mostrará en btn al ser presionado
     */
    btnProcess : function(btn, btnText){
        this.btn = btn;
        this.btnText = $(btn).prop('disabled', true).html();
        $(btn).html(btnText + ' <i class="fa fa-spin fa-spinner"></i>');    
    },

    btnEndProcess : function(){
        $(this.btn).prop('disabled', false).html(this.btnText);
        this.btn = null;
        this.btnText = '';
    }

}