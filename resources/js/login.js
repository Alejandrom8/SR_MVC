class LoginForm{
    constructor(whereToSend, form, form_button, debug){
        this._whereToSend = whereToSend;
        this._debug = debug;
        this._form = form;
        this._form_button = form_button;
        const that = this;
        this._form.addEventListener( 'submit' , async function (e) {
            e.preventDefault();
            that._form_button.attr("disabled", "disabled").val("Validando...");
            const formData = new FormData(this);
            const result = await LoginForm.sendData(that.whereToSend, formData);
            if(result != null){
                LoginForm.manageResponse(result, that._debug);
            }
            that._form_button.removeAttr("disabled").val("Entrar");
        });
    }

    set whereToSend(where){
        this._whereToSend = where;
    }

    get whereToSend(){
        return this._whereToSend;
    }

    static async sendData(urlAPI, data){
        try{
            const response = await fetch(urlAPI, {
                method: "post",
                body: data
            });

            if(response.ok){
                return await response.json();
            }else{
                throw new Error(`Error al hacer la consulta a: ${urlAPI}`);
            }
        }catch(e){
            console.log(e);
        }
        return null;
    }

    static manageResponse(data, debugSection){
        if(data.success){
            window.location = data.onSuccessEvent;
        }else{
            if(data.errors === 202){//is not an error, this is when a user isn't registered.
                window.location = data.onSuccessEvent;
            }else{
                const issues = data.messages;
                console.log(data.errors);
                debugSection.html(`<div id='error' class='alert alert-danger'>
                        <svg xmlns='https://www.w3.org/2000/svg' aria-hidden='true' focusable='false' width='16px' height='16px' viewBox='0 0 24 24' fill='currentColor'>
                            <path d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z'></path>
                            <path d='M0 0h24v24H0z' fill='none'></path>
                        </svg>
                        <span>${issues}</span>
                      </div>`);
                $("#error").click(function(){
                    $(this).fadeOut("slow");
                });       
            }                  
        }
    }
}