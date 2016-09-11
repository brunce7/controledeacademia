/*
 * Plugins para manipulação de Object para serem utilizando em fomulário HTML
 * @author Weslley Alves
 * @email wesshead@gmail.com
 * @version v0.0.2
 * @date 2011-12-19
 */
(function($){
   /*
     * Método que irá setar os valores nos campos do Form referente ao Object passado
     * via parâmetro.
     * @param {Object} data Obejto com os dados para os campos do Formulário
     * @return {Wrapped} Retorna o Elemento do Formulário
     * @use O atributo do Object ("nome") seja igual ao valor do atributo "name" do campo.
     * @example
     * HTML: <input id="nome" name="nome" type="text" />
     * Chamada: $('form').loadData({'nome':'Weslley Alves'});
     *
     **/
    $.fn.loadData = function(data){
        // Interando sobre o Object passado e setando os valores nos campos
        for(var campo in data){
            // Recuperando o elemento do campo
            var el = $(this).find('[name="'+ campo +'"]');
            
            // Verificando se foi resgatado mais de um Objeto
            if(el.length > 1){
                // LOOP para verificar se deve ser setado o valor
                $(el).each(function(i,v){
                    // Setando o valor no Elemento
                    $(this).setValue(data[campo]);
                });
            } else{
                // Setando o valor no Elemento
                $(el).setValue(data[campo]);
            }
        } // Fim da interação no Objeto com os dados
        
        // Retornando o Elemento do Formulário
        return this;
    }

   /*
     * Método que irá setar o valor passado via parâmetro no Elemento referênciado
     * @param {Number/String} value Valor a ser setado no Elemento referênciado
     * @return {Element} Retorna o Elemento referênciado
     * @use Deve ser chamado este método através do Elemento HTML.
     * @example
     * HTML: <input id="nome" name="nome" type="text" />
     * Chamada: $('#nome').setValue('Weslley Alves');
    */
    $.fn.setValue = function(value){
        // Campo "checkbox" ou "radio"
        if($(this).is('input[type=checkbox]') || $(this).is('input[type=radio]')){
            // Verificando se o valor do elemento é igual ao passado no Object
            if($(this).is('input[value='+ value +']')){
               // $(this).attr('checked', true);
               $(this).prop("checked", true); 
            }
        } else { // Demais campos
            $(this).val(value);
        }

        // Retornando o Elemento referênciado
        return this;
    }
})(jQuery);
/*
(function($) {
    $.fn.radioSel = function(valueToSel){
         
        Como usar
        » Marca o radio cujo valor é 'F';
          $('input[id=sexo]').radioSel('F')
        » Retorna o valor do radio selecionado ou 'false' caso nenhum esteja marcado;
          $('input[id=sexo]').radioSel()
        » Limpa todos o radio marcado;
          $('input[id=sexo]').radioSel('')
        
 
        if(arguments.length>0){
            if(valueToSel!=''){
                return this.each(function(){ // itera sobre cada elemento encontrado
                    if($(this).val()==valueToSel)this.checked = true;
                })
            }else{ //Se veio vazio é para limpar todas as marcações
                return this.each(function(){ this.checked = false; })
            }
        }else{
            valorSelecionado = false;
            this.each(function(){ // itera sobre cada elemento encontrado
                if(this.checked){
                    valorSelecionado = $(this).val();
                    return valorSelecionado;
                }
            });
            return valorSelecionado;
        }
    };
})(jQuery);

*/
