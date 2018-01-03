

/**
 * Objeto para validar
 */
var Validaciones = {

    /**
     * Validar rut
     * @param string rut
     * @returns boolean
     */
    validaRut : function(rut){
        var intlargo = rut;
		var tmpstr = "";
		if (intlargo.length > 0){
			var re = /^[1-9]{1}[0-9]{0,7}\-([0-9]|[kK]){1}$/;
			
			if(re.test(rut)){
				crut = rut;
				largo = crut.length;
				if ( largo < 2 ){
					return false;
				}
				for ( i=0; i <crut.length ; i++ )
					if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' ){
						tmpstr = tmpstr + crut.charAt(i);
					}

				rut = tmpstr;
				crut = tmpstr;
				largo = crut.length;

				if ( largo > 2 )
					rut = crut.substring(0, largo - 1);
				else
					rut = crut.charAt(0);

				dv = crut.charAt(largo-1);

				if ( rut == null || dv == null )
				return 0;

				var dvr = '0';
				suma = 0;
				mul  = 2;

				for (i= rut.length-1 ; i>= 0; i--){
					suma = suma + rut.charAt(i) * mul;
					if (mul == 7)
						mul = 2;
					else
						mul++;
				}

				res = suma % 11;
				if (res==1)
					dvr = 'k';
				else if (res==0)
					dvr = '0';
				else{
					dvi = 11-res;
					dvr = dvi + "";
				}

				if ( dvr != dv.toLowerCase() ){
					return false;
				}
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    },

    /**
     * Validar email
     * @param string email
     * @returns boolean
     */
    validaEmail : function(email){
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    	return re.test(email);
    }
}