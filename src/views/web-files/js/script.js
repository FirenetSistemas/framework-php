$(document).ready(function() {
    
    //var url_principal = '/';
    var url_principal = '/basico_melhor/';

    $(".valida-cnpj").mask("99.999.999/9999-99");
    $(".valida-inscricao_estadual").mask("99.999.999");
    $(".valida-cpf").mask("999.999.999-99");
    $(".valida-cep").mask("99.999-999");
    $(".valida-data").mask("99/99/9999");
    $(".valida-hora").mask("99:99");
    
    $(function(){
        $(".valida-numeros").bind("keyup blur focus", function(e) {
            e.preventDefault();
            var expre = /[^0-9]/g;
            // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
            if ($(this).val().match(expre))
                $(this).val($(this).val().replace(expre,''));
        });
    });

    $(".valida-telefone").mask("(99) 9999-9999?9").ready(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 9999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

    $(".valida-celular").mask("(99) 99999-9999?9").ready(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 99999-9999?9");
        }
    });
    

    $(".form_validar").validate({
        eachInvalidField : function() {
            $(this).css('background', '#FFEAEA');
            $(this).attr("placeholder", "Falta preencher");
        },
        eachValidField : function() {
            $(this).css('background', '#FFFFFF');
            $(this).attr("placeholder", "");
        }
    });
    
});