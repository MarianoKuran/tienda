window.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('traducir', function (e) {
        window.location.reload();
    });

    let idiomaCodigo = $('#idiomaCodigo').val();
    const encodedParams = new URLSearchParams();
      
    function traducir(idiomaCodigo) {
        let res = obtenerElementosTraducibles();
        if(res.traducir){
            for (const i of res.traducibles) {
                encodedParams.set('source_language', 'es');
                encodedParams.set('target_language', 'en');
                encodedParams.set('text', i.innerText);

                const options = {
                    async: true,
	                crossDomain: true,
                    method: 'POST',
                    url: 'https://text-translator2.p.rapidapi.com/translate',
                    headers: {
                        'content-type': 'application/x-www-form-urlencoded',
                        'X-RapidAPI-Key': '7c0b355f48mshce4d287a1c9a5c7p16cdc0jsn6443bc77aa30',
                        'X-RapidAPI-Host': 'text-translator2.p.rapidapi.com'
                    },
                    data: {
                        source_language: 'es',
                        target_language: idiomaCodigo,
                        text: i.innerText
                    }
                };
                $.ajax(options).done(function(res) {
                    mostrarTraduccion(res.data, i)
                });
            }
        };
    }

    function obtenerElementosTraducibles() {
        let traducibles = $('.tag-traducible');
        if (traducibles.length) {
            return {'traducibles':traducibles, 'traducir':true};
        } else {
            return {'traducir':false};
        };
    }

    function mostrarTraduccion(data, traducible) {
        traducible.innerText = data.translatedText;
    }

    if (idiomaCodigo != 'es') {
        traducir(idiomaCodigo);
    }
});