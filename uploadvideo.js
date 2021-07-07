window.onload = () => {

    $('#frm-envio').submit((ev) => {

        const fd = new FormData(ev.target);

        ev.preventDefault();

        $.ajax({
            url: 'enviar.php',
            data: fd,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (data) {
                
                let resp = null;

                try {

                    resp = JSON.parse(data);

                } catch (err) {
                    console.error('Falha ao obter a resposta: ', err.message);
                }

                alert(`Video ${resp.link} enviado !`);

            },
            error: function (data) {
                console.error(data)
            }
        });

    });

};