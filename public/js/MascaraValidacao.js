function Mascara(tipo, campo, teclaPress) {
    if (window.event) {
        var tecla = teclaPress.keyCode;
    } else {
        tecla = teclaPress.which;
    }
    var s = new String(campo.value);
    // Remove todos os caracteres à seguir: ( ) / - . e espaço, para tratar a string denovo.
    s = s.replace(/(\.|\(|\)|\/|\-| )+/g, '');
    tam = s.length + 1;
    if (tecla != 9 && tecla != 8) {
        switch (tipo) {
            case 'cpf' :
                if (tam > 3 && tam < 7) {
                    campo.value = s.substr(0, 3) + '.' + s.substr(3, tam);
                }
                if (tam >= 7 && tam < 10) {
                    campo.value = s.substr(0, 3) + '.' + s.substr(3, 3) + '.' + s.substr(6, tam - 6);
                }
                if (tam >= 10 && tam < 12) {
                    campo.value = s.substr(0, 3) + '.' + s.substr(3, 3) + '.' + s.substr(6, 3) + '-' + s.substr(9, tam - 9);
                }
                if (tam == 12) {

                    $("input:text:eq(3):visible").focus();
                    // document.customer.name.focus();


                }
                break;
            case 'cnpj' :
                if (tam > 2 && tam < 6) {
                    campo.value = s.substr(0, 2) + '.' + s.substr(2, tam);
                }
                if (tam >= 6 && tam < 9) {
                    campo.value = s.substr(0, 2) + '.' + s.substr(2, 3) + '.' + s.substr(5, tam - 5);
                }
                if (tam >= 9 && tam < 13) {
                    campo.value = s.substr(0, 2) + '.' + s.substr(2, 3) + '.' + s.substr(5, 3) + '/' + s.substr(8, tam - 8);
                }
                if (tam >= 13 && tam < 15) {
                    campo.value = s.substr(0, 2) + '.' + s.substr(2, 3) + '.' + s.substr(5, 3) + '/' + s.substr(8, 4) + '-' + s.substr(12, tam - 12);
                }
                if (tam == 15) {
                    $("input:text:eq(12):visible").focus();

                }
                break;


            case 'phone' :
                if (tam > 2 && tam < 7) {
                    campo.value = '(' + s.substr(0, 2) + ') ' + s.substr(2, tam);
                }
                if (tam >= 7 && tam < 11) {
                    campo.value = '(' + s.substr(0, 2) + ') ' + s.substr(2, 4) + '-' + s.substr(6, tam - 6);

                }
                if (tam > 11 && tam < 13) {
                    campo.value = '(' + s.substr(0, 2) + ') ' + s.substr(2, 5) + '-' + s.substr(7, tam - 7);

                }
                if (tam == 12) {
                    $("input:text:eq(10):visible").focus();
                }
                break;

            case 'cellphone' :
                if (tam > 2 && tam < 7) {
                    campo.value = '(' + s.substr(0, 2) + ') ' + s.substr(2, tam);
                }
                if (tam >= 7 && tam < 11) {
                    campo.value = '(' + s.substr(0, 2) + ') ' + s.substr(2, 4) + '-' + s.substr(6, tam - 6);

                }
                if (tam > 11 && tam < 13) {
                    campo.value = '(' + s.substr(0, 2) + ') ' + s.substr(2, 5) + '-' + s.substr(7, tam - 7);

                }
                if (tam == 12) {
                    $("input:text:eq(11):visible").focus();
                }
                break;



            case 'rg' :

                if (tam > 2 && tam < 5) {
                    campo.value = s.substr(0, 1) + '.' + s.substr(1, tam);
                }
                if (tam >= 5 && tam < 8) {
                    campo.value = s.substr(0, 1) + '.' + s.substr(1, 3) + '.' + s.substr(4, tam - 4);
                }
                if (tam >= 8 && tam < 9) {
                    campo.value = s.substr(0, 1) + '.' + s.substr(1, 3) + '.' + s.substr(4, 3) + '-' + s.substr(7, tam - 7);
                }
                if (tam > 9 && tam < 12) {
                    campo.value = s.substr(0, 2) + '.' + s.substr(2, 3) + '.' + s.substr(5, 3) + '-' + s.substr(8, tam - 8);
                }

                if (tam == 12) {
                    document.customer.cpf.blur();

                }
                break;

            case 'cep' :
                if (tam > 5 && tam < 10) {
                    campo.value = s.substr(0, 5) + '-' + s.substr(5, tam);
                    //campo.value = s.substr(0,2) + '.' + s.substr(2, tam);
                }
                if (tam >= 6 && tam < 9) {
                    campo.value = s.substr(0, 5) + '-' + s.substr(5, 3) + s.substr(8, tam - 8);
                    //   campo.value = s.substr(0,2) + '.' + s.substr(2,3)  + '-' +  s.substr(5, tam-5);

                }
                if (tam == 9) {
                    $("input:text:eq(9):visible").focus();
                }
                break;

            case 'birthday' :
                if (tam > 2 && tam < 5) {
                    campo.value = s.substr(0, 2) + '/' + s.substr(2, tam);
                }
                if (tam >= 5 && tam < 9) {
                    campo.value = s.substr(0, 2) + '/' + s.substr(2, 2) + '/' + s.substr(4, tam - 4);

                }
                if (tam == 9) {
                    // document.customer.neighborhood.focus();
                    $("input:text:eq(13):visible").focus();
                }
                break;
        }
    }
}




//--->Função para verificar se o valor digitado é número...<---
function digitos(event) {
    if (window.event) {
        // IE
        key = event.keyCode;
    } else if (event.which) {
        // netscape
        key = event.which;
    }
    if (key != 8 || key != 13 || key < 48 || key > 57) {
        return (((key > 47) && (key < 58)) || (key == 8) || (key == 13));
        return true;
    }
}

function SomenteLetras(e) {
    var tecla = (window.event) ? event.keyCode : e.which;
    if ((tecla > 65 && tecla < 90) || (tecla > 97 && tecla < 122))
        return true;
    else {
        if (tecla != 8)
            return false;
        else
            return true;
    }
}

// INICIO FUNÇÃO DE MASCARA MAIUSCULA
function maiuscula(z) {
    v = z.value.toUpperCase();
    z.value = v;
}
//FIM DA FUNÇÃO MASCARA MAIUSCULA
/*Como usar a função 
 <label>Nome:
 <input name="nome" type="text" id="nome" size="50" onkeyup="maiuscula(this)" />
 </label>
 */

// INICIO FUNÇÃO DE MASCARA MINUSCULA
function minuscula(z) {
    v = z.value.toLowerCase();
    z.value = v;
}
//FIM DA FUNÇÃO MASCARA MINUSCULA
/*<label>Nome:
 <input name="nome" type="text" id="nome" size="50" onkeyup="minuscula(this)" />
 </label>		
 */

function ValidaCep(cep) {
    var uncep = cep.value;
    if (uncep == 0) {
        mudarCorCampo(cep, '#FFFFFF')
        return;
    }
    exp = /\d{2}\.\d{3}\-\d{3}/
    if (!exp.test(cep.value)) {

        alert('Numero de Cep Invalido!');

        mudarCorCampo(cep, '#FFFBBF')
        document.cep.focus();
    } else {
        mudarCorCampo(cep, '#FFFFFF')

    }
}


//valida o CPF digitado
function ValidarCPF(Objcpf) {
    var cpf = Objcpf.value;
        if (cpf == 0) {
            mudarCorCampo(document.customer.cpf, '#FFFBBF');
            document.customer.cpf.focus();
            return;
        }

        exp = /\.|\-/g
        cpf = cpf.toString().replace(exp, "");
        var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
        var soma1 = 0, soma2 = 0;
        var vlr = 11;

        for (i = 0; i < 9; i++) {
            soma1 += eval(cpf.charAt(i) * (vlr - 1));
            soma2 += eval(cpf.charAt(i) * vlr);
            vlr--;
        }
        soma1 = (((soma1 * 10) % 11) == 10 ? 0 : ((soma1 * 10) % 11));
        soma2 = (((soma2 + (2 * soma1)) * 10) % 11);

        var digitoGerado = (soma1 * 10) + soma2;

        if (digitoGerado != digitoDigitado) {
            alert('CPF Invalido!');
            //  $("input:text:eq(2):visible").focus();
            document.customer.cpf.focus();
            mudarCorCampo(document.customer.cpf, '#FFFBBF');




        } else {
            mudarCorCampo(document.customer.cpf, '#dff0d8');
            document.customer.name.focus();


            //$("input:text:eq(3):visible").focus();
        }
    
}

function mudarCorCampo(elemento, cor) {
    elemento.style.backgroundColor = cor;
}


//valida o CNPJ digitado

function ValidarCNPJ(ObjCnpj) {
    var cnpj = ObjCnpj.value;
    var ncnpj = cnpj;
    if (ncnpj == 0) {
        mudarCorCampo(ObjCnpj, '#FFFFFF')
        return;
    }
    var valida = new Array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
    var dig1 = new Number;
    var dig2 = new Number;

    exp = /\.|\-|\//g
    cnpj = cnpj.toString().replace(exp, "");
    var digito = new Number(eval(cnpj.charAt(12) + cnpj.charAt(13)));

    for (i = 0; i < valida.length; i++) {
        dig1 += (i > 0 ? (cnpj.charAt(i - 1) * valida[i]) : 0);
        dig2 += cnpj.charAt(i) * valida[i];
    }
    dig1 = (((dig1 % 11) < 2) ? 0 : (11 - (dig1 % 11)));
    dig2 = (((dig2 % 11) < 2) ? 0 : (11 - (dig2 % 11)));

    if (((dig1 * 10) + dig2) != digito) {
        alert('CNPJ Invalido!');
        mudarCorCampo(ObjCnpj, '#FFFBBF')
        document.customer.cnpj.focus();


    } else {
        mudarCorCampo(ObjCnpj, '#FFFFFF')
        document.customer.dados_cliente.focus();

    }
}


//adiciona mascara ao RG
function MascaraRG(rg) {
    if ((rg) == false) {
        event.returnValue = false;
    }
    return formataCampo(rg, '00.000.000-0', event);
}

function ValidaEmail(Objemail) {

    if (Objemail.value.length > 0) {

        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (!filter.test(document.getElementById("email").value)) {
            alert('Por favor, digite um email valido');
            mudarCorCampo(Objemail, '#FFFBBF')
            document.customer.email.focus();



        } else {
            mudarCorCampo(Objemail, '#dff0d8')
            document.customer.street.focus();

        }
    }
    if (Objemail.value.length == 0) {
        mudarCorCampo(Objemail, '#FFFBBF')
        document.customer.street.focus();

    }
}

function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if ((whichCode == 13) || (whichCode == 0) || (whichCode == 8))
        return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1)
        return false; // Chave inválida
    len = objTextBox.value.length;
    for (i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal))
            break;
    aux = '';
    for (; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1)
            aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0)
        objTextBox.value = '';
    if (len == 1)
        objTextBox.value = '0' + SeparadorDecimal + '0' + aux;
    if (len == 2)
        objTextBox.value = '0' + SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
            objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}








