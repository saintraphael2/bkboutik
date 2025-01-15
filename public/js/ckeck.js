
        $(document).ready(function () {
            var md5=$.md5('Raphael le meilleur');
            var url=window.location.href
            var cert =url.split('?')
            var result=((md5+md5+md5)===cert[1]);

            if(!result)
                window.location.href='welcome'
        });
 